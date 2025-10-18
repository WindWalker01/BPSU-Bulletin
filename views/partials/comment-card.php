<div class="flex gap-3 <?= htmlspecialchars($indent) ?> reaction-wrapper">
    <p class="comment-id hidden"><?= htmlspecialchars($comment_id) ?></p>

    <img src='<?= htmlspecialchars(
        $avatar,
    ) ?>' class='w-9 h-9 rounded-full' alt='Avatar'>
    <div class='flex-1'>
        <div class='flex items-center gap-2 text-sm text-text-secondary'>
            <span class='font-semibold text-text-primary'><?= htmlspecialchars(
                $username,
            ) ?></span>
            <span>• <?= htmlspecialchars($created_at) ?></span>
        </div>
        <p class='mt-1 text-text-secondary'><?= htmlspecialchars(
            $content,
        ) ?></p>

        <div class='flex items-center gap-4 mt-2 text-sm text-text-secondary'>
            
            <button class="hover:text-brand-hover flex items-center gap-1 <?= isUserLoggedIn()
                ? ""
                : "hidden" ?> reaction-button up-button">
                <span class='material-symbols-outlined text-base reaction-icon <?= $user_reaction ===
                1
                    ? "fill-1"
                    : "" ?>'>thumb_up</span> 
                <span class="like-count"><?= htmlspecialchars(
                    $like_count,
                ) ?></span>
            </button>
            
            <button class='hover:text-brand-hover flex items-center gap-1 <?= isUserLoggedIn()
                ? ""
                : "hidden" ?> reaction-button down-button'>
                <span class='material-symbols-outlined text-base reaction-icon <?= $user_reaction ===
                2
                    ? "fill-1"
                    : "" ?>'>thumb_down</span> 
                <span class="dislike-count"><?= htmlspecialchars(
                    $dislike_count,
                ) ?></span>
            </button>
            
            <button 
                onclick="this.closest('.flex-1').querySelector('form').classList.toggle('hidden')" 
                class='hover:text-brand-hover <?= isUserLoggedIn()
                    ? ""
                    : "hidden" ?>'>
                Reply
            </button>
        </div>

        <form action='/reply' method='POST' class='hidden mt-3 space-y-2'>
            <input type='hidden' name='parent_id' value='<?= htmlspecialchars(
                $reply_parent_id,
            ) ?>'>
            <input type='hidden' name='blog_id' value='<?= htmlspecialchars(
                $blog_id,
            ) ?>'>
            <input type='hidden' name='_method' value='POST'>
            <textarea 
                name='reply_content'
                rows='2'
                class='w-full bg-card-dark text-text-primary text-sm p-2 rounded-md focus:outline-none focus:ring-1 focus:ring-brand-hover'
                placeholder='Write a reply...'
            ></textarea>
            <div class='flex justify-end gap-2'>
                <button 
                    type='button'
                    onclick="this.closest('form').classList.add('hidden')"
                    class='text-gray-400 hover:text-gray-300 text-sm'
                >
                    Cancel
                </button>
                <button 
                    type='submit'
                    class='bg-brand hover:bg-brand-hover text-text-primary px-3 py-1 rounded-md text-sm'
                >
                    Post
                </button>
            </div>
        </form>