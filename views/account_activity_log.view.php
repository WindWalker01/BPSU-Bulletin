<?php view("partials/head.php"); ?>

<div class="min-h-screen bg-bg-dark/80 flex justify-center items-center">
  <div class="h-[900px] w-[1200px] text-center flex-col justify-center bg-card-dark/20 rounded-lg p-[20px]">

    <!-- User Profile View -->
    <img 
      src="/assets/Hannie.jpg" 
      alt="Profile Picture"
      class="w-[128px] h-[128px] rounded-full object-cover mb-4 border-2 border-black-700 mx-auto"
    >

    <h1 class="text-white text-xl font-semibold">Nathaniel D. Sto Niño</h1>
    <p class="text-gray-500 text-base">Sharp Blade, Sharp Mind</p>
    <p class="text-gray-500 text-base">Joined September 1834</p>

    <a href="user_profile"
      class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
              bg-red-500 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
              flex justify-center items-center h-[40px] w-[400px] mt-4 mx-auto">
      Edit Profile
    </a>


    <!-- Tab Layouts -->
    <div class="  flex gap-[50px] border-b border-gray-200 mb-0 mt-20 text-white justify-left pl-[40px]">
      <button id="post-btn" class="tab-btn py-2 px-6 border-b-4 border-red-500 text-red-500 font-semibold">My Post</button>
      <button id="follow-btn" class="tab-btn py-2 px-6 hover:text-red-500">Followed Authors</button>
    </div>

    <!-- Tab Contents -->
    <div id="post-tab" class="tab-content mt-6">
      <h3 class="text-lg font-semibold mb-4 text-gray-500 ml-[40px] text-left">Posted 2 days ago</h3>
      <h1 class="text-xl font-semibold mb-2 text-white ml-[40px] text-left">Title</h1>
      <!-- Example Content Material -->
      <div class="flex items-start ml-[40px] gap-6">
        <p class="text-gray-400 text-left w-[60%]">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
        <img 
          src="/assets/mayncrap.png" 
          alt="minecraft-post"
          class="w-[400px] h-[300px] rounded-lg object-cover border-2 border-black-700 -mt-[80px]">
      </div>
    </div>

    <div id="follow-tab" class="hidden mt-6">
      <h3 class="text-lg font-semibold mb-4 text-gray-500 ml-[40px] text-left">No following Authors YEET.</h3>
    </div>

  </div>
</div>

<!-- Tab Script Functions -->
<script>
  const postBtn = document.getElementById("post-btn");
  const followBtn = document.getElementById("follow-btn");
  const postTab = document.getElementById("post-tab");
  const followTab = document.getElementById("follow-tab");

  postBtn.addEventListener("click", () => {
    postTab.classList.remove("hidden");
    followTab.classList.add("hidden");
    postBtn.classList.add("text-red-500", "border-b-4", "border-red-500");
    followBtn.classList.remove("text-red-500", "border-b-4", "border-red-500");
  });

  followBtn.addEventListener("click", () => {
    followTab.classList.remove("hidden");
    postTab.classList.add("hidden");
    followBtn.classList.add("text-red-500", "border-b-4", "border-red-500");
    postBtn.classList.remove("text-red-500", "border-b-4", "border-red-500");
  });
</script>

<?php view("partials/footer.php"); ?>
