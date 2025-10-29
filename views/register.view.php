<main class="flex min-h-screen">
        
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16">
            <div class="w-full max-w-lg space-y-8">
                
  
                <div>
                    <img src="/assets/logo.webp" class="w-35 h-35">
                </div>

    <main class="flex min-h-screen">
        <!-- Left Column: Form Content -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-16">
            <div class="w-full max-w-lg space-y-8">
                
                <!-- Logo -->
                <div>
                    <!-- Using a placeholder for the logo as seen in the image -->
                    <img src="/assets/logo.webp" class="w-35 h-35">
                </div>

                <!-- Heading -->
                <div>
                    <h1 class="text-2xl text-center sm:text-3xl font-bold text-[var(--color-text-primary)]">
                        Be Part of the BPSU Bulletin!
                    </h1>
                    <p class="mt-2 text-center text-[var(--color-text-secondary)]" style="animation-delay: 0.2s;">
                        A place where every Ka-Treyd stays informed and connected.
                    </p>
                </div>

                <!-- Sign Up Form -->
                <form class="space-y-6" action="/register" method="POST">
                    
                
                    <!-- Email Input -->
                    <div  style="animation-delay: 0.3s;">
                        <label for="email" class="block text-sm font-medium text-[var(--color-text-secondary)]">Email</label>
                        <div class="mt-1">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                   placeholder="john.doe@gmail.com"
                                   class="w-full px-4 py-3 bg-[var(--color-card-dark)] border-0 rounded-lg text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)]">
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div  style="animation-delay: 0.4s;">
                        <label for="password" class="block text-sm font-medium text-[var(--color-text-secondary)]">Password</label>
                        <div class="mt-1 relative">
                            <input id="password" name="password" type="password" autocomplete="new-password" required
                                   placeholder="*****************"
                                   class="w-full px-4 py-3 bg-[var(--color-card-dark)] border-0 rounded-lg text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)]">
                            <span class="password-toggle absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-[var(--color-text-secondary)] hover:text-[var(--color-text-primary)]">
                                <span class="material-symbols-outlined fill-1" style="font-size: 20px;">visibility_off</span>
                            </span>
                        </div>
                    </div>

                    <!-- Confirm Password Input -->
                    <div  style="animation-delay: 0.5s;">
                        <label for="confirm-password" class="block text-sm font-medium text-[var(--color-text-secondary)]">Confirm Password</label>
                        <div class="mt-1 relative">
                            <input id="confirm-password" name="confirm-password" type="password" autocomplete="new-password" required
                                   placeholder="*****************"
                                   class="w-full px-4 py-3 bg-[var(--color-card-dark)] border-0 rounded-lg text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)]">
                            <span class="password-toggle absolute inset-y-0 right-0 pr-4 flex items-center cursor-pointer text-[var(--color-text-secondary)] hover:text-[var(--color-text-primary)]">
                                <span class="material-symbols-outlined fill-1" style="font-size: 20px;">visibility_off</span>
                            </span>
                        </div>
                    </div>

                    <!-- Create Account Button -->
                    <div  style="animation-delay: 0.6s;">
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-bold text-white bg-[var(--color-brand)] hover:bg-[var(--color-brand-hover)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-brand)] transition-colors">
                            Create Account
                        </button>
                    </div>

                    <!-- OR Divider -->
                    <div class="relative flex items-center justify-center" style="animation-delay: 0.7s;">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-[var(--color-card-dark)]"></div>
                        </div>
                        <div class="relative px-3 bg-[var(--color-bg-dark)] text-sm text-[var(--color-text-secondary)]">
                            OR
                        </div>
                    </div>

                    <!-- Login with Google Button -->
                    
                </form>
                <form  action="/login_google" method="GET">
                        <button type="submit"
                                class="w-full flex items-center justify-center py-3 px-4 border border-[var(--color-card-dark)] rounded-lg shadow-sm bg-[var(--color-overlay-dark)] text-sm font-medium text-[var(--color-text-primary)] hover:bg-[var(--color-card-light)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-brand)] transition-colors">
                            <!-- Google G Logo SVG -->
                            <svg class="w-5 h-5 mr-3" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill="#C00000" d="M43.611 20.083H42V20H24V28H35.303C33.61 32.657 29.17 36 24 36C17.373 36 12 30.627 12 24C12 17.373 17.373 12 24 12C26.855 12 29.413 13.111 31.458 14.851L37.019 9.289C33.373 6.172 28.941 4 24 4C12.954 4 4 12.954 4 24C4 35.046 12.954 44 24 44C35.046 44 44 35.046 44 24C44 22.659 43.862 21.35 43.611 20.083Z"></path>
                                <path fill="#C00000" d="M6.306 14.691L11.731 18.455C13.013 15.067 15.897 12.581 19.349 11.196L13.793 5.64C9.805 8.133 7.041 11.233 6.306 14.691Z"></path>
                                <path fill="#C00000" d="M24 44C28.941 44 33.373 41.828 37.019 38.711L31.458 33.149C29.413 34.889 26.855 36 24 36C20.519 36 17.609 33.481 16.31 30.03L10.884 33.794C13.518 39.578 18.381 44 24 44Z"></Dpath>
                                <path fill="#C00000" d="M43.611 20.083H42V20H24V28H35.303C34.51 30.364 32.868 32.332 30.832 33.516L30.832 33.516L36.393 39.077C39.638 36.313 42.063 32.556 42.661 28.188C43.862 25.064 44 24.008 44 24C44 22.659 43.862 21.35 43.611 20.083Z"></path>
                            </svg>
                            Sign in with Google
                        </button>
                </form>
                <!-- Login Link -->
                <div class="text-sm text-center text-[var(--color-text-secondary)]">
                    Already have an account?
                    <a href="/login" class="font-medium text-[var(--color-brand)] hover:text-[var(--color-brand-hover)] hover:underline">
                        Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Right Column: Image with Gradient -->
        <div class=" lg:block lg:w-1/2 relative overflow-hidden">
            <!-- Background Image -->
            <img src="assets/bg-asset.png"
                 alt="University building architecture"
                 class="absolute inset-0 w-full h-full object-cover">
            
            <!-- Red Tint Overlay -->
              <div class="absolute inset-0 bg-[var(--color-brand)] mix-blend-multiply opacity-50"></div>

            <!-- 
              Gradient Fade Overlay: 
              This creates the fade from the background color (left) to transparent (right),
              achieving the effect from the image.
            -->
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
