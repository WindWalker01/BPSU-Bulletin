<div class="max-w-6xl mx-auto animate-fade-up my-8 px-4">
  <!-- Tabs Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-xl sm:text-2xl font-semibold">Admin Moderation Dashboard</h1>
  </div>

    <div class="flex space-x-2 mb-6 border-b border-card-dark">
        <button 
            class="tab-btn px-4 py-2 font-medium rounded-t-lg text-text-secondary hover:text-text-primary transition border border-transparent border-b-0"
            data-tab="blogs"
        >
            Blogs
        </button>
        <button 
            class="tab-btn px-4 py-2 font-medium rounded-t-lg text-text-secondary hover:text-text-primary transition border border-transparent border-b-0"
            data-tab="comments"
        >
            Comments
        </button>
        <button 
            class="tab-btn px-4 py-2 font-medium rounded-t-lg text-text-secondary hover:text-text-primary transition border border-transparent border-b-0"
            data-tab="appeals"
        >
            Appeals
        </button>
    </div>


  <!-- ========== BLOG MODERATION ========== -->
  <section id="tab-blogs" class="tab-content space-y-4">
    <p class="text-sm text-text-secondary">
      Review and take action on blog posts flagged by users.
    </p>
    <div class="bg-overlay-dark rounded-2xl overflow-hidden border border-card-dark shadow-lg overflow-x-auto">
      <table class="w-full text-sm min-w-[700px]">
        <thead class="bg-card-dark text-text-secondary">
          <tr class="text-left">
            <th class="px-4 sm:px-5 py-3 font-bold">Blog Details</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reason</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reported By</th>
            <th class="px-4 sm:px-5 py-3 font-bold text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-text-gray/40">
          <?php foreach ($blogs_reports as $blog): ?>
            <?php view("partials/blog-report-row.php", [
                "title" => $blog["title"],
                "author_name" => $blog["author_name"],
                "report_type" => $blog["report_type"],
                "reporter_name" => $blog["reporter_name"],
                "blog_id" => $blog["blog_id"],
                "badge_color" => $badge_color_map[$blog["report_type"]],
            ]); ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ========== COMMENT MODERATION ========== -->
  <section id="tab-comments" class="tab-content hidden space-y-4">
    <p class="text-sm text-text-secondary">
      Review and take action on comments flagged by users.
    </p>
    <div class="bg-overlay-dark rounded-2xl overflow-hidden border border-card-dark shadow-lg overflow-x-auto">
      <table class="w-full text-sm min-w-[650px]">
        <thead class="bg-card-dark text-text-secondary">
          <tr class="text-left">
            <th class="px-4 sm:px-5 py-3 font-bold">Accounts</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reason</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reported By</th>
            <th class="px-4 sm:px-5 py-3 font-bold text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-text-gray/40">
          <?php foreach ($comment_reports as $comment): ?>
            <?php view("partials/comment-report-row.php", [
                "secure_url" => $comment["reported_profile_image"],
                "reported_username" => $comment["reported_username"],
                "campus" => $comment["campus"],
                "report_type" => $comment["report_type"],
                "reporter_username" => $comment["reporter_username"],
                "blog_id" => $comment["blog_id"],
                "badge_color" => $badge_color_map[$comment["report_type"]],
            ]); ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

  <!-- ========== APPEALS ========== -->
  <section id="tab-appeals" class="tab-content hidden space-y-4">
    <p class="text-sm text-text-secondary">
      Review user appeals for moderated or removed content awaiting further review.
    </p>
    <div class="bg-overlay-dark rounded-2xl overflow-hidden border border-card-dark shadow-lg overflow-x-auto">
      <table class="w-full text-sm min-w-[700px]">
        <thead class="bg-card-dark text-text-secondary">
          <tr class="text-left">
            <th class="px-4 sm:px-5 py-3 font-bold">Appeal Details</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Appealed By</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Original Action</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reason</th>
            <th class="px-4 sm:px-5 py-3 font-bold text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-text-gray/40">
          <?php foreach ($appeals as $appeal): ?>
            <?php view("partials/appeal-row.php", [
                "appealed_by" => $appeal["appealed_by"],
                "original_action" => "Banned",
                "reason" => $appeal["reason"],
                "appeal_id" => $appeal["appeal_id"],
                "badge_color" => $badge_color_map["APPEAL"],
                "blog_id" => $appeal["blog_id"],
            ]); ?>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>
</div>

<!-- Tabs Script -->
<script>
  const tabs = document.querySelectorAll('.tab-btn');
  const contents = document.querySelectorAll('.tab-content');

  tabs.forEach(btn => {
    btn.addEventListener('click', () => {
      const target = btn.dataset.tab;

      tabs.forEach(b => {
        b.classList.remove('bg-card-dark', 'text-text-primary', 'border-card-dark');
        b.classList.add('text-text-secondary', 'border-transparent');
      });

      // Active tab styling (no bottom border!)
      btn.classList.add('bg-card-dark', 'text-text-primary', 'border', 'border-card-dark', 'border-b-0');
      btn.classList.remove('border-transparent');

      contents.forEach(c => c.classList.add('hidden'));
      document.getElementById(`tab-${target}`).classList.remove('hidden');
    });
  });

  // Initialize first tab
  tabs[0].click();
</script>




<?php view("partials/footer.php"); ?>
