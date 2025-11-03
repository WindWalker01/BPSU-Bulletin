<tr class="hover:bg-card-dark/40 transition-colors duration-200">
    <td class="px-4 sm:px-5 py-4">
        <p class="font-medium"><?= $title ?></p>
        <p class="text-xs text-text-secondary">Posted by: <?= $author_name ?></p>
    </td>
    <td class="px-4 sm:px-5 py-4">
        <span class="text-xs font-medium px-3 py-1 <?= $badge_color ?>"><?= $report_type ?></span>
    </td>
    <td class="px-4 sm:px-5 py-4"><?= $reporter_name ?></td>
    <td class="px-4 sm:px-5 py-4 text-center space-x-2 sm:space-x-3">
        <a href="/blog?id=<?= $blog_id ?>" class="text-accent-blue hover:underline">View</a>
        <a href="#" class="text-brand hover:underline">Ban</a>
        <a href="#" class="text-text-secondary hover:underline">Decline</a>
    </td>
</tr>