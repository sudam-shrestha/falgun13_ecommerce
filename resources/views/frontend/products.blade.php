<x-frontend-layout>

    <!-- ========== PAGE HEADER ========== -->
    <section class="bg-primary-5 py-12 border-b border-[var(--border-light)]">
        <div class="container">
            <div class="text-center max-w-2xl mx-auto">
                <span class="pill-badge mb-3 inline-block">
                    <i class="fa-regular fa-gem mr-1"></i> Curated Collection
                </span>
                <h1 class="text-4xl md:text-5xl font-bold text-[var(--primary)] mb-4">
                    All Handmade Products
                </h1>
                <p class="text-lg text-[var(--text-soft)]">
                    Discover unique creations from talented artisans across Nepal
                </p>
            </div>
        </div>
    </section>

    <!-- ========== PRODUCTS SECTION WITH FILTERS ========== -->
    <section class="section-gap">
        <div class="container">
            <div class="grid lg:grid-cols-4 gap-8">

                <!-- ========== FILTERS SIDEBAR ========== -->
                <div class="lg:col-span-1">
                    <div
                        class="bg-[var(--surface-card)] rounded-2xl p-6 border border-[var(--border-light)] sticky top-4">

                        <!-- Active Filters -->
                        <div class="mb-6 pb-6 border-b border-[var(--border-light)]">
                            <h3 class="font-bold text-[var(--text-dark)] mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-filter text-[var(--accent)]"></i> Filters
                            </h3>

                            <!-- Filter Pills -->
                            <div class="flex flex-wrap gap-2" id="activeFilters">
                                <!-- Dynamic filter pills will appear here -->
                            </div>

                            <button class="text-sm text-[var(--accent)] hover:underline mt-3" id="clearAllFilters">
                                Clear all filters
                            </button>
                        </div>

                        <!-- Categories Filter -->
                        <div class="mb-6 pb-6 border-b border-[var(--border-light)]">
                            <h4 class="font-semibold text-[var(--text-dark)] mb-3">Categories</h4>
                            <div class="space-y-2">
                                @php
                                    $categories = [
                                        'home-decor' => 'Home Decor',
                                        'textile' => 'Textile & Apparel',
                                        'jewelry' => 'Jewelry',
                                        'kitchen' => 'Kitchen & Dining',
                                        'pottery' => 'Pottery & Ceramics',
                                        'woodwork' => 'Woodwork',
                                        'paintings' => 'Paintings & Art',
                                        'accessories' => 'Accessories',
                                    ];
                                @endphp

                                @foreach ($categories as $value => $label)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox"
                                            class="category-filter rounded border-[var(--border-light)] text-[var(--primary)] focus:ring-[var(--primary)]"
                                            value="{{ $value }}">
                                        <span class="text-[var(--text-soft)]">{{ $label }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-6 pb-6 border-b border-[var(--border-light)]">
                            <h4 class="font-semibold text-[var(--text-dark)] mb-3">Price Range</h4>
                            <div class="space-y-3">
                                <div class="flex gap-3">
                                    <input type="number" id="minPrice" placeholder="Min"
                                        class="input-custom !py-2 text-sm" min="0">
                                    <input type="number" id="maxPrice" placeholder="Max"
                                        class="input-custom !py-2 text-sm" min="0">
                                </div>
                                <button id="applyPriceFilter"
                                    class="text-sm bg-[var(--surface)] hover:bg-[var(--border-light)] px-4 py-2 rounded-lg transition w-full">
                                    Apply Price
                                </button>
                            </div>
                        </div>

                        <!-- Dokan Filter -->
                        <div class="mb-6">
                            <h4 class="font-semibold text-[var(--text-dark)] mb-3">Shops</h4>
                            <div class="space-y-2 max-h-60 overflow-y-auto">
                                @php
                                    $dokans = App\Models\Dokan::where('status', 'approved')->take(10)->get();
                                @endphp

                                @foreach ($dokans as $dokan)
                                    <label class="flex items-center gap-2 cursor-pointer">
                                        <input type="checkbox"
                                            class="dokan-filter rounded border-[var(--border-light)] text-[var(--primary)]"
                                            value="{{ $dokan->id }}">
                                        <span class="text-[var(--text-soft)] text-sm">{{ $dokan->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ========== PRODUCTS GRID ========== -->
                <div class="lg:col-span-3">

                    <!-- Sort Bar -->
                    <div
                        class="flex flex-wrap items-center justify-between mb-6 bg-[var(--surface-card)] p-4 rounded-xl border border-[var(--border-light)]">
                        <div class="text-sm text-[var(--text-soft)]">
                            Showing <span id="showingCount">12</span> of <span id="totalCount">48</span> products
                        </div>

                        <div class="flex items-center gap-3">
                            <label class="text-sm text-[var(--text-soft)]">Sort by:</label>
                            <select id="sortSelect"
                                class="border border-[var(--border-light)] rounded-lg px-4 py-2 bg-white text-sm focus:border-[var(--primary)] focus:ring-1 focus:ring-[var(--primary)]">
                                <option value="newest">Newest First</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="popular">Most Popular</option>
                                <option value="discount">Biggest Discount</option>
                            </select>
                        </div>
                    </div>

                    <!-- Products Grid -->
                    <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products as $product)
                            <div
                                class="product-card overflow-hidden group bg-white rounded-xl shadow-sm hover:shadow-md transition">
                                <div
                                    class="h-56 overflow-hidden bg-[#f5f2ee] flex items-center justify-center relative">
                                    <img src="{{ asset(Storage::url($product->images[0])) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @if ($product->discount > 0)
                                        <span
                                            class="absolute top-3 right-3 px-3 py-1 bg-red-600 text-white text-xs font-bold rounded-full">
                                            -{{ $product->discount }}%
                                        </span>
                                    @endif
                                    <button
                                        class="absolute top-3 left-3 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md opacity-0 group-hover:opacity-100 transition wishlist-btn">
                                        <i class="fa-regular fa-heart text-[var(--accent)]"></i>
                                    </button>
                                </div>
                                <div class="p-5">
                                    <div class="flex items-center gap-1 text-xs text-[var(--text-soft)] mb-2">
                                        <i class="fa-regular fa-store"></i>
                                        <span>{{ $product->dokan->name }}</span>
                                    </div>
                                    <h3 class="font-bold text-[var(--text-dark)] mb-2 line-clamp-2 min-h-[3.5rem]">
                                        {{ $product->name }}
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-baseline gap-2">
                                            @if ($product->discount > 0)
                                                <span class="text-xl font-bold text-[var(--primary)]">
                                                    Rs.{{ number_format($product->price - ($product->discount * $product->price) / 100, 0) }}
                                                </span>
                                                <span class="text-sm text-gray-400 line-through">
                                                    Rs.{{ number_format($product->price, 0) }}
                                                </span>
                                            @else
                                                <span class="text-xl font-bold text-[var(--primary)]">
                                                    Rs.{{ number_format($product->price, 0) }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex gap-2 mt-4">
                                        <a href="{{ route('product', $product->slug) }}"
                                            class="flex-1 btn-cart text-[var(--primary)] font-medium py-2 rounded-lg flex items-center justify-center gap-1 text-sm">
                                            <i class="fa-solid fa-eye"></i> View
                                        </a>
                                        <button
                                            class="w-10 h-10 border border-[var(--border-light)] rounded-lg flex items-center justify-center hover:bg-[var(--primary)] hover:text-white transition add-to-cart">
                                            <i class="fa-solid fa-cart-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Load More Button -->
                    <div class="text-center mt-10">
                        <button id="loadMoreBtn" class="btn-outline-accent px-8 py-3">
                            <i class="fa-solid fa-spinner mr-2"></i> Load More Products
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- ========== NEWSLETTER ========== -->
    <section class="bg-primary-5 py-14 mt-8">
        <div class="container text-center max-w-3xl">
            <i class="fa-solid fa-gift text-4xl text-[var(--accent)] mb-4"></i>
            <h4 class="text-3xl font-bold text-[var(--primary)]">Never miss a unique find</h4>
            <p class="text-[var(--text-soft)] mt-2">Subscribe to get updates on new products and artisan stories.</p>
            <div class="flex flex-col sm:flex-row gap-3 mt-6 justify-center">
                <input type="email" placeholder="Your email address" class="input-custom !w-auto sm:!w-80" />
                <button class="btn-primary !py-3">Subscribe Now</button>
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
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const categoryFilters = document.querySelectorAll('.category-filter');
        const dokanFilters = document.querySelectorAll('.dokan-filter');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const applyPriceBtn = document.getElementById('applyPriceFilter');
        const sortSelect = document.getElementById('sortSelect');
        const clearAllBtn = document.getElementById('clearAllFilters');
        const activeFiltersDiv = document.getElementById('activeFilters');

        // Add filter pill
        function addFilterPill(type, value, label) {
            const pill = document.createElement('span');
            pill.className = 'bg-[var(--surface)] px-3 py-1 rounded-full text-xs flex items-center gap-2';
            pill.innerHTML = `
                ${label}
                <button class="remove-filter hover:text-red-600" data-type="${type}" data-value="${value}">
                    <i class="fa-solid fa-times"></i>
                </button>
            `;
            activeFiltersDiv.appendChild(pill);

            // Add remove functionality
            pill.querySelector('.remove-filter').addEventListener('click', function() {
                removeFilter(type, value);
                pill.remove();
                filterProducts();
            });
        }

        // Remove filter
        function removeFilter(type, value) {
            if (type === 'category') {
                document.querySelector(`.category-filter[value="${value}"]`).checked = false;
            } else if (type === 'dokan') {
                document.querySelector(`.dokan-filter[value="${value}"]`).checked = false;
            } else if (type === 'price') {
                minPrice.value = '';
                maxPrice.value = '';
            }
        }

        // Filter products (AJAX call)
        function filterProducts() {
            const categories = Array.from(categoryFilters)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            const dokans = Array.from(dokanFilters)
                .filter(cb => cb.checked)
                .map(cb => cb.value);

            const priceMin = minPrice.value;
            const priceMax = maxPrice.value;
            const sort = sortSelect.value;

            // Update active filters display
            activeFiltersDiv.innerHTML = '';

            categories.forEach(cat => {
                const label = document.querySelector(`.category-filter[value="${cat}"]`)
                    .closest('label').querySelector('span').textContent;
                addFilterPill('category', cat, label);
            });

            dokans.forEach(dok => {
                const label = document.querySelector(`.dokan-filter[value="${dok}"]`)
                    .closest('label').querySelector('span').textContent;
                addFilterPill('dokan', dok, label);
            });

            if (priceMin || priceMax) {
                addFilterPill('price', 'range', `Rs.${priceMin || 0} - Rs.${priceMax || '∞'}`);
            }

            // Make AJAX call to filter products
            fetch('/api/products/filter', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        categories: categories,
                        dokans: dokans,
                        min_price: priceMin,
                        max_price: priceMax,
                        sort: sort
                    })
                })
                .then(response => response.json())
                .then(data => {
                    updateProductsGrid(data.products);
                    updateCounts(data.showing, data.total);
                });
        }

        // Update products grid
        function updateProductsGrid(products) {
            // Implementation depends on your AJAX response structure
            // You can replace the grid content with new HTML
        }

        // Update showing/total counts
        function updateCounts(showing, total) {
            document.getElementById('showingCount').textContent = showing;
            document.getElementById('totalCount').textContent = total;
        }

        // Event listeners
        categoryFilters.forEach(filter => {
            filter.addEventListener('change', filterProducts);
        });

        dokanFilters.forEach(filter => {
            filter.addEventListener('change', filterProducts);
        });

        applyPriceBtn.addEventListener('click', filterProducts);

        sortSelect.addEventListener('change', filterProducts);

        clearAllBtn.addEventListener('click', function() {
            categoryFilters.forEach(cb => cb.checked = false);
            dokanFilters.forEach(cb => cb.checked = false);
            minPrice.value = '';
            maxPrice.value = '';
            sortSelect.value = 'newest';
            filterProducts();
        });

        // Wishlist functionality
        document.querySelectorAll('.wishlist-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                if (icon.classList.contains('fa-regular')) {
                    icon.classList.remove('fa-regular');
                    icon.classList.add('fa-solid', 'text-red-500');
                } else {
                    icon.classList.remove('fa-solid', 'text-red-500');
                    icon.classList.add('fa-regular');
                }
            });
        });

        // Load more functionality
        document.getElementById('loadMoreBtn').addEventListener('click', function() {
            // Implement load more logic
            this.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Loading...';

            // Simulate loading
            setTimeout(() => {
                this.innerHTML = '<i class="fa-solid fa-spinner mr-2"></i> Load More Products';
            }, 2000);
        });
    });
</script>
