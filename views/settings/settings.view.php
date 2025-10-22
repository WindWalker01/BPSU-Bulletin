<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <h1 class="text-3xl font-bold text-text-primary mb-10">Settings</h1>

        <!-- Account Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary ">Account</h2>
            <div class="border-b border-card-dark mt-4"></div>
            <a href="/user_profile" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
                <!-- Icon + Text -->
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                        <span class="material-symbols-outlined  text-brand">person</span>
                    </div>
                    <div>
                        <p class="text-text-primary font-medium">Account Settings</p>
                        <p class="text-text-secondary text-sm">Manage your account details, including your name, email, and password.</p>
                    </div>
                </div>
                <!-- Chevron -->
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
        </section>

        <!-- Preferences Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Preferences</h2>
              <div class="border-b border-card-dark mt-4"></div>
            <a href="preferences" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-brand">shield</span>
                    </div>
                    <div>
                        <p class="text-text-primary font-medium">Preferences</p>
                        <p class="text-text-secondary text-sm">Customize how you receive notifications, including email and in-app alerts.</p>
                    </div>
                </div>
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
        </section>

        <!-- Data & Storage Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Data & Storage</h2>
              <div class="border-b border-card-dark mt-4"></div>
            <a href="data" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-brand">database</span>
                    </div>
                    <div>
                        <p class="text-text-primary font-medium">Data & Storage</p>
                        <p class="text-text-secondary text-sm">Manage your data and storage usage.</p>
                    </div>
                </div>
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
        </section>

        <!-- Feedback Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Feedback</h2>
                        <div class="border-b border-card-dark mt-4"></div>
            <a href="feedback" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-brand">feedback</span>
                    </div>
                    <div>
                        <p class="text-text-primary font-medium">Provide Feedback</p>
                        <p class="text-text-secondary text-sm">Share your thoughts and suggestions with us.</p>
                    </div>
                </div>
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
        </section>

        <!-- Danger Zone Section -->
        <section class="mt-20">
            <!-- Deactivate Account -->
            <a href="#" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
                <div>
                    <p class="text-brand-hover font-medium group-hover:text-brand-hover/85 transition-colors">Deactivate account</p>
                    <p class="text-text-secondary text-sm">Deactivating will suspend your account until you sign back in.</p>
                </div>
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
            
            <!-- Delete Account -->
            <a href="#" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group mt-2">
                <div>
                    <p class="text-brand-hover font-medium group-hover:text-brand-hover/85 transition-colors">Delete account</p>
                    <p class="text-text-secondary text-sm">Permanently delete your account and all your content.</p>
                </div>
                <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
            </a>
        </section>

    </div>

  <?php view("partials/footer.php"); ?>