
<!-- if may footer -->
<!-- <footer class="mt-auto bg-overlay-dark/50 border-t border-card-dark backdrop-blur-sm text-text-secondary text-center py-6 fixed bottom-0 left-0 w-full z-40">
  <p class="text-sm text-text-primary">© <?= date('Y') ?> BPSU Bulletin — All rights reserved.</p>
</footer> -->

<script>
document.addEventListener('DOMContentLoaded', () => {

  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const mainContent = document.getElementById('main-content');

  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');

  const mobileSearchBtn = document.getElementById('mobileSearchBtn');
  const mobileSearchContainer = document.getElementById('mobileSearchContainer');
  const mobileSearchInput = document.getElementById('mobileSearchInput');
  const mobileSearchResults = document.getElementById('mobileSearchResults');

  // --- Sidebar logic ---
  sidebarToggle.addEventListener('change', () => {
    if (sidebarToggle.checked) {
      sidebar.classList.remove('-translate-x-full');
      overlay.classList.remove('hidden');
      if (window.innerWidth >= 1024) mainContent.style.marginLeft = '286px';
    } else {
      sidebar.classList.add('-translate-x-full');
      overlay.classList.add('hidden');
      mainContent.style.marginLeft = '0';
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth < 1024) mainContent.style.marginLeft = '0';
    else if (sidebarToggle.checked) mainContent.style.marginLeft = '256px';
  });

  // --- Desktop search ---
  searchInput?.addEventListener('input', () => {
    const query = searchInput.value.toLowerCase().trim();
    if (!query) {
      searchResults.classList.add('hidden');
      return;
    }

    const filtered = (window.posts || []).filter(p =>
      p.title.toLowerCase().includes(query) ||
      p.excerpt.toLowerCase().includes(query) ||
      p.author.toLowerCase().includes(query)
    );

    searchResults.innerHTML = filtered.length === 0
      ? `<div class='p-3 text-sm text-text-secondary'>No results found</div>`
      : filtered.map(p => `
        <a href="${p.link}" class="block px-4 py-2 hover:bg-card-dark text-text-primary rounded-md">
          <div class="font-medium">${p.title}</div>
          <div class="text-sm text-text-secondary ">${p.excerpt.length > 100 ? p.excerpt.slice(0,100)+'...' : p.excerpt}</div>
        </a>
      `).join('');

    searchResults.classList.remove('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!searchResults.contains(e.target) && e.target !== searchInput) {
      searchResults.classList.add('hidden');
    }
  });

  // --- Mobile search ---
  mobileSearchBtn?.addEventListener('click', (e) => {
    e.stopPropagation(); // prevent document click from closing immediately
    mobileSearchContainer.classList.toggle('hidden');
    if (!mobileSearchContainer.classList.contains('hidden')) {
      mobileSearchInput.focus();
    }
  });

  mobileSearchInput?.addEventListener('input', () => {
    const query = mobileSearchInput.value.toLowerCase().trim();
    if (!query) {
      mobileSearchResults.classList.add('hidden');
      return;
    }

    const filtered = (window.posts || []).filter(p =>
      p.title.toLowerCase().includes(query) ||
      p.excerpt.toLowerCase().includes(query) ||
      p.author.toLowerCase().includes(query)
    );

    mobileSearchResults.innerHTML = filtered.length === 0
      ? `<div class='p-3 text-sm text-text-secondary'>No results found</div>`
      : filtered.map(p => `
        <a href="${p.link}" class="block px-4 py-2 hover:bg-card-dark text-text-primary rounded-md">
          <div class="font-medium">${p.title}</div>
          <div class="text-sm text-text-secondary truncate">${p.excerpt.length > 200 ? p.excerpt.slice(0,200)+'...' : p.excerpt}</div>
        </a>
      `).join('');

    mobileSearchResults.classList.remove('hidden');
  });

  document.addEventListener('click', (e) => {
    if (!mobileSearchContainer.contains(e.target) && e.target !== mobileSearchBtn) {
      mobileSearchContainer.classList.add('hidden');
    }
  });

});
</script>


</body>
</html>
