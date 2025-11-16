
<script>
  let website_url = "<?= getConfig()["website_url"] ?>"
document.addEventListener('DOMContentLoaded', () => {

  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');
  const overlay = document.getElementById('sidebar-overlay');
  const mainContent = document.getElementById('main-content');

  const searchInput = document.getElementById('searchInput');
  const searchResults = document.getElementById('searchResults');
  const currentPath = window.location.pathname;
  const mobileSearchBtn = document.getElementById('mobileSearchBtn');
  const mobileSearchContainer = document.getElementById('mobileSearchContainer');
  const mobileSearchInput = document.getElementById('mobileSearchInput');
  const mobileSearchResults = document.getElementById('mobileSearchResults');

  let timeout = null; // for searching query. to make sure that we only fetch for blogs and accounts in the database when the user stops typing for x amount of seconds

  // --- Profile dropdown logic ---
  const profileButton = document.getElementById('profileButton');
  const profileDropdown = document.getElementById('profileDropdown');

  if (profileButton && profileDropdown) {
    profileButton.addEventListener('click', (event) => {
      event.stopPropagation();
      const isOpen = profileDropdown.classList.toggle('hidden');
      // Toggle border highlight
      const isActive = !isOpen;
      profileButton.dataset.active = isActive ? "true" : "false";
    });

    // Close when clicking outside
    window.addEventListener('click', (event) => {
      if (
        !profileDropdown.classList.contains('hidden') &&
        !profileDropdown.contains(event.target) &&
        event.target !== profileButton
      ) {
        profileDropdown.classList.add('hidden');
        profileButton.dataset.active = "false";
      }
    });
  }

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
  searchInput.addEventListener("input", (e) => {
    clearTimeout(timeout);
    const query = e.target.value.trim();

    timeout = setTimeout(() => {
      if (query.length >= 2) {
        fetch(website_url + `/search?query=${encodeURIComponent(query)}`, {headers: { "X-Search-Source": "dropdown" }})
          .then((res) => res.json())
          .then((data) => renderSearchResults(data))
          .catch((err) => console.error("Search error:", err));
      } else {
        searchResults.classList.add("hidden");
        searchResults.innerHTML = "";
      }
    }, 400);
  });

    // --- Redirect on Submit or Enter ---
  searchInput?.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      const query = searchInput.value.trim();
      if (query) {
        window.location.href = `/search?query=${encodeURIComponent(query)}`;
      }
    }
  });

  function renderSearchResults(data) {
    // No results
    if ((!data.blogs || data.blogs.length === 0) && (!data.users || data.users.length === 0)) {
      searchResults.classList.remove("hidden");
      searchResults.innerHTML = `
        <div class="p-4 text-sm text-[var(--color-text-secondary)] text-center">
          No results found.
        </div>
      `;
      return;
    }

    // --- USERS SECTION ---
    let usersHTML = "";
    if (data.users?.length > 0) {
      const userItems = data.users
        .map(
          (u) => `
          <a href="/account?id=${u.id}" 
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-[var(--color-card-light)] dark:hover:bg-[var(--color-card-dark)] transition">
            <img src="${u.secure_url}" alt="${u.username}" 
                class="w-10 h-10 rounded-full object-cover border border-[var(--color-card-light)] dark:border-[var(--color-card-dark)]" />
            <div>
              <div class="font-semibold text-[var(--color-text-primary)]">${u.username}</div>
              <div class="text-sm text-[var(--color-text-secondary)]">${u.email}</div>
            </div>
          </a>
        `
        )
        .join("");

      usersHTML = `
        <div class="border-b border-[var(--color-card-light)] dark:border-[var(--color-card-dark)] mb-2">
          <h3 class="px-3 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-[var(--color-brand)]">
            Users
          </h3>
          ${userItems}
        </div>
      `;
    }

    // --- BLOGS SECTION ---
    let blogsHTML = "";
    if (data.blogs?.length > 0) {
      const blogItems = data.blogs
        .map(
          (b) => `
          <a href="/blog?id=${b.id}" 
            class="block p-3 rounded-lg hover:bg-[var(--color-card-light)] dark:hover:bg-[var(--color-card-dark)] transition">
            <div class="font-semibold text-[var(--color-text-primary)]">${b.title}</div>
            <div class="text-sm text-[var(--color-text-secondary)]">by ${b.author_name}</div>
            <div class="text-xs text-[var(--color-text-gray)] mt-1">
              Categories: ${b.categories || "—"}
            </div>
          </a>
        `
        )
        .join("");

      blogsHTML = `
        <div>
          <h3 class="px-3 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-[var(--color-brand)]">
            Blogs
          </h3>
          ${blogItems}
        </div>
      `;
    }

    // --- RENDER RESULTS ---
    searchResults.classList.remove("hidden");
    searchResults.innerHTML = `
      <div class="rounded-xl shadow-lg max-h-96 overflow-y-auto divide-y divide-[var(--color-card-light)] dark:divide-[var(--color-card-dark)]
                  border border-[var(--color-card-light)] dark:border-[var(--color-card-dark)]
                  bg-[var(--color-bg-light)] dark:bg-[var(--color-bg-dark)]">
        ${usersHTML}
        ${blogsHTML}
      </div>
    `;
  }

  document.addEventListener('click', (e) => {
    if (!searchResults.contains(e.target) && e.target !== searchInput) {
      searchResults.classList.add('hidden');
    }
  });

  // --- Mobile Search Logic ---
  mobileSearchBtn?.addEventListener("click", (e) => {
    e.stopPropagation();
    mobileSearchContainer.classList.toggle("hidden");

    if (!mobileSearchContainer.classList.contains("hidden")) {
      mobileSearchInput.focus();
    } else {
      mobileSearchResults.classList.add("hidden");
      mobileSearchResults.innerHTML = "";
    }
  });

  let mobileTimeout = null;

  mobileSearchInput?.addEventListener("input", () => {
    clearTimeout(mobileTimeout);
    const query = mobileSearchInput.value.trim();

    mobileTimeout = setTimeout(() => {
      if (query.length < 2) {
        mobileSearchResults.classList.add("hidden");
        mobileSearchResults.innerHTML = "";
        return;
      }

      // Fetch results from backend
      fetch(website_url + `/search?query=${encodeURIComponent(query)}`, {headers: { "X-Search-Source": "dropdown" }})
        .then((res) => res.json())
        .then((data) => renderMobileSearchResults(data))
        .catch((err) => console.error("Mobile search error:", err));
    }, 400);
  });

  // --- Redirect on Submit or Enter ---
  mobileSearchInput?.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      const query = mobileSearchInput.value.trim();
      if (query) {
        window.location.href = `/search?query=${encodeURIComponent(query)}`;
      }
    }
  });

  function renderMobileSearchResults(data) {
    if ((!data.blogs || data.blogs.length === 0) && (!data.users || data.users.length === 0)) {
      mobileSearchResults.classList.remove("hidden");
      mobileSearchResults.innerHTML = `
        <div class="p-3 text-sm text-[var(--color-text-secondary)] text-center">
          No results found
        </div>
      `;
      return;
    }

    // --- USERS ---
    let usersHTML = "";
    if (data.users?.length > 0) {
      const userItems = data.users
        .map(
          (u) => `
          <a href="/profile/${u.id}" 
            class="flex items-center gap-3 p-3 rounded-lg hover:bg-[var(--color-card-light)] dark:hover:bg-[var(--color-card-dark)] transition">
            <img src="${u.secure_url}" alt="${u.username}" 
                class="w-10 h-10 rounded-full object-cover border border-[var(--color-card-light)] dark:border-[var(--color-card-dark)]" />
            <div>
              <div class="font-semibold text-[var(--color-text-primary)]">${u.username}</div>
              <div class="text-sm text-[var(--color-text-secondary)]">${u.email}</div>
            </div>
          </a>
        `
        )
        .join("");

      usersHTML = `
        <div class="border-b border-[var(--color-card-light)] dark:border-[var(--color-card-dark)] mb-2">
          <h3 class="px-3 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-[var(--color-brand)]">
            Users
          </h3>
          ${userItems}
        </div>
      `;
    }

    // --- BLOGS ---
    let blogsHTML = "";
    if (data.blogs?.length > 0) {
      const blogItems = data.blogs
        .map(
          (b) => `
          <a href="/blog/${b.id}" 
            class="block p-3 rounded-lg hover:bg-[var(--color-card-light)] dark:hover:bg-[var(--color-card-dark)] transition">
            <div class="font-semibold text-[var(--color-text-primary)]">${b.title}</div>
            <div class="text-sm text-[var(--color-text-secondary)]">by ${b.author_name}</div>
            <div class="text-xs text-[var(--color-text-gray)] mt-1">
              Categories: ${b.categories || "—"}
            </div>
          </a>
        `
        )
        .join("");

      blogsHTML = `
        <div>
          <h3 class="px-3 pt-3 pb-1 text-xs font-semibold uppercase tracking-wider text-[var(--color-brand)]">
            Blogs
          </h3>
          ${blogItems}
        </div>
      `;
    }

    // --- RENDER ---
    mobileSearchResults.classList.remove("hidden");
    mobileSearchResults.innerHTML = `
      <div class="rounded-xl shadow-lg max-h-[70vh] overflow-y-auto divide-y divide-[var(--color-card-light)] dark:divide-[var(--color-card-dark)]
                  border border-[var(--color-card-light)] dark:border-[var(--color-card-dark)]
                  bg-[var(--color-bg-light)] dark:bg-[var(--color-bg-dark)]">
        ${usersHTML}
        ${blogsHTML}
      </div>
    `;
  }



  // --- Navigation active link ---
  document.querySelectorAll(".nav-link").forEach(link => {
    if (link.getAttribute("href") === currentPath) {
      link.classList.add("bg-brand", "text-white");
    } else {
      link.classList.add("hover:bg-card-dark", "text-text-secondary");
    }
  });

});

// --- Notification Dropdown Logic --- //
const notifButton = document.getElementById('notifButton');
const notifDropdown = document.getElementById('notifDropdown');
const markAllBtn = document.getElementById('markAllRead');

// Dropdown toggle (only if it exists)
if (notifButton && notifDropdown) {
  notifButton.addEventListener('click', (e) => {
    e.stopPropagation();
    notifDropdown.classList.toggle('hidden');
  });

  // Close when clicking outside
  window.addEventListener('click', (e) => {
    if (!notifButton.contains(e.target) && !notifDropdown.contains(e.target)) {
      notifDropdown.classList.add('hidden');
    }
  });
}

// --- Mark as Read --- //
function markAsRead(button) {
  const item = button.closest('.group');
  if (!item) return;

  item.classList.add('opacity-50');
  button.remove();

  const id = button.dataset.notificationId;
  if (id) marked(id);

  // Hide red dot if all notifications are read
  hideDotIfAllRead();
}

// --- Mark All as Read --- //
if (markAllBtn) {
  markAllBtn.addEventListener('click', () => {
    document.querySelectorAll('.group').forEach(item => {
      item.classList.add('opacity-50');
      const btn = item.querySelector('button[data-notification-id]');
      if (btn) {
        marked(btn.dataset.notificationId);
        btn.remove();
      }
    });
    hideDotIfAllRead();
  });
}

// --- Update Database (AJAX PATCH) --- //
async function marked(id) {
  try {
    const formdata = new FormData();
    formdata.append('_method', 'PATCH');
    formdata.append('id', id);

    const res = await fetch('/notification/marked', {
      method: 'POST',
      body: formdata,
    });

    await res.json();
  } catch (err) {
    console.error('Failed to mark notification:', err);
  }
}

// --- Helper: Hide Red Dot if All Read --- //
function hideDotIfAllRead() {
  const unreadExists = document.querySelector('.group button[data-notification-id]');
  const notifDot = document.getElementById('notifDot');

  if (!unreadExists && notifDot) {
    notifDot.classList.add('hidden');
  }
}
</script>

</body>
</html>