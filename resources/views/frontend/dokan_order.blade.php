<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details #{{ $order->id }} - {{ $dokan->name ?? 'Dokan' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @media print {
            .no-print {
                display: none;
            }

            .print-only {
                display: block;
            }

            body {
                padding: 0;
                margin: 0;
            }
        }

        .print-only {
            display: none;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- Header Actions -->
    <div class="no-print bg-white border-b border-gray-200 sticky top-0 z-10">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <a href="{{ url('/dokan') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fa-solid fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <h1 class="text-xl font-bold text-gray-800">Order Details</h1>
                </div>
                <div class="flex gap-3">
                    <button onclick="window.print()"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Print Receipt
                    </button>
                    <a href="{{ route('dokan.receipt.download', $order->id) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center gap-2">
                        <i class="fa-solid fa-download"></i> Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <!-- Order Receipt -->
        <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden">

            <!-- Receipt Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-6">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold mb-2">ORDER RECEIPT</h1>
                        <p class="text-blue-100">Order #{{ $order->id }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $dokan = $items->first()->product->dokan ?? null;
                        @endphp
                        @if ($dokan)
                            <div class="text-2xl font-bold mb-1">{{ $dokan->name }}</div>
                            <p class="text-sm text-blue-100">{{ $dokan->address ?? 'Dokan Address' }}</p>
                            <p class="text-sm text-blue-100">{{ $dokan->phone ?? 'Phone: N/A' }}</p>
                            <p class="text-sm text-blue-100">{{ $dokan->email ?? 'Email: N/A' }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Order Info -->
            <div class="px-8 py-6 border-b border-gray-200">
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Customer Information</h3>
                        <div class="space-y-1">
                            <p class="text-gray-800"><i class="fa-regular fa-user mr-2"></i>
                                {{ $order->user->name ?? 'N/A' }}</p>
                            <p class="text-gray-800"><i class="fa-regular fa-envelope mr-2"></i>
                                {{ $order->user->email ?? 'N/A' }}</p>
                            @if ($order->user->phone)
                                <p class="text-gray-800"><i class="fa-regular fa-phone mr-2"></i>
                                    {{ $order->user->phone }}</p>
                            @endif
                        </div>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase mb-2">Order Information</h3>
                        <div class="space-y-1">
                            <p class="text-gray-800"><i class="fa-regular fa-calendar mr-2"></i> Order Date:
                                {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                            <p class="text-gray-800">
                                <i class="fa-regular fa-circle-check mr-2"></i>
                                Payment Status:
                                <span
                                    class="font-semibold
                                    @if ($order->payment_status == 'Completed') text-green-600
                                    @elseif($order->payment_status == 'Pending') text-yellow-600
                                    @else text-red-600 @endif">
                                    {{ $order->payment_status ?? 'Pending' }}
                                </span>
                            </p>
                            <p class="text-gray-800">
                                <i class="fa-regular fa-truck mr-2"></i>
                                Order Status:
                                <span
                                    class="font-semibold
                                    @if ($order->status == 'delivered') text-green-600
                                    @elseif($order->status == 'processing') text-blue-600
                                    @else text-yellow-600 @endif">
                                    {{ ucfirst($order->status ?? 'Pending') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items Table -->
            <div class="px-8 py-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Order Items</h3>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="text-left py-3 px-4 text-sm font-semibold text-gray-600">Product</th>
                                <th class="text-center py-3 px-4 text-sm font-semibold text-gray-600">Quantity</th>
                                <th class="text-right py-3 px-4 text-sm font-semibold text-gray-600">Unit Price</th>
                                <th class="text-right py-3 px-4 text-sm font-semibold text-gray-600">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $item)
                                @php
                                    $product = $item->product;
                                    $unitPrice = $item->amount / $item->qty;
                                @endphp
                                <tr>
                                    <td class="py-4 px-4">
                                        <div class="flex items-center gap-3">
                                            @if ($product && $product->images && count($product->images) > 0)
                                                <img src="{{ asset('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <div
                                                    class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center">
                                                    <i class="fa-solid fa-image text-gray-400"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="font-medium text-gray-800">
                                                    {{ $product->name ?? 'Product Unavailable' }}</p>
                                                @if ($product && $product->sku)
                                                    <p class="text-xs text-gray-500">SKU: {{ $product->sku }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center py-4 px-4 text-gray-800">{{ $item->qty }}</td>
                                    <td class="text-right py-4 px-4 text-gray-800">Rs.
                                        {{ number_format($unitPrice, 2) }}</td>
                                    <td class="text-right py-4 px-4 font-medium text-gray-800">Rs.
                                        {{ number_format($item->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="text-right py-3 px-4 font-semibold text-gray-600">Subtotal
                                </td>
                                <td class="text-right py-3 px-4 font-semibold text-gray-800">Rs.
                                    {{ number_format($subtotal, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-right py-3 px-4 font-semibold text-gray-600">Shipping
                                </td>
                                <td class="text-right py-3 px-4 text-gray-800">Calculated at checkout</td>
                            </tr>
                            <tr class="border-t-2 border-gray-300">
                                <td colspan="3" class="text-right py-3 px-4 text-lg font-bold text-gray-800">Total
                                </td>
                                <td class="text-right py-3 px-4 text-xl font-bold text-blue-600">Rs.
                                    {{ number_format($subtotal, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="bg-gray-50 px-8 py-6 border-t border-gray-200">
                <div class="text-center text-sm text-gray-600">
                    <p class="mb-2">Thank you for your business!</p>
                    <p>For any inquiries, please contact us at {{ $dokan->email ?? 'support@example.com' }} or call
                        {{ $dokan->phone ?? 'N/A' }}</p>
                    <p class="mt-2 text-xs">This is a computer generated receipt and does not require signature.</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
