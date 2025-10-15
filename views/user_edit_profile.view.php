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
            class="text-gray-400 font-normal absolute top-[40px] left-[1700px]">
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
                      absolute top-[50px] left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-10">

            <div class="h-[2px] w-[90%] max-w-[1600px] bg-red-500 rounded-lg mt-[20px] pb-[10px] 
                        absolute top-[280px] left-1/2 transform -translate-x-1/2 z-20"></div>

  <div class=" bg-overlay-dark/50 w-[85%] max-w-[1600px] h-[635px] rounded-lg flex items-start">
          <h1 class="text-lg font-semibold text-red-500 mt-[10px] ml-[70px] ">
            Name
            <div class="pt-[15px] pl-[30px] text-white bg-card-dark/20 w-[700px] h-[260px] mt-[10px] ml-[10px] rounded-lg"> 
              <form action="account" method="POST">    
                <button type="submit " class="hidden"></button>      
                  <label class="text-base">First Name</label>
                    <input type="text" name="fname" placeholder="Nathaniel"
                    class="focus:outline-none border-red-500 border-b mt-[10px] w-[630px]"> 
                  <label class="text-base flex mt-[20px]">Middle Name</label>
                    <input type="text" name="mname" placeholder="Dela Masa"
                    class="focus:outline-none border-red-500 border-b w-[630px] flex mt-[10px]"> 
                  <label class="text-base flex mt-[20px]" >Last Name</label>
                    <input type="text" name="lname" placeholder="Sto Nino"
                    class="focus:outline-none border-red-500 border-b mt-[10px] w-[630px]">
              </form>
            </div>
            <p>Contact Information</p>
            <div class="pt-[15px] pl-[30px] text-white bg-card-dark/20 w-[700px] h-[260px] mt-[10px] ml-[10px] rounded-lg"> 
              <form action="account" method="POST">          
                <label class="text-base">Email Address</label>
                  <input type="text" name="email" placeholder="ndmstonino@bpsu.edu.ph"
                  class="focus:outline-none border-red-500 border-b mt-[10px] w-[630px]"> 
                <label class="text-base flex mt-[50px]">Contact No.</label>
                  <input type="text" name="contactNumber" placeholder="09123456789"
                  class="focus:outline-none border-red-500 border-b w-[630px] flex mt-[10px]"> 
              </form>
            </div>
          </h1>
          <h1 class="text-lg font-semibold text-red-500 mt-[10px] ml-[50px]">
            School Information 
            <div class="pt-[2px] pl-[30px] text-white bg-card-dark/20 w-[700px] h-[260px] mt-[10px] ml-[10px] rounded-lg"> 
              <label class="text-base flex mt-[5px]">Program:</label>
                <select name="program" id="program" class="focus:outline-none bg-card-dark border-red-500 border-1 flex mt-[10px] w-[630px] p-[5px] cursor-pointer">
                  <option value="" class="text-center text-text-secondary">-- Select a Course --</option>
                  <option value="Midwifery">Bachelor of Science in Midwifery</option>
                  <option value="Nursing">Bachelor of Science in Nursing</option>
                  <option value="Tourism Management">Bachelor of Science in Tourism Management</option>
                  <option value="Architecture">Bachelor of Science in Architecture</option>
                  <option value="Civil Engineering">Bachelor of Science in Civil Engineering</option>
                  <option value="Computer Science">Bachelor of Science in Computer Science</option>
                  <option value="Data Science">Bachelor of Science in Data Science</option>
                  <option value="Information Technology">Bachelor of Science in Information Technology</option>
                </select>
              
              <label class="text-base flex mt-[10px]"><p>Year Level:</p></label>
                <select name="gradeYear" id="gradeYear" class="focus:outline-none bg-card-dark border-red-500 border-1 flex mt-[10px] w-[630px] p-[5px] cursor-pointer">
                  <option value="" class="text-center text-text-secondary">-- Select Year Level --</option>
                  <option value="1st Year">1st Year</option>
                  <option value="2nd Year">2nd Year</option>
                  <option value="3rd Year">3rd Year</option>  
                  <option value="4th Year">4th Year</option>
                  <option value="5th Year">5th Year</option>
                </select>
              <label class="text-base flex mt-[10px]">Campus:</label>
                <select name="campus" id="campus"class="focus:outline-none bg-card-dark border-red-500 flex border-1 flex mt-[10px] w-[630px] p-[5px] cursor-pointer">
                  <option value="" class="text-center text-text-secondary">-- Select Campus --</option>
                  <option value="Bataan">Bataan Campus</option>
                  <option value="Abucay">Abucay Campus</option>
                  <option value="Balanga">Balanga Campus</option>
                  <option value="Orani">Orani Campus</option>
                </select>
          </div>
            <p>Bio</p>
              <div class="pt-[8px] pl-[30px] text-white bg-card-dark/20 w-[700px] h-[260px] mt-[10px] ml-[10px] rounded-lg"> 
                <p class="text-base ">Intro</p>
                  <form action="bio" method="POST">
                    <textarea  name="bio" id="bio" rows="6" cols="70" placeholder="Describe yourself"
                      class="focus:outline-none bg-card-dark border-b border-red-500 m-[20px] w-[600px] p-[10px] cursor-pointer 
                          text-white placeholder:text-gray-400 placeholder:text-center 
                            resize-none text-center"></textarea>
                  </form>
              </div>
          </h1>
    </div>
</div>

<?php view("partials/footer.php"); ?>