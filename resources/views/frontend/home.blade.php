<x-frontend-layout>

    <!-- ========== HERO SECTION ========== -->
    <section class="section-gap pb-8">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div>
                    <span class="pill-badge mb-4 inline-block"><i class="fa-regular fa-gem mr-1"></i> Handpicked
                        artisans</span>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight text-[var(--text-dark)]">
                        Discover <span class="text-[var(--primary)]">unique</span><br>
                        <span class="text-[var(--accent)]">handmade</span> treasures
                    </h1>
                    <p class="text-lg text-[var(--text-soft)] mt-5 max-w-xl">
                        SudamHub connects you with independent makers. Every purchase supports a small Dokan.
                    </p>
                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#" class="btn-primary text-lg px-8 py-3">Explore collection <i
                                class="fa-solid fa-arrow-right"></i></a>
                        <a href="#" class="btn-outline-accent text-lg px-8 py-3">Become a seller</a>
                    </div>
                </div>
                <div class="relative flex justify-center">
                    <div class="bg-accent-soft-30 w-80 h-80 rounded-full absolute -z-[5] blur-3xl"></div>
                    <img src="https://placehold.co/500x400/f2ede8/1e3a5f?text=SudamHub+Artisan" alt="hero visual"
                        class="rounded-3xl shadow-2xl border-8 border-white/80" style="max-width:100%; height:auto;" />
                </div>
            </div>
        </div>
    </section>

    <!-- ========== FEATURED PRODUCT CARDS ========== -->
    <section class="section-gap border-t border-[var(--border-light)]">
        <div class="container">
            <div class="flex items-end justify-between mb-10">
                <div>
                    <span class="pill-badge mb-2"><i class="fa-solid fa-wand-magic-sparkles"></i> Trending
                        now</span>
                    <h2 class="text-4xl font-bold text-[var(--primary)]">Handpicked for you</h2>
                </div>
                <a href="#"
                    class="text-[var(--accent)] font-semibold hover:underline flex items-center gap-1">View all <i
                        class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-7">
                <!-- Card 1 -->
                <div class="product-card overflow-hidden group">
                    <div class="h-56 bg-[#e8e1d7] flex items-center justify-center relative">
                        <i class="fa-solid fa-mug-saucer text-5xl text-primary-40"></i>
                        <span
                            class="absolute top-3 left-3 bg-[var(--accent)] text-white text-xs px-3 py-1 rounded-full">-15%</span>
                        <i
                            class="fa-regular fa-heart absolute top-3 right-3 text-xl text-primary-60 hover:text-red-400 cursor-pointer"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg text-[var(--text-dark)]">Ceramic Pour-Over</h3>
                            <span class="font-bold text-[var(--primary)]">$38</span>
                        </div>
                        <p class="text-sm text-[var(--text-soft)] mt-1">by ClayCraft Dokan</p>
                        <button
                            class="btn-cart mt-4 w-full text-[var(--primary)] font-medium py-2.5 rounded-xl flex items-center justify-center gap-2"><i
                                class="fa-solid fa-cart-plus"></i> Add to cart</button>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="product-card overflow-hidden group">
                    <div class="h-56 bg-[#dad3c9] flex items-center justify-center relative">
                        <i class="fa-solid fa-bag-shopping text-5xl text-primary-40"></i>
                        <i
                            class="fa-regular fa-heart absolute top-3 right-3 text-xl text-primary-60 hover:text-red-400 cursor-pointer"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg text-[var(--text-dark)]">Linen Tote (natural)</h3>
                            <span class="font-bold text-[var(--primary)]">$26</span>
                        </div>
                        <p class="text-sm text-[var(--text-soft)] mt-1">Weave & Wonder</p>
                        <button
                            class="btn-cart mt-4 w-full text-[var(--primary)] font-medium py-2.5 rounded-xl flex items-center justify-center gap-2"><i
                                class="fa-solid fa-cart-plus"></i> Add to cart</button>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="product-card overflow-hidden group">
                    <div class="h-56 bg-[#e0d5c4] flex items-center justify-center relative">
                        <i class="fa-solid fa-fire text-5xl text-primary-40"></i>
                        <span
                            class="absolute top-3 left-3 bg-[var(--primary)] text-white text-xs px-3 py-1 rounded-full">bestseller</span>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg text-[var(--text-dark)]">Soy wax candle</h3>
                            <span class="font-bold text-[var(--primary)]">$22</span>
                        </div>
                        <p class="text-sm text-[var(--text-soft)] mt-1">Aroma Dokan</p>
                        <button
                            class="btn-cart mt-4 w-full text-[var(--primary)] font-medium py-2.5 rounded-xl flex items-center justify-center gap-2"><i
                                class="fa-solid fa-cart-plus"></i> Add to cart</button>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="product-card overflow-hidden group">
                    <div class="h-56 bg-[#cfc5b8] flex items-center justify-center relative">
                        <i class="fa-solid fa-gem text-5xl text-primary-40"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg text-[var(--text-dark)]">Brass earrings</h3>
                            <span class="font-bold text-[var(--primary)]">$45</span>
                        </div>
                        <p class="text-sm text-[var(--text-soft)] mt-1">Metal & Stone</p>
                        <button
                            class="btn-cart mt-4 w-full text-[var(--primary)] font-medium py-2.5 rounded-xl flex items-center justify-center gap-2"><i
                                class="fa-solid fa-cart-plus"></i> Add to cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== DOKAN REGISTRATION SECTION ========== -->
    <section id="dokan-register" class="section-gap bg-surface-card-60 border-y border-[var(--border-light)]">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left column -->
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-10 h-10 rounded-full bg-accent-20 flex items-center justify-center"><i
                                class="fa-solid fa-store text-[var(--accent)]"></i></span>
                        <span class="pill-primary">Open your Dokan</span>
                    </div>
                    <h2 class="text-4xl font-extrabold text-[var(--primary)] leading-tight">Sell with
                        SudamHub.<br>Your own dashboard awaits.</h2>
                    <p class="text-lg text-[var(--text-soft)] mt-4 max-w-lg">
                        Register your Dokan — we'll review and approve your shop. Once approved, you'll get a
                        dedicated dashboard to add products, manage inventory, and track sales.
                    </p>
                    <ul class="mt-6 space-y-3">
                        <li class="flex items-center gap-3"><i
                                class="fa-solid fa-circle-check text-[var(--success)] text-xl"></i>
                            <span>Unlimited product listings</span>
                        </li>
                        <li class="flex items-center gap-3"><i
                                class="fa-solid fa-circle-check text-[var(--success)] text-xl"></i>
                            <span>Real-time order dashboard</span>
                        </li>
                        <li class="flex items-center gap-3"><i
                                class="fa-solid fa-circle-check text-[var(--success)] text-xl"></i> <span>Payouts
                                directly to your account</span></li>
                        <li class="flex items-center gap-3"><i
                                class="fa-solid fa-circle-check text-[var(--success)] text-xl"></i>
                            <span>Approval within 24h</span>
                        </li>
                    </ul>
                    <div class="mt-8 bg-[var(--surface)] p-5 rounded-2xl border border-[var(--border-light)]">
                        <p class="italic text-[var(--text-soft)]">"SudamHub gave my small pottery studio a global
                            audience. The dashboard is intuitive and powerful."</p>
                        <div class="flex items-center gap-3 mt-3"><span class="font-bold text-[var(--primary)]">—
                                Meera, Kathmandu Pottery</span></div>
                    </div>
                </div>

                <!-- Right column: REGISTRATION CARD -->
                <div class="bg-[var(--surface-card)] rounded-[2rem] shadow-xl p-8 border border-[var(--border-light)]">
                    <h3 class="text-2xl font-bold text-[var(--primary)] flex items-center gap-2 mb-2"><i
                            class="fa-solid fa-pen-to-square text-[var(--accent)]"></i> Register your Dokan</h3>
                    <p class="text-[var(--text-soft)] mb-6">Fill the form — we'll set up your dashboard after
                        approval.</p>

                    <form action="{{ route('dokan_registration') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="label-custom" for="dokanName">Full name / shop owner <span
                                    class="text-[var(--accent)]">*</span></label>
                            <input type="text" id="dokanName" name="name" placeholder="e.g. Suresh Maharjan"
                                class="input-custom" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-custom" for="email">Email address <span
                                    class="text-[var(--accent)]">*</span></label>
                            <input type="email" id="email" name="email" placeholder="owner@sudamhub.com"
                                class="input-custom" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-custom" for="contactNo">Contact number <span
                                    class="text-[var(--accent)]">*</span></label>
                            <input type="tel" id="contactNo" name="contact_no" placeholder="+977 9800000000"
                                class="input-custom" value="{{ old('contact_no') }}">
                            @error('contact_no')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div>
                            <label class="label-custom" for="message">Message / Tell us about your shop</label>
                            <textarea id="message" name="message" rows="3" placeholder="What products do you sell? Any website/social?"
                                class="input-custom">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-[red]">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="flex items-start gap-3 text-sm bg-[var(--surface)] p-3 rounded-xl">
                            <i class="fa-solid fa-shield-halved text-[var(--primary)] mt-0.5"></i>
                            <span>After approval, you will receive an email with a link to your vendor dashboard
                                where you can add products.</span>
                        </div>
                        <button type="submit" class="btn-primary w-full !py-3.5 !text-base justify-center"><i
                                class="fa-solid fa-paper-plane"></i> Submit for approval</button>
                        <p class="text-xs text-center text-[var(--text-soft)] mt-3">By registering you agree to
                            SudamHub's seller terms.</p>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== CATEGORY BANNER ========== -->
    <section class="section-gap">
        <div class="container">
            <div class="flex flex-wrap items-center justify-between mb-8">
                <h3 class="text-3xl font-bold text-[var(--primary)]">Shop by category</h3>
                <a href="#" class="text-[var(--accent)] font-medium flex items-center gap-1">All categories
                    <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <div
                    class="bg-[var(--surface-card)] p-5 rounded-2xl shadow-sm border border-[var(--border-light)] flex flex-col items-center text-center hover:border-[var(--accent)] transition">
                    <i class="fa-solid fa-couch text-3xl text-[var(--primary)] mb-3"></i>
                    <span class="font-semibold">Home decor</span>
                </div>
                <div
                    class="bg-[var(--surface-card)] p-5 rounded-2xl shadow-sm border border-[var(--border-light)] flex flex-col items-center text-center hover:border-[var(--accent)] transition">
                    <i class="fa-solid fa-shirt text-3xl text-[var(--primary)] mb-3"></i>
                    <span class="font-semibold">Textile & apparel</span>
                </div>
                <div
                    class="bg-[var(--surface-card)] p-5 rounded-2xl shadow-sm border border-[var(--border-light)] flex flex-col items-center text-center hover:border-[var(--accent)] transition">
                    <i class="fa-regular fa-gem text-3xl text-[var(--primary)] mb-3"></i>
                    <span class="font-semibold">Jewelry</span>
                </div>
                <div
                    class="bg-[var(--surface-card)] p-5 rounded-2xl shadow-sm border border-[var(--border-light)] flex flex-col items-center text-center hover:border-[var(--accent)] transition">
                    <i class="fa-solid fa-mug-saucer text-3xl text-[var(--primary)] mb-3"></i>
                    <span class="font-semibold">Kitchen & dining</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ========== NEWSLETTER / PROMO ========== -->
    <section class="bg-primary-5 py-14">
        <div class="container text-center max-w-3xl">
            <i class="fa-solid fa-envelope-open-text text-4xl text-[var(--accent)] mb-4"></i>
            <h4 class="text-3xl font-bold text-[var(--primary)]">Get artisan updates</h4>
            <p class="text-[var(--text-soft)] mt-2">Be the first to know about new Dokans and exclusive deals.</p>
            <div class="flex flex-col sm:flex-row gap-3 mt-6 justify-center">
                <input type="email" placeholder="Your email" class="input-custom !w-auto sm:!w-80" />
                <button class="btn-primary !py-3">Subscribe</button>
            </div>
        </div>
    </section>

</x-frontend-layout>
