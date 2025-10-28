<article class="bg-overlay-dark/50 border border-card-dark rounded-xl backdrop-blur-sm flex overflow-hidden max-h-70">
  
  <div class="flex-shrink-0 w-60">
    <img class="rounded-l-xl object-cover h-full w-full" src="https://i.pinimg.com/736x/b3/ef/05/b3ef0536f78427ad969b732a98fc5cee.jpg" alt="">
  </div>
  
  <div class="flex-grow space-y-4 p-6 flex flex-col">
    <div class="flex justify-between items-center">
      <span class="text-xs font-medium <?= htmlspecialchars($badgeColor ?? 'bg-brand/20 text-brand') ?> px-2 py-1 rounded-full">
        <?= htmlspecialchars($category ?? 'General') ?>
      </span>
      <p class="text-xs text-text-secondary">Published on <?= htmlspecialchars($date ?? 'Unknown Date') ?></p>
    </div>

    <a class="block flex-grow" href="<?= htmlspecialchars($link ?? '#') ?>">
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
  </div>
</article>