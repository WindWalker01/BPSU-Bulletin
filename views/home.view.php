<?php
// All PHP database logic has been removed.
// This file now only displays variables given by the controller.
?>
<div class="flex flex-col min-h-screen">
    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <div class="lg:col-span-8 space-y-8 order-2 lg:order-1">

        <div id="featured-posts-container" class="space-y-8">
            <?php
            if (!empty($featured_posts)):
                foreach ($featured_posts as $post) {
                    include __DIR__ . "/partials/post-card-featured.php";
                }
            else:
                if (empty($grid_posts)) {
                     echo '<p class="text-text-secondary text-center">No posts found.</p>';
                }
            endif;
            ?>
        </div>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2" id="post-grid">
            <?php
            foreach ($grid_posts as $post) {
                extract($post); 
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
    let currentPage = 1;

    document.addEventListener('DOMContentLoaded', () => {
        const loadMoreBtn = document.getElementById('load-more-btn');
        const postGrid = document.getElementById('post-grid');
        const featuredPostsContainer = document.getElementById('featured-posts-container');

        const initialGridCount = postGrid.querySelectorAll('article').length;
        if (initialGridCount === 0) {
             loadMoreBtn.style.display = 'none';
        }

        function createPostCard(post) {
            const M = (data, fallback) => data ?? fallback;
            // This is your "main-featured" card template
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
                    <p class="text-xs text-text-secondary">${M(post.date, 'Unknown Date')}</p>
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

        loadMoreBtn.addEventListener('click', async function() {
            this.textContent = 'Loading...';
            this.disabled = true;

            if (featuredPostsContainer) {
                featuredPostsContainer.style.display = 'none';
            }
            if (postGrid) {
                postGrid.style.display = 'none';
            }
            
            const mainContentArea = document.getElementById('featured-posts-container');
            currentPage++;
            
            try {
                const response = await fetch(`/home?page=${currentPage}`); 
                if (!response.ok) throw new Error('Network error');
                
                const newPosts = await response.json();

                if (newPosts.length > 0) {
                    if (featuredPostsContainer) {
                        featuredPostsContainer.style.display = 'block';
                    }

                    newPosts.forEach(post => {
                        const postHTML = createPostCard(post);
                        mainContentArea.insertAdjacentHTML('beforeend', postHTML);
                    });

                    this.textContent = 'Load More';
                    this.disabled = false;

                    if (newPosts.length < 9) { // 9 is your $postsPerPage
                        this.style.display = 'none';
                    }
                } else {
                    this.style.display = 'none';
                }
            } catch (error) {
                console.error('Error loading posts:', error);
                this.textContent = 'Error. Try again?';
                this.disabled = false;
                currentPage--; 
            }
        });
    });
</script>

<?php view("partials/footer.php"); ?>
