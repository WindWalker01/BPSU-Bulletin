<div class="min-h-screen">
  <div class="w-10xl max-w-[80%] mx-auto md:px-0 pt-8 sm:pt-12 md:pt-16">

    <div class="flex items-center justify-between">
      <a
        href="/categories"
        class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
        <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">
          arrow_back
        </span>
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

    <!-- 🔽 Unified search, campus filter, and sort form -->
    <form method="GET" action="" class="flex flex-col sm:flex-row flex-wrap gap-4 mt-8">
      <!-- Search -->
      <div class="relative flex-grow">
        <input 
          id="searchInput"
          name="search"
          type="text" 
          placeholder="Search announcements..." 
          value="<?= htmlspecialchars($_GET["search"] ?? "") ?>"
          class="w-full px-4 py-2 bg-transparent border border-white rounded-lg text-sm placeholder-text-secondary focus:border-brand focus:ring-1 focus:ring-brand transition"
        >
      </div>

      <!-- Campus Filter -->
      <div class="relative w-full sm:w-48 flex-shrink-0">
        <select 
          id="campusFilter" 
          name="campus"
          class="appearance-none w-full bg-transparent border border-white rounded-lg text-sm py-2 px-3 pr-8 focus:border-brand focus:ring-1 focus:ring-brand transition"
          onchange="this.form.submit()"
        >
          <option value="">All Campuses</option>
          <?php
          // Generate unique campus options dynamically
          $campuses = array_unique(array_column($blogs, "campus"));
          sort($campuses);
          foreach ($campuses as $campus): ?>
            <option 
              value="<?= htmlspecialchars($campus) ?>" 
              <?= ($_GET["campus"] ?? "") === $campus ? "selected" : "" ?>
            >
              <?= htmlspecialchars($campus) ?>
            </option>
          <?php endforeach;
          ?>
        </select>
        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-secondary text-xs">▼</span>
      </div>

      <!-- Sort Order -->
      <div class="relative w-full sm:w-40 flex-shrink-0">
        <select 
          id="sortOrder" 
          name="sort"
          class="appearance-none w-full bg-transparent border border-white rounded-lg text-sm py-2 px-3 pr-8 focus:border-brand focus:ring-1 focus:ring-brand transition"
          onchange="this.form.submit()"
        >
          <option value="newest" <?= ($_GET["sort"] ?? "") === "newest"
              ? "selected"
              : "" ?>>Newest</option>
          <option value="oldest" <?= ($_GET["sort"] ?? "") === "oldest"
              ? "selected"
              : "" ?>>Oldest</option>
        </select>
        <span class="absolute right-3 top-1/2 transform -translate-y-1/2 pointer-events-none text-text-secondary text-xs">▼</span>
      </div>

      <!-- Submit button (optional for manual search) -->
      <button type="submit" class="hidden sm:block bg-brand text-white rounded-lg px-4 py-2 text-sm hover:bg-brand-hover transition">
        Apply Filters
      </button>
    </form>

    <?php
    // 🔽 Combined filtering logic
    $filteredAnnouncements = $blogs;

    // Filter by campus
    if (!empty($_GET["campus"])) {
        $filteredAnnouncements = array_filter($filteredAnnouncements, function (
            $b,
        ) {
            return $b["campus"] === $_GET["campus"];
        });
    }

    // Search filter
    if (!empty($_GET["search"])) {
        $search = strtolower($_GET["search"]);
        $filteredAnnouncements = array_filter($filteredAnnouncements, function (
            $b,
        ) use ($search) {
            return str_contains(strtolower($b["title"]), $search) ||
                str_contains(strtolower($b["username"]), $search) ||
                str_contains(strtolower($b["content"]), $search);
        });
    }

    // Sort
    if (!empty($_GET["sort"])) {
        usort($filteredAnnouncements, function ($a, $b) {
            $sortOrder = $_GET["sort"];
            $dateA = strtotime($a["created_at"]);
            $dateB = strtotime($b["created_at"]);
            return $sortOrder === "oldest" ? $dateA - $dateB : $dateB - $dateA;
        });
    }
    ?>

    <?php if (empty($filteredAnnouncements)): ?>
      <p class="text-text-secondary text-center mt-10 italic">No Blogs found in this category.</p>
    <?php endif; ?>

    <!-- 🔽 Announcement list -->
    <div id="announcementContainer" class="bg-bg-dark/50 rounded-2xl mt-8 space-y-4">
      <?php foreach ($filteredAnnouncements as $b): ?>
        <?php $excerpt = extractFirstParagraphFromTiptap(
            json_decode($b["content"], true),
        ); ?>

        <a href="/blog?id=<?= $b[
            "id"
        ] ?>" class="block announcement-card border-2 rounded-2xl" data-date="<?= htmlspecialchars(
    $b["created_at"],
) ?>">
          <div class="bg-card-dark/10 p-5 sm:p-6 rounded-xl border border-white/10 relative 
                      hover:bg-brand-hover/10 hover:border-brand/30 transition-all duration-300 group">

            <p class="ml-auto font-bold text-brand text-xs tracking-wider absolute top-4 right-5 
                        px-2 py-1 rounded-full bg-brand/20">
              University Announcement
            </p>

            <div class="flex items-center space-x-3 mb-2">
              <div class="w-8 h-8 rounded-full bg-brand flex-shrink-0"
                    style="background-image: url('<?= htmlspecialchars(
                        $b["author_avatar"] ?? "",
                    ) ?>'); background-size: cover; background-position: center;">
              </div>
              
              <div>
                <p class="text-sm font-semibold text-text-primary">
                  <?= htmlspecialchars($b["username"]) ?>
                </p>
                <p class="text-xs text-text-secondary">
                  Published on <?= date(
                      "F d, Y",
                      strtotime($b["created_at"]),
                  ) ?>
                </p>
              </div>
            </div>

            <h2 class="text-lg sm:text-xl font-semibold leading-snug mt-3 group-hover:text-brand transition">
              <?= htmlspecialchars($b["title"]) ?>
            </h2>
            <p class="text-sm text-text-secondary mt-2 line-clamp-3">
              <?= htmlspecialchars(
                  $excerpt ?: "No content preview available.",
              ) ?>
            </p>

            <!-- Campus Display -->
            <p class="text-xs text-text-secondary mt-2 italic">
              Campus: <?= htmlspecialchars($b["campus"]) ?>
            </p>
          </div>
        </a>
      <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-start items-center mt-10 text-text-secondary gap-4">
      <form method="GET" action="" class="flex items-center gap-2 mb-10">
        <label for="page" class="text-sm">Page</label>

        <select 
          name="page" 
          id="page" 
          onchange="this.form.submit()" 
          class="border-card-dark/50 border-3 bg-overlay-dark text-sm text-text-secondary rounded-md py-2 px-3 hover:border-brand transition"
        >
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <option 
              value="<?= $i ?>" 
              <?= $i === $page ? "selected" : "" ?> 
              class="bg-bg-dark/10 text-text-primary"
            >
              <?= $i ?>
            </option>
          <?php endfor; ?>
        </select>

        <span class="text-sm">of <?= $totalPages ?></span>

        <!-- Persist filters -->
        <input type="hidden" name="search" value="<?= htmlspecialchars(
            $_GET["search"] ?? "",
        ) ?>">
        <input type="hidden" name="campus" value="<?= htmlspecialchars(
            $_GET["campus"] ?? "",
        ) ?>">
        <input type="hidden" name="sort" value="<?= htmlspecialchars(
            $_GET["sort"] ?? "",
        ) ?>">
      </form>
    </div>

<?php view("partials/footer.php"); ?>
