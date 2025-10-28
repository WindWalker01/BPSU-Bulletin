<?php
use Core\Database;
use Core\App;
use Core\Authenticator;

if (isUserLoggedIn()) {
    $auth = new Authenticator();

    $db = App::resolve(Database::class);

    $profile_image = $db
        ->query("SELECT * FROM profile_images WHERE user_id = :id", [
            "id" => (int) $auth->getLoggedInUserId(),
        ])
        ->find();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data["title"] ?? "BPSU Bulletin" ?></title>
    
    <script>
        (function() {
            // This function applies the theme to the <html> tag
            function applyTheme(theme) {
                let effectiveTheme = theme;
                if (theme === 'system') {
                    effectiveTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
                }

                if (effectiveTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }

            // Get the saved theme or default to 'system'
            const savedTheme = localStorage.getItem('theme') || 'system';
            applyTheme(savedTheme);

            // Add a listener to update the theme if the system preference changes
            // This is only needed if the user's saved choice is 'system'
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
                if (localStorage.getItem('theme') === 'system') {
                    applyTheme('system');
                }
            });
        })();
    </script>
    <link href="/css/tailwind.css" rel="stylesheet">
    <link href="/css/tiptap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
</head>
<body class="bg-bg-light text-text-dark min-h-screen dark:bg-bg-dark dark:text-text-primary dark:[background-image:radial-gradient(circle_at_25%_15%,rgb(192_0_0/0.2),transparent_40%),radial-gradient(circle_at_75%_85%,rgb(192_0_0/0.15),transparent_40%)] transition-colors duration-200">
<input type="checkbox" id="sidebar-toggle" class="hidden">
<?php if ($showHeader ?? true): ?>
<header class="bg-bg-dark/80 backdrop-blur-md border-b border-card-dark fixed top-0 left-0 right-0 z-30">
  <div class="flex items-center justify-between w-full h-16 px-4 sm:px-6 lg:px-8">

    <!-- Left Section: Menu + Logo + Search -->
    <div class="flex items-center gap-2 sm:gap-4 flex-1">

      <!-- Menu Button -->
      <label for="sidebar-toggle" class="text-text-primary flex items-center hover:text-text-secondary p-2 cursor-pointer">
        <i class="material-icons">menu</i>
      </label>

      <!-- Logo -->
      <a href="/" class="flex items-center max-sm:absolute max-sm:left-1/2 max-sm:transform max-sm:-translate-x-1/2">
        <img src="assets/logo.webp" class="w-18 sm:w-23" alt="BPSU Bulletin">
      </a>

      <!-- Search bar for desktop only -->
      <div class="hidden sm:block flex-1 max-w-xs relative">
  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
    <i class="material-icons text-text-secondary">search</i>
  </div>

  <input 
    type="text" 
    id="searchInput"
    placeholder="Search" 
    class="block w-full pl-10 pr-3 py-2 bg-overlay-dark border border-card-dark rounded-full text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
  >

  <!-- Search Results Dropdown -->
  <div 
    id="searchResults" 
    class="absolute mt-2 w-full bg-overlay-dark border border-card-dark rounded-lg shadow-lg hidden z-50"
  ></div>
      </div>

      <!-- Mobile search icon only -->
<button id="mobileSearchBtn" class="sm:hidden flex items-center text-text-secondary p-2 cursor-pointer">
  <i class="material-icons">search</i>
</button>

<!-- Mobile search input -->
<div id="mobileSearchContainer" class="absolute top-16 left-0 w-screen px-4 hidden z-50">
  <input
    type="text"
    id="mobileSearchInput"
    placeholder="Search"
    class="w-full pl-10 pr-3 py-2 bg-overlay-dark border border-card-dark rounded-full text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
  >
  <div 
    id="mobileSearchResults" 
    class="absolute mt-2 w-full bg-overlay-dark border border-card-dark rounded-lg shadow-lg hidden z-50"
  ></div>
</div>

    </div>

    <!-- Right Section: Write + Notifications + Profile -->
    <div class="flex items-center gap-4">
      <?php if (isUserLoggedIn()): ?>
        <?php if (
            getLoggedInRole() === "AUTHOR" ||
            getLoggedInRole() === "ADMIN"
        ): ?>      
          <form action="/blog" method="post">
            <input type="hidden" name="_method" value="POST">
            <button class="flex items-center gap-1 sm:gap-2 text-text-secondary hover:text-text-primary cursor-pointer">
              <span class="material-symbols-outlined">edit_square</span>
              <span class="text-sm font-medium hidden sm:inline">Write</span>
            </button>
          </form>
        <?php endif; ?>
      <?php endif; ?>

    
      <?php if (isUserLoggedIn()): ?>
      <!-- Notifications hidden on mobile -->
      <button class="hidden sm:flex items-center justify-center text-text-secondary hover:text-text-primary p-2 relative cursor-pointer">
        <i class="material-symbols-outlined">notifications</i>
      </button>

      
      <!-- Profile -->
     <div class="relative">
                <button 
                    id="profileButton"
                    class="flex items-center cursor-pointer p-0.5 border-2 border-transparent rounded-full transition-colors duration-100 data-[active=true]:border-brand"
                    data-active="false">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-brand-hover flex items-center justify-center hover:opacity-90 text-text-primary font-semibold overflow-hidden">
                      <img src="<?= $profile_image["secure_url"] ?>" alt="Profile" class="w-full h-full object-cover">
                    </div>
                </button>

                <div id="profileDropdown" 
                     class="absolute right-0 mt-2 w-48 bg-overlay-dark border border-card-dark rounded-lg shadow-lg hidden z-50 py-1 text-text-secondary">
                    
                    <a href="/account" class="flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark">
                        <span class="material-symbols-outlined text-base">person</span>
                        View Profile
                    </a>
                    
                    <a href="/notifications" class="flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark sm:hidden">
                        <span class="material-symbols-outlined text-base">notifications</span>
                        Notification
                    </a>

                    <a href="/settings" class="flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark">
                        <span class="material-symbols-outlined text-base">settings</span>
                        Settings
                    </a>
                    
                    <div class="border-t border-card-dark my-1"></div>
                    
                    <form action="/logout" method="POST">
                        <button type="submit" class="w-full cursor-pointer text-left flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark">
                           <span class="material-symbols-outlined text-base">logout</span>
                           Logout
                        </button>
                    </form>
                </div>
            </div>
      
      <?php else: ?>

        <!-- Login -->
        <button class="hidden sm:block text-text-secondary hover:text-text-primary p-2 relative cursor-pointer">
          <a href="/login">Login</a>
        </button>

      <!-- Register -->
        <button class="hidden sm:block text-text-secondary hover:text-text-primary p-2 relative cursor-pointer">
          <a href="/register">Register</a>
        </button>
      <?php endif; ?>
    </div>

  </div>
</header>

<!-- Sidebar - Slides under header -->
<aside
  class="fixed top-16 left-0 bottom-0 w-74 bg-overlay-dark/50 text-text-primary shadow-lg transform -translate-x-full transition-transform duration-300 z-40 flex flex-col border-r border-card-dark"
  id="sidebar"
>
 
  <nav class="flex flex-col gap-5 m-2 mt-4 space-y-1 px-3 flex-1 overflow-y-auto">
  <a href="/home" class="nav-link flex items-center gap-2 p-3 rounded-2xl">
    <i class="material-symbols-outlined">home</i>
    Home
  </a>
  <a href="/categories" class="nav-link flex items-center gap-2 p-3 rounded-2xl">
    <i class="material-symbols-outlined">category</i>
    Categories
  </a>
  <a href="/stats" class="nav-link flex items-center gap-2 p-3 rounded-2xl">
    <i class="material-symbols-outlined">dashboard</i>
    Stats
  </a>
  <a href="/following" class="nav-link flex items-center gap-2 p-3 rounded-2xl">
    <i class="material-symbols-outlined">group</i>
    Following
  </a>
  <a href="/admin" class="nav-link flex items-center gap-2 p-3 rounded-2xl">
    <i class="material-symbols-outlined">admin_panel_settings</i>
    Admin Panel
  </a>
</nav>
</aside>

<!-- Overlay -->
<label for="sidebar-toggle" class="fixed inset-0  bg-opacity-50 hidden cursor-pointer z-35" id="sidebar-overlay"></label>

<div class="pt-16 min-h-screen transition-all duration-300" id="main-content">
    <?= $slot ?? "" ?>
</div>
<?php else: ?>
    <?= $slot ?? "" ?>
<?php endif; ?>