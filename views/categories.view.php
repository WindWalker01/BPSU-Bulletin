<div class="flex justify-end pt-10 pr-30">
  <div>
    <label class="text-gray-400 text-2xl block text-right">Sort By</label>
    <select name="program" id="campus"
      class="focus:outline-none text-white bg-brand brand border-red-500 w-60 mt-3 p-2 rounded cursor-pointer">
      <option value="Select" class="text-center">Select a Campus</option>
      <option value="Main" class="text-center" <?php echo $campus === "MAIN" ? "selected": ""?> >Main Campus</option>
      <option value="Abucay" class="text-center" <?php echo $campus === "ABUCAY" ? "selected": ""?> >Abucay Campus</option>
      <option value="Balanga" class="text-center" <?php echo $campus === "BALANGA" ? "selected": ""?> >Balanga Campus</option>
      <option value="Orani" class="text-center" <?php echo $campus === "ORANI" ? "selected": ""?> >Orani Campus</option>
    </select>
  </div>
</div>

<div class="w-10px ml-48 ; ">
  <h1 class="text-white text-4xl font-bold">Browse Categories
    <p class="text-gray-300 pt-5 text-2xl font-semibold">Updates, events, and official notices for the campus community.</p>
  </h1>
</div>

  <!-- Category Cards -->

<div class="mt-10 p-6 ml-10 rounded-lg w-[95%] flex flex-col lg:flex-row gap-10 py-15 pl-30">
    <div class="flex flex-col flex-1 gap-5">
      <a href="/announcement"
              class="group bg-overlay-dark/50 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/megaphone.svg" alt="megaphone" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">University Announcement</p>
        <p class="text-sm text-gray-400">Latest news and updates</p>
      </a>

      <a href="/enrollment"
              class="group bg-overlay-dark/50 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/docs.svg" alt="folder" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Enrollment & Documents</p>
        <p class="text-sm text-gray-400">Registration and Course Information</p>
      </a>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <a href="/organization"
              class="group bg-overlay-dark/50 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/team.svg" alt="teamwork" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Organizations</p>
        <p class="text-sm text-gray-400">Clubs and student groups</p>
      </a>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <a href="/scholar"
              class="group bg-overlay-dark/50 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/school.svg" alt="hat" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Scholarship</p>
        <p class="text-sm text-gray-400">Financial aid opportunities</p>
      </a>
    </div>

    <div class="flex flex-col flex-1 gap-5">
      <a href="/achievement"
              class="group bg-overlay-dark/50 hover:bg-red-500/40 transition-all duration-300 pl-5 pt-10 pb-10 pr-5 rounded-lg border border-white/10 text-left focus:outline-none focus:ring-2 focus:ring-red-400 cursor-pointer w-full">
        <img src="/assets/award.svg" alt="medal" class="w-10 h-10 mb-4">
        <p class="text-lg text-white">Achievements</p>
        <p class="text-sm text-gray-400">Student and faculty accomplishments.</p>
      </a>
    </div>
</div>




  

<?php view("partials/footer.php"); ?>