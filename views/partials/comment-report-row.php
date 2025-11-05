<tr class="hover:bg-card-dark/40 transition-colors duration-200">
    <td class="px-4 sm:px-5 py-4 flex items-center gap-3">
        <img class="w-10 h-10 rounded-full bg-text-gray/20" src="<?= $secure_url ?>" />
        <div>
            <p class="font-medium"><?= $reported_username ?></p>
            <p class="text-xs text-text-secondary">
                BPSU <?= $campus ?>
            </p>
        </div>
    </td>
    <td class="px-4 sm:px-5 py-4">
       <span class="text-xs font-medium px-3 py-1 <?= $badge_color ?>"><?= $report_type ?></span>
    </td>
    <td class="px-4 sm:px-5 py-4"><?= $reporter_username ?></td>
    <td class="px-4 sm:px-5 py-4 text-center space-x-2 sm:space-x-3">
        <a href="/blog?id=<?= $blog_id ?>" class="text-accent-blue hover:underline">View</a>
        <a onclick="banUser(<?= $user_id ?>, <?= $report_id ?>)" href="#" class="text-brand hover:underline">Ban User</a>
        <a onclick="removeComment(<?= $comment_id ?>, <?= $report_id ?>)" href="#" class="text-brand hover:underline">Remove Comment</a>
        <a onclick="declineComment(<?= $report_id ?>)" href="#" class="text-text-secondary hover:underline">Decline</a>
    </td>
</tr>