<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout(Request $request, $id)
    {
        $order = new Order();
        $order->dokan_id = $id;
        $order->total_amount = $request->total_amt;
        $order->user_id = Auth::guard('web')->user()->id;
        $order->save();

        $carts = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->where('dokan_id', $id)
            ->get();

        foreach ($carts as $cart) {
            $data = new OrderItem();
            $data->order_id = $order->id;
            $data->product_id = $cart->product_id;
            $data->qty = $cart->qty;
            $data->amount = $cart->amount;
            $data->save();
            $cart->delete();
        }

        $url = env('KHALTI_BASE_URL') . '/epayment/initiate/';

        $response = Http::withHeaders([
            "Authorization" => "Key " . env('KHALTI_SECRET')
        ])->post($url, [
            "return_url" => route('khalti.callback'),
            "website_url" => env("APP_URL"),
            "amount" => $order->total_amount * 100,
            "purchase_order_id" => $order->id,
            "purchase_order_name" => "Order #" . $order->id
        ]);

        return redirect($response["payment_url"]);
    }

    public function payment_retry($id)
    {
        $order = Order::find($id);

        $url = env('KHALTI_BASE_URL') . '/epayment/initiate/';

        $response = Http::withHeaders([
            "Authorization" => "Key " . env('KHALTI_SECRET')
        ])->post($url, [
            "return_url" => route('khalti.callback'),
            "website_url" => env("APP_URL"),
            "amount" => $order->total_amount * 100,
            "purchase_order_id" => $order->id,
            "purchase_order_name" => "Order #" . $order->id
        ]);

        return redirect($response["payment_url"]);
    }

    public function callback(Request $request)
    {
        // return $request->all();
        $order = Order::find($request["purchase_order_id"]);
        $order->payment_status = $request["status"];
        $order->save();
        return redirect()->route('order.history');
    }

    public function history()
    {
        $orders = Order::orderBy('id', 'desc')->where('user_id', Auth::id())->get();
        return view("frontend.order_history", compact('orders'));
    }

    public function getOrderDetails($id)
    {
        try {
            $order = Order::with(['items.product.dokan'])->find($id);

            if (!$order || $order->user_id != Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Order not found'
                ], 404);
            }

            // Format the order data properly
            $orderData = [
                'id' => $order->id,
                'total_amount' => $order->total_amount,
                'payment_status' => $order->payment_status,
                'created_at' => $order->created_at,
                'order_items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'qty' => $item->qty,
                        'amount' => $item->amount,
                        'product' => $item->product ? [
                            'id' => $item->product->id,
                            'name' => $item->product->name,
                            'images' => $item->product->images,
                            'dokan' => $item->product->dokan ? [
                                'id' => $item->product->dokan->id,
                                'name' => $item->product->dokan->name
                            ] : null
                        ] : null
                    ];
                })
            ];

            return response()->json([
                'success' => true,
                'order' => $orderData
            ]);
        } catch (\Exception $e) {
            Log::error('Order details error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to load order details: ' . $e->getMessage()
            ], 500);
        }
    }


    public function dokan_order($record)
    {
        $order = Order::with(['items.product.dokan', 'user'])->find($record);

        // Check if the logged-in dokan owns this order's products
        $dokanId = Auth::guard('dokan')->id();
        $items = $order->items->filter(function ($item) use ($dokanId) {
            return $item->product && $item->product->dokan_id == $dokanId;
        });

        if ($items->isEmpty()) {
            abort(403, 'Unauthorized access to this order');
        }

        $subtotal = $items->sum('amount');

        return view("frontend.dokan_order", compact('order', 'items', 'subtotal'));
    }

    public function downloadDokanReceipt($id)
    {
        $order = Order::with(['items.product.dokan', 'user'])->find($id);

        // Check if the logged-in dokan owns this order's products
        $dokanId = Auth::guard('dokan')->id();
        $items = $order->items->filter(function ($item) use ($dokanId) {
            return $item->product && $item->product->dokan_id == $dokanId;
        });

        if ($items->isEmpty()) {
            abort(403, 'Unauthorized access to this order');
        }

        $subtotal = $items->sum('amount');
        $dokan = $items->first()->product->dokan;

        $pdf = Pdf::loadView('pdf.dokan_receipt', compact('order', 'items', 'subtotal', 'dokan'));

        return $pdf->download('order-receipt-' . $order->id . '.pdf');
    }
}
