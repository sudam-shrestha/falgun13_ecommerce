<x-frontend-layout>

    <!-- ========== HERO BANNER ========== -->
    <section class="relative bg-gradient-to-r from-[var(--primary)] to-[var(--accent)] py-16">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 left-10 w-40 h-40 bg-white rounded-full"></div>
            <div class="absolute bottom-10 right-20 w-60 h-60 bg-white rounded-full"></div>
        </div>
        <div class="container relative">
            <div class="text-center max-w-3xl mx-auto text-white">
                <span class="inline-block bg-white/20 backdrop-blur-sm px-6 py-2 rounded-full text-sm font-semibold mb-4">
                    <i class="fa-solid fa-tags mr-2"></i> Limited Time Offers
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">
                    Mega Deals & Discounts
                </h1>
                <p class="text-lg md:text-xl opacity-90 mb-8">
                    Grab the best handmade products at unbeatable prices. Up to 70% off!
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full">
                        <i class="fa-regular fa-clock mr-2"></i>
                        <span id="countdown">Limited Time</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DEALS STATS ========== -->
    <section class="py-8 border-b border-[var(--border-light)]">
        <div class="container">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-3xl font-bold text-[var(--primary)]">{{ $deals->total() }}</div>
                    <div class="text-sm text-[var(--text-soft)]">Active Deals</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[var(--accent)]">70%</div>
                    <div class="text-sm text-[var(--text-soft)]">Max Discount</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[var(--primary)]">500+</div>
                    <div class="text-sm text-[var(--text-soft)]">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-[var(--accent)]">24h</div>
                    <div class="text-sm text-[var(--text-soft)]">Fast Shipping</div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DISCOUNT FILTERS ========== -->
    <section class="py-8">
        <div class="container">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                <div class="flex flex-wrap gap-2">
                    <button class="discount-filter-btn active px-6 py-2 rounded-full bg-[var(--primary)] text-white text-sm font-medium" data-discount="all">
                        All Deals
                    </button>
                    <button class="discount-filter-btn px-6 py-2 rounded-full border border-[var(--border-light)] hover:border-[var(--primary)] text-sm font-medium" data-discount="10">
                        10%+ OFF
                    </button>
                    <button class="discount-filter-btn px-6 py-2 rounded-full border border-[var(--border-light)] hover:border-[var(--primary)] text-sm font-medium" data-discount="20">
                        20%+ OFF
                    </button>
                    <button class="discount-filter-btn px-6 py-2 rounded-full border border-[var(--border-light)] hover:border-[var(--primary)] text-sm font-medium" data-discount="30">
                        30%+ OFF
                    </button>
                    <button class="discount-filter-btn px-6 py-2 rounded-full border border-[var(--border-light)] hover:border-[var(--primary)] text-sm font-medium" data-discount="50">
                        50%+ OFF
                    </button>
                </div>

                <div class="flex items-center gap-3">
                    <label class="text-sm text-[var(--text-soft)]">Sort by:</label>
                    <select id="dealSort" class="border border-[var(--border-light)] rounded-lg px-4 py-2 bg-white text-sm focus:border-[var(--primary)]">
                        <option value="discount-high">Highest Discount</option>
                        <option value="discount-low">Lowest Discount</option>
                        <option value="price-low">Price: Low to High</option>
                        <option value="price-high">Price: High to Low</option>
                        <option value="newest">Newest First</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DEALS GRID ========== -->
    <section class="section-gap">
        <div class="container">

            @if($deals->count() > 0)
                <!-- Featured Deal -->
                @php
                    $featuredDeal = $deals->sortByDesc('discount')->first();
                @endphp

                <div class="bg-gradient-to-br from-[var(--surface-card)] to-[var(--surface)] rounded-3xl p-6 md:p-8 mb-12 border-2 border-[var(--accent)]">
                    <div class="grid md:grid-cols-2 gap-8 items-center">
                        <div>
                            <span class="inline-block bg-red-100 text-red-700 px-4 py-1 rounded-full text-sm font-bold mb-4">
                                <i class="fa-solid fa-fire mr-1"></i> HOTTEST DEAL
                            </span>
                            <h2 class="text-3xl md:text-4xl font-bold text-[var(--text-dark)] mb-3">
                                {{ $featuredDeal->name }}
                            </h2>
                            <p class="text-[var(--text-soft)] mb-6">
                                by {{ $featuredDeal->dokan->name }}
                            </p>

                            <div class="flex items-baseline gap-4 mb-6">
                                <span class="text-4xl font-bold text-[var(--primary)]">
                                    Rs.{{ number_format($featuredDeal->price - ($featuredDeal->discount * $featuredDeal->price) / 100, 0) }}
                                </span>
                                <span class="text-xl text-gray-400 line-through">
                                    Rs.{{ number_format($featuredDeal->price, 0) }}
                                </span>
                                <span class="bg-red-600 text-white px-4 py-2 rounded-full text-lg font-bold">
                                    SAVE {{ $featuredDeal->discount }}%
                                </span>
                            </div>

                            <div class="flex gap-4">
                                <a href="{{ route('product', $featuredDeal->slug) }}" class="btn-primary px-8 py-3">
                                    <i class="fa-solid fa-bolt mr-2"></i> Grab Deal
                                </a>
                                <button class="btn-outline-accent px-8 py-3 wishlist-btn">
                                    <i class="fa-regular fa-heart mr-2"></i> Wishlist
                                </button>
                            </div>

                            <!-- Progress Bar -->
                            <div class="mt-8">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-[var(--text-soft)]">🔥 Selling fast</span>
                                    <span class="font-semibold text-[var(--primary)]">75% claimed</span>
                                </div>
                                <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-[var(--accent)] to-[var(--primary)] rounded-full" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-[var(--accent)]/20 to-[var(--primary)]/20 rounded-3xl blur-2xl"></div>
                            <img src="{{ asset(Storage::url($featuredDeal->images[0])) }}"
                                 alt="{{ $featuredDeal->name }}"
                                 class="relative rounded-3xl shadow-2xl w-full h-[400px] object-cover">
                        </div>
                    </div>
                </div>

                <!-- Deals Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="dealsGrid">
                    @foreach($deals as $deal)
                        @php
                            $discountedPrice = $deal->price - ($deal->discount * $deal->price) / 100;
                            $savings = ($deal->discount * $deal->price) / 100;
                        @endphp

                        <div class="product-card group bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-[var(--border-light)]"
                             data-discount="{{ $deal->discount }}">

                            <!-- Image Container -->
                            <div class="relative h-64 overflow-hidden bg-[#f5f2ee]">
                                <img src="{{ asset(Storage::url($deal->images[0])) }}"
                                     alt="{{ $deal->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                <!-- Discount Badge -->
                                <div class="absolute top-3 left-3">
                                    <span class="bg-red-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                        -{{ $deal->discount }}%
                                    </span>
                                </div>

                                <!-- Savings Badge -->
                                <div class="absolute top-3 right-3">
                                    <span class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                                        Save Rs.{{ number_format($savings, 0) }}
                                    </span>
                                </div>

                                <!-- Quick Actions -->
                                <div class="absolute bottom-3 right-3 opacity-0 group-hover:opacity-100 transition">
                                    <button class="w-10 h-10 bg-white rounded-full flex items-center justify-center shadow-lg hover:bg-[var(--primary)] hover:text-white transition wishlist-btn">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <!-- Dokan Info -->
                                <div class="flex items-center gap-2 mb-3">
                                    <div class="w-6 h-6 bg-[var(--accent-soft-30)] rounded-full flex items-center justify-center">
                                        <i class="fa-solid fa-store text-[var(--primary)] text-xs"></i>
                                    </div>
                                    <span class="text-xs text-[var(--text-soft)]">{{ $deal->dokan->name }}</span>
                                </div>

                                <!-- Product Name -->
                                <h3 class="font-bold text-[var(--text-dark)] mb-3 line-clamp-2 min-h-[3rem]">
                                    <a href="{{ route('product', $deal->slug) }}" class="hover:text-[var(--primary)] transition">
                                        {{ $deal->name }}
                                    </a>
                                </h3>

                                <!-- Price Section -->
                                <div class="mb-4">
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-[var(--primary)]">
                                            Rs.{{ number_format($discountedPrice, 0) }}
                                        </span>
                                        <span class="text-sm text-gray-400 line-through">
                                            Rs.{{ number_format($deal->price, 0) }}
                                        </span>
                                    </div>
                                </div>

                                <!-- Deal Timer -->
                                <div class="mb-4 bg-[var(--surface)] p-3 rounded-lg">
                                    <div class="flex items-center gap-2 text-xs text-[var(--text-soft)] mb-1">
                                        <i class="fa-regular fa-hourglass-half text-[var(--accent)]"></i>
                                        <span>Hurry! Limited stock</span>
                                    </div>
                                    <div class="flex gap-2 text-center">
                                        <div class="flex-1">
                                            <div class="text-lg font-bold text-[var(--primary)]">24</div>
                                            <div class="text-xs text-[var(--text-soft)]">Days</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-lg font-bold text-[var(--primary)]">12</div>
                                            <div class="text-xs text-[var(--text-soft)]">Hrs</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="text-lg font-bold text-[var(--primary)]">45</div>
                                            <div class="text-xs text-[var(--text-soft)]">Mins</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex gap-2">
                                    <a href="{{ route('product', $deal->slug) }}"
                                       class="flex-1 bg-[var(--primary)] text-white font-medium py-2.5 rounded-lg flex items-center justify-center gap-2 hover:bg-[var(--accent)] transition text-sm">
                                        <i class="fa-solid fa-bolt"></i> Buy Now
                                    </a>
                                    <button class="w-10 h-10 border border-[var(--border-light)] rounded-lg flex items-center justify-center hover:bg-[var(--surface)] transition add-to-cart-btn">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $deals->links() }}
                </div>

            @else
                <!-- No Deals Message -->
                <div class="text-center py-16">
                    <i class="fa-regular fa-tags text-6xl text-[var(--border-light)] mb-4"></i>
                    <h3 class="text-2xl font-bold text-[var(--text-dark)] mb-2">No active deals</h3>
                    <p class="text-[var(--text-soft)] mb-6">Check back soon for amazing discounts!</p>
                    <a href="{{ route('products') }}" class="btn-primary inline-flex px-6 py-3">
                        Browse All Products
                    </a>
                </div>
            @endif

        </div>
    </section>

    <!-- ========== DEAL ALERT BANNER ========== -->
    <section class="bg-[var(--surface-card)] py-12 border-t border-[var(--border-light)]">
        <div class="container">
            <div class="max-w-3xl mx-auto text-center">
                <i class="fa-regular fa-bell text-4xl text-[var(--accent)] mb-4"></i>
                <h3 class="text-2xl font-bold text-[var(--primary)] mb-3">Never Miss a Deal!</h3>
                <p class="text-[var(--text-soft)] mb-6">
                    Subscribe to get notified about flash sales and exclusive discounts.
                </p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Enter your email" class="input-custom flex-1">
                    <button type="submit" class="btn-primary px-6 py-3 whitespace-nowrap">
                        <i class="fa-regular fa-envelope mr-2"></i> Notify Me
                    </button>
                </form>
            </div>
        </div>
    </section>

</x-frontend-layout>

<style>
    .line-clamp-2 {
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .discount-filter-btn.active {
        background-color: var(--primary);
        color: white;
        border-color: var(--primary);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Discount filter functionality
        const filterBtns = document.querySelectorAll('.discount-filter-btn');
        const dealsGrid = document.getElementById('dealsGrid');
        const dealCards = document.querySelectorAll('[data-discount]');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state
                filterBtns.forEach(b => {
                    b.classList.remove('active', 'bg-[var(--primary)]', 'text-white');
                    b.classList.add('border', 'border-[var(--border-light)]');
                });
                this.classList.add('active', 'bg-[var(--primary)]', 'text-white');
                this.classList.remove('border', 'border-[var(--border-light)]');

                const minDiscount = this.dataset.discount;

                // Filter deals
                dealCards.forEach(card => {
                    const discount = parseInt(card.dataset.discount);

                    if (minDiscount === 'all' || discount >= parseInt(minDiscount)) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Sort functionality
        const sortSelect = document.getElementById('dealSort');

        sortSelect.addEventListener('change', function() {
            const sortBy = this.value;
            const cards = Array.from(dealCards);

            cards.sort((a, b) => {
                const discountA = parseInt(a.dataset.discount);
                const discountB = parseInt(b.dataset.discount);
                const priceA = parseFloat(a.querySelector('.text-2xl').textContent.replace('Rs.', '').replace(',', ''));
                const priceB = parseFloat(b.querySelector('.text-2xl').textContent.replace('Rs.', '').replace(',', ''));

                switch(sortBy) {
                    case 'discount-high':
                        return discountB - discountA;
                    case 'discount-low':
                        return discountA - discountB;
                    case 'price-low':
                        return priceA - priceB;
                    case 'price-high':
                        return priceB - priceA;
                    case 'newest':
                        // Assuming newer products have higher IDs
                        return 0; // Implement based on your data structure
                    default:
                        return 0;
                }
            });

            // Reorder cards in DOM
            cards.forEach(card => dealsGrid.appendChild(card));
        });

        // Countdown timer
        function updateCountdown() {
            const countdownEl = document.getElementById('countdown');
            if (!countdownEl) return;

            // Set the date we're counting down to (24 hours from now)
            const now = new Date().getTime();
            const countDownDate = now + (24 * 60 * 60 * 1000);

            const timer = setInterval(function() {
                const now = new Date().getTime();
                const distance = countDownDate - now;

                const hours = Math.floor((distance % (24 * 60 * 60 * 1000)) / (60 * 60 * 1000));
                const minutes = Math.floor((distance % (60 * 60 * 1000)) / (60 * 1000));
                const seconds = Math.floor((distance % (60 * 1000)) / 1000);

                countdownEl.innerHTML = `Ends in: ${hours}h ${minutes}m ${seconds}s`;

                if (distance < 0) {
                    clearInterval(timer);
                    countdownEl.innerHTML = "Deal Ended";
                }
            }, 1000);
        }

        updateCountdown();

        // Wishlist functionality
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-regular')) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid', 'text-red-500');

                    // Show toast notification
                    showToast('Added to wishlist!');
                } else {
                    icon.classList.remove('fa-solid', 'text-red-500');
                    icon.classList.add('fa-regular');

                    showToast('Removed from wishlist');
                }
            });
        });

        // Add to cart functionality
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Add animation
                this.classList.add('bg-green-500', 'text-white');
                const icon = this.querySelector('i');
                icon.classList.remove('fa-cart-plus');
                icon.classList.add('fa-check');

                showToast('Added to cart!');

                setTimeout(() => {
                    this.classList.remove('bg-green-500', 'text-white');
                    icon.classList.remove('fa-check');
                    icon.classList.add('fa-cart-plus');
                }, 2000);
            });
        });

        // Toast notification
        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-[var(--primary)] text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-up';
            toast.innerHTML = `
                <i class="fa-regular fa-circle-check mr-2"></i>
                ${message}
            `;
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    });
</script>

<style>
    @keyframes slide-up {
        from {
            transform: translateY(100%);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }
</style>
