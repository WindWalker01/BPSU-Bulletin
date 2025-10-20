


<div class="min-h-screen bg-bg-dark/80 flex flex-col items-center pt-24 px-4 relative">
  <!-- Top Section -->
  <div class="w-full flex justify-between items-center max-w-6xl">
    <h1 class="text-2xl md:text-3xl font-bold text-white mt-4">Profile Information</h1>
    <a href="account" class="text-gray-400 font-normal text-sm md:text-base">← Back</a>
  </div>

  <!-- Profile Picture Section -->
  <div class="flex flex-col items-center mt-10 relative">
    <h2 class="text-xl md:text-2xl font-bold text-white mb-3">Profile Picture</h2>

    <div class="relative">
      <img 
        src="<?php echo $image_url; ?>"
        alt="Profile Picture"
        class="w-32 h-32 md:w-44 md:h-44 rounded-full object-cover border border-gray-700"
      />
      <form id="uploadForm" action="/user_profile/image" method="POST" enctype="multipart/form-data" class="absolute bottom-0 right-0">
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="user_id" value="<?php echo $id; ?>">

        <label for="file-upload"
          class="transition transform hover:-translate-y-1 hover:scale-110 bg-red-500 hover:bg-red-800 text-white font-semibold py-1 px-3 rounded-lg text-xs cursor-pointer">
          ✏ Edit
        </label>
        <input type="file" id="file-upload" name="profile_image" accept="image/png, image/jpeg, image/gif" class="hidden">
      </form>
    </div>
  </div>

  <!-- Divider -->
  <div class="h-[2px] w-[90%] max-w-6xl bg-red-500 rounded-lg mt-8"></div>

  <!-- Info Section -->
  <div class="bg-overlay-dark/50 w-[90%] max-w-6xl rounded-lg mt-8 flex flex-col lg:flex-row gap-10 p-6">
    <!-- Left Column -->
    <div class="flex-1">
      <h2 class="text-lg font-semibold text-red-500 mb-2">Name</h2>
      <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
        <form action="account" method="POST">
          <div>
            <label class="text-base block">First Name</label>
            <input type="text" name="fname" placeholder="Nathaniel"
              class="focus:outline-none border-b border-red-500 mt-1 w-full bg-transparent" />
          </div>
          <div>
            <label class="text-base block mt-4">Middle Name</label>
            <input type="text" name="mname" placeholder="Dela Masa"
              class="focus:outline-none border-b border-red-500 mt-1 w-full bg-transparent" />
          </div>
          <div>
            <label class="text-base block mt-4">Last Name</label>
            <input type="text" name="lname" placeholder="Sto Nino"
              class="focus:outline-none border-b border-red-500 mt-1 w-full bg-transparent" />
          </div>
        </form>
      </div>

      <h2 class="text-lg font-semibold text-red-500 mt-6 mb-2">Contact Information</h2>
      <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
        <form action="account" method="POST">
          <div>
            <label class="text-base block">Email Address</label>
            <input type="text" name="email" placeholder="ndmstonino@bpsu.edu.ph"
              class="focus:outline-none border-b border-red-500 mt-1 w-full bg-transparent" />
          </div>
          <div>
            <label class="text-base block mt-4">Contact No.</label>
            <input type="text" name="contactNumber" placeholder="09123456789"
              class="focus:outline-none border-b border-red-500 mt-1 w-full bg-transparent" />
          </div>
        </form>
      </div>
    </div>

    <!-- Right Column -->
    <div class="flex-1">
      <h2 class="text-lg font-semibold text-red-500 mb-2">School Information</h2>
      <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
        <div>
          <label class="text-base block">Program</label>
          <select name="program" id="program"
            class="focus:outline-none bg-card-dark border border-red-500 w-full mt-1 p-2 rounded cursor-pointer">
            <option value="">-- Select a Course --</option>
            <option value="Midwifery">Bachelor of Science in Midwifery</option>
            <option value="Nursing">Bachelor of Science in Nursing</option>
            <option value="Tourism Management">Bachelor of Science in Tourism Management</option>
            <option value="Architecture">Bachelor of Science in Architecture</option>
            <option value="Civil Engineering">Bachelor of Science in Civil Engineering</option>
            <option value="Computer Science">Bachelor of Science in Computer Science</option>
            <option value="Data Science">Bachelor of Science in Data Science</option>
            <option value="Information Technology">Bachelor of Science in Information Technology</option>
          </select>
        </div>
        <div>
          <label class="text-base block">Year Level</label>
          <select name="gradeYear" id="gradeYear"
            class="focus:outline-none bg-card-dark border border-red-500 w-full mt-1 p-2 rounded cursor-pointer">
            <option value="">-- Select Year Level --</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
            <option value="5th Year">5th Year</option>
          </select>
        </div>
        <div>
          <label class="text-base block">Campus</label>
          <select name="campus" id="campus"
            class="focus:outline-none bg-card-dark border border-red-500 w-full mt-1 p-2 rounded cursor-pointer">
            <option value="">-- Select Campus --</option>
            <option value="Bataan">Bataan Campus</option>
            <option value="Abucay">Abucay Campus</option>
            <option value="Balanga">Balanga Campus</option>
            <option value="Orani">Orani Campus</option>
          </select>
        </div>
      </div>

      <h2 class="text-lg font-semibold text-red-500 mt-6 mb-2">Bio</h2>
      <div class="bg-card-dark/20 p-4 rounded-lg text-white">
        <form action="bio" method="POST">
          <textarea name="bio" id="bio" rows="6" placeholder="Describe yourself"
            class="focus:outline-none bg-card-dark border-b border-red-500 w-full p-2 text-white placeholder:text-gray-400 placeholder:text-center resize-none text-center rounded"></textarea>
        </form>
      </div>
    </div>
  </div>
</div>

<?php view("partials/footer.php"); ?>


<script>
  const fileInput = document.getElementById("file-upload");
  const uploadForm = document.getElementById("uploadForm");

  fileInput.addEventListener("change", () => {
    if (fileInput.files.length > 0) {
      uploadForm.submit(); // triggers the form action
    }
  });
</script>
