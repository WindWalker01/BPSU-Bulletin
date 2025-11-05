<tr class="hover:bg-card-dark/40 transition-colors duration-200">
    <td class="px-4 sm:px-5 py-4">
        <div class="flex flex-col">
            <p class="font-medium">Banned Blog Appeal</p>
            <p class="text-xs text-text-secondary">
                ID #<?= $appeal_id ?>
            </p>
        </div>
    </td>

    <td class="px-4 sm:px-5 py-4">
        <p class="font-medium"><?= $appealed_by ?></p>
    </td>

    <td class="px-4 sm:px-5 py-4">
        <span class="text-xs font-medium px-3 py-1 <?= $badge_color ?> rounded-full">
            <?= $original_action ?>
        </span>
    </td>

    <td class="px-4 sm:px-5 py-4">
        <?= $reason ?>
    </td>

    <td class="px-4 sm:px-5 py-4 text-center space-x-2 sm:space-x-3">
        <a href="/blog?id=<?= $blog_id ?>" class="text-accent-blue hover:underline">View</a>
        <a href="#" class="text-brand hover:underline">Approve</a>
        <a href="#" class="text-text-secondary hover:underline">Reject</a>
    </td>
</tr>
