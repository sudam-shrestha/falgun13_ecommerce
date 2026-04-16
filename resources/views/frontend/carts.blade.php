<x-frontend-layout>

    <!-- ========== BREADCRUMB ========== -->
    <div class="container py-4">
        <nav class="flex text-sm text-[var(--text-soft)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)]">Home</a>
            <span class="mx-2">/</span>
            <span class="text-[var(--primary)]">Shopping Cart</span>
        </nav>
    </div>

    <!-- ========== CART HEADER ========== -->
    <section class="pb-8">
        <div class="container">
            <h1 class="text-3xl md:text-4xl font-bold text-[var(--primary)] mb-2">
                Shopping Cart
            </h1>
            <p class="text-[var(--text-soft)]">{{ $groupedCart->flatten()->count() }} items in your cart</p>
        </div>
    </section>

    <!-- ========== CART CONTENT ========== -->
    <section class="section-gap">
        <div class="container">

            @if ($groupedCart->count() > 0)
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- Cart Items - Left Column -->
                    <div class="lg:col-span-2 space-y-6">

                        @foreach ($groupedCart as $dokanId => $cartItems)
                            @php
                                $dokan = $cartItems->first()->dokan;
                            @endphp

                            <!-- Dokan Group Card -->
                            <div
                                class="bg-white rounded-2xl shadow-sm border border-[var(--border-light)] overflow-hidden">

                                <!-- Dokan Header -->
                                <div
                                    class="bg-[var(--surface)] px-6 py-4 border-b border-[var(--border-light)] flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-[var(--accent-soft-30)] rounded-full flex items-center justify-center">
                                            <i class="fa-solid fa-store text-[var(--primary)]"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-[var(--text-dark)]">{{ $dokan->name }}</h3>
                                            <p class="text-xs text-[var(--text-soft)]">{{ $cartItems->count() }}
                                                {{ Str::plural('item', $cartItems->count()) }}</p>
                                        </div>
                                    </div>
                                    <span class="text-sm text-[var(--text-soft)]">
                                        <i class="fa-regular fa-truck"></i> Ships from {{ $dokan->name }}
                                    </span>
                                </div>

                                <!-- Cart Items List -->
                                <div class="divide-y divide-[var(--border-light)]">
                                    @foreach ($cartItems as $item)
                                        @php
                                            $product = $item->product;
                                            $product->images = $product->images;
                                            $discountedPrice =
                                                $product->price - ($product->discount * $product->price) / 100;
                                            $itemTotal = $discountedPrice * $item->qty;
                                        @endphp

                                        <div class="p-6 cart-item" data-cart-id="{{ $item->id }}">
                                            <div class="flex gap-4">
                                                <!-- Product Image -->
                                                <div
                                                    class="w-24 h-24 flex-shrink-0 bg-[#f5f2ee] rounded-lg overflow-hidden">
                                                    <img src="{{ asset(Storage::url($product->images[0])) }}"
                                                        alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                </div>

                                                <!-- Product Details -->
                                                <div class="flex-1">
                                                    <div class="flex justify-between">
                                                        <div>
                                                            <a href="{{ route('product', $product->slug) }}"
                                                                class="font-semibold text-[var(--text-dark)] hover:text-[var(--primary)] transition">
                                                                {{ $product->name }}
                                                            </a>

                                                            <!-- Price -->
                                                            <div class="flex items-baseline gap-2 mt-1">
                                                                <span class="text-lg font-bold text-[var(--primary)]">
                                                                    Rs.{{ number_format($discountedPrice, 0) }}
                                                                </span>
                                                                @if ($product->discount > 0)
                                                                    <span class="text-sm text-gray-400 line-through">
                                                                        Rs.{{ number_format($product->price, 0) }}
                                                                    </span>
                                                                    <span class="text-xs text-green-600 font-medium">
                                                                        {{ $product->discount }}% OFF
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Remove Button -->
                                                        <button
                                                            class="remove-item text-gray-400 hover:text-red-600 transition"
                                                            data-cart-id="{{ $item->id }}">
                                                            <i class="fa-regular fa-trash-can"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Quantity Controls -->
                                                    <div class="flex items-center justify-between mt-3">
                                                        <div class="flex items-center gap-2">
                                                            <button
                                                                class="qty-decrease w-8 h-8 border border-[var(--border-light)] rounded-lg flex items-center justify-center hover:bg-[var(--surface)] transition">
                                                                <i class="fa-solid fa-minus text-xs"></i>
                                                            </button>
                                                            <input type="number"
                                                                class="qty-input w-14 text-center border border-[var(--border-light)] rounded-lg py-1.5 text-sm"
                                                                value="{{ $item->qty }}" min="1"
                                                                max="99" data-cart-id="{{ $item->id }}"
                                                                data-price="{{ $discountedPrice }}">
                                                            <button
                                                                class="qty-increase w-8 h-8 border border-[var(--border-light)] rounded-lg flex items-center justify-center hover:bg-[var(--surface)] transition">
                                                                <i class="fa-solid fa-plus text-xs"></i>
                                                            </button>
                                                        </div>

                                                        <div class="text-right">
                                                            <p class="text-sm text-[var(--text-soft)]">Subtotal</p>
                                                            <p class="font-bold text-[var(--primary)] item-total">
                                                                Rs.{{ number_format($itemTotal, 0) }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Dokan Footer -->
                                <div class="bg-[var(--surface)] px-6 py-4 border-t border-[var(--border-light)]">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-sm text-[var(--text-soft)]">Total for {{ $dokan->name }}
                                            </p>
                                            <p class="text-xl font-bold text-[var(--primary)]">
                                                Rs.{{ number_format($dokanTotals[$dokanId], 0) }}
                                            </p>
                                        </div>
                                        <a href="{{ route('checkout.dokan', $dokan->id) }}"
                                            class="btn-primary px-6 py-2.5">
                                            <i class="fa-solid fa-lock mr-2"></i> Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Continue Shopping -->
                        <div class="text-center pt-4">
                            <a href="{{ route('products') }}"
                                class="inline-flex items-center gap-2 text-[var(--accent)] hover:underline">
                                <i class="fa-solid fa-arrow-left"></i>
                                Continue Shopping
                            </a>
                        </div>
                    </div>

                    <!-- Order Summary - Right Column -->
                    <div class="lg:col-span-1">
                        <div
                            class="bg-white rounded-2xl shadow-sm border border-[var(--border-light)] p-6 sticky top-4">
                            <h3 class="text-xl font-bold text-[var(--text-dark)] mb-4">Order Summary</h3>

                            <!-- Summary Items -->
                            <div class="space-y-3 mb-6">
                                @foreach ($groupedCart as $dokanId => $cartItems)
                                    <div class="flex justify-between text-sm">
                                        <span class="text-[var(--text-soft)]">
                                            {{ $cartItems->first()->dokan->name }}
                                            <span class="text-xs">({{ $cartItems->count() }} items)</span>
                                        </span>
                                        <span class="font-medium">
                                            Rs.{{ number_format($dokanTotals[$dokanId], 0) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <div class="border-t border-[var(--border-light)] pt-4">
                                <div class="flex justify-between items-center mb-4">
                                    <span class="font-semibold text-[var(--text-dark)]">Grand Total</span>
                                    <span class="text-2xl font-bold text-[var(--primary)]">
                                        Rs.{{ number_format($grandTotal, 0) }}
                                    </span>
                                </div>

                                <button class="btn-primary w-full py-3 text-lg" id="checkoutAllBtn">
                                    <i class="fa-solid fa-lock mr-2"></i> Checkout All
                                </button>

                                <button class="w-full mt-3 text-sm text-red-600 hover:text-red-700 transition"
                                    id="clearCartBtn">
                                    <i class="fa-regular fa-trash-can mr-2"></i> Clear Cart
                                </button>
                            </div>

                            <!-- Payment Icons -->
                            <div class="mt-6 flex justify-center gap-3">
                                <i class="fa-brands fa-cc-visa text-2xl text-gray-400"></i>
                                <i class="fa-brands fa-cc-mastercard text-2xl text-gray-400"></i>
                                <i class="fa-brands fa-cc-paypal text-2xl text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- Empty Cart -->
                <div class="text-center py-16">
                    <div
                        class="w-32 h-32 mx-auto bg-[var(--surface)] rounded-full flex items-center justify-center mb-6">
                        <i class="fa-solid fa-cart-shopping text-5xl text-[var(--border-light)]"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-[var(--text-dark)] mb-3">Your cart is empty</h2>
                    <p class="text-[var(--text-soft)] mb-8">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products') }}" class="btn-primary inline-flex px-8 py-3">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Start Shopping
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- ========== RECOMMENDED PRODUCTS ========== -->
    @if ($groupedCart->count() > 0)
        <section class="section-gap bg-[var(--surface)] border-t border-[var(--border-light)]">
            <div class="container">
                <h3 class="text-2xl font-bold text-[var(--primary)] mb-6">You might also like</h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $recommended = App\Models\Product::take(4)->get();
                    @endphp

                    @foreach ($recommended as $product)
                        @php
                            $product->images = $product->images;
                        @endphp
                        <div class="bg-white rounded-xl p-3 shadow-sm">
                            <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                                class="w-full h-32 object-cover rounded-lg mb-2">
                            <h4 class="font-medium text-sm line-clamp-1">{{ $product->name }}</h4>
                            <p class="text-[var(--primary)] font-bold text-sm mt-1">
                                Rs.{{ number_format($product->price - ($product->discount * $product->price) / 100, 0) }}
                            </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

</x-frontend-layout>

<style>
    .line-clamp-1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .qty-input::-webkit-outer-spin-button,
    .qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .qty-input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Quantity decrease
        document.querySelectorAll('.qty-decrease').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                let value = parseInt(input.value);
                if (value > 1) {
                    value--;
                    input.value = value;
                    updateCartItem(input);
                }
            });
        });

        // Quantity increase
        document.querySelectorAll('.qty-increase').forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.qty-input');
                let value = parseInt(input.value);
                if (value < 99) {
                    value++;
                    input.value = value;
                    updateCartItem(input);
                }
            });
        });

        // Quantity input change
        document.querySelectorAll('.qty-input').forEach(input => {
            input.addEventListener('change', function() {
                let value = parseInt(this.value);
                if (value < 1) value = 1;
                if (value > 99) value = 99;
                this.value = value;
                updateCartItem(this);
            });
        });

        // Update cart item via AJAX
        function updateCartItem(input) {
            const cartId = input.dataset.cartId;
            const qty = input.value;
            const price = parseFloat(input.dataset.price);
            const cartItem = input.closest('.cart-item');
            const itemTotal = cartItem.querySelector('.item-total');

            fetch('{{ route('cart.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cart_id: cartId,
                        qty: qty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update item total
                        const newTotal = price * qty;
                        itemTotal.textContent = 'Rs.' + newTotal.toLocaleString();

                        // Reload page to update group totals
                        setTimeout(() => location.reload(), 300);
                    }
                });
        }

        // Remove item
        document.querySelectorAll('.remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                const cartId = this.dataset.cartId;
                const cartItem = this.closest('.cart-item');

                if (confirm('Remove this item from cart?')) {
                    fetch(`{{ url('cart/remove') }}/${cartId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }
            });
        });

        // Clear cart
        const clearCartBtn = document.getElementById('clearCartBtn');
        if (clearCartBtn) {
            clearCartBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to clear your entire cart?')) {
                    fetch('{{ route('cart.clear') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }
            });
        }
    });
</script>
