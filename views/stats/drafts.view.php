<body class="bg-bg-dark min-h-screen">
  <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden" style='font-family: Inter, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
      <div class="px-4 sm:px-6 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 w-full">
          
          <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-4">
            <h1 class="text-text-primary text-2xl sm:text-[32px] font-bold leading-tight">Your Posts</h1>
          </div>

          <div class="px-4 py-3">
            <form action="/drafts" method="GET">
              <?php if (!empty($sort_order)): ?>
                <input type="hidden" name="sort" value="<?= htmlspecialchars($sort_order) ?>">
              <?php endif; ?>
              
              <label class="flex flex-col min-w-40 h-12 w-full">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                  <button type="submit" class="text-text-secondary flex border-none bg-overlay-dark/50 bg-blur-sm items-center justify-center pl-4 rounded-l-lg hover:text-text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                  </button>
                  <input
                    placeholder="Search posts by title"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden text-text-primary focus:outline-0 focus:ring-0 border-none bg-overlay-dark/50 bg-blur-sm focus:border-none h-full placeholder:text-text-secondary px-4 rounded-l-none pl-2 text-base font-normal leading-normal <?php if (!empty($search_term)): ?>rounded-r-none<?php else: ?>rounded-r-lg<?php endif; ?>"
                    name="search"
                    value="<?= htmlspecialchars($search_term ?? '') ?>"
                  />
                  
                  <?php if (!empty($search_term)): ?>
                    <a href="/drafts?sort=<?= htmlspecialchars($sort_order) ?>" class="text-text-secondary flex border-none bg-overlay-dark/50 bg-blur-sm items-center justify-center pr-4 rounded-r-lg hover:text-text-primary transition-colors">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31l-66.34,66.35a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path>
                      </svg>
                    </a>
                  <?php endif; ?>

                </div>
              </label>
            </form>
          </div>

          <div class="pb-3">
            <div class="flex flex-col lg:flex-row lg:justify-between px-4 gap-4">
              <div class="flex gap-4 sm:gap-8 overflow-x-auto pb-2 lg:pb-0">
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-text-secondary hover:text-text-primary pb-[13px] pt-4 whitespace-nowrap" href="stats">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Published</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-brand text-text-primary hover:text-text-primary pb-[13px] pt-4 whitespace-nowrap transition-colors" href="drafts">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Drafts</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-text-secondary hover:text-text-primary pb-[13px] pt-4 whitespace-nowrap transition-colors" href="scheduled">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Scheduled</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-text-secondary hover:text-text-primary pb-[13px] pt-4 whitespace-nowrap transition-colors" href="archived">
                  <p class="text-sm font-bold leading-normal tracking-[0.015em]">Archived</p>
                </a>
              </div>

              <div class="flex gap-2 sm:gap-3 flex-wrap">
                <div class="relative">
                  <button id="sort-button" class="flex h-8 cursor-pointer shrink-0 items-center justify-center gap-x-2 rounded-lg bg-card-dark hover:bg-card-dark/80 pl-4 pr-2 transition-colors">
                    <p class="text-text-primary text-sm font-medium leading-normal whitespace-nowrap">
                        Sort: <?= ($sort_order === 'asc') ? 'Oldest' : 'Most Recent' ?>
                    </p> 
                    <div class="text-text-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256"><path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
                    </div>
                  </button>
                  <div id="sort-menu" class="absolute z-10 top-full left-0 lg:right-0 lg:left-auto mt-2 w-56 rounded-lg bg-overlay-dark border border-card-dark shadow-lg overflow-hidden hidden dropdown-menu">
                    <ul class="py-2">
                        <?php
                            $search_query = !empty($search_term) ? '&search=' . urlencode($search_term) : '';
                        ?>
                        <li><a href="/drafts?sort=desc<?= $search_query ?>" class="block px-4 py-2 text-text-secondary hover:bg-card-dark hover:text-text-primary rounded-md text-sm mx-2">Most Recent</a></li>
                        <li><a href="/drafts?sort=asc<?= $search_query ?>" class="block px-4 py-2 text-text-secondary hover:bg-card-dark hover:text-text-primary rounded-md text-sm mx-2">Oldest</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h3 class="text-text-primary text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Drafts</h3>
          <div class="px-4 py-3">
            <div class="overflow-x-auto rounded-lg border border-card-dark bg-overlay-dark/50">
              <table class="w-full min-w-[640px]">
                <thead>
                  <tr class="border-b border-card-dark">
                    <th class="px-4 py-3 text-left text-text-primary text-sm font-medium leading-normal">Title</th>
                    <th class="px-4 py-3 text-left text-text-primary text-sm font-medium leading-normal whitespace-nowrap">Status</th>
                    <th class="px-4 py-3 text-left text-text-primary text-sm font-medium leading-normal">Views</th>
                    <th class="px-4 py-3 text-left text-text-primary text-sm font-medium leading-normal hidden sm:table-cell">Comments</th>
                    <th class="px-4 py-3 text-left text-text-secondary text-sm font-medium leading-normal hidden md:table-cell">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php if (empty($draft_blogs)): ?>
                    <tr class="border-t border-card-dark">
                      <td colspan="5" class="px-4 py-4 text-center text-text-secondary text-sm font-normal leading-normal">
                        <?php if (!empty($search_term)): ?>
                            No drafts found matching "<?= htmlspecialchars($search_term) ?>".
                        <?php else: ?>
                            No drafts found.
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($draft_blogs as $blog): ?>
                      <tr class="border-t border-card-dark hover:bg-card-dark/30 transition-colors">
                        
                        <td class="px-4 py-4 text-text-primary text-sm font-normal leading-normal">
                          <?= htmlspecialchars($blog['title'] ?? 'Untitled Post') ?>
                        </td>
                        
                        <td class="px-4 py-4 text-sm font-normal leading-normal">
                          <span class="inline-flex items-center justify-center rounded-lg px-3 py-1 text-xs font-medium whitespace-nowrap bg-badge-draft-bg text-badge-draft-text">
                            Draft
                          </span>
                        </td>
                        
                        <td class="px-4 py-4 text-text-secondary text-sm font-normal leading-normal">
                          <?= $blog['views_count'] ?? 0 ?>
                        </td>
                        <td class="px-4 py-4 text-text-secondary text-sm font-normal leading-normal hidden sm:table-cell">
                          <?= $blog['comments_count'] ?? 0 ?>
                        </td>
                        
                        <td class="px-4 py-4 text-text-secondary text-sm font-bold leading-normal tracking-[0.015em] hidden md:table-cell">
                          <a href="/blog/editor?blog_id=<?= $blog['id'] ?>" class="text-accent-yellow hover:text-accent-yellow-hover cursor-pointer transition-colors">Edit</a> | 
                          
                          <button type="button" 
                                  class="open-delete-modal text-brand hover:text-brand-hover cursor-pointer transition-colors bg-transparent border-none p-0 font-bold leading-normal"
                                  data-blog-id="<?= $blog['id'] ?>"
                                  data-redirect-to="/drafts"
                                  data-message="Are you sure you want to permanently delete this draft?">
                            Delete
                          </button>
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

  <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 hidden">
    <div class="w-full max-w-sm rounded-lg border border-card-dark bg-overlay-dark p-6 shadow-lg">
      <h3 class="text-lg font-bold text-text-primary">Confirm Deletion</h3>
      <p id="modal-message-text" class="mt-2 text-sm text-text-secondary">
        Are you sure you want to delete this post?
      </p>

      <form id="modal-delete-form" action="/delete" method="POST" class="mt-6 flex justify-end gap-4">
        
        <input type="hidden" id="modal-blog-id" name="id" value="">
        <input type="hidden" id="modal-redirect-to" name="redirect_to" value="">

        <button id="modal-cancel-btn" type="button" class="rounded-lg cursor-pointer bg-card-dark px-4 py-2 text-sm font-medium text-text-primary transition-colors hover:bg-card-dark/80">
          Cancel
        </button>
        <button type="submit" class="rounded-lg cursor-pointer bg-brand px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-brand-hover">
          Delete
        </button>
      </form>
    </div>
  </div>
</body>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const buttons = [
        document.getElementById('sort-button')
      ];
      const menus = [
        document.getElementById('sort-menu')
      ];
      const allMenus = document.querySelectorAll('.dropdown-menu');

      const closeAllMenus = () => {
        allMenus.forEach(menu => {
          menu.classList.add('hidden');
        });
      };

      buttons.forEach((button, index) => {
        if (button) {
          button.addEventListener('click', (event) => {
            event.stopPropagation();
            const menu = menus[index];
            if (menu) {
              const isHidden = menu.classList.contains('hidden');
              closeAllMenus();
              if (isHidden) {
                menu.classList.remove('hidden');
              }
            }
          });
        }
      });

      window.addEventListener('click', (event) => {
          let clickedOutside = true;
          buttons.forEach(button => {
              if (button && button.contains(event.target)) clickedOutside = false;
          });
          menus.forEach(menu => {
              if (menu && menu.contains(event.target)) clickedOutside = false;
          });
          
          if (clickedOutside) {
              closeAllMenus();
          }
      });

      
      const deleteModal = document.getElementById('delete-modal');
      const modalCancelBtn = document.getElementById('modal-cancel-btn');
      const modalDeleteForm = document.getElementById('modal-delete-form');
      const modalBlogIdInput = document.getElementById('modal-blog-id');
      const modalRedirectInput = document.getElementById('modal-redirect-to');
      const modalMessageText = document.getElementById('modal-message-text');
      const allDeleteButtons = document.querySelectorAll('.open-delete-modal');

      if (deleteModal) {
        const openModal = (event) => {
          const button = event.currentTarget;
          const blogId = button.dataset.blogId;
          const redirectUrl = button.dataset.redirectTo;
          const message = button.dataset.message;

          modalBlogIdInput.value = blogId;
          modalRedirectInput.value = redirectUrl;
          modalMessageText.textContent = message;

          deleteModal.classList.remove('hidden');
        };

        const closeModal = () => {
          deleteModal.classList.add('hidden');
        };

        allDeleteButtons.forEach(button => {
          button.addEventListener('click', openModal);
        });

        modalCancelBtn.addEventListener('click', closeModal);

        deleteModal.addEventListener('click', (event) => {
          if (event.target === deleteModal) {
            closeModal();
          }
        });
      }
    });
  </script>
</body>

<?php view("partials/footer.php"); ?>