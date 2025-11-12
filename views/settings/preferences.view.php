<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <a
    href="/settings"
    class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group"
  >
    <span
      class="material-symbols-outlined transition-transform group-hover:-translate-x-1"
      >arrow_back</span
    >
    Back
  </a>

  <h1 class="text-3xl font-bold text-text-primary mb-2">Preferences</h1>
  <p class="text-text-secondary mb-10">
    Set your preferences for announcements, alerts, and updates.
  </p>

  <h1 class="text-xl font-bold text-text-primary mb-2">Alerts & Updates</h1>

  <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
    <div class="flex justify-between items-center p-4">
      <div>
        <p class="text-text-primary font-medium">New Announcement</p>
        <p class="text-text-secondary text-sm">
          Receive an email when a new official announcement is posted
        </p>
      </div>
      <label class="relative inline-flex items-center cursor-pointer">
        <input 
          type="checkbox" 
          name="email_notification" 
          class="sr-only peer preference-toggle" 
          <?= $preferences['email_notification'] ? 'checked' : '' ?> 
        />
        <div
          class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
        ></div>
      </label>
    </div>
      <div class="border-t border-card-dark flex justify-between items-center p-4">
    <div>
      <p class="text-text-primary font-medium">Push Notifications</p>
      <p class="text-text-secondary text-sm">
        Enable in-app notifications for posts, comments, and follows.
      </p>
    </div>
    <label class="relative inline-flex items-center cursor-pointer">
      <input 
        type="checkbox" 
        name="push_notification" 
        class="sr-only peer preference-toggle" 
        <?= $preferences['push_notification'] ? 'checked' : '' ?> 
      />
      <div
        class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
      ></div>
    </label>
  </div>
  
  </div>

  <section class="mt-8">
    <h2 class="text-xl font-semibold text-text-primary mb-4">
      Activity Notifications
    </h2>
    <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
      <div class="flex justify-between items-center p-4">
        <div>
          <p class="text-text-primary font-medium">Follow Alerts</p>
          <p class="text-text-secondary text-sm">
            Get notified when someone starts following you.
          </p>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
          <input 
            type="checkbox" 
            name="follow_notification" 
            class="sr-only peer preference-toggle" 
            <?= $preferences['follow_notification'] ? 'checked' : '' ?> 
          />
          <div
            class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
          ></div>
        </label>
      </div>

      <div class="border-t border-card-dark flex justify-between items-center p-4">
        <div>
          <p class="text-text-primary font-medium">Reactions & Comments</p>
          <p class="text-text-secondary text-sm">
            Be notified when someone comments on or reacts to your post.
          </p>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
          <input 
            type="checkbox" 
            name="reaction_notification" 
            class="sr-only peer preference-toggle" 
            <?= $preferences['reaction_notification'] ? 'checked' : '' ?> 
          />
          <div
            class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
          ></div>
        </label>
      </div>
    </div>
  </section>

  <section class="mt-8">
    <h2 class="text-xl font-semibold text-text-primary mb-4">
     Profile & Personal Info
    </h2>
    <div class="bg-overlay-dark/50 border border-card-dark rounded-lg">
      <div class="flex justify-between items-center p-4">
        <div>
          <p class="text-text-primary font-medium">Display Email</p>
          <p class="text-text-secondary text-sm">
           Turn this on to let other users see your email address on the Bulletin.
          </p>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
          <input 
            type="checkbox" 
            name="show_email_public" 
            class="sr-only peer preference-toggle" 
            <?= $preferences['show_email_public'] ? 'checked' : '' ?> 
          />
          <div
            class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
          ></div>
        </label>
      </div>

      <div class="border-t border-card-dark flex justify-between items-center p-4">
        <div>
          <p class="text-text-primary font-medium">Lock Your Profile</p>
          <p class="text-text-secondary text-sm">
            Make your profile visible only to your followers.
          </p>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
          <input 
            type="checkbox" 
            name="show_profile_public" 
            class="sr-only peer preference-toggle" 
            <?= $preferences['show_profile_public'] ? 'checked' : '' ?> 
          />
          <div
            class="w-11 h-6 bg-card-dark rounded-full peer peer-focus:ring-2 peer-focus:ring-brand-hover peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-brand"
          ></div>
        </label>
      </div>
    </div>
  </section>

  <section class="mt-8">
    <h2 class="text-xl font-semibold text-text-primary mb-2">Theme</h2>
    <p class="text-text-secondary mb-4">
      Customize your Bulletin appearance by choosing between light, dark, or
      system themes.
    </p>
    <div
      class="bg-overlay-dark/50 border border-card-dark rounded-lg p-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4"
    >
      <div>
        <p class="text-text-primary font-medium">Theme Mode</p>
        <p class="text-text-secondary text-sm">
          Choose how the Bulletin appears: Light, Dark, or System default.
        </p>
      </div>

      <div class="relative">
        <button
          id="themeButton"
          class="bg-brand text-text-primary px-4 py-2 rounded-lg text-sm hover:bg-brand-hover transition-colors whitespace-nowrap flex items-center gap-2 w-36 justify-center"
        >
          <span id="theme-icon" class="material-symbols-outlined text-base"></span>
          <span id="theme-text" class="font-medium"></span>
          <span class="material-symbols-outlined text-base ml-auto"
            >expand_more</span
          >
        </button>

        <div
          id="themeDropdown"
          class="absolute right-0 bottom-full mb-2 w-48 bg-overlay-dark/50 border border-card-dark rounded-lg shadow-lg hidden z-50 py-1 text-text-secondary"
        >
          <a
            href="#"
            class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark"
            data-theme="LIGHT"
          >
            <span class="material-symbols-outlined fill-1 text-base"
              >light_mode</span
            >
            Light
          </a>
          <a
            href="#"
            class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark"
            data-theme="DARK"
          >
            <span class="material-symbols-outlined fill-1 text-base"
              >dark_mode</span
            >
            Dark
          </a>
          <a
            href="#"
            class="theme-option-button flex items-center gap-3 px-4 py-2 text-sm hover:text-text-primary hover:bg-card-dark"
            data-theme="SYSTEM"
          >
            <span class="material-symbols-outlined fill-1 text-base"
              >desktop_windows</span
            >
            System
          </a>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    
    // --- Reusable Function to Save Preferences ---
    async function savePreference(name, value) {
      try {
        const response = await fetch('/settings/preferences/update', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            name: name,
            value: value
          })
        });

        if (!response.ok) {
          console.error('Failed to save preference');
        }
        
      } catch (error) {
        console.error('Error saving preference:', error);
      }
    }

    // --- 1. Theme Selection Logic ---
    const themeButton = document.getElementById("themeButton");
    const themeDropdown = document.getElementById("themeDropdown");
    const themeIcon = document.getElementById("theme-icon");
    const themeText = document.getElementById("theme-text");
    const themeOptionButtons = document.querySelectorAll(".theme-option-button");

    const themeMap = {
      LIGHT: { icon: "light_mode", text: "Light" },
      DARK: { icon: "dark_mode", text: "Dark" },
      SYSTEM: { icon: "desktop_windows", text: "System" },
    };

    function applyTheme(theme) {
      let effectiveTheme = theme.toLowerCase();

      if (theme === "SYSTEM") {
        const systemThemeMatcher = window.matchMedia(
          "(prefers-color-scheme: dark)"
        );
        effectiveTheme = systemThemeMatcher.matches ? "dark" : "light";
      }

      if (effectiveTheme === "dark") {
        document.documentElement.classList.add("dark");
      } else {
        document.documentElement.classList.remove("dark");
      }

      if (themeMap[theme] && themeIcon && themeText) {
        themeIcon.textContent = themeMap[theme].icon;
        themeText.textContent = themeMap[theme].text;
      }

      localStorage.setItem("theme", theme);
      if (themeDropdown) {
        themeDropdown.classList.add("hidden");
      }
    }

    function initButtonState() {
      // Use the theme from PHP as the source of truth, fall back to localStorage/system
      const savedTheme = "<?= $preferences['theme_preference'] ?>" || localStorage.getItem("theme") || "SYSTEM";
      if (themeMap[savedTheme] && themeIcon && themeText) {
        themeIcon.textContent = themeMap[savedTheme].icon;
        themeText.textContent = themeMap[savedTheme].text;
      }
      // Note: The theme is already applied by a script in the <head>
    }

    if (themeButton && themeDropdown) {
      themeButton.addEventListener("click", (event) => {
        event.stopPropagation();
        themeDropdown.classList.toggle("hidden");
      });

      window.addEventListener("click", () => {
        if (!themeDropdown.classList.contains("hidden")) {
          themeDropdown.classList.add("hidden");
        }
      });

      themeOptionButtons.forEach((button) => {
        button.addEventListener("click", (e) => {
          e.preventDefault();
          const newTheme = e.currentTarget.dataset.theme;
          applyTheme(newTheme);
          // Save to database
          savePreference('theme_preference', newTheme);
        });
      });

      const systemThemeMatcher = window.matchMedia(
        "(prefers-color-scheme: dark)"
      );
      systemThemeMatcher.addEventListener("change", (e) => {
        const currentSavedPref = localStorage.getItem("theme") || "<?= $preferences['theme_preference'] ?>";
        if (currentSavedPref === "SYSTEM") {
          applyTheme("SYSTEM");
        }
      });
    }

    initButtonState();

    // --- 2. Toggle Switch Logic ---
    const allToggles = document.querySelectorAll('.preference-toggle');

    allToggles.forEach(toggle => {
      toggle.addEventListener('change', (e) => {
        const name = e.target.name;
        const value = e.target.checked ? 1 : 0;
        
        // Save the change to the database
        savePreference(name, value);
      });
    });

  });
</script>

<?php view("partials/footer.php"); ?>