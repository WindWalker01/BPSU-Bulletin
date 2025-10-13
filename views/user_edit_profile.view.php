<?php view("partials/head.php"); ?>

<div class="min-h-screen bg-bg-dark/80 flex flex-col items-center pt-[100px] relative">
  <h1 class="text-3xl font-bold text-white  
     mt-[230px] mb-[10px]">
    Profile Information
  </h1>
    <h1 class="text-2xl font-bold text-white  
        absolute top-10 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">
        Profile Picture
    </h1>
        <a href="account"
            class="text-white font-normal absolute top-[40px] left-[1700px]">
                ← Back
        </a>
            <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data" 
                class="absolute top-[180px] left-1/2 transform -translate-x-1/2 z-20">
                <label for="file-upload" class="transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110
                        bg-red-500 hover:bg-red-800 text-white font-semibold py-2 px-4 rounded-lg
                        flex justify-center items-center h-[20px] w-[70px] mt-[30px] mx-auto ml-[180px] text-xs">
                        ✏Edit
                </label>
                
                <input type="file" id="file-upload" name="profile_image" accept="image/png, image/jpeg, image/gif" class="hidden">
            </form>
                  <img 
                    src="/assets/Hannie.jpg" 
                    alt="Profile Picture"
                    class="w-[180px] h-[180px] rounded-full object-cover border border-black-700 mt-[120px]
                        absolute top-[50px] left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10"
                    >
            <div class="h-[2px] w-[90%] max-w-[1600px] bg-red-500 rounded-lg mt-[20px] pb-[10px] 
                        absolute top-[280px] left-1/2 transform -translate-x-1/2 z-20"></div>

        <div class="mt-[10px] h-[550px] w-[90%] max-w-[1600px] bg-card-dark/20 rounded-lg pt-[50px] pb-[100px] mx-auto">
    
  </div>
</div>

<?php view("partials/footer.php"); ?>
