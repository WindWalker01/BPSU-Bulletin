


<div class="min-h-screen flex flex-col items-center pt-24 px-4 relative">
  <!-- Top Section -->
  <div class="w-full flex justify-start max-w-6xl">
      <div class="w-full flex justify-start max-w-6xl">
    <a href="/account" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
                     <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Back
    </a>
  </div>

  </div>

  <!-- Profile Picture Section -->
  <div class="flex flex-col items-center mt-10 relative">
    <h2 class="text-xl md:text-2xl font-bold text-text-primary mb-3">Profile Picture</h2>

    <div class="relative">
      <img 
        src="<?php echo $image_url; ?>"
        alt="Profile Picture"
        class="w-32 h-32 md:w-44 md:h-44 rounded-full object-cover border border-gray-700"/>
        
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

    <h1 class="text-2xl md:text-3xl font-bold text-text-primary mt-4">Profile Information</h1>

  <!-- Info Section -->
    <form action="/account" method="POST" class="bg-overlay-dark/50 w-[90%] max-w-6xl rounded-lg mt-8 mb-10 flex flex-col lg:flex-row gap-10 p-6">
      <!-- Left Column -->
        <input type="hidden" name="_method" value="PATCH">
        <input type="hidden" name="user_id" value="<?php echo $id; ?>">
      <div class="flex-1">
        <h2 class="text-lg font-semibold   text-red-500 mb-2">Name</h2>
        <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
            <div>
              <label class="text-base text-text-primary block">Username</label>
              <input type="text" name="username" placeholder="Username" value="<?php echo $username?>"
                class="focus:outline-none text-text-primary border-b border-red-500 mt-1 w-full bg-transparent" />
            </div>
        </div>

        <h2 class="text-lg font-semibold text-red-500 mt-6 mb-2">Contact Information</h2>
        <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
            <div>
              <label class="text-base text-text-primary block">Email Address</label>
              <input type="text" name="email" placeholder="Email" value="<?php echo $email ?>"
                class="focus:outline-none border-b text-text-primary border-red-500 mt-1 w-full bg-transparent" />
            </div>
        </div>
      </div>

    <!-- Right Column -->
    <div class="flex-1">
      <h2 class="text-lg font-semibold text-red-500 mb-2">School Information</h2>
      <div class="bg-card-dark/20 p-4 rounded-lg text-white space-y-4">
          <div>
            <label class="text-base  text-text-primary block">Campus</label>
            <select name="campus" id="campus" 
              class="focus:outline-none bg-card-dark text-text-primary border border-red-500 w-full mt-1 p-2 rounded cursor-pointer">
              <option value="MAIN" <?php echo $campus === "MAIN" ? "selected": ""?> >Main Campus</option>
              <option value="ABUCAY" <?php echo $campus === "ABUCAY" ? "selected": ""?>>Abucay Campus</option>
              <option value="BALANGA" <?php echo $campus === "BALANGA" ? "selected": ""?>>Balanga Campus</option>
              <option value="ORANI" <?php echo $campus === "ORANI" ? "selected": ""?>>Orani Campus</option>
              <option value="DINALUPIHAN" <?php echo $campus === "DINALUPIHAN" ? "selected": ""?> >Dinalupihan Campus</option>
              <option value="BAGAC" <?php echo $campus === "BAGAC" ? "selected": ""?>>Bagac Campus</option>
            </select>
          </div>
        </div>
        <h2 class="text-lg font-semibold text-red-500 mt-6 mb-2">Bio</h2>
        <div class="bg-card-dark/20 p-4 rounded-lg text-white">
            <textarea name="bio" id="bio" rows="6" placeholder="Describe yourself" 
              class="focus:outline-none text-text-primary bg-card-dark border-b border-red-500 w-full p-2  placeholder:text-gray-400 resize-none rounded"><?php echo $bio ?></textarea>
       
        </div>
        
        <div class="flex">
          <button type="submit" 
            class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
                  bg-brand hover:bg-brand/80 text-white font-semibold py-2 px-4 rounded-lg
                  flex justify-center items-center h-10 w-40 mt-4 mx-auto">
            Save Changes
          </button>
      </div>
      </form>

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