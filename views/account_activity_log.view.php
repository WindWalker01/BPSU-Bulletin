
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

    
        <aside class="lg:col-span-1 lg:sticky lg:top-8 h-fit">
            <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm text-center">
                
                <img 
                    src="<?php echo $url ?? '/images/default-avatar.png'; ?>" 
                    alt="Profile Picture"
                    class="w-32 h-32 rounded-full object-cover mb-4 border-2 border-card-dark mx-auto"
                >
                
                <h1 class="text-text-primary text-xl font-semibold">
                    <?php
                        echo htmlspecialchars($fname ?? ''); 
                        echo htmlspecialchars($lname ? ' ' . $lname : '');
                    ?>
                </h1>
                <p class="text-text-brand font-extrabold text-lg break-words"><?php echo htmlspecialchars($username); ?></p>
                
                <p class="text-text-primary text-base mt-4 break-words"><?php echo htmlspecialchars($bio ?? 'No Bio.'); ?></p>
                <p class="text-text-secondary text-sm mt-1">Joined <?php echo $join_date; ?></p>

                
                <div class="mt-6">
                <?php if (!isset($_GET["id"]) || $isQueryLoggedIn): ?>
                    <a href="/user_profile"
                        class="transition duration-200 ease-in-out 
                               bg-brand hover:bg-brand-hover text-text-primary font-semibold py-2 px-4 rounded-lg
                               flex justify-center items-center w-full">
                        Edit Profile
                    </a>
                <?php elseif ($isAuthor): ?>
                    <?php view("partials/follow-button.php", [
                        "isFollowed" => $isFollowed,
                        "follow_css" =>
                            "transition duration-200 ease-in-out bg-brand hover:bg-brand-hover text-text-primary font-semibold py-2 px-4 rounded-lg flex justify-center items-center w-full",
                        "unfollow_css" =>
                            "transition duration-200 ease-in-out bg-gray-600 hover:bg-gray-700 text-text-primary font-semibold py-2 px-4 rounded-lg flex justify-center items-center w-full",
                        "account_id" => $account_id,
                    ]); ?>
                <?php endif; ?>
                </div>

            </div>
        </aside>

        <div class="lg:col-span-3">

            <div class="border-b border-card-dark text-text-primary">
                <div class="relative flex gap-8">
                    <button 
                        id="post-btn" class="tab-btn py-2 px-4 hover:text-brand">
                        <?php echo $isAuthor ? "Posts" : "Viewed Post"; ?>
                    </button> 
                    <button 
                        id="follow-btn" class="tab-btn py-2 px-4 hover:text-brand">
                        Followed Authors
                    </button>
                    
                    <span id="tab-underline" 
                        class="flex absolute bottom-0 left-0 h-0.5 bg-brand transition-all duration-300 ease-in-out">
                    </span>
                </div>
            </div>

            <div class="mt-6">

                <div id="post-tab" class="tab-content space-y-6">
                    <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                            <div class="md:col-span-2">
                                <p class="text-sm font-semibold mb-2 text-text-secondary">Posted 2 days ago</p>
                                <h2 class="text-xl font-semibold mb-3 text-text-primary">Example Post Title</h2>
                                <p class="text-text-secondary text-base">
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                </p>
                            </div>
                            <div class="md:col-span-1">
                                <img 
                                src="/assets/mayncrap.png" 
                                alt="minecraft-post"
                                class="w-full h-auto rounded-lg object-cover border border-card-dark aspect-video">
                            </div>
                        </div>
                    </div>
                    </div>

                <div id="follow-tab" class="hidden mt-6">
                    <?php if (empty($followed_authors)): ?>
                        <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
                            <h3 class="text-lg font-semibold text-text-secondary text-center">
                                Not following any authors yet.
                            </h3>
                        </div>
                    <?php else: ?>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php foreach ($followed_authors as $author): ?>
                                <a href="/account?id=<?= $author["id"] ?>">
                                    <div class="flex items-center gap-3 bg-surface rounded-xl p-3 shadow-sm hover:shadow-md transition-all duration-200">
                                        <img 
                                            src="<?= htmlspecialchars(
                                                $author["secure_url"] ?? "/images/default-avatar.png",
                                            ) ?>" 
                                            alt="Profile of <?= htmlspecialchars(
                                                $author["username"],
                                            ) ?>" 
                                            class="w-10 h-10 rounded-full object-cover"
                                        >
                                        <div class="flex flex-col min-w-0">
                                            <span class="text-sm font-medium text-text-primary truncate">
                                                <?= htmlspecialchars($author["username"]) ?>
                                            </span>
                                        </div>
                                        <span class="ml-auto text-xs bg-brand/10 text-brand font-semibold px-2 py-1 rounded-md">
                                            Following
                                        </span>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div> </div> </div> </div>  <script>
  (function() {
    const buttons = document.querySelectorAll('.tab-btn');
    const underline = document.getElementById('tab-underline');
    const postTab = document.getElementById('post-tab');
    const followTab = document.getElementById('follow-tab');

    if (!underline || buttons.length === 0 || !postTab || !followTab) return;

    function moveUnderline(btn) {
      underline.style.width = btn.offsetWidth + 'px';
      underline.style.left = btn.offsetLeft + 'px';
    }

    function activate(btn) {
      buttons.forEach(b => {
        b.classList.remove('text-brand');
        b.classList.add('text-text-secondary'); // Inactive color
        b.setAttribute('aria-pressed', 'false');
      });

      btn.classList.add('text-brand'); // Active color
      btn.classList.remove('text-text-secondary');
      btn.setAttribute('aria-pressed', 'true');

      if (btn.id === 'post-btn') {
        postTab.classList.remove('hidden');
        followTab.classList.add('hidden');
      } else if (btn.id === 'follow-btn') {
        followTab.classList.remove('hidden');
        postTab.classList.add('hidden');
      }

      moveUnderline(btn);
    }

    buttons.forEach(btn => {
      btn.addEventListener('click', () => activate(btn));
    });

    // Initialize the tab system on page load
    function initializeTabs() {
        // Find the currently active button or default to the first
        let defaultBtn = document.querySelector('.tab-btn[aria-pressed="true"]');
        if (!defaultBtn) {
            defaultBtn = buttons[0];
            // Manually set default text colors for initialization
            buttons.forEach((b, index) => {
                if (index === 0) {
                    b.classList.add('text-brand');
                    b.classList.remove('text-text-secondary');
                } else {
                    b.classList.add('text-text-secondary');
                    b.classList.remove('text-brand');
                }
            });
        }
        activate(defaultBtn);
    }

    window.addEventListener('load', initializeTabs);
    
    // Recalculate underline on resize
    window.addEventListener('resize', () => {
      const active = document.querySelector('.tab-btn[aria-pressed="true"]') || buttons[0];
      moveUnderline(active);
    });
  })();
</script>

<?php view("partials/footer.php"); ?>