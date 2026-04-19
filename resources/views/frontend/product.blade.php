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

    <!-- ========== REVIEWS SECTION ========== -->
    <section class="section-gap border-t border-[var(--border-light)]">
        <div class="container">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-3xl font-bold text-[var(--primary)]">
                    Customer Reviews
                    @if (isset($reviewsCount) && $reviewsCount > 0)
                        <span class="text-lg text-[var(--text-soft)] font-normal ml-2">
                            ({{ $reviewsCount }} {{ Str::plural('review', $reviewsCount) }})
                        </span>
                    @endif
                </h2>

                @if (isset($canReview) && $canReview)
                    <button onclick="openReviewModal()" class="btn-primary px-6 py-2.5 flex items-center gap-2">
                        <i class="fa-regular fa-pen-to-square"></i> Write a Review
                    </button>
                @endif
            </div>

            <!-- Rating Summary -->
            @if (isset($reviewsCount) && $reviewsCount > 0)
                <div class="bg-[var(--surface)] rounded-2xl p-6 mb-8">
                    <div class="flex flex-col md:flex-row gap-8">
                        <!-- Average Rating -->
                        <div class="text-center md:text-left">
                            <div class="text-5xl font-bold text-[var(--primary)] mb-2">
                                {{ number_format($averageRating ?? 0, 1) }}
                            </div>
                            <div class="flex justify-center md:justify-start gap-1 mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($averageRating ?? 0))
                                        <i class="fa-solid fa-star text-yellow-400"></i>
                                    @elseif($i == ceil($averageRating ?? 0) && ($averageRating ?? 0) - floor($averageRating ?? 0) >= 0.5)
                                        <i class="fa-solid fa-star-half-alt text-yellow-400"></i>
                                    @else
                                        <i class="fa-regular fa-star text-yellow-400"></i>
                                    @endif
                                @endfor
                            </div>
                            <p class="text-sm text-[var(--text-soft)]">
                                Based on {{ $reviewsCount }} reviews
                            </p>
                        </div>

                        <!-- Rating Distribution -->
                        <div class="flex-1 space-y-2">
                            @php
                                $ratingDistribution = [];
                                for ($i = 5; $i >= 1; $i--) {
                                    $count = $product->reviews->where('rating', $i)->count();
                                    $percentage = $reviewsCount > 0 ? ($count / $reviewsCount) * 100 : 0;
                                    $ratingDistribution[$i] = ['count' => $count, 'percentage' => $percentage];
                                }
                            @endphp

                            @foreach ($ratingDistribution as $rating => $data)
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-medium w-12">{{ $rating }} stars</span>
                                    <div class="flex-1 h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full"
                                            style="width: {{ $data['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-sm text-[var(--text-soft)] w-12">{{ $data['count'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

            <!-- Reviews List -->
            <div id="reviewsList" class="space-y-6">
                @if (isset($product->reviews) && $product->reviews->count() > 0)
                    @foreach ($product->reviews as $review)
                        <div class="bg-white rounded-2xl p-6 border border-[var(--border-light)]">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <div class="flex items-center gap-2 mb-2">
                                        <div
                                            class="w-10 h-10 bg-[var(--accent-soft-30)] rounded-full flex items-center justify-center">
                                            <i class="fa-regular fa-user text-[var(--primary)]"></i>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-[var(--text-dark)]">
                                                {{ $review->user->name }}
                                            </p>
                                            <p class="text-xs text-[var(--text-soft)]">
                                                {{ $review->created_at->format('F j, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fa-{{ $i <= $review->rating ? 'solid' : 'regular' }} fa-star text-yellow-400 text-sm"></i>
                                        @endfor
                                    </div>
                                </div>
                                <span class="text-xs text-[var(--text-soft)]">
                                    Verified Purchase
                                </span>
                            </div>
                            <p class="text-[var(--text-dark)] leading-relaxed">
                                {{ $review->comment }}
                            </p>
                        </div>
                    @endforeach
                @else
                    <div class="text-center py-12 bg-white rounded-2xl border border-[var(--border-light)]">
                        <i class="fa-regular fa-star text-5xl text-[var(--border-light)] mb-4"></i>
                        <h3 class="text-xl font-bold text-[var(--text-dark)] mb-2">No reviews yet</h3>
                        <p class="text-[var(--text-soft)]">Be the first to review this product!</p>
                        @if (isset($canReview) && $canReview)
                            <button onclick="openReviewModal()" class="btn-primary mt-4 px-6 py-2.5">
                                Write a Review
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Review Modal -->
    <div id="reviewModal" class="fixed inset-0 z-50 hidden overflow-y-auto"
        style="background-color: rgba(0,0,0,0.5);">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-2xl max-w-md w-full">
                <div class="border-b border-[var(--border-light)] px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-[var(--text-dark)]">Write a Review</h3>
                    <button onclick="closeReviewModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="text-center mb-4">
                        <h4 class="text-lg font-semibold text-[var(--text-dark)]">{{ $product->name }}</h4>
                    </div>

                    <!-- Star Rating -->
                    <div class="flex justify-center gap-2 mb-6">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fa-regular fa-star text-3xl cursor-pointer hover:scale-110 transition star-rating"
                                data-rating="{{ $i }}"></i>
                        @endfor
                    </div>

                    <!-- Comment -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-[var(--text-dark)] mb-2">Your Review</label>
                        <textarea id="reviewComment" rows="4"
                            class="w-full border border-[var(--border-light)] rounded-lg px-3 py-2 focus:outline-none focus:border-[var(--primary)]"
                            placeholder="Share your experience with this product..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button onclick="submitReview()" class="btn-primary w-full py-3">
                        Submit Review
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .star-rating {
            transition: all 0.2s ease;
            color: #ffc107;
            cursor: pointer;
        }

        .star-rating.active {
            font-weight: 900;
        }

        .star-rating:hover {
            transform: scale(1.1);
        }
    </style>

    <script>
        let selectedRating = 0;

        // Star rating click handler
        document.querySelectorAll('.star-rating').forEach(star => {
            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);

                // Update star display
                document.querySelectorAll('.star-rating').forEach((s, index) => {
                    if (index < selectedRating) {
                        s.classList.remove('fa-regular');
                        s.classList.add('fa-solid', 'active');
                    } else {
                        s.classList.remove('fa-solid', 'active');
                        s.classList.add('fa-regular');
                    }
                });
            });
        });

        function openReviewModal() {
            document.getElementById('reviewModal').classList.remove('hidden');
            // Reset form
            selectedRating = 0;
            document.getElementById('reviewComment').value = '';
            document.querySelectorAll('.star-rating').forEach(star => {
                star.classList.remove('active', 'fa-solid');
                star.classList.add('fa-regular');
            });
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').classList.add('hidden');
        }

        async function submitReview() {
            if (selectedRating === 0) {
                alert('Please select a rating');
                return;
            }

            const comment = document.getElementById('reviewComment').value;
            if (!comment.trim()) {
                alert('Please write a review comment');
                return;
            }

            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Submitting...';
            submitBtn.disabled = true;

            try {
                const response = await fetch('{{ route('review.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: {{ $product->id }},
                        rating: selectedRating,
                        comment: comment
                    })
                });

                const data = await response.json();

                if (data.success) {
                    alert('Thank you for your review!');
                    location.reload(); // Reload to show the new review
                } else {
                    alert(data.message || 'Failed to submit review');
                }
            } catch (error) {
                console.error('Error submitting review:', error);
                alert('Failed to submit review. Please try again.');
            } finally {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            }
        }

        // Close modal when clicking outside
        document.getElementById('reviewModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeReviewModal();
            }
        });
    </script>

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
