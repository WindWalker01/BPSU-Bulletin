<?php
$user_name = implode(" ", array_slice(explode(" ", trim($user_name)), 0, 2)); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Editor - BPSU Bulletin</title>

    <script>
        (function() {
            function applyTheme(theme) {
                let effectiveTheme = theme;
                if (theme === 'SYSTEM') { 
                    effectiveTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'DARK' : 'LIGHT';
                }

                if (effectiveTheme === 'DARK') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
            
            const savedTheme = localStorage.getItem('theme') || 'SYSTEM';
            applyTheme(savedTheme);

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (localStorage.getItem('theme') === 'SYSTEM') {
                    applyTheme('SYSTEM');
                }
            });

            
        })();
    </script>
    <link href="/css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=publish" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
  </head>
<body class="bg-bg-light dark:bg-bg-dark"> <link rel="stylesheet" href="/tiptap/index.css">

<header class="sticky top-0 bg-bg-light flex justify-center dark:bg-bg-dark/80 backdrop-blur-md border-b border-card-dark z-50">
  <div class="flex items-center justify-between w-full max-w-5xl h-16 px-4 sm:px-6 lg:px-8">
    <!-- Left: Logo and draft status -->
    <div class="flex items-center gap-3">
      <a href="/" class="flex items-center">
        <img src="/assets/logo.webp" class="w-12 lg:w-18" alt="BPSU Bulletin">
      </a>
      <div class="flex flex-col leading-tight">
        <span class="text-xs lg:text-sm text-text-primary font-medium">
          Draft in <span class="text-text-brand font-bold"><?php echo htmlspecialchars(
              $user_name,
          ); ?> </span>
        </span>
        <span id="saveStatus" class="text-xs text-text-secondary">Saved</span>
      </div>
    </div>

    <!-- Middle: Title input -->
    <div class="flex-1 mx-6">
      <input 
        id="title"
        name="title"
        type="text" 
        placeholder="Title"
        value="<?php echo htmlspecialchars($title); ?>"
        class="block w-full text-lg font-semibold bg-transparent border-none text-text-primary placeholder-text-secondary focus:outline-none"
      >
    </div>

    <!-- Right: Publish -->
    <div class="flex items-center gap-4">
      <?php if ($editing !== "SCHEDULED" && $editing !== "ACTIVE"): ?>
        <form action="/blog/publish" method="GET">
          <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
          <button 
            type="submit" 
            class="flex items-center gap-2 text-text-secondary hover:text-text-primary transition-colors"
          >
            <span class="material-symbols-outlined">publish</span>
            <span class="text-sm font-medium">Publish</span>
          </button>
        </form>
      <?php endif; ?>
    </div>
  </div>
</header>


<script>
  window.__APP_DATA__ = {
    blogId: <?php echo json_encode($blog_id); ?>,
    draftContent: <?php echo json_encode($draft_content); ?>,
    authorId: <?php echo json_encode($author_id); ?>
  };

  const titleInput = document.getElementById("title");
  const saveStatus = document.getElementById("saveStatus");

  let saveTimeout;
  let isSaving = false;

  titleInput.addEventListener("input", () => {
    saveStatus.textContent = "Saving...";
    clearTimeout(saveTimeout);

    saveTimeout = setTimeout(() => {
      saveTitle(titleInput.value);
    }, 800);
  });

  async function saveTitle(title) {
    const formData = new FormData();
    formData.append("_method", "PATCH");
    formData.append("blog_id", <?php echo $blog_id; ?>);
    formData.append("title", title);
    formData.append("author_id", <?php echo $author_id; ?>);

    try {
      const res = await fetch("http://localhost:8069/blog/editor", {
        method: "POST",
        body: formData
      });

      if (!res.ok) throw new Error("Save failed");

      saveStatus.textContent = "Saved";
      setTimeout(() => {
        saveStatus.textContent = "";
      }, 2000);
    } catch (err) {
      saveStatus.textContent = "Error saving";
    }
  }
</script>

<div id="root"></div>


<?php view("partials/intelligent-system-modal.php"); ?>

<script src="/tiptap/index.js"></script>

<script>
  (function () {
    const root = document.getElementById("root");
    const saveStatus = document.getElementById("saveStatus");
    let editorSaveTimeout;
    let stopped = false;

    function findEditorEl() {
      return root.querySelector('[contenteditable="true"], .ProseMirror, [data-editor], [role="textbox"]');
    }

    async function saveEditorContent(content) {
      console.log("[autosave] saving content length:", content.length);
      const formData = new FormData();
      formData.append("_method", "PATCH");
      formData.append("blog_id", <?php echo $blog_id; ?>);
      formData.append("content", content);
      formData.append("author_id", <?php echo $author_id; ?>);

      try {
        const res = await fetch("http://localhost:8069/blog/editor", {
          method: "POST",
          body: formData,
          credentials: "same-origin"
        });

        if (!res.ok) {
          const text = await res.text().catch(()=>"[no body]");
          console.error("[autosave] server error:", res.status, text);
          throw new Error("Save failed");
        }

        console.log("[autosave] saved OK");
        saveStatus.textContent = "Saved";
        setTimeout(() => { if (!stopped) saveStatus.textContent = ""; }, 2000);
      } catch (err) {
        console.error("[autosave] save error:", err);
        saveStatus.textContent = "Error saving";
      }
    }

    function handleChange() {
      saveStatus.textContent = "Saving...";
      clearTimeout(editorSaveTimeout);
      editorSaveTimeout = setTimeout(() => {
        const editorEl = findEditorEl();
        if (!editorEl) {
          console.warn("[autosave] editor not found at save time");
          return;
        }

        saveEditorContent(editorEl.innerHTML);
      }, 800);
    }

    function attachToEditor(editorEl) {
      if (!editorEl) return false;
      console.log("[autosave] attaching to editor element:", editorEl);
      if (editorEl._autosaveAttached) return true;
      editorEl._autosaveAttached = true;

      editorEl.addEventListener("keyup", handleChange);
      editorEl.addEventListener("paste", handleChange);
      editorEl.addEventListener("cut", handleChange);
      editorEl.addEventListener("input", handleChange); 

      const contentObserver = new MutationObserver(() => handleChange());
      contentObserver.observe(editorEl, { childList: true, subtree: true, characterData: true });
      return true;
    }

    const immediate = findEditorEl();
    if (immediate) {
      attachToEditor(immediate);
      return;
    }

    let attempts = 0;
    const pollMax = 20;
    const pollInterval = setInterval(() => {
      attempts++;
      const el = findEditorEl();
      if (el) {
        clearInterval(pollInterval);
        attachToEditor(el);
        return;
      }
      if (attempts >= pollMax) {
        clearInterval(pollInterval);
        console.warn("[autosave] editor not found by polling; we'll use mutation observer");
        // fallback: observe root for inserted editable
        const observer = new MutationObserver((mutations, obs) => {
          const el2 = findEditorEl();
          if (el2) {
            obs.disconnect();
            attachToEditor(el2);
          }
        });
        observer.observe(root, { childList: true, subtree: true });
      }
    }, 100);

    window.__autosave_stop = () => { stopped = true; clearTimeout(editorSaveTimeout); console.log("[autosave] stopped"); };
  })();
</script>

</body>
</html>

