<main class="min-h-screen flex justify-center items-center bg-[var(--color-bg)] px-4">
  <div class="w-full max-w-md bg-overlay-dark/50 border border-card-dark rounded-2xl shadow-2xl p-8 space-y-8 backdrop-blur-lg transition-all">
    <h1 class="text-center text-2xl font-bold text-[var(--color-text-primary)]">Profile Setup</h1>

    <form id="profileForm" action="/edit-profile" method="POST" enctype="multipart/form-data" class="space-y-6">
      
      <div class="flex flex-col items-center space-y-3">
        <div class="relative w-40 h-40 group">
          
          <input id="profileInput" name="profile_image" type="file" accept="image/*" class="hidden" />

          <div class="w-full h-full rounded-full bg-[var(--color-card-dark)] flex items-center justify-center overflow-hidden border border-[var(--color-card-dark)]">
            <span id="profileIcon" class="material-symbols-outlined text-6xl text-[var(--color-text-secondary)]">
              person
            </span>
            <img id="profilePreview" src="" alt="Profile Preview" class="hidden w-full h-full object-cover" />
          </div>
          
          <button onclick="document.getElementById('profileInput').click()"
                  type="button"
                  class="cursor-pointer absolute bottom-2 right-2 bg-[var(--color-brand)] hover:bg-[var(--color-brand-hover)] text-white rounded-full px-2 py-1 text-xs flex items-center gap-1 shadow-md">
            <span class="material-symbols-outlined text-sm">edit</span>
            Edit
          </button>
        </div>
      </div>

      <div>
        <label for="username" class="block text-sm font-medium text-[var(--color-text-secondary)]">Username</label>
        <input type="text" id="username" name="username"
               placeholder="Juan Dela Cruz"
               class="w-full mt-1 px-4 py-3 rounded-lg bg-[var(--color-card-dark)] border-0 text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)] transition-all">
      </div>

      <div>
        <label for="campus" class="block text-sm font-medium text-[var(--color-text-secondary)]">Campus</label>
        <div class="relative mt-1">
          <select id="campus" name="campus"
                  class="peer w-full px-4 py-3 rounded-lg bg-[var(--color-card-dark)] border-0 text-[var(--color-text-primary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)] transition-all duration-300 ease-in-out appearance-none pr-10">
            <option value="" selected disabled>Select your Campus</option>
            <option value="MAIN">Main Campus</option>
            <option value="BALANGA">Balanga Campus</option>
            <option value="ORANI">Orani Campus</option>
            <option value="ABUCAY">Abucay Campus</option>
            <option value="DINALUPIHAN">Dinalupihan Campus</option>
          </select>
          <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[var(--color-text-secondary)] pointer-events-none">
            expand_more
          </span>
        </div>
      </div>

      <div class="flex justify-between items-center pt-4">
        <button type="button" onclick="window.location.href='/register'"
                class="cursor-pointer flex items-center gap-2 px-5 py-2 bg-[var(--color-overlay-dark)] border border-[var(--color-card-dark)] rounded-lg hover:bg-[var(--color-card-light)] text-[var(--color-text-primary)] font-medium transition-all">
          <span class="material-symbols-outlined">arrow_back</span>
          Back
        </button>

        <button id="nextBtn" type="submit" disabled
                class="cursor-not-allowed flex items-center gap-2 px-5 py-2 bg-gray-500 text-white rounded-lg font-medium transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
          Finish
          <span class="material-symbols-outlined">check</span>
        </button>
      </div>
    </form> </div>
</main>

<script>
  const username = document.getElementById("username");
  const campus = document.getElementById("campus");
  const profileInput = document.getElementById("profileInput");
  const profilePreview = document.getElementById("profilePreview");
  const profileIcon = document.getElementById("profileIcon"); // Get the icon
  const nextBtn = document.getElementById("nextBtn");

  function validateForm() {
    const allFilled = username.value.trim() !== "" && campus.value !== "" && profilePreview.dataset.filled === "true";
    nextBtn.disabled = !allFilled;
    nextBtn.className = allFilled
      ? "cursor-pointer flex items-center gap-2 px-5 py-2 bg-[var(--color-brand)] hover:bg-[var(--color-brand-hover)] text-white rounded-lg font-medium transition-all"
      : "cursor-not-allowed flex items-center gap-2 px-5 py-2 bg-gray-500 text-white rounded-lg font-medium transition-all disabled:opacity-50 disabled:cursor-not-allowed";
  }

  [username, campus].forEach(el => el.addEventListener("input", validateForm));

  profileInput.addEventListener("change", (e) => {
    const file = e.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = () => {
        profilePreview.src = reader.result;
        profilePreview.classList.remove("hidden"); // Show the image
        profileIcon.classList.add("hidden");     // Hide the icon
        profilePreview.dataset.filled = "true";
        validateForm();
      };
      reader.readAsDataURL(file);
    }
  });

  // This line now works because profilePreview exists
  profilePreview.dataset.filled = "false";
  
  // Initial check in case of browser autofill
  validateForm();
</script>