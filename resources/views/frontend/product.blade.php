<x-frontend-layout>

    <!-- ========== BREADCRUMB ========== -->
    <div class="container py-4">
        <nav class="flex text-sm text-[var(--text-soft)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)]">Home</a>
            <span class="mx-2">/</span>
            <a href="#" class="hover:text-[var(--primary)]">Products</a>
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
                                <span class="text-3xl font-bold text-[var(--primary)]">
                                    Rs.{{ number_format($product->price - ($product->discount * $product->price) / 100, 2) }}
                                </span>
                                <span class="text-lg text-gray-400 line-through">
                                    Rs.{{ number_format($product->price, 2) }}
                                </span>
                                <span class="pill-badge bg-red-100 text-red-700 ml-2">
                                    {{ $product->discount }}% OFF
                                </span>
                            @else
                                <span class="text-3xl font-bold text-[var(--primary)]">
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

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="btn-primary flex-1 py-4 text-lg justify-center">
                            <i class="fa-solid fa-cart-shopping mr-2"></i> Add to Cart
                        </button>
                    </div>

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
                    <a href="#"
                        class="text-[var(--accent)] font-semibold hover:underline flex items-center gap-1">
                        View all <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="product-card overflow-hidden group">
                            <div class="h-56 overflow-hidden bg-[#e8e1d7] flex items-center justify-center relative">
                                <img src="{{ asset(Storage::url($relatedProduct->images[0])) }}"
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

</x-frontend-layout>

<!-- JavaScript for Image Gallery -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');

        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Update main image
                const imageUrl = this.dataset.image;
                mainImage.src = imageUrl;

                // Update active state
                thumbnails.forEach(t => {
                    t.classList.remove('border-[var(--primary)]');
                    t.classList.add('border-transparent');
                });
                this.classList.remove('border-transparent');
                this.classList.add('border-[var(--primary)]');
            });
        });
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
</style>
