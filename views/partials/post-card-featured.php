<?php
// views/partials/post-card-featured.php
?>
<article class="relative group bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm space-y-4 bg-blur-sm">
    <div class="flex items-center gap-3">
    <img
        alt="<?= htmlspecialchars($post['author']) ?> avatar"
        class="h-10 w-10 rounded-full object-cover"
        src="<?= htmlspecialchars($post['avatar']) ?>"
    />
    <div>
        <p class="font-semibold text-text-primary"><?= htmlspecialchars($post['author']) ?></p>
        <p class="text-xs text-text-secondary"><?= htmlspecialchars($post['date']) ?></p>
    </div>
    <span class="ml-auto text-xs font-medium <?= htmlspecialchars($post['badgeColor']) ?> px-2 py-1 rounded-full">
        <?= htmlspecialchars($post['category']) ?>
    </span>
    </div>

    <div class="w-full h-48 md:h-auto flex-shrink-0">
        <img
        class="object-cover w-full h-50 md:rounded-l-xl md:rounded-tr-none rounded-t-xl"
        src="<?= htmlspecialchars($post['image']) ?>"
        alt="<?= htmlspecialchars($post['title']) ?>"
        />
    </div>

    <a class="block after:absolute after:inset-0 after:z-0" href="<?= htmlspecialchars($post['link']) ?>">
    <h2 class="text-2xl font-bold tracking-tight text-text-primary group-hover:text-brand transition-colors">
        <?= htmlspecialchars($post['title']) ?>
    </h2>
    <p class="mt-2 text-sm text-text-secondary leading-relaxed">
        <?= htmlspecialchars($post['excerpt']) ?>
    </p>
    </a>

    <div class="relative z-10 pt-4 border-t border-card-dark flex items-center justify-between text-sm">
    <div class="flex items-center gap-4">
        <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">thumb_up</span> <?= htmlspecialchars($post['likes']) ?>
        </button>
        <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">chat_bubble</span> <?= htmlspecialchars($post['comments']) ?>
        </button>
        <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">visibility</span> <?= htmlspecialchars($post['views'] ?? 0) ?> views
        </button>
    </div>
    <button class="hidden flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
        <span class="material-symbols-outlined text-xl">share</span> Share
    </button>
    </div>
</article>