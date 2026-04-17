<header class="sticky top-0 z-30 bg-surface-card-80 backdrop-blur-md border-b border-[var(--border-light)] py-4">
    <div class="container flex items-center justify-between">
        <div class="flex items-center gap-2">
            <div
                class="w-10 h-10 bg-gradient-to-br from-[var(--primary)] to-[var(--primary-light)] rounded-xl flex items-center justify-center shadow-md">
                <i class="fa-solid fa-cube text-white text-xl"></i>
            </div>
            <span class="text-3xl font-bold tracking-tight text-[var(--primary)]">Sudam<span
                    class="text-[var(--accent)]">Hub</span></span>
        </div>

        <nav class="hidden lg:flex items-center gap-8 font-medium text-[var(--text-soft)]">
            <a href="{{ route('home') }}" class="hover:text-[var(--primary)] transition">Home</a>
            <a href="{{ route('products') }}" class="hover:text-[var(--primary)] transition">Shop</a>
            <a href="{{ route('deals') }}" class="hover:text-[var(--primary)] transition">Deals</a>
        </nav>

        <div class="flex items-center gap-4">
            <a href="{{ route('order.history') }}" class="hover:text-[var(--primary)] transition">Orders</a>

            <i
                class="fa-solid fa-magnifying-glass text-xl text-[var(--text-soft)] cursor-pointer hover:text-[var(--primary)]"></i>

            <a href="{{route('cart')}}">
                <i
                class="fa-solid fa-cart-shopping text-xl text-[var(--text-soft)] cursor-pointer hover:text-[var(--primary)]"></i>
            </a>
            @if (!Auth::guard('web')->user())
                <a href="{{ route('login') }}" class="hidden sm:inline-block btn-outline-accent !py-2 !px-5 text-sm">
                    Sign in
                </a>
            @else
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit"
                        class="hidden sm:inline-block btn-outline-accent !py-2 !px-5 text-sm">Logout</button>
                </form>
            @endif
        </div>
    </div>
</header>
