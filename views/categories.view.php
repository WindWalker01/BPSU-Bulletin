<div class="flex justify-end pt-10 pr-30">
  <div>
    <label class="text-gray-400 text-2xl block text-right">Sort By</label>
    <select name="program" id="program"
      class="focus:outline-none text-white bg-brand brand border-red-500 w-60 mt-3 p-2 rounded cursor-pointer">
      <option value="Select" class="text-center">Select a Campus</option>
      <option value="Main" class="text-center">Main Campus</option>
      <option value="Abucay" class="text-center">Abucay Campus</option>
      <option value="Balanga" class="text-center">Balanga Campus</option>
      <option value="Orani" class="text-center">Orani Campus</option>
    </select>
  </div>
</div>

<div class="w-10px ml-48 ; ">
  <h1 class="text-white text-4xl">Browse Categories
    <p class="text-gray-300 pt-5 text-2xl">Updates, events, and official notices for the campus community.</p>
  </h1>
</div>

  <div class="mt-10 p-6 ml-10 rounded-lg w-[95%] flex flex-col lg:flex-row gap-10 py-15 pl-30">

    <div class="flex flex-col flex-1 gap-5">
      <button data-modal="AnnouncementModal"
              class="group bg-white/10 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/megaphone.png" alt="megaphone" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">University Announcement</p>
        <p class="text-sm text-gray-400">Latest news and updates</p>
      </button>

      <button data-modal="EnrollmentModal"
              class="group bg-white/10 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/folder.png" alt="folder" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Enrollment & Documents</p>
        <p class="text-sm text-gray-400">Registration and Course Information</p>
      </button>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <button data-modal="OrganizationsModal"
              class="group bg-white/10 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/teamwork.png" alt="teamwork" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Organizations</p>
        <p class="text-sm text-gray-400">Clubs and student groups</p>
      </button>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <button data-modal="ScholarshipModal"
              class="group bg-white/10 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/graduation.png" alt="hat" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Scholarship</p>
        <p class="text-sm text-gray-400">Financial aid opportunities</p>
      </button>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <button data-modal="AchievementsModal"
              class="group bg-white/10 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/award.png" alt="medal" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Achievements</p>
        <p class="text-sm text-gray-400">Student and faculty accomplishments.</p>
      </button>
    </div>
  </div>

  <!-- MODALS  -->

  <!-- University Announcement Modal -->
  <div id="AnnouncementModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center">
    <div class="relative w-270 h-170 bg-overlay-dark text-white rounded-xl shadow-lg p-8 border-1 border-gray-500">
      <button class="absolute right-3 close-modal bg-white/20 hover:bg-red-600 text-white px-3 py-2 rounded-full">✕</button>
        <h2 class="text-2xl font-semibold mb-4">University Announcements</h2>
          <p class="mb-6 text-base text-gray-300">Here are the latest news and updates about the university.</p>
            <div class="border-1 w-255 border-gray-500"></div>
              <a href="announcement"
                class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-brand hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-10 w-40 absolute inset-x-220 inset-y-150">
                View Categories
              </a>
    </div>
  </div>

  <!-- Enrollment Modal -->
  <div id="EnrollmentModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center">
    <div class="relative w-270 h-170 bg-overlay-dark text-white rounded-xl shadow-lg p-8 border-1 border-gray-500">
      <button class="absolute right-3 close-modal bg-white/20 hover:bg-red-600 text-white px-3 py-2 rounded-full">✕</button>
        <h2 class="text-2xl font-semibold mb-4">Enrollment & Documents</h2>
          <p class="mb-6 text-base text-gray-300">Details about registration, documents, and requirements.</p>
            <div class="border-1 w-255 border-gray-500"></div>
              <a href="enrollment"
                class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-brand hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-10 w-40 absolute inset-x-220 inset-y-150">
                View Categories
              </a>
    </div>
  </div>

  <!-- Organizations Modal -->
  <div id="OrganizationsModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center">
    <div class="relative w-270 h-170 bg-overlay-dark text-white rounded-xl shadow-lg p-8 border-1 border-gray-500">
      <button class="absolute right-3 close-modal bg-white/20 hover:bg-red-600 text-white px-3 py-2 rounded-full">✕</button>
        <h2 class="text-2xl font-semibold mb-4">Organizations</h2>
          <p class="mb-6 text-base text-gray-300">Explore student clubs and organizations you can join.</p>
            <div class="border-1 w-255 border-gray-500"></div>
              <a href="organization"
                class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-brand hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-10 w-40 absolute inset-x-220 inset-y-150">
                View Categories
              </a>
    </div>
  </div>

  <!-- Scholarship Modal -->
  <div id="ScholarshipModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center">
    <div class="relative w-270 h-170 bg-overlay-dark text-white rounded-xl shadow-lg p-8 border-1 border-gray-500">
      <button class="absolute right-3 close-modal bg-white/20 hover:bg-red-600 text-white px-3 py-2 rounded-full">✕</button>
        <h2 class="text-2xl font-semibold mb-4">Scholarship</h2>
          <p class="mb-6 text-base text-gray-300">Information about financial aid and scholarship programs.</p>
            <div class="border-1 w-255 border-gray-500"></div>
              <a href="scholar"
                class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-brand hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-10 w-40 absolute inset-x-220 inset-y-150">
                View Categories
              </a>
    </div>
  </div>

  <!-- Achievements Modal -->
  <div id="AchievementsModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center">
    <div class="relative w-270 h-170 bg-overlay-dark text-white rounded-xl shadow-lg p-8 border-1 border-gray-500">
      <button class="absolute right-3 close-modal bg-white/20 hover:bg-red-600 text-white px-3 py-2 rounded-full">✕</button>
        <h2 class="text-2xl font-semibold mb-4 w-500px">Achievements</h2>
          <p class="mb-6 text-base text-gray-300">Student and faculty accomplishments.</p>
            <div class="border-1 w-255 border-gray-500"></div>
              <a href="achievement"
                class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-brand hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                flex justify-center items-center h-10 w-40 absolute inset-x-220 inset-y-150">
                View Categories
              </a>
    </div>
  </div>  

  <script>
    const buttons = document.querySelectorAll('[data-modal]');
    const closeButtons = document.querySelectorAll('.close-modal');

    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const modalId = btn.getAttribute('data-modal');
        const modal = document.getElementById(modalId);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
      });
    });

    closeButtons.forEach(btn => {
      btn.addEventListener('click', (e) => {
        const modal = e.target.closest('.fixed');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
      });
    });

  </script>


  

<?php view("partials/footer.php"); ?>