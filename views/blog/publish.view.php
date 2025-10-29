
<div class="flex flex-row w-screen h-screen justify-center items-center">

  <!-- Blog Preview -->
  <div class="hidden md:ml-16 md:flex md:flex-col md:h-160 md:w-screen md:overflow-y-auto md:pt-8">
    <p class="text-text-secondary italic">Preview</p>
     <div class="text-text-primary ml-4 col-span-1 md:col-span-3">
      <?php view("partials/blog-content.php", [
          "title" => $title,
          "blog_html" => $blog_html,
          "username" => $author_name,
          "published_at" => $published_at,
          "author_profile" => $author_profile,
      ]); ?>
    </div>
  </div>


  <div class="w-screen h-screen flex justify-center items-center text-text-primary">
    <div class="w-full max-w-md bg-bg-dark/70 backdrop-blur-sm rounded-2xl shadow-lg p-8 border border-text-secondary/30">
      
      <h1 class="text-2xl font-semibold mb-2">
        Publishing to: <span class="font-bold text-brand"><?= $username ??
            $author_name ?></span>
      </h1>
      <p class="mb-6 text-text-secondary text-sm">
        Add tags and choose categories so your readers can easily find your post.
      </p>

      <!-- Blog Publish Form -->
      <form action="/blog/publish" method="POST" class="space-y-5">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="is_schedule" id="schedule-value" value="">
        <input type="hidden" name="blog_id" value="<?= $blog_id ?>">

        <!-- Tags Input -->
        <div>
          <label for="tags" class="block text-sm mb-2">Tags</label>
          <input 
            type="text" 
            name="tags" 
            id="tags" 
            placeholder="e.g. #technology #education #ccst" 
            class="w-full pl-3 pr-3 py-2 bg-bg-dark/80 rounded-md text-text-primary placeholder-text-secondary border border-text-secondary/40 focus:outline-none focus:border-brand transition"
          >
        </div>

        <!-- Categories Input -->
        <div>
          <label for="categories" class="block text-sm mb-2">Category</label>
          <select 
            name="categories[]" 
            id="categories" 
            class="w-full pl-3 pr-3 py-2 bg-bg-dark/80 rounded-md text-text-primary border border-text-secondary/40 focus:outline-none focus:border-brand transition"
          >
            <?php foreach ($categories as $c): ?>
             <option value="<?= $c["id"] ?>"><?= $c["value"] ?></option>
            <?php endforeach; ?>
            
          </select>
          <p class="text-xs text-text-secondary mt-1">Hold <kbd>Ctrl</kbd> (or <kbd>Cmd</kbd>) to select multiple.</p>
        </div>

        <!-- Schedule Section -->
        <div id="schedule-ui" class="hidden">
          <label for="schedule" class="block text-sm mb-2">Schedule a time to publish</label>
          <input 
            type="datetime-local" 
            name="schedule" 
            value="<?= $date_now ?? "2018-06-12T19:30" ?>" 
            class="w-full pl-3 pr-3 py-2 bg-bg-dark/80 rounded-md text-text-primary border border-text-secondary/40 focus:outline-none focus:border-brand transition"
          >
          <p class="text-xs text-text-secondary mt-1">
            This story will be published automatically within five minutes of the scheduled time.
          </p>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-between">
          <button 
            type="submit" 
            id="publish-btn"
            class="bg-brand text-bg-dark px-4 py-2 rounded-md font-medium hover:opacity-90 transition"
          >
            Publish now
          </button>
          <button 
            type="button" 
            id="schedule-for-later" 
            class="text-sm text-text-secondary hover:text-brand transition"
          >
            Schedule for later
          </button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
  const scheduleUI = document.getElementById('schedule-ui');
  const scheduleValue = document.getElementById('schedule-value');
  const publishBtn = document.getElementById('publish-btn');
  const scheduleToggle = document.getElementById('schedule-for-later');

  scheduleToggle.addEventListener('click', () => {
    const isHidden = scheduleUI.classList.contains('hidden');

    // Toggle schedule UI visibility
    scheduleUI.classList.toggle('hidden');

    // Update hidden input
    scheduleValue.value = isHidden ? '1' : '';

    // Change button text and toggle label
    publishBtn.textContent = isHidden ? 'Schedule post' : 'Publish now';
    scheduleToggle.textContent = isHidden ? 'Cancel scheduling' : 'Schedule for later';
  });
</script>

<?php view("partials/footer.php"); ?>

