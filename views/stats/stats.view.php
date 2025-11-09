<body class="bg-bg-dark min-h-screen">
  <div class="relative flex h-auto min-h-screen w-full flex-col overflow-x-hidden" style='font-family: Inter, "Noto Sans", sans-serif;'>
    <div class="layout-container flex h-full grow flex-col">
      <div class="px-4 sm:px-6 lg:px-40 flex flex-1 justify-center py-5">
        <div class="layout-content-container flex flex-col max-w-[1200px] flex-1 w-full">
          
          <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 p-4">
            <h1 class="text-text-primary text-2xl sm:text-[32px] font-bold leading-tight">Your Posts</h1>
          </div>

          <div class="px-4 py-3">
            <form action="/stats" method="GET">
              <label class="flex flex-col min-w-40 h-12 w-full">
                <div class="flex w-full flex-1 items-stretch rounded-lg h-full">
                  <button type="submit" class="text-text-secondary flex border-none bg-overlay-dark/50 bg-blur-sm items-center justify-center pl-4 rounded-l-lg hover:text-text-primary transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                      <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z"></path>
                    </svg>
                  </button>
                  <input
                    placeholder="Search posts by title"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-lg text-text-primary focus:outline-0 focus:ring-0 border-none bg-overlay-dark/50 bg-blur-sm focus:border-none h-full placeholder:text-text-secondary px-4 rounded-l-none pl-2 text-base font-normal leading-normal <?php if (!empty($search_term)): ?>rounded-r-none<?php endif; /* */ ?>"
                    name="search"
                    value="<?= htmlspecialchars($search_term ?? '') ?>"
                  />
                  
                  <?php if (!empty($search_term)): ?>
                    <a href="/stats" class="text-text-secondary flex border-none bg-overlay-dark/50 bg-blur-sm items-center justify-center pr-4 rounded-r-lg hover:text-text-primary transition-colors">
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
            <div class="flex flex-col lg:flex-row lg:justify-between  px-4 gap-4">
              <div class="flex gap-4 sm:gap-8 overflow-x-auto pb-2 lg:pb-0">
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-brand text-text-primary pb-[13px] pt-4 whitespace-nowrap" href="stats">
                  <p class="text-text-primary text-sm font-bold leading-normal tracking-[0.015em]">Published</p>
                </a>
                <a class="flex flex-col items-center justify-center border-b-[3px] border-b-transparent text-text-secondary hover:text-text-primary pb-[13px] pt-4 whitespace-nowrap transition-colors" href="drafts">
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
              </div>
            </div>
          </div>

          <h3 class="text-text-primary text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Statistics</h3>
          <div class="px-4 py-3">
              <div class="rounded-lg border border-card-dark bg-overlay-dark/50 p-4 sm:p-6">
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                      <div class="bg-card-dark/50 rounded-lg p-4">
                          <p class="text-sm font-medium text-text-secondary">Today's Views</p>
                          <p class="text-3xl font-bold text-text-primary"><?= $todays_views ?></p>
                      </div>
                      <div class="bg-card-dark/50 rounded-lg p-4">
                          <p class="text-sm font-medium text-text-secondary">Past 7 Days</p>
                          <p class="text-3xl font-bold text-text-primary"><?= $total_7_day_views ?></p>
                      </div>
                      <div class="bg-card-dark/50 rounded-lg p-4">
                          <p class="text-sm font-medium text-text-secondary">Past 30 Days</p>
                          <p class="text-3xl font-bold text-text-primary"><?= $total_30_day_views ?></p>
                      </div>
                </div>

                <div class="flex justify-end gap-2 mb-4">
                      <div class="relative">
                          <button id="chart-range-button" class="flex h-8 cursor-pointer shrink-0 items-center justify-center gap-x-2 rounded-lg bg-card-dark hover:bg-card-dark/80 pl-4 pr-2 transition-colors">
                            <p id="chart-range-text" class="text-text-primary text-sm font-medium leading-normal whitespace-nowrap">Last 30 Days</p>
                            <div class="text-text-primary">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z"></path>
                              </svg>
                            </div>
                          </button>
                          <div id="chart-range-menu" class="absolute z-10 top-full right-0 mt-2 w-48 rounded-lg bg-overlay-dark border border-card-dark shadow-lg overflow-hidden hidden dropdown-menu">
                            <ul class="py-2">
                              <li><a href="#" class="chart-range-item block px-4 py-2 text-text-secondary hover:bg-card-dark hover:text-text-primary rounded-md text-sm mx-2" data-range="24h">Last 24 hours</a></li>
                              <li><a href="#" class="chart-range-item block px-4 py-2 text-text-secondary hover:bg-card-dark hover:text-text-primary rounded-md text-sm mx-2" data-range="7d">Last 7 days</a></li>
                              <li><a href="#" class="chart-range-item block px-4 py-2 text-text-secondary hover:bg-card-dark hover:text-text-primary rounded-md text-sm mx-2" data-range="30d">Last 30 days</a></li>
                            </ul>
                          </div>
                      </div>
                </div>
                
                <div class="relative h-64 sm:h-80">
                      <canvas id="viewsChart"></canvas>
                </div>
              </div>
          </div>

          <h3 class="text-text-primary text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Published</h3>
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
                  
                  <?php if (empty($published_blogs)): ?>
                    <tr class="border-t border-card-dark">
                      <td colspan="5" class="px-4 py-4 text-center text-text-secondary text-sm font-normal leading-normal">
                        <?php if (!empty($search_term)): ?>
                          No published posts found matching "<?= htmlspecialchars($search_term) ?>".
                        <?php else: ?>
                          No published posts found.
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php else: ?>
                    <?php foreach ($published_blogs as $blog): ?>
                      <tr class="border-t border-card-dark hover:bg-card-dark/30 transition-colors">
                        
                        <td class="px-4 py-4 text-text-primary text-sm font-normal leading-normal">
                          <?= htmlspecialchars($blog['title']) ?>
                        </td>
                        
                        <td class="px-4 py-4 text-sm font-normal leading-normal">
                          <span class="inline-flex items-center justify-center rounded-lg px-3 py-1 bg-accent-green/20 text-accent-green text-xs font-medium whitespace-nowrap">
                            Published 
                          </span>
                        </td>
                         <td class="px-4 py-4 text-text-secondary text-sm font-normal leading-normal">
                          <?= $blog['views_count'] ?? 0 ?>
                        </td>
                        
                        <td class="px-4 py-4 text-text-secondary text-sm font-normal leading-normal hidden sm:table-cell">
                          <?= $blog['comments_count'] ?? 0 ?>
                        </td>
                        
                        <td class="px-4 py-4 text-text-secondary text-sm font-bold leading-normal tracking-[0.015em] hidden md:table-cell">
                          <a href="/blog/editor?blog_id=<?= $blog['id'] ?>" class="text-brand hover:text-brand-hover cursor-pointer transition-colors">Edit</a> | 
                          
                          <form action="/archive" method="POST" style="display: inline;">
                              <input type="hidden" name="id" value="<?= $blog['id'] ?>">
                              <button type="submit" class="text-accent-blue hover:text-accent-navy cursor-pointer transition-colors bg-transparent border-none p-0 font-bold leading-normal">Archive</button>
                          </form> |

                          <button type="button" 
                                class="open-delete-modal text-text-secondary hover:text-text-primary cursor-pointer transition-colors bg-transparent border-none p-0 font-bold leading-normal"
                                data-blog-id="<?= $blog['id'] ?>"
                                data-redirect-to="/stats"
                                data-message="Are you sure you want to delete this post? This action is permanent.">
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
          
          <button type="submit" class="rounded-lg bg-brand cursor-pointer px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-brand-hover">
            Delete
          </button>
        </form>
      </div>
    </div>

        </div>
      </div>
    </div>
  </div>
</body>

    
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const buttons = [
        document.getElementById('categories-button'),
        document.getElementById('tags-button'),
        document.getElementById('date-button'),
        document.getElementById('chart-range-button') // Added chart button
      ];
      const menus = [
        document.getElementById('categories-menu'),
        document.getElementById('tags-menu'),
        document.getElementById('date-menu'),
        document.getElementById('chart-range-menu') // Added chart menu
      ];
      const allMenus = document.querySelectorAll('.dropdown-menu');

      const closeAllMenus = () => {
        allMenus.forEach(menu => menu.classList.add('hidden'));
      };

      buttons.forEach((button, index) => {
        if (button) {
          button.addEventListener('click', (event) => {
            event.stopPropagation();
            const menu = menus[index];
            if (menu) {
              const isHidden = menu.classList.contains('hidden');
              closeAllMenus(); // Close all *other* menus
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
      const ctx = document.getElementById('viewsChart');
      if (ctx) {
          // Get ALL datasets from PHP
          const dailyLabels = <?= $daily_chart_labels_json ?>;
          const dailyData = <?= $daily_chart_data_json ?>;
          const hourlyLabels = <?= $hourly_chart_labels_json ?>;
          const hourlyData = <?= $hourly_chart_data_json ?>;
          
          // Get new chart dropdown elements
          const chartRangeItems = document.querySelectorAll('.chart-range-item');
          const chartRangeText = document.getElementById('chart-range-text');

          const chartConfig = {
              type: 'line',
              data: {
                  // Default to 30 days
                  labels: dailyLabels.slice(-30), 
                  datasets: [{
                      label: 'Views',
                      data: dailyData.slice(-30),
                      fill: true,
                      backgroundColor: 'rgba(192, 0, 0, 0.2)',
                      borderColor: '#c00000',
                      tension: 0.3,
                      pointBackgroundColor: '#c00000',
                      pointBorderColor: '#fff',
                      pointHoverRadius: 6,
                      pointHoverBackgroundColor: '#fff',
                      pointHoverBorderColor: '#c00000'
                  }]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  plugins: {
                      legend: {
                          display: false // Hide legend
                      },
                      tooltip: {
                          backgroundColor: '#1a1a1a',
                          titleColor: '#ffffff',
                          bodyColor: '#a3a3a3',
                          borderColor: '#3a3a3a',
                          borderWidth: 1,
                          intersect: false,
                          mode: 'index',
                      }
                  },
                  scales: {
                      y: {
                          beginAtZero: true,
                          grid: {
                              color: '#2e2e2e' // Dark grid lines
                          },
                          ticks: {
                              color: '#a3a3a3',
                              precision: 0 // Ensure whole numbers for view counts
                          }
                      },
                      x: {
                          grid: {
                              display: false
                          },
                          ticks: {
                              color: '#a3a3a3'
                          }
                      }
                  }
              }
          };

          const myChart = new Chart(ctx, chartConfig);

          chartRangeItems.forEach(item => {
              item.addEventListener('click', (event) => {
                  event.preventDefault();
                  const range = item.dataset.range;
                  const text = item.textContent;

                  if (range === '24h') {
                      myChart.data.labels = hourlyLabels;
                      myChart.data.datasets[0].data = hourlyData;
                  } else if (range === '7d') {
                      myChart.data.labels = dailyLabels.slice(-7);
                      myChart.data.datasets[0].data = dailyData.slice(-7);
                  } else { // '30d'
                      myChart.data.labels = dailyLabels.slice(-30);
                      myChart.data.datasets[0].data = dailyData.slice(-30);
                  }
                  
                  myChart.update();

                  chartRangeText.textContent = text;
                  document.getElementById('chart-range-menu').classList.add('hidden');
              });
          });
      }
    });
  </script>

</body>

<?php view("partials/footer.php"); ?>