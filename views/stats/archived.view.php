<body class="bg-[#0d0d0d] min-h-screen">
  <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden" style='font-family: Inter, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
      <div class="px-4 sm:px-6 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 w-full">
          
          <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-4">
            <h1 class="text-[#ffffff] text-2xl sm:text-[32px] font-bold leading-tight">Your Posts</h1>
           
          </div>

          <div class="px-4 py-3">
            <label class="flex flex-col min-w-40 h-12 w-full">
              <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                <div class="text-[#a3a3a3] flex border-none bg-[#1a1a1a]/50 bg-blur-sm items-center justify-center pl-4 rounded-l-lg">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                  </svg>
                </div>
                <input
                  placeholder="Search posts by title or content"
                  class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-[#ffffff] focus:outline-0 focus:ring-0 border-none bg-[#1a1a1a]/50 bg-blur-sm focus:border-none h-full placeholder:text-[#a3a3a3] px-4 rounded-l-none pl-2 text-base font-normal leading-normal"
                  value=""
                />
              </div>
            </label>
          </div>

          <div class="pb-3">
            <div class="flex flex-col lg:flex-row lg:justify-between border-[#2e2e2e] px-4 gap-4">
              <div class="flex gap-4 sm:gap-8 overflow-x-auto pb-2 lg:pb-0">
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-[#a3a3a3] pb-[13px] pt-4 whitespace-nowrap" href="stats">
                  <p class=" text-sm font-bold leading-normal tracking-[0.015em]">Published</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-[#a3a3a3] hover:text-[#ffffff] pb-[13px] pt-4 whitespace-nowrap transition-colors" href="drafts">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Drafts</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-[#a3a3a3] hover:text-[#ffffff] pb-[13px] pt-4 whitespace-nowrap transition-colors" href="scheduled">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Scheduled</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-[#c00000] text-[#ffffff] hover:text-[#ffffff] pb-[13px] pt-4 whitespace-nowrap transition-colors" href="archived">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Archived</p>
                </a>
              </div>

              <div class="flex gap-2 sm:gap-3 flex-wrap">
                <div class="relative">
                  <button id="categories-button" class="flex h-8 cursor-pointer shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#2e2e2e] hover:bg-[#3a3a3a] pl-4 pr-2 transition-colors">
                    <p class="text-[#ffffff] text-sm font-medium leading-normal">Categories</p>
                    <div class="text-[#ffffff]">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                      </svg>
                    </div>
                  </button>
                  <div id="categories-menu" class="absolute z-10 top-full left-0 mt-2 w-56 rounded-lg bg-[#1a1a1a] border border-[#3a3a3a] shadow-lg overflow-hidden hidden dropdown-menu">
                    <ul class="py-2">
                      <li><a href="#" class="block px-4 py-2 text-[#a3a3a3] hover:bg-[#3a3a3a] hover:text-[#ffffff] rounded-md text-sm mx-2">Technology</a></li>
                      <li><a href="#" class="block px-4 py-2 text-[#a3a3a3] hover:bg-[#3a3a3a] hover:text-[#ffffff] rounded-md text-sm mx-2">Lifestyle</a></li>
                      <li><a href="#" class="block px-4 py-2 text-[#a3a3a3] hover:bg-[#3a3a3a] hover:text-[#ffffff] rounded-md text-sm mx-2">Travel</a></li>
                      <li><a href="#" class="block px-4 py-2 text-[#a3a3a3] hover:bg-[#3a3a3a] hover:text-[#ffffff] rounded-md text-sm mx-2">Food</a></li>
                    </ul>
                  </div>
                </div>
                <div class="relative">
                  <button id="tags-button" class="flex h-8 cursor-pointer shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#2e2e2e] hover:bg-[#3a3a3a] pl-4 pr-2 transition-colors">
                    <p class="text-[#ffffff] text-sm font-medium leading-normal">Tags</p>
                    <div class="text-[#ffffff]">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                      </svg>
                    </div>
                  </button>
                  <div id="tags-menu" class="absolute z-10 top-full left-0 mt-2 w-56 rounded-lg bg-[#1a1a1a] border border-[#3a3a3a] shadow-lg overflow-hidden hidden dropdown-menu">
                    <div class="p-4 flex flex-wrap gap-2">
                      <span class="inline-flex items-center justify-center rounded-full px-3 py-1 bg-[#3b82f6]/20 text-[#3b82f6] text-xs font-medium cursor-pointer hover:bg-[#3b82f6]/40">AI</span>
                      <span class="inline-flex items-center justify-center rounded-full px-3 py-1 bg-[#22c55e]/20 text-[#22c55e] text-xs font-medium cursor-pointer hover:bg-[#22c55e]/40">Productivity</span>
                      <span class="inline-flex items-center justify-center rounded-full px-3 py-1 bg-[#a855f7]/20 text-[#a855f7] text-xs font-medium cursor-pointer hover:bg-[#a855f7]/40">Europe</span>
                      <span class="inline-flex items-center justify-center rounded-full px-3 py-1 bg-[#FDE047]/20 text-[#FDE047] text-xs font-medium cursor-pointer hover:bg-[#FDE047]/40">Tips</span>
                      <span class="inline-flex items-center justify-center rounded-full px-3 py-1 bg-[#c00000]/20 text-[#d55454] text-xs font-medium cursor-pointer hover:bg-[#c00000]/40">Tech</span>
                    </div>
                  </div>
                </div>
                <div class="relative">
                  <button id="date-button" class="flex h-8 cursor-pointer shrink-0 items-center justify-center gap-x-2 rounded-lg bg-[#2e2e2e] hover:bg-[#3a3a3a] pl-4 pr-2 transition-colors">
                    <p class="text-[#ffffff] text-sm font-medium leading-normal whitespace-nowrap">Date</p>
                    <div class="text-[#ffffff]">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                      </svg>
                    </div>
                  </button>
                  <div id="date-menu" class="absolute z-10 top-full left-0 lg:right-0 lg:left-auto mt-2 w-72 rounded-lg bg-[#1a1a1a] border border-[#3a3a3a] shadow-lg p-4 hidden dropdown-menu">
                    </div>
                </div>
              </div>
            </div>
          </div>

          
          <h3 class="text-[#ffffff] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Archived</h3>
          <div class="px-4 py-3">
            <div class="overflow-x-auto rounded-lg border border-[#2e2e2e] bg-[#1a1a1a]/50">
              <table class="w-full min-w-[640px]">
                <thead>
                  <tr class="border-b border-[#2e2e2e]">
                    <th class="px-4 py-3 text-left text-[#ffffff] text-sm font-medium leading-normal">Title</th>
                    <th class="px-4 py-3 text-left text-[#ffffff] text-sm font-medium leading-normal whitespace-nowrap">Status</th>
                    <th class="px-4 py-3 text-left text-[#ffffff] text-sm font-medium leading-normal">Views</th>
                    <th class="px-4 py-3 text-left text-[#ffffff] text-sm font-medium leading-normal hidden sm:table-cell">Comments</th>
                    <th class="px-4 py-3 text-left text-[#a3a3a3] text-sm font-medium leading-normal hidden md:table-cell">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php if (empty($archived_blogs)): ?>
                    <tr class="border-t border-[#2e2e2e]">
                      <td colspan="5" class="px-4 py-4 text-center text-[#a3a3a3] text-sm font-normal leading-normal">
                        No archived posts found.
                      </td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($archived_blogs as $blog): ?>
                      <tr class="border-t border-[#2e2e2e] hover:bg-[#2e2e2e]/30 transition-colors">
                        
                        <td class="px-4 py-4 text-[#ffffff] text-sm font-normal leading-normal">
                          <?= htmlspecialchars($blog['title'] ?? 'Untitled Post') ?>
                        </td>
                        
                        <td class="px-4 py-4 text-sm font-normal leading-normal">
                          <span class="inline-flex items-center justify-center rounded-lg px-3 py-1 bg-[#c00000]/20 text-[#d55454] text-xs font-medium whitespace-nowrap">
                            Archived
                          </span>
                        </td>
                        
                        <td class="px-4 py-4 text-[#a3a3a3] text-sm font-normal leading-normal">0</td>
                        <td class="px-4 py-4 text-[#a3a3a3] text-sm font-normal leading-normal hidden sm:table-cell">0</td>
                        
                        <td class="px-4 py-4 text-[#a3a3a3] text-sm font-bold leading-normal tracking-[0.015em] hidden md:table-cell">
                          <a href="/unarchive?id=<?= $blog['id'] ?>" class="text-[#22c55e] hover:text-[#4ade80] cursor-pointer transition-colors">Unarchive</a> | 
                          <a href="/delete-permanent?id=<?= $blog['id'] ?>" class="text-[#c00000] hover:text-[#d55454] cursor-pointer transition-colors">Delete</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>

                </tbody>
                </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const buttons = [
        document.getElementById('categories-button'),
        document.getElementById('tags-button'),
        document.getElementById('date-button')
      ];

      const menus = [
        document.getElementById('categories-menu'),
        document.getElementById('tags-menu'),
        document.getElementById('date-menu')
      ];

      const allMenus = document.querySelectorAll('.dropdown-menu');

      // Function to close all menus
      const closeAllMenus = () => {
        allMenus.forEach(menu => {
          menu.classList.add('hidden');
        });
      };

      // Toggle logic for each button
      buttons.forEach((button, index) => {
        if (button) {
          button.addEventListener('click', (event) => {
            event.stopPropagation(); // Stop click from bubbling up to the window
            const menu = menus[index];
            if (menu) {
              const isHidden = menu.classList.contains('hidden');
              closeAllMenus(); // Close all menus first
              if (isHidden) {
                menu.classList.remove('hidden'); // Open the clicked one
              }
            }
          });
        }
      });

      // Stop clicks inside the menu from closing it
      menus.forEach(menu => {
        if (menu) {
          menu.addEventListener('click', (event) => {
            event.stopPropagation();
          });
        }
      });

      // Click away to close
      window.addEventListener('click', () => {
        closeAllMenus();
      });
    });
  </script>

</body>

<?php view("partials/footer.php"); ?>