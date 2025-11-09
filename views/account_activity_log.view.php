
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

    <?php
        if (!function_exists('extractFirstParagraphFromTiptap')) {
            function extractFirstParagraphFromTiptap($contentJson) {
                if (!is_array($contentJson) || !isset($contentJson['content'])) {
                    return 'No content available.';  // Return a string now
                }

                foreach ($contentJson['content'] as $node) {
                    if ($node['type'] === 'paragraph' && isset($node['content']) && is_array($node['content'])) {
                        $text = '';
                        foreach ($node['content'] as $child) {
                            if (isset($child['text'])) {
                                $text .= $child['text'];
                            }
                        }
                        if ($text !== '') {
                            return $text;  // Return concatenated paragraph text string
                        }
                    }
                }

                return 'No content available.';
            }
        }
    ?>

<div class="mt-6">
    <div id="post-tab" class="tab-content space-y-6">
        <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm ">
            <?php if (!empty($blogs)): ?>
                <div class="max-h-155 overflow-y-auto space-y-4 custom-scrollbar">
                    <?php foreach ($blogs as $blog): ?>
                        <?php 
                            $content = json_decode($blog['content'], true);
                            $formattedDate = date("M j, Y", strtotime($blog['created_at']));
                            $excerpt = extractFirstParagraphFromTiptap($content);
                        ?>

                        <a href="/blog?id=<?= htmlspecialchars($blog['id']) ?>" 
                            class="block group rounded-xl border border-card-dark bg-card-dark/40 p-5 
                                    hover:border-brand hover:-translate-y-1 hover:shadow-lg 
                                    transition-all duration-300 ease-in-out
                                    h-50 max-w-[90%] ml-10"> <div class="flex flex-col justify-between h-full">
                                
                                <div class="flex justify-between items-start mb-4">
                                    <div class="flex items-center space-x-3">
                                        <img src="<?= htmlspecialchars($blog['author_image_url']) ?>" 
                                             alt="<?= htmlspecialchars($blog['author_name'] ?? 'Author') ?>" 
                                             class="w-8 h-8 rounded-full object-cover">
                                        <div>
                                            <p class="text-sm font-semibold text-text-primary"><?= htmlspecialchars($blog['author_name']) ?></p>
                                            <p class="text-xs text-gray-400">Published on <?= $formattedDate ?></p>
                                        </div>
                                    </div>
                                    
                                    <span class="inline-block text-xs font-semibold px-2 py-1 rounded-lg whitespace-nowrap 
                                        <?= htmlspecialchars($blog['category_color'] ?? 'bg-gray-500/20 text-gray-400') ?>">
                                        <?= htmlspecialchars($blog['category_label'] ?? 'Uncategorized') ?>
                                    </span>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-text-primary group-hover:text-brand transition">
                                        <?= htmlspecialchars($blog['title'] ?? '1') ?>
                                    </h2>

                                    <p class="text-text-secondary mt-2 line-clamp-3 leading-relaxed overflow-hidden">
                                        <?= htmlspecialchars($excerpt ?: 'Welcome testastestasthu the Simple Editor template! This template integrates open source UI components and Tiptap extensions licensed under MIT.') ?>
                                    </p>
                                </div>

                                </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center text-gray-400 mt-8">No posts available.</div>
            <?php endif; ?>
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