<x-frontend-layout>
    <div class="min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-10 border border-[var(--border-light)]">

                <!-- Logo/Brand -->
                <div class="text-center mb-8">
                    <div
                        class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-[var(--primary)] to-[var(--accent)] rounded-2xl mb-4">
                        <i class="fa-solid fa-crown text-white text-2xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold text-[var(--text-dark)] mb-2">Welcome Back</h1>
                    <p class="text-[var(--text-soft)]">Sign in to access your account</p>
                </div>

                <!-- Google Sign In Button -->
                <a href="{{ route('google.redirect') }}"
                    class="group relative w-full flex items-center justify-center gap-3 bg-white border-2 border-[var(--border-light)] hover:border-[var(--primary)] rounded-xl px-6 py-4 transition-all duration-300 shadow-sm hover:shadow-md">

                    <!-- Google Icon -->
                    <div class="w-6 h-6">
                        <svg viewBox="0 0 24 24" class="w-full h-full">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                    </div>

                    <span class="text-[var(--text-dark)] font-medium group-hover:text-[var(--primary)] transition">
                        Continue with Google
                    </span>

                    <i
                        class="fa-solid fa-arrow-right text-[var(--text-soft)] group-hover:translate-x-1 group-hover:text-[var(--primary)] transition-all"></i>
                </a>

                <!-- Divider -->
                <div class="relative my-8">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[var(--border-light)]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-[var(--text-soft)]">Secure sign in</span>
                    </div>
                </div>

                <!-- Benefits List -->
                <div class="space-y-3">
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-8 h-8 bg-green-50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-shield text-green-600 text-sm"></i>
                        </div>
                        <span>Secure authentication with Google</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-8 h-8 bg-blue-50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-bolt text-blue-600 text-sm"></i>
                        </div>
                        <span>One-click sign in - no password needed</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-[var(--text-soft)]">
                        <div class="w-8 h-8 bg-purple-50 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-gem text-purple-600 text-sm"></i>
                        </div>
                        <span>Access exclusive member benefits</span>
                    </div>
                </div>

                <!-- Terms -->
                <p class="text-xs text-center text-[var(--text-soft)] mt-8">
                    By continuing, you agree to SudamHub's
                    <a href="#" class="text-[var(--primary)] hover:underline">Terms of Service</a>
                    and
                    <a href="#" class="text-[var(--primary)] hover:underline">Privacy Policy</a>
                </p>
            </div>

            <!-- Footer Links -->
            <div class="text-center mt-6 space-y-2">
                <p class="text-sm text-[var(--text-soft)]">
                    New to SudamHub?
                    <a href="{{ route('home') }}#dokan-register"
                        class="text-[var(--accent)] font-medium hover:underline">
                        Become a seller
                    </a>
                </p>
                <a href="{{ route('home') }}"
                    class="inline-flex items-center gap-1 text-sm text-[var(--text-soft)] hover:text-[var(--primary)] transition">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Back to home
                </a>
            </div>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[var(--accent-soft-30)] rounded-full blur-3xl opacity-20">
        </div>
        <div
            class="absolute -bottom-40 -left-40 w-80 h-80 bg-[var(--primary-soft-30)] rounded-full blur-3xl opacity-20">
        </div>
    </div>

    <style>
        .min-h-\[calc\(100vh-200px\)\] {
            min-height: calc(100vh - 200px);
        }
    </style>
</x-frontend-layout>
