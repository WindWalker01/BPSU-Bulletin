<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'BPSU Bulletin' ?></title>
    <link href="css/tailwind.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<body class="bg-bg-dark text-foreground-dark [background-image:radial-gradient(circle_at_25%_15%,rgb(192_0_0/0.2),transparent_40%),radial-gradient(circle_at_75%_85%,rgb(192_0_0/0.15),transparent_40%)]">
    
<!-- Sidebar Toggle Checkbox -->
<input type="checkbox" id="sidebar-toggle" class="hidden">

<!-- Header - Fixed and Full Width -->
<?php if($showHeader ?? true): ?>
<header class="bg-bg-dark/80  backdrop-blur-md border-b border-card-dark fixed top-0 left-0 right-0 z-30">
  <div class="flex items-center justify-between w-full h-16 px-4 sm:px-6 lg:px-8">
    <!-- Left Section: Menu + Logo + Search -->
    <div class="flex items-center gap-4 flex-1">
      <!-- Menu Button -->
      <label for="sidebar-toggle" class="text-text-primary hover:text-text-secondary p-2 cursor-pointer">
        <i class="material-icons">menu</i>
      </label>

      <a href="#" class="flex items-center">
        <img src="assets/logo.webp" class="w-23" alt="BPSU Bulletin">
      </a>

      <div class="flex-1 max-w-xs">
        <div class="relative">
          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <i class="material-icons text-text-secondary">search</i>
          </div>
          <input 
            type="text" 
            placeholder="Search" 
            class="block w-3xs pl-10 pr-3 py-2 bg-overlay-dark border-1 border-card-dark rounded-full text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
          >
        </div>
      </div>
    </div>

    <!-- Right Section: Write + Notifications + Profile -->
    <div class="flex items-center gap-4">
      <button class="flex items-center gap-2 text-text-secondary hover:text-text-primary cursor-pointer">
        <span class="material-symbols-outlined">edit_square</span>
        <span class="text-sm font-medium hidden sm:inline">Write</span>
      </button>

      <button class="text-text-secondary hover:text-text-primary p-2 relative cursor-pointer">
        <i class="material-symbols-outlined">notifications</i>
      </button>

      <button class="flex items-center">
        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-brand-hover flex items-center justify-center text-text-primary font-semibold overflow-hidden">
          <img src="https://images.jammable.com/voices/f2e3aa8d-e446-4f3b-bce2-bf24c570d5a8.png" alt="Profile" class="w-full h-full object-cover">
        </div>
      </button>
    </div>
  </div>
</header>

<!-- Sidebar - Slides under header -->
<aside
  class="fixed top-16 left-0 bottom-0 w-74 bg-overlay-dark/50 text-text-primary shadow-lg transform -translate-x-full transition-transform duration-300 z-40 flex flex-col border-r border-card-dark"
  id="sidebar"
>
 
  <nav class="flex flex-col gap-5 m-2 mt-4 space-y-1 px-3 flex-1 overflow-y-auto">
    <a href="#" class="flex items-center gap-2 p-3 rounded-2xl bg-brand text-white">
      <i class="material-symbols-outlined text-[4px]" >home</i>
      Home
    </a>
    <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-card-dark text-text-secondary">
      <i class="material-symbols-outlined">category</i>
      Categories
    </a>
    <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-card-dark text-text-secondary">
      <i class="material-symbols-outlined">dashboard</i>
      Stats
    </a>
    <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-card-dark text-text-secondary">
      <i class="material-symbols-outlined">group</i>
      Following
    </a>
    <a href="#" class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-card-dark text-text-secondary">
      <i class="material-symbols-outlined">admin_panel_settings</i>
      Admin Panel
    </a>
  </nav>
  <div class="mt-auto px-2 mx-4 py-4 border-t border-card-dark">
    <a href="#" class="flex items-center gap-2 p-3 rounded-lg hover:bg-card-dark text-text-secondary">
      <i class="material-icons">logout</i>
      Logout
    </a>
  </div>
</aside>

<!-- Overlay -->
<label for="sidebar-toggle" class="fixed inset-0  bg-opacity-50 hidden cursor-pointer z-35" id="sidebar-overlay"></label>

<div class="pt-16 min-h-screen transition-all duration-300" id="main-content">
    <?= $slot ?? "" ?>
</div>
    <?php else: ?>
        <?= $slot ?? "" ?>
    <?php endif; ?>


<script>
  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const mainContent = document.getElementById('main-content');

  sidebarToggle.addEventListener('change', () => {
    if(sidebarToggle.checked) {
      // Open sidebar
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      // Push only main content on desktop
      if (window.innerWidth >= 1024) {
        mainContent.style.marginLeft = '286px';
      }
    } else {
      // Close sidebar
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      mainContent.style.marginLeft = '0';
    }
  });

  // Handle window resize
  window.addEventListener('resize', () => {
    if (window.innerWidth < 1024) {
      mainContent.style.marginLeft = '0';
    } else if (sidebarToggle.checked) {
      mainContent.style.marginLeft = '256px';
    }
  });
</script>
