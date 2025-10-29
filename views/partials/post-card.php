<?php
?>
<article
  class="bg-overlay-dark/50 border border-card-dark rounded-xl backdrop-blur-sm flex flex-col md:flex-row overflow-hidden md:max-h-50"
>
  <div class="w-full md:w-20 lg:w-30 h-48 md:h-auto flex-shrink-0">
    <img
      class="object-cover w-full h-full lg:w-30 md:rounded-l-xl md:rounded-tr-none rounded-t-xl"
      src="<?= htmlspecialchars($image ?? 'https://via.placeholder.com/640x360?text=No+Image') ?>"
      alt="<?= htmlspecialchars($title ?? 'Post image') ?>"
    />
  </div>

  <div class="flex flex-col justify-between flex-grow p-3 md:p-3 space-y-3 md:space-y-2">
    <div class="flex items-center justify-between">
      <span
        class="text-xs font-medium <?= htmlspecialchars($badgeColor ?? 'bg-brand/20 text-brand') ?> px-2 py-1 rounded-full"
      >
        <?= htmlspecialchars($category ?? 'General') ?>
      </span>
      <p class="text-[11px] md:text-xs text-text-secondary">
         <?= htmlspecialchars($date ?? 'Unknown Date') ?>
      </p>
    </div>

    <a class="block flex-grow" href="<?= htmlspecialchars($link ?? '#') ?>">
      <h2
        class="text-base sm:text-base md:text-lg font-bold tracking-tight text-text-primary hover:text-brand transition-colors line-clamp-2"
      >
        <?= htmlspecialchars($title ?? 'Untitled Post') ?>
      </h2>
      <p
        class="mt-2 text-xs md:text-xs text-text-secondary leading-relaxed line-clamp-2 md:line-clamp-3" >
        <?php
          // Your excerpt logic is fine, let's keep it concise
          $excerptText = $excerpt ?? '';
          echo htmlspecialchars(strlen($excerptText) > 100 ? substr($excerptText, 0, 100) . '...' : $excerptText);
        ?>
      </p>
    </a>

    <div
      class="pt-2 border-t border-card-dark flex items-center justify-between text-xs md:text-sm"
    >
      <div class="flex items-center gap-3">
        <button
          class="flex items-center md:text-xs gap-1 text-text-secondary hover:text-brand transition-colors cursor-pointer"
        >
          <span class="material-symbols-outlined text-base md:text-base">thumb_up</span>
          <?= htmlspecialchars($likes ?? 0) ?>
        </button>
        <button
          class="flex items-center md:text-xs gap-1 text-text-secondary hover:text-brand transition-colors cursor-pointer"
        >
          <span class="material-symbols-outlined text-base md:text-base">chat_bubble</span>
          <?= htmlspecialchars($comments ?? 0) ?>
        </button>
      </div>
      <button
        class="flex items-center md:text-xs gap-1 text-text-secondary hover:text-brand transition-colors cursor-pointer"
      >
        <span class="material-symbols-outlined text-base md:text-base">share</span> Share
      </button>
    </div>
  </div>
</article>