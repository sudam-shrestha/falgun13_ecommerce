<x-frontend-layout>

    <!-- ========== BREADCRUMB ========== -->
    <div class="container py-4">
        <nav class="flex text-sm text-[var(--text-soft)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)]">Home</a>
            <span class="mx-2">/</span>
            <span class="text-[var(--primary)]">Order History</span>
        </nav>
    </div>

    <!-- ========== ORDER HISTORY HEADER ========== -->
    <section class="pb-8">
        <div class="container">
            <h1 class="text-3xl md:text-4xl font-bold text-[var(--primary)] mb-2">
                Order History
            </h1>
            <p class="text-[var(--text-soft)]">{{ $orders->count() }} {{ Str::plural('order', $orders->count()) }} found</p>
        </div>
    </section>

    <!-- ========== ORDER HISTORY CONTENT ========== -->
    <section class="section-gap">
        <div class="container">

            @if ($orders->count() > 0)
                <div class="space-y-6">

                    @foreach ($orders as $order)
                        <!-- Order Card -->
                        <div class="bg-white rounded-2xl shadow-sm border border-[var(--border-light)] overflow-hidden">

                            <!-- Order Header -->
                            <div class="bg-[var(--surface)] px-6 py-4 border-b border-[var(--border-light)] flex flex-wrap items-center justify-between gap-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 bg-[var(--accent-soft-30)] rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-receipt text-[var(--primary)]"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-[var(--text-soft)]">Order #{{ $order->id }}</p>
                                        <p class="text-sm font-medium text-[var(--text-dark)]">
                                            Placed on {{ $order->created_at->format('F j, Y') }}
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4">
                                    <!-- Payment Status Badge -->
                                    <span class="px-3 py-1 rounded-full text-xs font-medium
                                        @if($order->payment_status == 'Completed') bg-green-100 text-green-700
                                        @elseif($order->payment_status == 'Pending') bg-yellow-100 text-yellow-700
                                        @elseif($order->payment_status == 'Failed') bg-red-100 text-red-700
                                        @else bg-gray-100 text-gray-700 @endif">
                                        <i class="fa-regular
                                            @if($order->payment_status == 'Completed') fa-circle-check
                                            @elseif($order->payment_status == 'Pending') fa-clock
                                            @elseif($order->payment_status == 'Failed') fa-circle-exclamation
                                            @else fa-circle @endif mr-1"></i>
                                        {{ $order->payment_status ?? 'Processing' }}
                                    </span>

                                    <span class="text-sm text-[var(--text-soft)]">
                                        <i class="fa-regular fa-store"></i>
                                        @php
                                            $uniqueDokans = $order->items->groupBy('product.dokan_id');
                                        @endphp
                                        {{ $uniqueDokans->count() }} {{ Str::plural('Seller', $uniqueDokans->count()) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Order Items List -->
                            <div class="divide-y divide-[var(--border-light)]">
                                @foreach ($order->items as $item)
                                    @php
                                        $product = $item->product;
                                        $product->images = $product->images;
                                        $itemTotal = $item->amount;
                                    @endphp

                                    <div class="p-6">
                                        <div class="flex gap-4">
                                            <!-- Product Image -->
                                            <div class="w-24 h-24 flex-shrink-0 bg-[#f5f2ee] rounded-lg overflow-hidden">
                                                @if($product && $product->images && count($product->images) > 0)
                                                    <img src="{{ asset(Storage::url($product->images[0])) }}"
                                                        alt="{{ $product->name ?? 'Product' }}" class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fa-solid fa-image text-gray-400 text-3xl"></i>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Product Details -->
                                            <div class="flex-1">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <h3 class="font-semibold text-[var(--text-dark)]">
                                                            {{ $product->name ?? 'Product Unavailable' }}
                                                        </h3>

                                                        <!-- Seller Info -->
                                                        <p class="text-sm text-[var(--text-soft)] mt-1">
                                                            <i class="fa-regular fa-store"></i>
                                                            {{ $product->dokan->name ?? 'Seller' }}
                                                        </p>

                                                        <!-- Price -->
                                                        <div class="flex items-baseline gap-2 mt-2">
                                                            <span class="text-lg font-bold text-[var(--primary)]">
                                                                Rs.{{ number_format($item->amount / $item->qty, 0) }}
                                                            </span>
                                                            <span class="text-sm text-[var(--text-soft)]">
                                                                × {{ $item->qty }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <!-- Item Total -->
                                                    <div class="text-right">
                                                        <p class="text-sm text-[var(--text-soft)]">Total</p>
                                                        <p class="font-bold text-[var(--primary)]">
                                                            Rs.{{ number_format($item->amount, 0) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Order Footer -->
                            <div class="bg-[var(--surface)] px-6 py-4 border-t border-[var(--border-light)]">
                                <div class="flex flex-wrap items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-[var(--text-soft)]">Total Amount</p>
                                        <p class="text-2xl font-bold text-[var(--primary)]">
                                            Rs.{{ number_format($order->total_amount, 0) }}
                                        </p>
                                    </div>

                                    <div class="flex gap-3">
                                        @if($order->payment_status != 'Completed')
                                            <a href="{{route('payment.retry', $order->id)}}" class="btn-primary px-6 py-2.5 retry-payment">
                                                <i class="fa-solid fa-rotate-right mr-2"></i> Retry Payment
                                            </a>
                                        @endif

                                        <button class="border border-[var(--border-light)] px-6 py-2.5 rounded-lg hover:bg-[var(--surface)] transition view-details"
                                                data-order-id="{{ $order->id }}">
                                            <i class="fa-regular fa-eye mr-2"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty Order History -->
                <div class="text-center py-16">
                    <div class="w-32 h-32 mx-auto bg-[var(--surface)] rounded-full flex items-center justify-center mb-6">
                        <i class="fa-regular fa-receipt text-5xl text-[var(--border-light)]"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[var(--text-dark)] mb-3">No orders yet</h2>
                    <p class="text-[var(--text-soft)] mb-8">You haven't placed any orders yet. Start shopping to see your orders here.</p>
                    <a href="{{ route('products') }}" class="btn-primary inline-flex px-8 py-3">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Start Shopping
                    </a>
                </div>
            @endif

        </div>
    </section>

</x-frontend-layout>

<!-- Order Details Modal -->
<div id="orderModal" class="fixed inset-0 z-50 hidden overflow-y-auto" style="background-color: rgba(0,0,0,0.5);">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="sticky top-0 bg-white border-b border-[var(--border-light)] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[var(--text-dark)]">Order Details</h3>
                <button onclick="closeOrderModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            <div id="orderDetailsContent" class="p-6">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
    .line-clamp-1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // View order details
        document.querySelectorAll('.view-details').forEach(btn => {
            btn.addEventListener('click', async function() {
                const orderId = this.dataset.orderId;
                const modal = document.getElementById('orderModal');
                const contentDiv = document.getElementById('orderDetailsContent');

                // Show loading state
                contentDiv.innerHTML = '<div class="text-center py-8"><i class="fa-solid fa-spinner fa-spin text-2xl text-[var(--primary)]"></i><p class="mt-2">Loading order details...</p></div>';
                modal.classList.remove('hidden');

                try {
                    const response = await fetch(`{{ url('order/details') }}/${orderId}`);
                    const data = await response.json();

                    if (data.success) {
                        displayOrderDetails(data.order);
                    } else {
                        contentDiv.innerHTML = '<div class="text-center py-8 text-red-600">Failed to load order details</div>';
                    }
                } catch (error) {
                    console.error('Failed to load order details:', error);
                    contentDiv.innerHTML = '<div class="text-center py-8 text-red-600">Failed to load order details</div>';
                }
            });
        });
    });

    function displayOrderDetails(order) {
        const contentDiv = document.getElementById('orderDetailsContent');

        let itemsHtml = '';
        order.order_items.forEach(item => {
            itemsHtml += `
                <div class="flex gap-4 py-4 border-b border-[var(--border-light)]">
                    <div class="w-20 h-20 flex-shrink-0 bg-[#f5f2ee] rounded-lg overflow-hidden">
                        ${item.product && item.product.images && item.product.images.length > 0 ?
                            `<img src="{{ asset('storage/') }}/${item.product.images[0]}" alt="${item.product.name}" class="w-full h-full object-cover">` :
                            '<div class="w-full h-full flex items-center justify-center"><i class="fa-solid fa-image text-gray-400 text-2xl"></i></div>'
                        }
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold text-[var(--text-dark)]">${item.product ? item.product.name : 'Product Unavailable'}</h4>
                        <p class="text-sm text-[var(--text-soft)] mt-1">Quantity: ${item.qty}</p>
                        <div class="flex justify-between items-center mt-2">
                            <span class="font-bold text-[var(--primary)]">Rs.${(item.amount / item.qty).toLocaleString()}</span>
                            <span class="font-medium">Total: Rs.${item.amount.toLocaleString()}</span>
                        </div>
                    </div>
                </div>
            `;
        });

        contentDiv.innerHTML = `
            <div class="space-y-4">
                <!-- Order Info -->
                <div class="bg-[var(--surface)] p-4 rounded-lg">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-[var(--text-soft)]">Order ID</p>
                            <p class="font-medium">#${order.id}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[var(--text-soft)]">Order Date</p>
                            <p class="font-medium">${new Date(order.created_at).toLocaleDateString()}</p>
                        </div>
                        <div>
                            <p class="text-sm text-[var(--text-soft)]">Payment Status</p>
                            <p class="font-medium">
                                <span class="px-2 py-1 rounded-full text-xs font-medium
                                    ${order.payment_status === 'Completed' ? 'bg-green-100 text-green-700' :
                                      order.payment_status === 'Pending' ? 'bg-yellow-100 text-yellow-700' :
                                      'bg-red-100 text-red-700'}">
                                    ${order.payment_status || 'Processing'}
                                </span>
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-[var(--text-soft)]">Total Amount</p>
                            <p class="font-bold text-[var(--primary)] text-lg">Rs.${order.total_amount.toLocaleString()}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div>
                    <h4 class="font-bold text-[var(--text-dark)] mb-3">Order Items</h4>
                    <div class="space-y-2">
                        ${itemsHtml}
                    </div>
                </div>
            </div>
        `;
    }

    function closeOrderModal() {
        document.getElementById('orderModal').classList.add('hidden');
    }

    // Close modal when clicking outside
    document.getElementById('orderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeOrderModal();
        }
    });
</script>
