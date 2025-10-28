
<div class="min-h-screen bg-bg-dark/80 flex justify-center items-center">
  <div class="h-[900px] w-[1200px] text-center flex-col justify-center bg-card-dark/20 rounded-lg p-[20px]">
    <!-- User Profile View -->
    <img 
      src="<?php echo $url; ?>" 
      alt="Profile Picture"
      class="w-[128px] h-[128px] rounded-full object-cover mb-4 border-2 border-black-700 mx-auto"
    >
    <?php
    echo "<p class='text-white text-xl font-semibold'>" .
        $_POST["fname"] .
        "</p>";
    echo "<p class='text-gray-500 italic'>" . $_POST["mname"] . "</p>";
    echo "<p class='text-gray-500 underline'>" . $_POST["lname"] . "</p>";
    ?>
    <h1 class="text-white text-xl font-semibold"><?php echo $username; ?></h1>
      <p class="text-gray-50  0 text-base"><?php echo $bio ??
          "A humble reader 💗"; ?></p>
        <p class="text-gray-500 text-base">Joined <?php echo $join_date; ?></p>


    <?php if (!isset($_GET["id"]) || $isQueryLoggedIn): ?>
      <a href="/user_profile"
        class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
                bg-red-500 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-[40px] w-[400px] mt-4 mx-auto">
        Edit Profile
      </a>
    <?php elseif ($isAuthor): ?>
      <?php view("partials/follow-button.php", [
          "isFollowed" => $isFollowed,
          "follow_css" =>
              "transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 bg-red-500 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg flex justify-center items-center h-[40px] w-[400px] mt-4 mx-auto",
          "unfollow_css" =>
              "transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110 bg-gray-500 hover:bg-gray-800 text-white font-semibold py-2 px-4 rounded-lg flex justify-center items-center h-[40px] w-[400px] mt-4 mx-auto",
          "account_id" => $account_id,
      ]); ?>
      

    <?php endif; ?>
    
<!-- Tab Layouts --> 
<div class="flex gap-[50px] border-b border-gray-200 text-white pl-[40px]">
  <div class="relative flex gap-8 border-b border-gray-600 text-white">
  <button 
    id="post-btn" class="tab-btn py-2 px-6 hover:text-red-500 pl-[30px]">
    <?php echo $isAuthor ? "Posts" : "Viewed Post"; ?>
  </button> 
  <button 
    id="follow-btn" class="tab-btn py-2 px-6 hover:text-red-500">
    Followed Authors
  </button>
  
    <span id="tab-underline" 
      class="flex absolute bottom-0 left-0 h-[3px] bg-white transition-all duration-200 ease-linear">
    </span>
  </div>
</div>
    <!-- Tab Contents -->
<div id="post-tab" class="tab-content mt-6">
    <h3 class="text-lg font-semibold mb-4 text-gray-500 ml-[40px] text-left">Posted 2 days ago</h3>
      <h1 class="text-xl font-semibold mb-2 text-white ml-[40px] text-left">Title</h1>
      <!-- Example Content Material -->
      <div class="flex items-start ml-[40px] gap-6">
        <p class="text-gray-400 text-left w-[60%]">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <img 
          src="/assets/mayncrap.png" 
          alt="minecraft-post"
          class="w-[400px] h-[300px] rounded-lg object-cover border-2 border-black-700 -mt-[80px]">
      </div>
    </div>

    <div id="follow-tab" class="hidden mt-6">
      <?php if (count($followed_authors) < 1): ?>
        <h3 class="text-lg font-semibold mb-4 text-gray-500 ml-[40px] text-left">
          No following Authors YEET.
        </h3>
      <?php else: ?>
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 p-4">
            <!-- Author Card -->
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
                      <span class="text-sm text-text-secondary truncate">
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
</div>
<!-- Tab Script Aesthetic Functions -->
<script>
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
        b.classList.remove('text-red-500');
        b.classList.add('text-gray-300');
        b.setAttribute('aria-pressed', 'false');
      });

      btn.classList.add('text-red-500');
      btn.classList.remove('text-gray-300');
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

    window.addEventListener('load', () => {
      const defaultBtn = document.querySelector('.tab-btn.text-red-500') || buttons[0];
      activate(defaultBtn);
    });
    // keep underline aligned when resizing
    window.addEventListener('resize', () => {
      const active = document.querySelector('.tab-btn.text-red-500') || buttons[0];
      moveUnderline(active);
    });
  })();
</script>
<?php view("partials/footer.php"); ?>
