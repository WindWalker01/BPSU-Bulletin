<!-- Main Container -->
    <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <a href="/settings" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
            Back
        </a>

        <h1 class="text-3xl font-bold text-text-primary mb-10">Data and Storage</h1>

        <!-- Cache Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Cache</h2>
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-text-primary font-medium">Clear cache</p>
                    <p class="text-text-secondary text-sm">Clear cached files to free up space. This will not delete your files from the cloud.</p>
                </div>
                <button class="bg-brand cursor-pointer text-text-primary px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors whitespace-nowrap self-start sm:self-center">
                    Clear cache
                </button>
            </div>
        </section>

        <!-- Downloaded images Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Downloaded images</h2>
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-text-primary font-medium">Delete downloaded images</p>
                    <p class="text-text-secondary text-sm">Delete all downloaded images from your device. This will not delete your files from the cloud.</p>
                </div>
                <button class="bg-brand cursor-pointer text-text-primary px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors whitespace-nowrap self-start sm:self-center">
                    Delete images
                </button>
            </div>
        </section>

        <!-- Storage Section -->
        <section class="mb-8">
            <h2 class="text-xl font-semibold text-text-primary mb-4">Storage</h2>

            <div class="flex justify-between items-center mb-2">
                    <p class="text-text-primary font-medium">Storage used</p>
                    <p class="text-text-secondary text-sm">60%</p>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-card-dark rounded-full h-2 my-2">
                    <div class="bg-brand h-2 rounded-full" style="width: 60%"></div>
                </div>
                <p class="text-text-secondary text-sm mb-4">60 GB of 100 GB used</p>
                
            <div class="bg-overlay-dark/50 border border-card-dark rounded-lg p-4">
                <!-- View Storage Usage -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <p class="text-text-primary font-medium">View storage usage</p>
                        <p class="text-text-secondary text-sm">View storage usage by file type.</p>
                    </div>
                    <button class="bg-brand cursor-pointer text-text-primary px-4 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors whitespace-nowrap self-start sm:self-center">
                        View usage
                    </button>
                </div>
            </div>
        </section>

    </div>

      <?php view("partials/footer.php"); ?>