<div
class="<?= $is_read === 1
    ? "opacity-50"
    : "" ?> group flex items-center justify-between p-3 rounded-lg hover:bg-gray-800 transition duration-200 space-x-3">
<div class="flex items-center space-x-3 flex-1 cursor-pointer">
    <img src="<?= $author_image ??
        "https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760671868/bpsu_bulletin/profile_images/iqq13zjwd7pfhcbdjud0.jpg" ?>"
    class="rounded-full w-12 h-12 object-cover border border-gray-700" />
    <div class="text-sm">
    <div class="text-white font-medium">
        <?= $author_name ??
            "Someone" ?> <?= $description ?>: <span class="text-gray-300"><?= $title ?></span>
    </div>
    <div class="text-gray-400 text-xs mt-1"><?= $time_ago ?></div>
    </div>
</div>
<button onclick="markAsRead(this)"
    class="<?= $is_read === 1
        ? "hidden"
        : "" ?> text-xs px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition" 
        data-notification-id="<?= $id ?>">
    Mark as read
</button>
</div>