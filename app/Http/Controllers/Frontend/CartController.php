<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with(['product', 'dokan'])
            ->where('user_id', Auth::id())
            ->get();

        // Group cart items by dokan
        $groupedCart = $cartItems->groupBy('dokan_id');

        // Calculate totals for each dokan group
        $dokanTotals = [];
        $grandTotal = 0;

        foreach ($groupedCart as $dokanId => $items) {
            $dokanTotal = 0;
            foreach ($items as $item) {
                $discountedPrice = $item->product->price - ($item->product->discount * $item->product->price) / 100;
                $itemTotal = $discountedPrice * $item->qty;
                $dokanTotal += $itemTotal;
            }
            $dokanTotals[$dokanId] = $dokanTotal;
            $grandTotal += $dokanTotal;
        }

        return view('frontend.carts', compact('groupedCart', 'dokanTotals', 'grandTotal'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to add items to cart',
                'redirect' => route('google.redirect')
            ]);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        // Calculate discounted price
        $discountedPrice = $product->price - ($product->discount * $product->price) / 100;
        $amount = $discountedPrice * $request->qty;

        // Check if product already in cart
        $existingCart = Cart::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingCart) {
            // Update quantity
            $existingCart->qty += $request->qty;
            $existingCart->amount = $discountedPrice * $existingCart->qty;
            $existingCart->save();
        } else {
            // Create new cart item
            Cart::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'dokan_id' => $product->dokan_id,
                'qty' => $request->qty,
                'amount' => $amount
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => Cart::where('user_id', Auth::id())->count()
        ]);
    }


    public function update(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Cart::where('id', $request->cart_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $product = $cart->product;
        $discountedPrice = $product->price - ($product->discount * $product->price) / 100;

        $cart->qty = $request->qty;
        $cart->amount = $discountedPrice * $request->qty;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!',
            'amount' => $cart->amount
        ]);
    }

    public function delete($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cart->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from cart!'
        ]);
    }

    public function clear_cart()
    {
        Cart::where('user_id', Auth::id())->delete();

        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }
}
