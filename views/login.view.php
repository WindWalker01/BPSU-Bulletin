<main class="flex min-h-screen">
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16">
        <div class="w-full max-w-lg space-y-8">

            <!-- Logo -->
            <div class="flex justify-center">
                <img src="/assets/logo.webp" class="w-35 h-35" alt="BPSU Bulletin Logo">
            </div>

            <!-- Heading -->
            <div>
                <h1 class="text-2xl text-center sm:text-3xl font-bold text-[var(--color-text-primary)]">
                    Welcome Back , Ka-Treyd!
                </h1>
                <p class="mt-2 text-center text-[var(--color-text-secondary)]">
                    Step into your BPSU Bulletin — the official hub for every announcement, event, and story that matters to our campus.
                </p>
            </div>

            <!-- Login Form -->
            <form action="/login" method="POST" class="space-y-6">
                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--color-text-secondary)]">Email</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            placeholder="john.doe@gmail.com"
                            class="w-full px-4 py-3 bg-[var(--color-card-dark)] border-0 rounded-lg 
                                   text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] 
                                   focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)]">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium text-[var(--color-text-secondary)]">Password</label>
                        <a href="#" class="text-sm text-[var(--color-brand)] hover:text-[var(--color-brand-hover)] hover: un">
                            Forgot password?
                        </a>
                    </div>
                    <div class="mt-1 relative">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            placeholder="*****************"
                            class="w-full px-4 py-3 bg-[var(--color-card-dark)] border-0 rounded-lg 
                                   text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] 
                                   focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)]">
                        <span class="password-toggle absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer 
                                     text-[var(--color-text-secondary)] hover:text-[var(--color-text-primary)]">
                            <span class="material-symbols-outlined fill-1" style="font-size: 20px;">visibility_off</span>
                        </span>
                    </div>
                </div>

                <!-- Sign In Button -->
                <div>
                    <button type="submit"
                        class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm 
                               text-sm font-bold text-white bg-[var(--color-brand)] hover:bg-[var(--color-brand-hover)] 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-brand)] 
                               transition-colors">
                        Log In
                    </button>
                </div>

                <!-- OR Divider -->
                <div class="relative flex items-center justify-center">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[var(--color-card-dark)]"></div>
                    </div>
                    <div class="relative px-3 bg-[var(--color-bg-dark)] text-sm text-[var(--color-text-secondary)]">
                        OR
                    </div>
                </div>
            </form>

            <!-- Login with Google -->
            <form action="/login_google" method="GET">
                <button type="submit"
                    class="w-full flex items-center justify-center py-3 px-4 border border-[var(--color-card-dark)] 
                           rounded-lg shadow-sm bg-[var(--color-overlay-dark)] text-sm font-medium 
                           text-[var(--color-text-primary)] hover:bg-[var(--color-card-light)] 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-brand)] 
                           transition-colors">
                    <svg class="w-5 h-5 mr-3" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill="#C00000"
                            d="M43.611 20.083H42V20H24V28H35.303C33.61 32.657 29.17 36 24 36C17.373 36 12 30.627 12 24C12 17.373 17.373 12 24 12C26.855 12 29.413 13.111 31.458 14.851L37.019 9.289C33.373 6.172 28.941 4 24 4C12.954 4 4 12.954 4 24C4 35.046 12.954 44 24 44C35.046 44 44 35.046 44 24C44 22.659 43.862 21.35 43.611 20.083Z">
                        </path>
                    </svg>
                    Log in with Google
                </button>
            </form>

            <!-- Register Link -->
            <div class="text-sm text-right text-[var(--color-text-secondary)]">
                Don't have an account?
                <a href="/register" class="font-medium text-[var(--color-brand)] hover:text-[var(--color-brand-hover)] hover:underline">
                    Create Account
                </a>
            </div>
        </div>
    </div>

    <!-- Right Column: Image with Gradient -->
    <div class="hidden lg:block lg:w-1/2 relative overflow-hidden">
        <img src="assets/bg-asset.png" alt="University background"
             class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-[var(--color-brand)] mix-blend-multiply opacity-50"></div>
        <div class="absolute inset-0 opacity-80 bg-gradient-to-r from-[var(--color-bg-dark)] via-[var(--color-bg-dark)]/50 to-transparent"></div>
    </div>
</main>

<!-- JavaScript for Password Toggle -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleButtons = document.querySelectorAll('.password-toggle');
        toggleButtons.forEach(button => {
            button.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const icon = this.querySelector('span.material-symbols-outlined');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.textContent = 'visibility';
                } else {
                    input.type = 'password';
                    icon.textContent = 'visibility_off';
                }
            });
        });
    });
</script>

<?php view("partials/footer.php"); ?>