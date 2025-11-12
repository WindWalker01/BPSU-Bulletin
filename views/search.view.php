<div class="flex flex-col min-h-screen">

<main class="container mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-grow">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
      <div class="lg:col-span-8 space-y-8 order-2 lg:order-1">
        <?php foreach ($blogs as $blog) {
            view("partials/post-card.php", [
                "date" => DateTime::createFromFormat(
                    "Y-m-d H:i:s",
                    $blog["updated_at"],
                )->format("F j, Y"),
                "link" => "/blog?id={$blog["id"]}",
                "title" => $blog["title"],
                "excerpt" => extractFirstParagraphFromTiptap(
                    json_decode($blog["content"]),
                ),
                "likes" => $blog["reaction_count_like"],
                "comments" => $blog["comment_count"],
                "image" => extractFirstImageFromTiptap(
                    json_decode($blog["content"]),
                ),
                "category" => $blog["categories"],
            ]);
        } ?>

        </div>
        
        <aside class="lg:col-span-4 space-y-8 lg:sticky lg:top-24 order-1 lg:order-2 hidden">
          <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
            <h3 class="text-lg font-bold mb-4 text-text-primary">Trending Topics</h3>
            <div class="space-y-3">
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#BPSUNewPrograms</a>
                <p class="text-sm text-text-secondary">1,204 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#InnovationFair2023</a>
                <p class="text-sm text-text-secondary">876 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#CSSWorkshop</a>
                <p class="text-sm text-text-secondary">451 Posts</p>
              </div>
              <div>
                <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">#StudentLife</a>
                <p class="text-sm text-text-secondary">2.3k Posts</p>
              </div>
            </div>
          </div>
        </aside>
      </div>
    </main>
</div>




<?php view("partials/footer.php"); ?>
