<!-- Title  -->
<div class="flex flex-col justify-start">
    <h1 class="text-5xl font-bold my-2"><?= $title ?></h1>
    
    <!-- Author and Publish date-->
    <div class="flex flex-row justify-between my-2">
        <div class="flex flex-row gap-2 my-2 items-center">
            <a href="/account?id=<?= $author_id ?>" class="flex flex-row gap-2 items-center">
                <img
                    alt="avatar"
                    class="h-10 w-10 rounded-full object-cover"
                    src="<?= $author_profile ?>"
                />
                <p class="text-text-primary text-s"><?= $username ??
                    "Unknown" ?>
                </p>
            </a>
            <p class="text-s mx-0.5">  &bull;  </p>
            <p class="text-text-secondary text-s">Published on <?= $published_at ?></p>
        </div>

        <!-- Follow Button -->
        <?php if (isUserLoggedIn() && !$isOwner): ?>
            <?php view("partials/follow-button.php", [
                "isFollowed" => $isFollowed,
                "follow_css" =>
                    "flex items-center gap-1.5 px-3 py-1.5 text-sm bg-brand rounded-md border border-brand text-text hover:bg-brand-hover transition-all duration-200",
                "unfollow_css" =>
                    "flex items-center gap-1.5 px-3 py-1.5 text-sm bg-gray-500 rounded-md border border-gray-500 text-text hover:bg-gray-800 transition-all duration-200",
                "account_id" => $author_id,
            ]); ?>

        <?php endif; ?>

    </div>

    <!-- Blog Content -->
    <article class="tiptap-content mb-12">
        <?= $blog_html ?>
    </article>
    
</div>