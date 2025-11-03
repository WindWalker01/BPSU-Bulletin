
<div class="max-w-6xl mx-auto animate-fade-up space-y-12 my-8 px-4">
    <!-- ========== Blog Moderation Queue ========== -->
    <section>
    <!-- Header -->
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6"
    >
        <h1 class="text-xl sm:text-2xl font-semibold">
            Blog  Moderation Queue
        </h1>
    </div>

    <p class="text-sm text-text-secondary mb-4">
        Review and take action on content flagged by users.
    </p>

    <!-- Table Wrapper -->
    <div
        class="bg-overlay-dark rounded-2xl overflow-hidden border border-card-dark shadow-lg overflow-x-auto"
    >
        <table class="w-full text-sm min-w-[700px]">
         <thead class="bg-card-dark text-text-secondary">
            <tr class="text-left">
            <th class="px-4 sm:px-5 py-3 font-bold">Blog Details</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reason</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reported By</th>
            <th class="px-4 sm:px-5 py-3 font-bold text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-text-gray/40">
            <?php foreach ($blogs_reports as $blog): ?>
                <?php view("partials/blog-report-row.php", [
                    "title" => $blog["title"],
                    "author_name" => $blog["author_name"],
                    "report_type" => $blog["report_type"],
                    "reporter_name" => $blog["reporter_name"],
                    "blog_id" => $blog["blog_id"],
                    "badge_color" => $badge_color_map[$blog["report_type"]],
                ]); ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    </section>

    <!-- ========== Comments Moderation Queue ========== -->
    <section>
    <h2 class="text-xl sm:text-2xl font-semibold mb-2">
        Comments Moderation Queue
    </h2>
    <p class="text-sm text-text-secondary mb-4">
        Review and take action on accounts flagged by users.
    </p>

    <div
        class="bg-overlay-dark rounded-2xl overflow-hidden border border-card-dark shadow-lg overflow-x-auto"
    >
        <table class="w-full text-sm min-w-[650px]">
        <thead class="bg-card-dark text-text-secondary">
            <tr class="text-left">
            <th class="px-4 sm:px-5 py-3 font-bold">Accounts</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reason</th>
            <th class="px-4 sm:px-5 py-3 font-bold">Reported By</th>
            <th class="px-4 sm:px-5 py-3 font-bold text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-text-gray/40">
            <?php foreach ($comment_reports as $comment): ?>
                <?php view("partials/comment-report-row.php", [
                    "secure_url" => $comment["reported_profile_image"],
                    "reported_username" => $comment["reported_username"],
                    "campus" => $comment["campus"],
                    "report_type" => $comment["report_type"],
                    "reporter_username" => $comment["reporter_username"],
                    "blog_id" => $comment["blog_id"],
                    "badge_color" => $badge_color_map[$comment["report_type"]],
                ]); ?>
            <?php endforeach; ?>

            <tr
            class="hover:bg-card-dark/40 transition-colors duration-200"
            >
            <td class="px-4 sm:px-5 py-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-text-gray/20"></div>
                <div>
                <p class="font-medium">Maria Clara</p>
                <p class="text-xs text-text-secondary">
                    BPSU Balanga Campus
                </p>
                </div>
            </td>
            <td class="px-4 sm:px-5 py-4">
                <span
                class="bg-accent-navy/20 text-accent-navy text-xs font-medium px-3 py-1">Spam</span>
            </td>
            <td class="px-4 sm:px-5 py-4">Jose Rizal</td>
            <td class="px-4 sm:px-5 py-4 text-right space-x-2 sm:space-x-3">
                <a href="#" class="text-accent-blue hover:underline">View</a>
                <a href="#" class="text-brand hover:underline">Ban</a>
                <a href="#" class="text-text-secondary hover:underline">Decline</a>
            </td>
            </tr>
        </tbody>
        </table>
    </div>
    </section>
</div>




<?php view("partials/footer.php"); ?>
