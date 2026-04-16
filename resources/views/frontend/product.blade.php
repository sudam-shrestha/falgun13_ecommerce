<x-frontend-layout>

    <!-- ========== BREADCRUMB ========== -->
    <div class="container py-4">
        <nav class="flex text-sm text-[var(--text-soft)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)]">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products') }}" class="hover:text-[var(--primary)]">Products</a>
            <span class="mx-2">/</span>
            <span class="text-[var(--primary)]">{{ $product->name }}</span>
        </nav>
    </div>

    <!-- ========== PRODUCT DETAIL SECTION ========== -->
    <section class="section-gap pb-12">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-12">

                <!-- Left Column - Product Images -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="bg-[#f5f2ee] rounded-2xl overflow-hidden border border-[var(--border-light)]">
                        <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                            id="mainImage" class="w-full h-[400px] md:h-[500px] object-contain">
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if (count($product->images) > 1)
                        <div class="grid grid-cols-4 gap-3">
                            @foreach ($product->images as $index => $image)
                                <div class="bg-[#f5f2ee] rounded-lg overflow-hidden border-2 cursor-pointer thumbnail
                                            {{ $index === 0 ? 'border-[var(--primary)]' : 'border-transparent hover:border-[var(--accent)]' }}"
                                    data-image="{{ asset(Storage::url($image)) }}">
                                    <img src="{{ asset(Storage::url($image)) }}" alt="Thumbnail {{ $index + 1 }}"
                                        class="w-full h-20 object-cover">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Right Column - Product Info -->
                <div>
                    <!-- Dokan Info -->
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-[var(--accent-soft-30)] rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-store text-[var(--primary)] text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-[var(--text-soft)]">Sold by</p>
                            <a href="#" class="font-semibold text-[var(--primary)] hover:underline">
                                {{ $product->dokan->name }}
                            </a>
                        </div>
                    </div>

                    <!-- Product Name -->
                    <h1 class="text-3xl md:text-4xl font-bold text-[var(--text-dark)] mb-3">
                        {{ $product->name }}
                    </h1>

                    <!-- Price Section -->
                    <div class="bg-[var(--surface-card)] p-5 rounded-xl border border-[var(--border-light)] mb-6">
                        <div class="flex items-baseline gap-3">
                            @if ($product->discount > 0)
                                <span class="text-3xl font-bold text-[var(--primary)]" id="productPrice">
                                    Rs.{{ number_format($product->price - ($product->discount * $product->price) / 100, 2) }}
                                </span>
                                <span class="text-lg text-gray-400 line-through">
                                    Rs.{{ number_format($product->price, 2) }}
                                </span>
                                <span class="pill-badge bg-red-100 text-red-700 ml-2">
                                    {{ $product->discount }}% OFF
                                </span>
                            @else
                                <span class="text-3xl font-bold text-[var(--primary)]" id="productPrice">
                                    Rs.{{ number_format($product->price, 2) }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-[var(--text-soft)] mt-2">
                            <i class="fa-regular fa-circle-check text-green-600"></i>
                            Inclusive of all taxes
                        </p>
                    </div>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-lg text-[var(--text-dark)] mb-2">Description</h3>
                        <div class="prose prose-sm text-[var(--text-soft)] leading-relaxed">
                            {!! $product->description !!}
                        </div>
                    </div>

                    <!-- Add to Cart Form -->
                    <form id="addToCartForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4">
                            <label class="font-semibold text-[var(--text-dark)]">Quantity:</label>
                            <div class="flex items-center border border-[var(--border-light)] rounded-lg">
                                <button type="button" id="decreaseQty"
                                    class="px-4 py-2 hover:bg-[var(--surface)] transition">
                                    <i class="fa-solid fa-minus text-sm"></i>
                                </button>
                                <input type="number" name="qty" id="quantity" value="1" min="1"
                                    max="99"
                                    class="w-16 text-center border-x border-[var(--border-light)] py-2 focus:outline-none"
                                    readonly>
                                <button type="button" id="increaseQty"
                                    class="px-4 py-2 hover:bg-[var(--surface)] transition">
                                    <i class="fa-solid fa-plus text-sm"></i>
                                </button>
                            </div>
                            <span class="text-sm text-[var(--text-soft)]">
                                <span id="stockInfo">In Stock</span>
                            </span>
                        </div>

                        <!-- Total Price Display -->
                        <div class="bg-[var(--surface)] p-4 rounded-lg">
                            <div class="flex items-center justify-between">
                                <span class="font-semibold text-[var(--text-dark)]">Total Amount:</span>
                                <span class="text-2xl font-bold text-[var(--primary)]" id="totalAmount">
                                    Rs.{{ number_format($product->price - ($product->discount * $product->price) / 100, 2) }}
                                </span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit" class="btn-primary flex-1 py-4 text-lg justify-center"
                                id="addToCartBtn">
                                <i class="fa-solid fa-cart-shopping mr-2"></i>
                                <span id="addToCartText">Add to Cart</span>
                            </button>
                            <a href="{{ route('cart') }}"
                                class="btn-outline-accent flex-1 py-4 text-lg justify-center hidden" id="viewCartBtn">
                                <i class="fa-solid fa-eye mr-2"></i> View Cart
                            </a>
                        </div>
                    </form>

                    <!-- Additional Info -->
                    <div class="mt-8 space-y-3 text-sm">
                        <div class="flex items-center gap-3 text-[var(--text-soft)]">
                            <i class="fa-solid fa-truck text-[var(--primary)] w-5"></i>
                            <span>Free shipping on orders over Rs. 5000</span>
                        </div>
                        <div class="flex items-center gap-3 text-[var(--text-soft)]">
                            <i class="fa-solid fa-rotate-left text-[var(--primary)] w-5"></i>
                            <span>7 days easy returns</span>
                        </div>
                        <div class="flex items-center gap-3 text-[var(--text-soft)]">
                            <i class="fa-solid fa-shield text-[var(--primary)] w-5"></i>
                            <span>Secure checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== RELATED PRODUCTS ========== -->
    @php
        $relatedProducts = App\Models\Product::where('dokan_id', $product->dokan_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();
    @endphp

    @if ($relatedProducts->count() > 0)
        <section class="section-gap border-t border-[var(--border-light)]">
            <div class="container">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="text-3xl font-bold text-[var(--primary)]">
                        More from {{ $product->dokan->name }}
                    </h2>
                    <a href="{{ route('products') }}"
                        class="text-[var(--accent)] font-semibold hover:underline flex items-center gap-1">
                        View all <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
                    @foreach ($relatedProducts as $relatedProduct)
                        @php
                            $relatedImages = $relatedProduct->images;
                        @endphp
                        <div class="product-card overflow-hidden group">
                            <div class="h-56 overflow-hidden bg-[#e8e1d7] flex items-center justify-center relative">
                                <img src="{{ asset(Storage::url($relatedImages[0])) }}"
                                    alt="{{ $relatedProduct->name }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @if ($relatedProduct->discount > 0)
                                    <span
                                        class="absolute top-2 right-0 px-4 py-1 bg-red-600 text-white text-sm font-medium">
                                        -{{ $relatedProduct->discount }}%
                                    </span>
                                @endif
                            </div>
                            <div class="p-5">
                                <h3 class="font-bold text-lg text-[var(--text-dark)] line-clamp-1">
                                    {{ $relatedProduct->name }}
                                </h3>
                                <div class="flex justify-between items-start mt-1">
                                    @if ($relatedProduct->discount > 0)
                                        <span class="text-sm text-gray-400 line-through">
                                            Rs.{{ number_format($relatedProduct->price, 0) }}
                                        </span>
                                    @endif
                                    <span class="font-bold text-[var(--primary)]">
                                        Rs.{{ number_format($relatedProduct->price - ($relatedProduct->discount * $relatedProduct->price) / 100, 0) }}
                                    </span>
                                </div>
                                <a href="{{ route('product', $relatedProduct->slug) }}"
                                    class="btn-cart mt-4 w-full text-[var(--primary)] font-medium py-2.5 rounded-xl flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-eye"></i> View product
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- ========== CTA SECTION ========== -->
    <section class="bg-primary-5 py-14 mt-8">
        <div class="container text-center max-w-3xl">
            <i class="fa-solid fa-tags text-4xl text-[var(--accent)] mb-4"></i>
            <h4 class="text-3xl font-bold text-[var(--primary)]">Handmade with love</h4>
            <p class="text-[var(--text-soft)] mt-2">
                Every purchase supports independent artisans and their craft.
            </p>
            <a href="{{ route('home') }}" class="btn-primary inline-flex mt-6 !py-3 !px-8">
                <i class="fa-solid fa-arrow-left mr-2"></i> Continue Shopping
            </a>
        </div>
    </section>

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed bottom-4 right-4 z-50 transform translate-y-full opacity-0 transition-all duration-300">
        <div class="bg-[var(--primary)] text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3">
            <i class="fa-regular fa-circle-check"></i>
            <span id="toastMessage">Added to cart successfully!</span>
        </div>
    </div>

</x-frontend-layout>

<!-- JavaScript for Image Gallery and Add to Cart -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Gallery
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                const imageUrl = this.dataset.image;
                mainImage.src = imageUrl;

                thumbnails.forEach(t => {
                    t.classList.remove('border-[var(--primary)]');
                    t.classList.add('border-transparent');
                });
                this.classList.remove('border-transparent');
                this.classList.add('border-[var(--primary)]');
            });
        });

        // Quantity Controls
        const quantityInput = document.getElementById('quantity');
        const decreaseBtn = document.getElementById('decreaseQty');
        const increaseBtn = document.getElementById('increaseQty');
        const totalAmount = document.getElementById('totalAmount');

        @php
            $unitPrice = $product->price - ($product->discount * $product->price) / 100;
        @endphp

        const unitPrice = {{ $unitPrice }};

        function updateTotal() {
            const qty = parseInt(quantityInput.value);
            const total = unitPrice * qty;
            totalAmount.textContent = 'Rs.' + total.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }

        decreaseBtn.addEventListener('click', function() {
            let qty = parseInt(quantityInput.value);
            if (qty > 1) {
                qty--;
                quantityInput.value = qty;
                updateTotal();
            }
        });

        increaseBtn.addEventListener('click', function() {
            let qty = parseInt(quantityInput.value);
            if (qty < 99) {
                qty++;
                quantityInput.value = qty;
                updateTotal();
            }
        });

        // Add to Cart Form Submit
        const addToCartForm = document.getElementById('addToCartForm');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const addToCartText = document.getElementById('addToCartText');
        const viewCartBtn = document.getElementById('viewCartBtn');
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toastMessage');

        addToCartForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            addToCartBtn.disabled = true;
            addToCartText.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Adding...';

            const formData = new FormData(this);

            fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        toastMessage.textContent = data.message;
                        showToast();

                        // Update cart count if you have a cart counter in header
                        if (typeof updateCartCount === 'function') {
                            updateCartCount(data.cart_count);
                        }

                        // Change button to show success
                        addToCartText.innerHTML =
                            '<i class="fa-solid fa-check mr-2"></i> Added to Cart';
                        addToCartBtn.classList.add('bg-green-600');

                        // Show View Cart button
                        viewCartBtn.classList.remove('hidden');

                        // Reset after 3 seconds
                        setTimeout(() => {
                            addToCartBtn.disabled = false;
                            addToCartText.innerHTML =
                                '<i class="fa-solid fa-cart-shopping mr-2"></i> Add to Cart';
                            addToCartBtn.classList.remove('bg-green-600');
                        }, 3000);
                    } else {
                        // Show error
                        toastMessage.textContent = data.message || 'Failed to add to cart';
                        showToast(true);
                        addToCartBtn.disabled = false;
                        addToCartText.innerHTML =
                            '<i class="fa-solid fa-cart-shopping mr-2"></i> Add to Cart';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastMessage.textContent = 'An error occurred. Please try again.';
                    showToast(true);
                    addToCartBtn.disabled = false;
                    addToCartText.innerHTML =
                        '<i class="fa-solid fa-cart-shopping mr-2"></i> Add to Cart';
                });
        });

        // Toast notification
        function showToast(isError = false) {
            const toastDiv = toast.querySelector('div');
            if (isError) {
                toastDiv.classList.remove('bg-[var(--primary)]');
                toastDiv.classList.add('bg-red-600');
                toast.querySelector('i').classList.remove('fa-circle-check');
                toast.querySelector('i').classList.add('fa-circle-exclamation');
            } else {
                toastDiv.classList.remove('bg-red-600');
                toastDiv.classList.add('bg-[var(--primary)]');
                toast.querySelector('i').classList.remove('fa-circle-exclamation');
                toast.querySelector('i').classList.add('fa-circle-check');
            }

            toast.classList.remove('translate-y-full', 'opacity-0');

            setTimeout(() => {
                toast.classList.add('translate-y-full', 'opacity-0');
            }, 3000);
        }

        // Update cart count function (if needed)
        window.updateCartCount = function(count) {
            const cartCountEl = document.getElementById('cartCount');
            if (cartCountEl) {
                cartCountEl.textContent = count;
                if (count > 0) {
                    cartCountEl.classList.remove('hidden');
                } else {
                    cartCountEl.classList.add('hidden');
                }
            }
        };
    });
</script>

<style>
    .line-clamp-1 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
    }

    .prose {
        max-width: 100%;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }

    #toast {
        transition: transform 0.3s ease, opacity 0.3s ease;
    }
</style>
