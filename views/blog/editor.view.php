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

<link rel="stylesheet" href="/tiptap/index.css">

<!-- Header -->
<header class="bg-bg-dark/80 border-b border-card-dark">
  <div class="flex items-center justify-between w-full h-16 px-4 sm:px-6 lg:px-8">
      <!-- Left Section: Logo + Title -->
      <a href="/" class="flex items-center">
          <img src="/assets/logo.webp" class="w-23" alt="BPSU Bulletin">
      </a>
      
      <div class="flex items-center gap-4 flex-1">
        <input 
            id="title"
            name="title"
            type="text" 
            placeholder="Insert Blog Title" 
            value="<?php echo htmlspecialchars($title); ?>"
            class="block w-xs pl-3 pr-3 py-2 bg-bg-dark/80 text-text-primary placeholder-text-secondary focus:outline-none focus:border-transparent border-1 border-card-dark rounded-md"
        >  

        <p class="flex items-center gap-2 text-text-secondary text-xs">
          Tip: The editor auto-saves your work!
        </p>
      </div>   
  
      <!-- Right Section: Publish + Profile -->
  <div class="flex items-center gap-4">
      
    <!-- Publish Button -->
     <?php if ($editing !== "SCHEDULED" && $editing !== "ACTIVE"): ?>
        <form action="/blog/publish" method="GET">
          <input type="hidden" name="blog_id" value="<?= $blog_id ?>">

          <button type="submit" class="flex items-center gap-2 text-text-secondary hover:text-text-primary">
            <span class="material-symbols-outlined">
                publish
            </span>
            <span class="text-sm font-medium">Publish</span>

          </button>
        </form>
      <?php endif; ?>
    

      <!-- Profile Picture -->
      <button class="flex items-center">
          <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-brand-hover flex items-center justify-center text-text-primary font-semibold overflow-hidden">
              <img src="https://images.jammable.com/voices/f2e3aa8d-e446-4f3b-bce2-bf24c570d5a8.png" alt="Profile" class="w-full h-full object-cover">
          </div>
      </button>
    </div>
  </div> 
</header>


<script>
      window.__APP_DATA__ = {
        blogId: <?php echo json_encode($blog_id); ?>,
        draftContent: <?php echo json_encode($draft_content); ?>,
        authorId: <?php echo json_encode($author_id); ?>
      };
      
      let titleInput = document.getElementById("title");

      titleInput.addEventListener("blur", () =>{
        saveTitle(titleInput.value);
      });

      async function saveTitle(title){
        const formData = new FormData();
        formData.append("_method", "PATCH");
        formData.append("blog_id", <?php echo $blog_id; ?>);
        formData.append("title", title);
        formData.append("author_id", <?php echo $author_id; ?>);

        await fetch("http://localhost:8069/blog/editor", {
          method: "POST",
          body: formData,
          });

      }
      
</script>


<div id="root"></div>

<script src="/tiptap/index.js"></script>

<?php view("partials/footer.php"); ?>

