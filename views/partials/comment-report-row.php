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
        <a href="#" class="text-brand hover:underline">Ban</a>
        <a href="#" class="text-text-secondary hover:underline">Decline</a>
    </td>
</tr>