<main class="flex flex-1 flex-col">
    
    <!-- Hero Section (New Layout, Original Text) -->
    <section class="w-full">
        <div class="mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-32 lg:px-8 lg:py-40">
            <div class="flex min-h-[400px] flex-col items-center justify-center gap-8 rounded-xl p-4 text-center">
                <div class="flex flex-col items-center gap-6 relative">
                  <h1 class="relative text-5xl font-black leading-tight tracking-tighter text-text-primary  sm:text-6xl lg:text-8xl">
                     <span class="text-brand">BPSU</span>
                     <span class="relative inline-block">
  Bulletin
  <img
    src="assets/pin.png"
    alt="pin"
    class="absolute w-7 sm:w-10 lg:w-15 -top-2 sm:-top-3 lg:-top-4 right-[-1rem] sm:right-[-1.5rem] lg:right-[-2rem] animate-float"
  />
</span>

                  </h1>

                  <h2 class="mx-auto max-w-3xl text-lg font-normal leading-normal text-text-secondary sm:text-xl">
                     Your central source for official announcements, campus activities, and university achievements. Stay connected and informed.
                  </h2>
                  </div>

                <div class="mt-4 flex flex-col items-center gap-4 sm:flex-row">
                    <!-- Button 1 from original file, with new layout classes -->
                    <a class="flex h-12 w-full cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg bg-brand px-8 text-base font-bold text-white transition-opacity hover:opacity-90 sm:w-auto" href="/home">
                        <span class="truncate">View Bulletin</span>
                    </a>
                    <!-- Button 2 from original file, with new layout classes -->
                    <a class="group flex h-12 w-full cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg border border-card-dark bg-transparent px-8 text-base font-medium text-text-primary transition-colors hover:bg-card-dark/50 sm:w-auto" href="#about-section">
                        <span class="truncate">Learn More</span>
                        <!-- Original icon -->
                         <span class="material-symbols-outlined transform transition-transform duration-300 group-hover:translate-x-1">
                           arrow_forward
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section (New Layout, Original Text) -->
    <section class="w-full opacity-0 translate-y-8 [animation:fadeUp_0.8s_ease-out_forwards] [animation-timeline:view()] [animation-range:entry_0%_cover_40%] pb-16 sm:pb-24" id="about-section">
        <div class="mx-auto flex max-w-4xl flex-col items-center gap-6 px-4 text-center sm:px-6 lg:px-8">
            <div class="flex items-center gap-3">
                <h2 class="text-3xl font-bold leading-tight tracking-tighter text-text-primary sm:text-4xl">About BPSU Bulletin</h2>
            </div>
            <!-- Original paragraph text -->
            <p class="text-base leading-relaxed text-text-secondary">BPSU Bulletin is the official digital hub for the Bataan Peninsula State University community. Our mission is to bridge information gaps between students, faculty, and administration by centralizing all university announcements and promoting a single, reliable source of truth. We aim to empower students, faculty, and organizations to stay updated, engaged, and united.</p>
        </div>
    </section>

    <!-- Featured Announcements (New Layout, Original Card Content) -->
    <section class="w-full opacity-0 translate-y-8 [animation:fadeUp_0.8s_ease-out_forwards] [animation-timeline:view()] [animation-range:entry_0%_cover_40%] py-16 sm:py-24" id="featured">
        <div class="mx-auto flex max-w-7xl flex-col gap-12 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 text-center">
                <!-- Original title and subtitle -->
                <h1 class="text-3xl font-bold leading-tight tracking-tighter text-text-primary sm:text-4xl">Featured Announcements</h1>
                <p class="mx-auto max-w-2xl text-base font-normal leading-normal text-text-secondary">Catch up on the most important updates and events happening at BPSU.</p>
            </div>
            <div class="relative w-full">
                <!-- Using new scroll container -->
                <div class="overflow-x-auto snap-x snap-mandatory flex gap-8 pb-8 -mx-4 px-4 sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8" style="scrollbar-width: none;">
                    
                    <!-- Card 1 (Original Content) -->
                    <div class="snap-center shrink-0 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.333rem)]">
                        <div class="group flex h-full flex-col overflow-hidden rounded-lg border border-card-dark bg-overlay-dark/50 transition-all duration-300 hover:border-brand/50 hover:bg-card-dark/50">
                            <div class="aspect-h-9 aspect-w-16 overflow-hidden">
                                <img alt="University Seal" class="h-95 w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRy8z1hvLYvlT14VVREnGheYdr4VRIn24QJFg&s">
                            </div>
                            <div class="flex flex-1 flex-col justify-between p-6">
                                <div class="flex flex-col gap-3">
                                    <!-- Original tag style -->
                                    <span class="bg-accent-blue/20 text-accent-blue text-xs w-40 font-medium px-2 py-1 rounded-full ">Enrollment & Documents</span>
                                    <h3 class="text-2xl font-bold leading-tight text-text-primary">Enrollment for A.Y. 2024-2025 Now Open</h3>
                                    <p class="text-sm font-normal text-text-secondary">The admission portal for the upcoming academic year is now live. All interested and returning students are advised to check the online portal for procedures and deadlines.</p>
                                </div>
                                <!-- Original button text and icon -->
                                <a class="mt-6 flex h-11 w-full cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-md bg-brand px-4 text-sm font-bold text-white transition-opacity hover:opacity-90" href="#">
                                    <span class="truncate">Read More</span>
                                    <span class="material-symbols-outlined !text-base cursor-pointer">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 (Original Content) -->
                    <div class="snap-center shrink-0 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.333rem)]">
                        <div class="group flex h-full flex-col overflow-hidden rounded-lg border border-card-dark bg-overlay-dark/50 transition-all duration-300 hover:border-brand/50 hover:bg-card-dark/50">
                            <div class="aspect-h-9 aspect-w-16 overflow-hidden">
                                <img alt="University Foundation Week" class="h-95 w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBP1R1CHY4ZU4YLgFqTZSC_DstVYgKVqVAtw&s">
                            </div>
                            <div class="flex flex-1 flex-col justify-between p-6">
                                <div class="flex flex-col gap-3">
                                    <!-- Original tag style -->
                                    <span class="bg-brand/20 text-brand text-xs w-43 font-medium px-2 py-1 rounded-full">University Announcements</span>
                                    <h3 class="text-2xl font-bold leading-tight text-text-primary">University Foundation Week Celebration</h3>
                                    <p class="text-sm font-normal text-text-secondary">Join us in celebrating BPSU's Foundation Week! Packed with exciting activities, student competitions, and performances. Check out the full schedule of events and be part of the tradition.</p>
                                </div>
                                <!-- Original button text and icon -->
                                <a class="mt-6 flex h-11 w-full cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-md bg-brand px-4 text-sm font-bold text-white transition-opacity hover:opacity-90" href="#">
                                    <span class="truncate">Read More</span>
                                    <span class="material-symbols-outlined !text-base cursor-pointer">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 (Original Content) -->
                    <div class="snap-center shrink-0 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.333rem)]">
                        <div class="group flex h-full flex-col overflow-hidden rounded-lg border border-card-dark bg-overlay-dark/50 transition-all duration-300 hover:border-brand/50 hover:bg-card-dark/50">
                            <div class="aspect-h-9 aspect-w-16 overflow-hidden">
                                <img alt="Coding Challenge" class="h-95 w-full object-cover transition-transform duration-300 group-hover:scale-105" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWudhyCxrxGsChTCZCdbYWL4IREa_2M4hWEA&s">
                            </div>
                            <div class="flex flex-1 flex-col justify-between p-6">
                                <div class="flex flex-col gap-3">
                                    <!-- Original tag style -->
                                    <span class="bg-accent-green/20 text-accent-green text-xs w-24 font-medium px-2 py-1 rounded-full">Organizations</span>
                                    <h3 class="text-2xl font-bold leading-tight text-text-primary">University-wide Tech Fair & Coding Challenge</h3>
                                    <p class="text-sm font-normal text-text-secondary">In partnership with leading tech organizations, this event aims at showcasing student innovations and promoting technological advancement within the university.</p>
                                </div>
                                 <!-- Original button text and icon, but with new "primary" button style -->
                                <a class="mt-6 flex h-11 w-full cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-md bg-brand px-4 text-sm font-bold text-white transition-opacity hover:opacity-90" href="#">
                                    <span class="truncate">Read More</span>
                                    <span class="material-symbols-outlined !text-base">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- New slider controls, styled with original theme -->
            <div class="mt-8 flex justify-center gap-3">
                <button class="h-10 w-10 flex items-center cursor-pointer justify-center rounded-full border border-card-dark text-text-secondary transition-colors hover:bg-card-dark/50 hover:text-text-primary">
                    <span class="material-symbols-outlined cursor-pointer">arrow_back</span>
                </button>
                <div class="flex items-center justify-center gap-2">
                    <button class="h-2 w-2 rounded-full bg-brand transition-all"></button>
                    <button class="h-2 w-2 rounded-full bg-card-dark transition-all hover:bg-overlay"></button>
                    <button class="h-2 w-2 rounded-full bg-card-dark transition-all hover:bg-overlay"></button>
                </div>
                <button class="h-10 w-10 flex items-center cursor-pointer justify-center rounded-full border border-card-dark text-text-secondary transition-colors hover:bg-card-dark/50 hover:text-text-primary">
                    <span class="material-symbols-outlined cursor-pointer">arrow_forward</span>
                </button>
            </div>
        </div>
    </section>

    <!-- "More Connected" Section (New Layout, Original Content) -->
    <section class="w-full opacity-0 translate-y-8 [animation:fadeUp_0.8s_ease-out_forwards] [animation-timeline:view()] [animation-range:entry_0%_cover_40%] py-16 sm:py-24">
        <div class="mx-auto flex max-w-7xl flex-col gap-10 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4 text-center">
                <!-- Original title and subtitle -->
                <h1 class="text-3xl font-bold leading-tight tracking-tighter text-text-primary sm:text-4xl">A More Connected Campus Community</h1>
                <p class="mx-auto max-w-3xl text-base font-normal leading-normal text-text-secondary">Bridging information gaps between students, faculty, and administration by centralizing all university announcements in one accessible hub.</p>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                
                <!-- Feature 1 (Original Content) -->
                <div class="flex flex-col gap-4 rounded-lg border border-card-dark bg-overlay-dark/50 p-6 transition-colors hover:border-brand/50">
                    <div class="text-brand"><span class="material-symbols-outlined fill-1 !text-3xl">push_pin</span></div>
                    <div class="flex flex-col gap-1">
                        <h2 class="text-lg font-bold leading-tight text-text-primary">Stay Informed</h2>
                        <p class="text-sm font-normal leading-normal text-text-secondary">Get real-time updates and never miss an important announcement from the university.</p>
                    </div>
                </div>
                
                <!-- Feature 2 (Original Content) -->
                <div class="flex flex-col gap-4 rounded-lg border border-card-dark bg-overlay-dark/50 p-6 transition-colors hover:border-brand/50">
                    <div class="text-brand"><span class="material-symbols-outlined fill-1 !text-3xl">campaign</span></div>
                    <div class="flex flex-col gap-1">
                        <h2 class="text-lg font-bold leading-tight text-text-primary">Share Your News</h2>
                        <p class="text-sm font-normal leading-normal text-text-secondary">Accredited organizations and departments can easily publish their announcements and achievements.</p>
                    </div>
                </div>

                <!-- Feature 3 (Original Content) -->
                <div class="flex flex-col gap-4 rounded-lg border border-card-dark bg-overlay-dark/50 p-6 transition-colors hover:border-brand/50">
                    <div class="text-brand"><span class="material-symbols-outlined fill-1 !text-3xl">groups</span></div>
                    <div class="flex flex-col gap-1">
                        <h2 class="text-lg font-bold leading-tight text-text-primary">Connect with Your Community</h2>
                        <p class="text-sm font-normal leading-normal text-text-secondary">A unified platform for students, faculty, and admin to stay aligned and connected.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section (New Layout, Original Content) -->
    <section class="w-full opacity-0 translate-y-8 [animation:fadeUp_0.8s_ease-out_forwards] [animation-timeline:view()] [animation-range:entry_0%_cover_40%] py-16 sm:py-24" id="login">
        <div class="mx-auto flex max-w-4xl flex-col items-center justify-center gap-8 rounded-xl border border-card-dark bg-overlay-dark/50 px-4 py-16 text-center sm:px-6 lg:px-8">
            <div class="flex flex-col gap-4">
                <!-- Original title and text -->
                <h1 class="text-3xl font-bold leading-tight tracking-tighter text-text-primary sm:text-4xl">Ready to Dive In?</h1>
                <p class="mx-auto max-w-2xl text-base font-normal leading-normal text-text-secondary">Join the BPSU Bulletin community to get personalized updates, contribute your own announcements, and be a part of a more informed and engaged campus.</p>
            </div>
            <!-- Original button text and icon -->
            <a class="flex h-12 cursor-pointer items-center justify-center gap-2 overflow-hidden rounded-lg bg-brand px-8 text-base font-bold text-white transition-opacity hover:opacity-90" href="#">
                <span class="truncate">Join the Community</span>
                <span class="material-symbols-outlined">group_add</span>
            </a>
        </div>
    </section>
</main>

<?php view("partials/footer.php"); ?>