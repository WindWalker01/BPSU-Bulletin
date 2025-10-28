<div class="flex flex-col min-h-screen">

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <div class="lg:col-span-8 space-y-8 order-2 lg:order-1">

      <article id="featured-post" class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm space-y-4 bg-blur-sm">
  <div class="flex items-center gap-3">
    <img
      alt="<?= htmlspecialchars($author ?? 'Unknown Author') ?> avatar"
      class="h-10 w-10 rounded-full object-cover"
      src="https://lh3.googleusercontent.com/aida-public/AB6AXuC9NMh9sGihLlPg4qW0ZVugJwTHWCfx4R7RDdwO_d7fx76hgkqLOmmyzKtt2O1O8PILHK6uoqPNHxjAU1sgIrqeFIT7bwAq8W_h4fUhIjugKbitv6Hfx5fzsP_hHija_6jkQLolfI1gz4YmjBHeRB5kN9DIndJ_nULBMJDkwrNYq2Xq-y97KmDpiVewKZOgl9vJ7lZKVqbnDVZSaZUsbUMZpw98_SEf69VB6JVbLPMOYx3yi33r6BEz33cnDryThk-3Yuno-ul4CfWL"
    />
    <div>
      <p class="font-semibold text-text-primary">Dr. Marcus Evans</p>
      <p class="text-xs text-text-secondary">Published on <?= htmlspecialchars($date ?? 'Unknown Date') ?></p>
    </div>
    <span class="ml-auto text-xs font-medium <?= htmlspecialchars($badgeColor ?? 'bg-brand/20 text-brand') ?> px-2 py-1 rounded-full">
      <?= htmlspecialchars($category ?? 'General') ?>
    </span>
  </div>

  <div class="w-full h-48 md:h-auto flex-shrink-0">
    <img
      class="object-cover w-full h-50 md:rounded-l-xl md:rounded-tr-none rounded-t-xl"
      src="https://i.ytimg.com/vi/Wl959QnD3lM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAS9JpzGQGZPGKNbqnrX3X-qLIFng"
      alt=""
    />
  </div>
  <a class="block" href="<?= htmlspecialchars($link ?? '#') ?>">
    <h2 class="text-2xl font-bold tracking-tight text-text-primary hover:text-brand transition-colors">
      BPSU Announces New Academic Programs for 2024
    </h2>
    <p class="mt-2 text-sm text-text-secondary leading-relaxed">
        Bataan Peninsula State University (BPSU) is excited to announce the launch of several new academic programs starting in the academic year 2024. These programs are designed to meet the evolving needs of the job market and provide students with cutting-edge skills and knowledge...
    </p>
  </a>

  <div class="pt-4 border-t border-card-dark flex items-center justify-between text-sm">
    <div class="flex items-center gap-4">
      <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">thumb_up</span> <?= htmlspecialchars($likes ?? 0) ?>
      </button>
      <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">chat_bubble</span> <?= htmlspecialchars($comments ?? 0) ?>
      </button>
    </div>
    <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
      <span class="material-symbols-outlined text-xl">share</span> Share
    </button>
  </div>
</article>
        
 <div class="grid grid-cols-1 gap-6 md:grid-cols-2" id="post-grid">
        <?php
        // MODIFICATION: Added 'image' key to each post
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
                "image" => "https://i.ytimg.com/vi/Wl959QnD3lM/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAS9JpzGQGZPGKNbqnrX3X-qLIFng",
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
                "image" => "https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1170",
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
                "image" => "https://images.unsplash.com/photo-1542831371-29b0f74f9713?auto=format&fit=crop&w=1170",
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

<div class="mt-8 text-center">
    <button id="load-more-btn" class="bg-brand text-text-primary font-semibold px-6 py-3 rounded-lg hover:bg-brand/90 transition-colors">
    Load More
    </button>
</div>

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

  
  <script>
const posts = <?= json_encode($posts) ?>;
 window.posts = <?= json_encode(
     $posts,
     JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
 ) ?>;
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const loadMoreBtn = document.getElementById('load-more-btn');
        const postGrid = document.getElementById('post-grid');
        // MODIFICATION: Get the featured post
        const featuredPost = document.getElementById('featured-post');

        // MODIFICATION: Updated function to include image
        function createPostCard(post) {
            const M = (data, fallback) => data ?? fallback;

            // Note: This HTML structure now matches your featured post card
            return `
            <article class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm space-y-4 bg-blur-sm">
                <div class="flex items-center gap-3">
                <img
                    alt="${M(post.author, 'Unknown Author')} avatar"
                    class="h-10 w-10 rounded-full object-cover"
                    src="${M(post.avatar, 'https://lh3.googleusercontent.com/aida-public/AB6AXuC9NMh9sGihLlPg4qW0ZVugJwTHWCfx4R7RDdwO_d7fx76hgkqLOmmyzKtt2O1O8PILHK6uoqPNHxjAU1sgIrqeFIT7bwAq8W_h4fUhIjugKbitv6Hfx5fzsP_hHija_6jkQLolfI1gz4YmjBHeRB5kN9DIndJ_nULBMJDkwrNYq2Xq-y97KmDpiVewKZOgl9vJ7lZKVqbnDVZSaZUsbUMZpw98_SEf69VB6JVbLPMOYx3yi33r6BEz33cnDryThk-3Yuno-ul4CfWL')}"
                />
                <div>
                    <p class="font-semibold text-text-primary">${M(post.author, 'Unknown Author')}</p>
                    <p class="text-xs text-text-secondary">Published on ${M(post.date, 'Unknown Date')}</p>
                </div>
                <span class="ml-auto text-xs font-medium ${M(post.badgeColor, 'bg-brand/20 text-brand')} px-2 py-1 rounded-full">
                    ${M(post.category, 'General')}
                </span>
                </div>

                <div class="w-full h-48 md:h-auto flex-shrink-0">
                    <img
                    class="object-cover w-full h-50 md:rounded-l-xl md:rounded-tr-none rounded-t-xl"
                    src="${M(post.image, 'https://via.placeholder.com/640x360?text=No+Image')}"
                    alt="${M(post.title, 'Post image')}"
                    />
                </div>

                <a class="block" href="${M(post.link, '#')}">
                <h2 class="text-2xl font-bold tracking-tight text-text-primary hover:text-brand transition-colors">
                    ${M(post.title, 'Untitled Post')}
                </h2>
                <p class="mt-2 text-sm text-text-secondary leading-relaxed">
                    ${M(post.excerpt, '')}
                </p>
                </a>

                <div class="pt-4 border-t border-card-dark flex items-center justify-between text-sm">
                <div class="flex items-center gap-4">
                    <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">thumb_up</span> ${M(post.likes, 0)}
                    </button>
                    <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">chat_bubble</span> ${M(post.comments, 0)}
                    </button>
                </div>
                <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">share</span> Share
                </button>
                </div>
            </article>
            `;
        }

        loadMoreBtn.addEventListener('click', function() {
            this.textContent = 'Loading...';
            this.disabled = true;

            // MODIFICATION: Hide featured post
            if (featuredPost) {
                featuredPost.style.display = 'none';
            }
            
            // MODIFICATION: Change grid to single column ('block' layout)
            // This removes the two-column layout for medium screens
            postGrid.classList.remove('md:grid-cols-2');
            // 'grid-cols-1' is already present, so it will stack
            
            setTimeout(() => {
                const postsToLoad = window.posts; 

                postsToLoad.forEach(post => {
                    const postHTML = createPostCard(post);
                    postGrid.insertAdjacentHTML('beforeend', postHTML);
                });

                this.textContent = 'Load More';
                this.disabled = false;
            }, 500); 
        });
    });
</script>
  <?php view("partials/footer.php"); ?>