<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order Receipt #{{ $order->id }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
        }
        .header {
            background: #2563eb;
            color: white;
            padding: 30px;
            margin-bottom: 30px;
        }
        .order-info {
            margin-bottom: 30px;
            padding: 0 30px;
        }
        .info-grid {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .info-box {
            width: 48%;
        }
        .info-title {
            font-size: 14px;
            font-weight: bold;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th {
            background: #f3f4f6;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            color: #666;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .total-row {
            background: #f3f4f6;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            padding: 20px 30px;
            background: #f9fafb;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }
        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        .status-failed {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1 style="margin: 0 0 10px 0;">ORDER RECEIPT</h1>
            <p style="margin: 0; opacity: 0.9;">Order #{{ $order->id }}</p>
            <div style="margin-top: 20px; text-align: right;">
                <strong>{{ $dokan->name }}</strong><br>
                {{ $dokan->address ?? '' }}<br>
                {{ $dokan->phone ?? '' }}<br>
                {{ $dokan->email ?? '' }}
            </div>
        </div>

        <!-- Order Information -->
        <div class="order-info">
            <div class="info-grid">
                <div class="info-box">
                    <div class="info-title">Customer Information</div>
                    <p style="margin: 0;"><strong>{{ $order->user->name ?? 'N/A' }}</strong></p>
                    <p style="margin: 5px 0 0 0;">{{ $order->user->email ?? 'N/A' }}</p>
                    @if($order->user->phone)
                        <p style="margin: 5px 0 0 0;">{{ $order->user->phone }}</p>
                    @endif
                </div>
                <div class="info-box">
                    <div class="info-title">Order Information</div>
                    <p style="margin: 0;"><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y, g:i a') }}</p>
                    <p style="margin: 5px 0 0 0;">
                        <strong>Payment Status:</strong>
                        <span class="status-badge status-{{ strtolower($order->payment_status ?? 'pending') }}">
                            {{ $order->payment_status ?? 'Pending' }}
                        </span>
                    </p>
                    <p style="margin: 5px 0 0 0;">
                        <strong>Order Status:</strong>
                        <span>{{ ucfirst($order->status ?? 'Pending') }}</span>
                    </p>
                </div>
            </div>

            <!-- Order Items Table -->
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-right">Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        @php
                            $product = $item->product;
                            $unitPrice = $item->amount / $item->qty;
                        @endphp
                        <tr>
                            <td>
                                <strong>{{ $product->name ?? 'Product Unavailable' }}</strong>
                                @if($product && $product->sku)
                                    <br><small style="color: #666;">SKU: {{ $product->sku }}</small>
                                @endif
                            </td>
                            <td class="text-center">{{ $item->qty }}</td>
                            <td class="text-right">Rs. {{ number_format($unitPrice, 2) }}</td>
                            <td class="text-right">Rs. {{ number_format($item->amount, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Subtotal</strong></td>
                        <td class="text-right">Rs. {{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right"><strong>Shipping</strong></td>
                        <td class="text-right">Calculated at checkout</td>
                    </tr>
                    <tr style="background: #f3f4f6;">
                        <td colspan="3" class="text-right"><strong style="font-size: 16px;">Total</strong></td>
                        <td class="text-right"><strong style="font-size: 16px; color: #2563eb;">Rs. {{ number_format($subtotal, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0;">Thank you for your business!</p>
            <p style="margin: 10px 0 0 0; font-size: 11px;">For any inquiries, please contact us at {{ $dokan->email ?? 'support@example.com' }}</p>
            <p style="margin: 5px 0 0 0; font-size: 10px;">This is a computer generated receipt and does not require signature.</p>
        </div>
    </div>
</body>
</html>
