<div class="flex flex-col min-h-screen">

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <div class="lg:col-span-8 space-y-8 order-2 lg:order-1">
        <?php
        $posts = [
            [
                "author" => "Dr. Marcus Evans",
                "avatar" =>
                    "https://lh3.googleusercontent.com/aida-public/AB6AXuC9NMh9sGihLlPg4qW0ZVugJwTHWCfx4R7RDdwO_d7fx76hgkqLOmmyzKtt2O1O8PILHK6uoqPNHxjAU1sgIrqeFIT7bwAq8W_h4fUhIjugKbitv6Hfx5fzsP_hHija_6jkQLolfI1gz4YmjBHeRB5kN9DIndJ_nULBMJDkwrNYq2Xq-y97KmDpiVewKZOgl9vJ7lZKVqbnDVZSaZUsbUMZpw98_SEf69VB6JVbLPMOYx3yi33r6BEz33cnDryThk-3Yuno-ul4CfWL",
                "date" => "October 26, 2023",
                "category" => "University Updates",
                "badgeColor" => "bg-brand/20 text-brand",
                "title" => "BPSU Announces New Academic Programs for 2024",
                "excerpt" =>
                    "   Bataan Peninsula State University (BPSU) is excited to announce the launch of several new academic programs starting in the academic year 2024. These programs are designed to meet the evolving needs of the job market and provide students with cutting-edge skills and knowledge...",
                "link" => "#",
                "likes" => 342,
                "comments" => 45,
            ],
            [
                "author" => "Sophia Rodriguez",
                "avatar" =>
                    "https://lh3.googleusercontent.com/aida-public/AB6AXuDY6v6w9gHTKHGYuFv2JPuHHbLOqAq8DnEWCOPJxTakAZ43mEZNwIGWjdBcotJrCG6HOiWVbqWJWp72CWhr28OXQfWjd756bzaky4-JMFy152phSR33T7KD4LgXk0Je6362EZYW7oqC7CqbZy8ihOLFMAKXBP0DkSQZzkRv6pRGWzIMIG_SL6usNPlr4E-iGEbZ8mNCPQToR8kRieRmWqOFF8swtwqIR8lPvZOkc3d_-y2LJDZS-_osKjmzCsNubCLIrUGabXiCiquV",
                "date" => "October 24, 2023",
                "category" => "Student Life",
                "badgeColor" => "bg-accent-green/20 text-accent-green",
                "title" => "My Experience at the BPSU Innovation Fair",
                "excerpt" =>
                    " I had an amazing time at the annual BPSU Innovation Fair! It was inspiring to see so many creative projects from fellow students. The energy was electric, and I learned so much. Highly recommend everyone to participate next year! #BPSUPride #Innovation",
                "link" => "#",
                "likes" => 198,
                "comments" => 21,
            ],
            [
                "author" => "Computer Science Society",
                "avatar" =>
                    "https://lh3.googleusercontent.com/aida-public/AB6AXuAQPnNFYPL28lmjM5b-HAkkYfz80BugzAALGEPqJoIjjhd1VcgFu1EcgaIP_45spTLQb-wbnKEzu_IsR1gmHHFhbYV1tbEJKtGyA06O3f6Xli6cSpc-MduoyE1bNPmohxvp-wGZayFapOP-kuElBIKyTu9pYj6tvvGnwIzqI9SpzdZzT0ujG8Yyn9iYosq5DK17Pcij-_oF8LKwygjrm3hmfWDpEMEV9WX7iL2GcwnDx16J4B81ZQDjefl_HNrK1WcGVUvgPihjtb8t",
                "date" => "October 22, 2023",
                "category" => "Organizations",
                "badgeColor" => "bg-accent-blue/20 text-accent-blue",
                "title" => "Upcoming Workshop: Intro to Web Development",
                "excerpt" =>
                    "Join the Computer Science Society for a hands-on web development workshop this Friday! We'll cover the basics of HTML, CSS, and JavaScript. No prior experience needed. Limited slots available, so sign up now!",
                "link" => "#",
                "likes" => 156,
                "comments" => 33,
            ],
        ];

        foreach ($posts as $post) {
            extract($post); // makes keys accessible as variables
            include __DIR__ . "/partials/post-card.php";
        }
        ?>

        </div>
        
        <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-24 order-1 lg:order-2">
          <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
            <h3 class="text-lg font-bold mb-4 text-text-primary">Trending Topics</h3>
            <div class="space-y-3">
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#BPSUNewPrograms</a>
                <p class="text-sm text-text-secondary">1,204 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#InnovationFair2023</a>
                <p class="text-sm text-text-secondary">876 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#CSSWorkshop</a>
                <p class="text-sm text-text-secondary">451 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#StudentLife</a>
                <p class="text-sm text-text-secondary">2.3k Posts</p>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </main>
  </div>

  <!-- pang test lang -->
  <script>
const posts = <?= json_encode($posts) ?>;
 window.posts = <?= json_encode(
     $posts,
     JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
 ) ?>;
</script>
  <?php view("partials/footer.php"); ?>
