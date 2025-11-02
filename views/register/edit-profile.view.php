<main class="min-h-screen flex items-center justify-center bg-[var(--color-bg)] p-4 sm:p-6 lg:p-8">
  <div class="w-full max-w-lg bg-overlay-dark/50 border border-card-dark rounded-3xl shadow-xl p-6 sm:p-8 lg:p-10 space-y-8 backdrop-blur-lg transform transition-all duration-300 ease-in-out scale-100">
    <h1 class="text-center text-3xl font-extrabold text-[var(--color-text-primary)] tracking-tight">
      Complete Your Profile
    </h1>
    <p class="text-center text-[var(--color-text-secondary)] text-sm sm:text-base -mt-4">
      Let's get you officially connected, <span class="text-brand font-bold">Ka-Treyd!</span>
    </p>

    <form id="profileForm" action="/edit-profile" method="POST" enctype="multipart/form-data" class="space-y-6">
      
      <div class="flex flex-col items-center space-y-4">
        <div class="relative w-40 h-40 group cursor-pointer" onclick="document.getElementById('profileInput').click()">
          
          <input id="profileInput" name="profile_image" type="file" accept="image/*" class="hidden" />

          <div class="w-full h-full rounded-full bg-[var(--color-card-dark)] flex items-center justify-center overflow-hidden border-4 border-[var(--color-card-dark)] group-hover:border-[var(--color-brand)] transition-all duration-300 relative">
            
            <span id="profileIcon" class="material-symbols-outlined text-7xl text-[var(--color-text-secondary)] transition-opacity duration-300 ease-in-out">
              person
            </span>
            
            <img id="profilePreview" src="" alt="Profile Preview" class="absolute inset-0 w-full h-full object-cover rounded-full opacity-0 transition-opacity duration-300 ease-in-out" />
          </div>
          
          <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-full">
            <span class="material-symbols-outlined text-white text-3xl">edit</span>
          </div>

        </div>
      </div>

      <div>
        <label for="username" class="block text-sm font-medium text-[var(--color-text-secondary)] mb-1">Username</label>
        <input type="text" id="username" name="username"
               placeholder="e.g., Juan Dela Cruz"
               class="w-full px-4 py-3 rounded-xl bg-[var(--color-card-dark)] border border-[var(--color-card-dark)] text-[var(--color-text-primary)] placeholder-[var(--color-text-secondary)] focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)] focus:border-transparent transition-all duration-200">
      </div>

      <div>
  <label for="campus" class="block text-sm font-medium text-[var(--color-text-secondary)] mb-1.5">Campus</label>
  <div class="relative">
    <select id="campus-select" name="campus" required
            class="peer w-full px-4 py-3 rounded-xl 
                   bg-[var(--color-card-dark)] 
                   border border-white/10 
                   text-[var(--color-text-primary)] 
                   
                   invalid:text-[var(--color-text-secondary)] 
                   
                   focus:outline-none focus:ring-2 focus:ring-[var(--color-brand)] focus:border-[var(--color-brand)] 
                   
                   transition-all duration-200 
                   appearance-none pr-10">
                   
      <option value="" selected disabled class="text-[var(--color-text-secondary)]">Select your Campus</option>
      <option value="MAIN" class="bg-[var(--color-card-dark)] text-[var(--color-text-primary)]">Main Campus</option>
      <option value="BALANGA" class="bg-[var(--color-card-dark)] text-[var(--color-text-primary)]">Balanga Campus</option>
      <option value="ORANI" class="bg-[var(--color-card-dark)] text-[var(--color-text-primary)]">Orani Campus</option>
      <option value="ABUCAY" class="bg-[var(--color-card-dark)] text-[var(--color-text-primary)]">Abucay Campus</option>
      <option value="DINALUPIHAN" class="bg-[var(--color-card-dark)] text-[var(--color-text-primary)]">Dinalupihan Campus</option>
    </select>
    
    <span id="campus-icon" 
          class="material-symbols-outlined 
                 absolute right-3 top-1/2 -translate-y-1/2 
                 text-[var(--color-text-secondary)] 
                 peer-focus:text-[var(--color-brand)] pointer-events-none 
                 transform transition-all duration-200">
      expand_more
    </span>
  </div>
</div>

      <div class="flex justify-between items-center pt-4">
        <button type="button" onclick="window.location.href='/register'"
                class="flex items-center cursor-pointer gap-2 px-5 py-2 bg-[var(--color-overlay-dark)] border border-[var(--color-card-dark)] rounded-xl hover:bg-[var(--color-card-light)] text-[var(--color-text-primary)] font-medium transition-all duration-200">
          <span class="material-symbols-outlined text-lg">arrow_back</span>
          Back
        </button>

        <button id="nextBtn" type="submit" disabled
                class="flex items-center cursor-pointer gap-2 px-6 py-2 bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300 disabled:opacity-50 disabled:bg-gray-600">
          Finish
          <span class="material-symbols-outlined text-lg cursor-pointer">check</span>
        </button>
      </div>
    </form>
  </div>
</main>

<script>
  const username = document.getElementById("username");
  const campus = document.getElementById("campus-select"); // <-- THE FIX IS HERE
  const profileInput = document.getElementById("profileInput");
  const profilePreview = document.getElementById("profilePreview");
  const profileIcon = document.getElementById("profileIcon"); 
  const nextBtn = document.getElementById("nextBtn");
  

  document.addEventListener('DOMContentLoaded', () => {
    const campusSelect = document.getElementById('campus-select');
    const campusIcon = document.getElementById('campus-icon');

    if (campusSelect && campusIcon) {
      // When you press down, you are opening it.
      campusSelect.addEventListener('mousedown', (e) => {
        // We only rotate up if it's not already rotated
        if (!campusIcon.classList.contains('rotate-180')) {
          campusIcon.classList.add('rotate-180');
        }
      });

      // 'blur' fires when you click away OR select an option.
      // This is the "close" event.
      campusSelect.addEventListener('blur', (e) => {
        campusIcon.classList.remove('rotate-180');
      });
      
      // 'change' also fires when you select an option.
      // We add this as a fallback for some browsers.
      campusSelect.addEventListener('change', (e) => {
        campusIcon.classList.remove('rotate-180');
      });
    }
  });

  function validateForm() {
    const isProfileImageSelected = profilePreview.dataset.filled === "true" || profilePreview.src.length > 0;
    // Make sure campus is not null before checking its value
    const campusValue = campus ? campus.value : "";
    const allFilled = username.value.trim() !== "" && campusValue !== "" && isProfileImageSelected;
    
    nextBtn.disabled = !allFilled;

    nextBtn.className = allFilled
      ? "flex items-center gap-2 px-6 py-2 bg-[var(--color-brand)] hover:bg-[var(--color-brand-hover)] text-white rounded-xl font-semibold transition-all duration-300"
      : "flex items-center gap-2 px-6 py-2 bg-gray-600 text-white rounded-xl font-semibold transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-600";
  }

  // Check if username and campus were found before adding listeners
  if (username) {
    username.addEventListener("input", validateForm);
  }
  if (campus) {
    campus.addEventListener("input", validateForm);
  }

  if (profileInput) {
    profileInput.addEventListener("change", (e) => {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = () => {
          profilePreview.src = reader.result;
          profilePreview.classList.remove("opacity-0");
          profileIcon.classList.add("opacity-0");
          profilePreview.dataset.filled = "true";
          validateForm();
        };
        reader.readAsDataURL(file);
      } else {
          profilePreview.src = "";
          profilePreview.classList.add("opacity-0");
          profileIcon.classList.remove("opacity-0");
          profilePreview.dataset.filled = "false";
          validateForm();
      }
    });
  }

  if (profilePreview.src && profilePreview.src !== window.location.href) {
      profilePreview.classList.remove("opacity-0");
      profileIcon.classList.add("opacity-0");
      profilePreview.dataset.filled = "true";
  } else {
      profilePreview.classList.add("opacity-0");
      profileIcon.classList.remove("opacity-0");
      profilePreview.dataset.filled = "false";
  }
  
  validateForm();
</script>