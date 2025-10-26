<a href="<?= isset($blog_id)
    ? "/blog?id=" . $blog_id
    : "/account?id=" . $user_id ?>">
  <div
    class="<?= $is_read === 1 ? "opacity-50" : "" ?> 
          group flex items-center justify-between p-3 
          rounded-lg hover:bg-surface-hover bg-surface transition duration-200 space-x-3">

    <!-- Profile + Content -->
    <div class="flex items-center space-x-3 flex-1 cursor-pointer">
      <img 
        src="<?= $author_image ??
            "https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760671868/bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0.jpg" ?>" 
        class="rounded-full w-12 h-12 object-cover border border-border-secondary" 
        alt="Author Profile">
        
      <div class="text-sm">
        <div class="text-text-primary font-medium leading-tight">
          <?= $author_name ?? "Someone" ?> 
          <span class="text-text-secondary"><?= $description ?>:</span> 
          <span class="text-brand font-semibold"><?= $title ?></span>
        </div>
        <div class="text-text-muted text-xs mt-1"><?= $time_ago ?></div>
      </div>
    </div>

    <!-- Mark as Read Button -->
    <button 
      onclick="markAsRead(this)"
      data-notification-id="<?= $id ?>"
      class="<?= $is_read === 1 ? "hidden" : "" ?> 
            text-xs px-2 py-1 rounded-full 
            bg-brand hover:bg-brand-dark text-white 
            opacity-0 group-hover:opacity-100 
            transition duration-200">
      Mark as read
    </button>
  </div>
</a>
