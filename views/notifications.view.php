<!-- notifications.php -->
<div class="min-h-screen bg-surface text-text-primary px-6 sm:px-10 py-10 mt-10">

  <!-- Page Header -->
  <div class="flex justify-between items-center mb-6 border-b border-border-secondary pb-3">
    <h1 class="text-2xl font-semibold text-text-primary">Notifications</h1>
    <button id="markAllRead"
      class="text-sm bg-brand hover:bg-brand-dark text-white px-3 py-1.5 rounded-full transition">
      Mark all as read
    </button>
  </div>

  <!-- No Notifications Message -->
  <?php if (empty($notifications)): ?>
    <div class="text-center py-20 text-text-secondary">
      <i class="material-symbols-outlined text-6xl mb-2">notifications_off</i>
      <p class="text-lg">You're all caught up! 🎉</p>
    </div>
  <?php else: ?>

  <!-- Notifications Container -->
  <div class="space-y-8">

    <!-- Important Notifications -->
    <div>
      <h2 class="text-lg text-text-secondary mb-3 font-medium">Important</h2>
      <div class="flex flex-col space-y-2">
        <?php foreach ($notifications as $notification): ?>
          <?php if ($notification["category"] === "IMPORTANT"): ?>
            <?php view("partials/notification-card.php", [
                "title" => $notification["title"],
                "is_read" => $notification["is_read"],
                "author_image" => $notification["secure_url"],
                "author_name" => $notification["username"],
                "description" => $notification["description"],
                "time_ago" => timeAgo($notification["created_at"]),
                "id" => $notification["id"],
                "user_id" => $notification["sender_id"],
                "blog_id" => $notification["blog_id"],
            ]); ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- General Notifications -->
    <div>
      <h2 class="text-lg text-text-secondary mb-3 font-medium border-t border-border-secondary pt-5">More Notifications</h2>
      <div class="flex flex-col space-y-2">
        <?php foreach ($notifications as $notification): ?>
          <?php if ($notification["category"] === "GENERAL"): ?>
            <?php view("partials/notification-card.php", [
                "title" => $notification["title"],
                "is_read" => $notification["is_read"],
                "author_image" => $notification["secure_url"],
                "author_name" => $notification["username"],
                "description" => $notification["description"],
                "time_ago" => timeAgo($notification["created_at"]),
                "id" => $notification["id"],
                "users_id" => $notification["sender_id"],
                "blog_id" => $notification["blog_id"],
            ]); ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <?php endif; ?>
</div>


<?php view("partials/footer.php"); ?>
