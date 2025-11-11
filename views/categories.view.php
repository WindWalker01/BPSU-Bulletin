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

            <!-- Right: Sort By Dropdown -->
           <div class="relative w-full md:w-60" x-data="{ open: false, selected: 'Main' }">
                <label class="block text-sm text-text-secondary mb-2">Sort By</label>
                
                <!-- Custom Select Button -->
                <button @click="open = !open"
                    class="flex items-center justify-between pl-4 pr-3 py-2.5 rounded-lg text-white bg-brand border border-brand hover:bg-brand-hover focus:outline-none focus:ring-2 focus:ring-brand-hover focus:ring-opacity-50 cursor-pointer w-full">
                    
                    <!-- Displays the selected option text -->
                    <span x-text="selected + ' Campus'">Main Campus</span>
                    
                    <!-- Animated Arrow -->
                    <span class="material-symbols-outlined transition-transform duration-300"
                          :class="{ 'rotate-180': open }">
                        expand_more
                    </span>
                </button>
                
                <!-- Dropdown Panel -->
                <div x-show="open" @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 transform scale-100"
                     x-transition:leave-end="opacity-0 transform scale-95"
                     class="absolute z-10 mt-2 w-full bg-overlay-dark rounded-lg shadow-lg border border-card-dark overflow-hidden"
                     x-cloak>
                     
                    <a @click="selected = 'Main'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Main Campus</a>
                    <a @click="selected = 'Abucay'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Abucay Campus</a>
                    <a @click="selected = 'Balanga'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Balanga Campus</a>
                    <a @click="selected = 'Orani'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Orani Campus</a>
                    <a @click="selected = 'Orani'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Dinalupihan Campus</a>
                    <a @click="selected = 'Orani'; open = false" class="block px-4 py-3 text-text-primary hover:bg-brand/10 cursor-pointer text-sm">Bagac Campus</a>
                </div>
                
                <!-- Hidden, real select for form submission (links to Alpine state) -->
                <select name="program" id="campus" x-model="selected" class="hidden">
                    <option value="Main">Main Campus</option>
                    <option value="Abucay">Abucay Campus</option>
                    <option value="Balanga">Balanga Campus</option>
                    <option value="Orani">Orani Campus</option>
                </select>
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