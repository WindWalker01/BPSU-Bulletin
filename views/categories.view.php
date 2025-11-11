   <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

      <style type="text/css">
        [x-cloak] {
            display: none !important;
        }
    </style>

   
   <div class="container max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between md:items-center gap-6 mb-12">
            
            <!-- Left: Title -->
            <div class="">
                <h1 class="text-4xl font-bold text-text-primary">Browse Categories</h1>
                <p class="text-lg text-text-secondary mt-2">Updates, events, and official notices for the campus community.</p>
            </div>
        </div>

        <!-- Category Cards Grid -->
        <!-- This layout uses the 4-column flex structure from your original code -->
        <div class="flex flex-col lg:flex-row gap-5">
            
            <!-- Column 1: Announcements & Enrollment -->
            <div class="flex flex-col flex-1 gap-5">
                <a href="/announcement"
                    class="group bg-overlay-dark/50 hover:bg-brand/10 transition-all duration-300 p-6 rounded-lg border border-card-dark text-left focus:outline-none focus:ring-2 focus:ring-brand cursor-pointer w-full">
                    <span class="material-symbols-outlined text-brand text-3xl mb-3">campaign</span>
                    <p class="text-lg font-semibold text-text-primary">University Announcement</p>
                    <p class="text-sm text-text-secondary">Latest news and updates</p>
                </a>

                <a href="/enrollment"
                    class="group bg-overlay-dark/50 hover:bg-brand/10 transition-all duration-300 p-6 rounded-lg border border-card-dark text-left focus:outline-none focus:ring-2 focus:ring-brand cursor-pointer w-full">
                    <span class="material-symbols-outlined text-brand text-3xl mb-3">description</span>
                    <p class="text-lg font-semibold text-text-primary">Enrollment & Documents</p>
                    <p class="text-sm text-text-secondary">Registration and Course Information</p>
                </a>
            </div>

            <!-- Column 2: Organizations -->
            <div class="flex flex-col flex-1 gap-5">
                <a href="/organization"
                    class="group bg-overlay-dark/50 hover:bg-brand/10 transition-all duration-300 p-6 rounded-lg border border-card-dark text-left focus:outline-none focus:ring-2 focus:ring-brand cursor-pointer w-full">
                    <span class="material-symbols-outlined text-brand text-3xl mb-3">groups</span>
                    <p class="text-lg font-semibold text-text-primary">Organizations</p>
                    <p class="text-sm text-text-secondary">Clubs and student groups</p>
                </a>
            </div>

            <!-- Column 3: Scholarship -->
            <div class="flex flex-col flex-1 gap-5">
                <a href="/scholar"
                    class="group bg-overlay-dark/50 hover:bg-brand/10 transition-all duration-300 p-6 rounded-lg border border-card-dark text-left focus:outline-none focus:ring-2 focus:ring-brand cursor-pointer w-full">
                    <span class="material-symbols-outlined text-brand text-3xl mb-3">school</span>
                    <p class="text-lg font-semibold text-text-primary">Scholarship</p>
                    <p class="text-sm text-text-secondary">Financial aid opportunities</p>
                </a>
            </div>

            <!-- Column 4: Achievements -->
            <div class="flex flex-col flex-1 gap-5">
                <a href="/achievement"
                    class="group bg-overlay-dark/50 hover:bg-brand/10 transition-all duration-300 p-6 rounded-lg border border-card-dark text-left focus:outline-none focus:ring-2 focus:ring-brand cursor-pointer w-full">
                    <span class="material-symbols-outlined text-brand text-3xl mb-3">military_tech</span>
                    <p class="text-lg font-semibold text-text-primary">Achievements</p>
                    <p class="text-sm text-text-secondary">Student and faculty accomplishments.</p>
                </a>
            </div>
        </div>
    </div>

<?php view("partials/footer.php"); ?>
