<?php if (!$isFollowed): ?>
    <form action="/account/follow" method="post">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="author_id" value="<?php echo $account_id; ?>">
        <input type="hidden" name="is_followed" value="<?php echo $isFollowed; ?>">

        <button type="submit"
        class= "<?= $follow_css ?>">
        Follow Author
        </button>
    </form>
    <?php else: ?>
    <form action="/account/follow" method="post">
        <input type="hidden" name="_method" value="POST">
        <input type="hidden" name="author_id" value="<?php echo $account_id; ?>">
        <input type="hidden" name="is_followed" value="<?php echo $isFollowed; ?>">

        <button type="submit"
        class="<?= $unfollow_css ?>">
        Unfollow Author
        </button>
    </form>
<?php endif; ?>
