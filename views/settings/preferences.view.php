
 <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <a href="/settings" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
            Back
        </a>

        <h1 class="text-3xl font-bold text-text-primary mb-2">Preferences</h1>
        <p class="text-text-secondary mb-10">Set your preferences for announcements, alerts, and updates.</p>
        
        <h1 class="text-xl font-bold text-text-primary mb-2">Alerts & Updates</h1>
        <!-- Toggle Component -->
        <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
            <!-- New Announcement -->
            <div class="flex justify-between items-center p-4">
                <div>
                    <p class="text-text-primary font-medium">New Announcement</p>
                    <p class="text-text-secondary text-sm">Receive an email when a new official announcement is posted</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                </label>
            </div>
            <!-- Content Updates -->
            <div class="border-t border-card-dark flex justify-between items-center p-4">
                <div>
                    <p class="text-text-primary font-medium">Content Updates</p>
                    <p class="text-text-secondary text-sm">Be alerted by email when an announcement is edited or updated by an author.</p>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer" checked>
                    <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                </label>
            </div>
        </div>


        <!-- In-App Notifications Section -->
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">In-App Notifications</h2>
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
                <!-- Announcement Activity -->
                <div class="flex justify-between items-center p-4">
                    <div>
                        <p class="text-text-primary font-medium">Announcement Activity</p>
                        <p class="text-text-secondary text-sm">View notifications for new announcements directly within the Bulletin.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                    </label>
                </div>
                <!-- Reactions & Comments -->
                <div class="border-t border-card-dark flex justify-between items-center p-4">
                    <div>
                        <p class="text-text-primary font-medium">Reactions & Comments</p>
                        <p class="text-text-secondary text-sm">Be notified when someone comments on or reacts to your post.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                    </label>
                </div>
                 <!-- Mentions -->
                 <div class="border-t border-card-dark flex justify-between items-center p-4">
                    <div>
                        <p class="text-text-primary font-medium">Mentions</p>
                        <p class="text-text-secondary text-sm">Get notified when your account is mentioned in a comment or post.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                    </label>
                </div>
            </div>
        </section>

        <!-- Push Notifications Section -->
        <section class="mt-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Push Notifications</h2>
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
                <!-- Important Announcements -->
                <div class="flex justify-between items-center p-4">
                    <div>
                        <p class="text-text-primary font-medium">Important Announcements</p>
                        <p class="text-text-secondary text-sm">Get notified right away for important updates.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                    </label>
                </div>
                <!-- New Posts -->
                <div class="border-t border-card-dark flex justify-between items-center p-4">
                    <div>
                        <p class="text-text-primary font-medium">New Posts</p>
                        <p class="text-text-secondary text-sm">Push alerts when new announcements are posted.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer">
                        <div class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"></div>
                    </label>
                </div>
            </div>
        </section>

         <!-- Theme Section -->
       <section class="mt-8">
            <h2 class="text-xl font-semibold text-text-primary mb-2">Theme</h2>
            <p class="text-text-secondary mb-4">Customize your Bulletin appearance by choosing between light, dark, or system themes.</p>
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-text-primary font-medium">Theme Mode</p>
                    <p class="text-text-secondary text-sm">Choose how the Bulletin appears: Light, Dark, or System default.</p>
                </div>
                
                <div class="relative">
                    <button id="themeButton" class="bg-brand text-text-primary px-4 py-2 rounded-lg text-sm hover:bg-brand-hover transition-colors whitespace-nowrap flex items-center gap-2 w-36 justify-center">
                        <span id="theme-icon" class="material-symbols-outlined text-base"></span>
                        <span id="theme-text" class="font-medium"></span>
                        <span class="material-symbols-outlined text-base ml-auto">expand_more</span>
                    </button>

                    <div id="themeDropdown" class="absolute right-0 bottom-full mb-2 w-48 bg-overlay-dark/50 border border-card-dark rounded-lg shadow-lg hidden z-50 py-1 text-text-secondary">
                        <a href="#" class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark" data-theme="light">
                            <span class="material-symbols-outlined fill-1 text-base">light_mode</span>
                            Light
                        </a>
                        <a href="#" class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark" data-theme="dark">
                            <span class="material-symbols-outlined fill-1 text-base">dark_mode</span>
                            Dark
                        </a>
                        <a href="#" class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark" data-theme="system">
                            <span class="material-symbols-outlined fill-1 text-base">desktop_windows</span>
                            System
                        </a>
                    </div>
                </div>

            </div>
        </section>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const themeButton = document.getElementById('themeButton');
    const themeDropdown = document.getElementById('themeDropdown');
    const themeIcon = document.getElementById('theme-icon');
    const themeText = document.getElementById('theme-text');
    const themeOptionButtons = document.querySelectorAll('.theme-option-button');
    
    // Icons and Text for the button
    const themeMap = {
        'light': { icon: 'light_mode', text: 'Light' },
        'dark': { icon: 'dark_mode', text: 'Dark' },
        'system': { icon: 'desktop_windows', text: 'System' }
    };

    // 1. Function to apply the theme AND update the button
    function applyTheme(theme) {
        let effectiveTheme = theme;

        if (theme === 'system') {
            // Check system preference
            const systemThemeMatcher = window.matchMedia('(prefers-color-scheme: dark)');
            effectiveTheme = systemThemeMatcher.matches ? 'dark' : 'light';
        }

        // Apply 'dark' class to <html> element
        if (effectiveTheme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        // Update the button text and icon
        if (themeMap[theme] && themeIcon && themeText) {
            themeIcon.textContent = themeMap[theme].icon;
            themeText.textContent = themeMap[theme].text;
        }
        
        // Save preference to localStorage
        localStorage.setItem('theme', theme);

        // Close dropdown
        if (themeDropdown) {
            themeDropdown.classList.add('hidden');
        }
    }

    // 2. Function to initialize the button's state on page load
    function initButtonState() {
        const savedTheme = localStorage.getItem('theme') || 'system';
        if (themeMap[savedTheme] && themeIcon && themeText) {
            themeIcon.textContent = themeMap[savedTheme].icon;
            themeText.textContent = themeMap[savedTheme].text;
        }
    }

    // 3. Event Listeners
    if (themeButton && themeDropdown) {
        // Toggle dropdown
        themeButton.addEventListener('click', (event) => {
            event.stopPropagation();
            themeDropdown.classList.toggle('hidden');
        });

        // Close dropdown when clicking outside
        window.addEventListener('click', () => {
            if (!themeDropdown.classList.contains('hidden')) {
                themeDropdown.classList.add('hidden');
            }
        });

        // Listen to theme option clicks
        themeOptionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.preventDefault(); // Stop the <a> tag from navigating
                const newTheme = e.currentTarget.dataset.theme;
                applyTheme(newTheme);
            });
        });

        // Listen for changes in system theme (to update <html> tag)
        const systemThemeMatcher = window.matchMedia('(prefers-color-scheme: dark)');
        systemThemeMatcher.addEventListener('change', (e) => {
            // Only re-apply if user's preference is 'system'
            if (localStorage.getItem('theme') === 'system') {
                applyTheme('system');
            }
        });
    }
    
    // 4. Run initialization for the button
    initButtonState();
});
    </script>
    <?php view("partials/footer.php"); ?>