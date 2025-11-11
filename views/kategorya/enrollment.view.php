<div class=" min-h-screen">
  <div class="w-10xl max-w-[80%] mx-auto md:px-0 pt-8 sm:pt-12 md:pt-16">

    <div class="flex items-center justify-between">
            <a
    href="/categories"
    class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
    <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1"
      >arrow_back</span>
    Back to Categories
  </a>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" 
                class="text-text-secondary hover:text-text-primary text-sm flex items-center justify-center gap-1 transition">
                Next →
            </a>
        <?php endif; ?>
    </div>

    <div class="mt-8">
      <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold">University Enrollment & Documents</h1>
       <p class="text-base sm:text-lg text-text-secondary mt-1">Details about registration, documents, and requirements.</p>
    </div>

        <form method="GET" action="" class="flex flex-col sm:flex-row gap-4 mt-8">
            <div class="relative flex-grow">
                <input 
                id="searchInput"
                name="search"
                type="text" 
                placeholder="Search enrollment and documents..." 
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                class="w-full px-4 py-2 bg-transparent border border-white rounded-lg text-sm placeholder-text-secondary focus:border-brand focus:ring-1 focus:ring-brand transition"
                >
            </div>

            <div class="relative w-full sm:w-40 flex-shrink-0">
                <select id="sortOrder" class="appearance-none w-full bg-transparent border border-white rounded-lg text-sm py-2 px-3 pr-8 focus:border-brand focus:ring-1 focus:ring-brand transition">
                <option value="newest" class="bg-bg-dark text-text-primary" selected>Newest</option>
                <option value="oldest" class="bg-bg-dark text-text-primary">Oldest</option>
                </select>
                <span class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-secondary text-xs">
                ▼
                </span>
            </div>
        </form>

    <?php if (empty($blogs)): ?>
        <p class="text-text-secondary text-center mt-10 italic">No Enrollment & Documents found in this category.</p>
    <?php endif; ?>

    <div id="enrollmentDocumentsContainer" class="mt-8 space-y-4">
        <?php foreach ($blogs as $b): ?>
            <?php 
                $excerpt = extractFirstParagraphFromTiptap(json_decode($b['content'], true)); ?>

            <a href="/blog?id=<?= $b['id'] ?>" class="block enrollmentDocuments-card border-2 rounded-2xl" data-date="<?= htmlspecialchars($b['created_at']) ?>"> 
                <div class="bg-card-dark/10 p-5 sm:p-6 rounded-xl border border-white/10 relative 
                            hover:bg-brand-hover/10 hover:border-brand/30 transition-all duration-300 group">
                    
                    <p class="ml-auto text-blue-400 text-xs tracking-wider absolute top-4 right-5 
                                px-2 py-1 rounded-full bg-blue-500/40 font-bold">
                        Enrollment & Documents
                    </p>

                    <div class="flex items-center space-x-3 mb-2">
                        <div class="w-8 h-8 rounded-full bg-brand flex-shrink-0"
                              style="background-image: url('<?= htmlspecialchars($b['author_avatar'] ?? '') ?>'); background-size: cover; background-position: center;">
                        </div>
                        
                        <div>
                            <p class="text-sm font-semibold text-text-primary">
                                <?= htmlspecialchars($b['username']) ?>
                            </p>
                            <p class="text-xs text-text-secondary">
                                Published on <?= date('F d, Y', strtotime($b['created_at'])) ?>
                            </p>
                        </div>
                    </div>

                    <h2 class="text-lg sm:text-xl font-semibold leading-snug mt-3 group-hover:text-brand transition">
                        <?= htmlspecialchars($b['title']) ?>
                    </h2>
                      <p class="text-sm text-text-secondary mt-2 line-clamp-3">
                          <?= htmlspecialchars($excerpt ?: "No content preview available.") ?>
                      </p>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

<div class="flex justify-start items-center mt-10 text-text-secondary gap-4">
    
    <form method="GET" action="" class="flex items-center gap-2 mb-10">
        <label for="page" class="text-sm">Page</label>

        <select 
            name="page" 
            id="page" 
            onchange="this.form.submit()" 
            class= " border-card-dark/50 border-3 bg-overlay-dark text-sm text-text-secondary rounded-md py-2 px-3 hover:border-brand transition">

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <option 
                    value="<?= $i ?>" 
                    <?= $i === $page ? 'selected' : '' ?> 
                    class="bg-bg-dark/10 text-text-primary"
                >
                    <?= $i ?>
                </option>
            <?php endfor; ?>
        </select>

        <span class="text-sm">of <?= $totalPages ?></span>
    </form>
</div>


<script>
  const select = document.getElementById('sortOrder');
  const container = document.getElementById('enrollmentDocumentsContainer');

  select.addEventListener('change', () => {
    const cards = Array.from(container.querySelectorAll('.enrollmentDocuments-card'));
    const order = select.value;

    // Sort by date
    cards.sort((a, b) => {
      const dateA = new Date(a.dataset.date);
      const dateB = new Date(b.dataset.date);
      return order === 'newest' ? dateB - dateA : dateA - dateB;
    });

    // Re-append sorted cards
    cards.forEach(card => container.appendChild(card));
  });
</script>


<?php view("partials/footer.php"); ?>
