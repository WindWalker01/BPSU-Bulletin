<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

    <!-- LEFT CARD: Locked Profile Info -->
    <aside class="lg:col-span-1 lg:sticky lg:top-8">
      <div class="bg-overlay-dark/50 border border-card-dark rounded-2xl p-6 backdrop-blur-sm text-center shadow-md">
        
        <img 
          src="<?= htmlspecialchars($profile_img) ?>" 
          alt="Profile Picture" 
          class="w-24 h-24 rounded-full border-2 border-card-dark mx-auto mb-4 object-cover shadow"
        >

        <h1 class="text-xl font-semibold text-text-primary mb-1">@<?= htmlspecialchars($username) ?></h1>
        <p class="text-text-secondary text-sm mb-6">This profile is locked</p>

        <span class="material-symbols-outlined text-5xl text-brand animate-bounce mb-3">
          lock
        </span>

        <p class="text-text-secondary mb-6">
          Follow this user to unlock their posts and view their full profile.
        </p>

        <a href="/home"
          class="bg-brand hover:bg-brand-hover text-text-primary font-semibold py-2 px-5 rounded-lg transition duration-200 ease-in-out shadow">
          Go Back Home
        </a>

      </div>
    </aside>

    <!-- RIGHT CARD: No Posts Section -->
    <div class="lg:col-span-3">
      <div class="bg-overlay-dark/50 border border-card-dark rounded-2xl p-8 backdrop-blur-sm text-center shadow-md flex flex-col justify-center items-center h-full">
        <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">
          feed
        </span>
        <h2 class="text-xl font-semibold text-text-primary mb-2">No Posts Available</h2>
        <p class="text-text-secondary">
          This user’s posts are private. Follow them to see what they share.
        </p>
      </div>
    </div>

  </div>
</div>

<?php view("partials/footer.php"); ?>
