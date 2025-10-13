
<article class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm space-y-4 blur-sm">
  <div class="flex items-center gap-3">
    <img
      alt="<?= htmlspecialchars($author ?? 'Unknown Author') ?> avatar"
      class="h-10 w-10 rounded-full object-cover"
      src="<?= htmlspecialchars($avatar ?? 'default-avatar.jpg') ?>"
    />
    <div>
      <p class="font-semibold text-text-primary"><?= htmlspecialchars($author ?? 'Unknown Author') ?></p>
      <p class="text-xs text-text-secondary">Published on <?= htmlspecialchars($date ?? 'Unknown Date') ?></p>
    </div>
    <span class="ml-auto text-xs font-medium <?= htmlspecialchars($badgeColor ?? 'bg-brand/20 text-brand') ?> px-2 py-1 rounded-full">
      <?= htmlspecialchars($category ?? 'General') ?>
    </span>
  </div>

  <a class="block" href="<?= htmlspecialchars($link ?? '#') ?>">
    <h2 class="text-2xl font-bold tracking-tight text-text-primary hover:text-brand transition-colors">
      <?= htmlspecialchars($title ?? 'Untitled Post') ?>
    </h2>
    <p class="mt-2 text-sm text-text-secondary leading-relaxed">
      <?= htmlspecialchars($excerpt ?? '') ?>
    </p>
  </a>

  <div class="pt-4 border-t border-card-dark flex items-center justify-between text-sm">
    <div class="flex items-center gap-4">
      <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">thumb_up</span> <?= htmlspecialchars($likes ?? 0) ?>
      </button>
      <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">chat_bubble</span> <?= htmlspecialchars($comments ?? 0) ?>
      </button>
    </div>
    <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
      <span class="material-symbols-outlined text-xl">share</span> Share
    </button>
  </div>
</article>
