<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="/css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=publish" />
</head>
<body class="bg-bg-dark/80">

<link rel="stylesheet" href="/dist/assets/index.css">

<!-- Header -->
<header class="bg-bg-dark/80 border-b border-card-dark">
  <form action="" method="GET">
    <input type="hidden" name="_method" value="GET">
    <div class="flex items-center justify-between w-full h-16 px-4 sm:px-6 lg:px-8">
          <!-- Left Section: Logo + Title -->
          <div class="flex items-center gap-4 flex-1">
            <a href="#" class="flex items-center">
                <img src="/assets/logo.webp" class="w-23" alt="BPSU Bulletin">
            </a>
            <input 
                id="blog_title"
                name="blog_title"
                type="text" 
                placeholder="Insert Title" 
                class="block w-xs pl-3 pr-3 py-2 bg-bg-dark/80 rounded-xs text-text-primary placeholder-text-secondary focus:outline-none focus:border-transparent"
            >
          </div>

          <!-- Right Section: Publish + Profile -->
          <div class="flex items-center gap-4">
              <!-- Publish Button -->
                <button type="submit" class="flex items-center gap-2 text-text-secondary hover:text-text-primary">
                  <span class="material-symbols-outlined">
                      publish
                  </span>
                  <span class="text-sm font-medium">Publish</span>

                </button>
              

              <!-- Profile Picture -->
              <button class="flex items-center">
                  <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-brand-hover flex items-center justify-center text-text-primary font-semibold overflow-hidden">
                      <img src="https://images.jammable.com/voices/f2e3aa8d-e446-4f3b-bce2-bf24c570d5a8.png" alt="Profile" class="w-full h-full object-cover">
                  </div>
              </button>
          </div>
    </div>
  </form>
      
</header>


<script>
      window.__APP_DATA__ = {
        blogId: <?php echo json_encode($blog_id); ?>,
        draftContent: <?php echo json_encode($draft_content); ?>
      };

      console.log(<?= $blog_id ?>);
      console.log(<?= $draft_content ?>);
</script>


<div id="root"></div>

<script src="/dist/assets/index.js"></script>

<?php view("partials/footer.php"); ?>

