<script src="https://unpkg.com/lucide@latest"></script>

<div class="flex flex-row justify-center px-16">

    <!-- Main Content -->
    <div class="grid grid-cols-4 mt-8 gap-4">
        <div class="text-text-primary ml-4 col-span-3">
            <!-- Category and Back button -->
            <div class="flex flex-row justify-between">
                <span class="ml-1 text-xs font-medium bg-brand/20 text-brand px-2 py-1 rounded-full">
                    University Updates
                </span>

                <span class="mr-1 text-xs font-medium bg-brand/20 text-brand px-2 py-1 rounded-full">
                    Go back
                </span>
            </div>

            <!-- Title  -->
            <div class="flex flex-col justify-start">
                <h1 class="text-5xl font-bold my-2"><?= $title ?></h1>
                
                <!-- Author and Publish date-->
                <div class="flex flex-row gap-2 my-2 items-center">
                    <img
                        alt="avatar"
                        class="h-10 w-10 rounded-full object-cover"
                        src="https://res.cloudinary.com/dz4qgnk5v/image/upload/v1760546534/bpsu_bulletin/profile_images/bni4vecslgge8yy7szi5.jpg"
                    />
                    <p class="text-text-primary text-s">Juan Dela Cruz</p>
                    <p class="text-s mx-0.5">  &bull;  </p>
                    <p class="text-text-secondary text-s">Published on October 16, 2025</p>
                </div>
                
            </div>


            <!-- Blog Content -->
            <article class="tiptap-content mb-12">
                <?= $blog_html ?>
            </article>

            <hr class="text-text-secondary my-6">

            <!-- Reactions and Share -->
            <div class="flex flex-row justify-between my-6">
                <div class="flex flex-row gap-4">
                    <p class="text-text-primary">Reactions: </p>
                    <button class= "text-text-secondary hover:text-brand transition">
                        <span class="material-symbols-outlined w-5 h-5" >favorite</span>                    
                    </button>

                     <button class= "text-text-secondary hover:text-brand transition">
                        <span class="material-symbols-outlined w-5 h-5" style="font-variation-settings: 'FILL' 1;">favorite</span>                    
                    </button>
                    
                    <button class="text-text-secondary hover:text-brand transition">
                        <span class="material-symbols-outlined">sentiment_satisfied</span>
                    </button>
                    
                    <button class="text-text-secondary hover:text-brand transition">
                        <span class="material-symbols-outlined">lightbulb</span>
                    </button>
                    
                    <button class="text-text-secondary hover:text-brand transition">
                        <span class="material-symbols-outlined">celebration</span>
                    </button>     
                </div>

                <div class="flex flex-row gap-4">
                    <p>Share: </p>
                    <button class= "text-text-secondary hover:text-brand transition">
                        <i data-lucide="facebook" class="w-5 h-5"></i>
                    </button>
                    <button class="text-text-secondary hover:text-brand transition">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </button>
                    <button class="text-text-secondary hover:text-brand transition">
                        <i data-lucide="linkedin" class="w-5 h-5"></i>
                    </button>   
                </div>
            </div>

            <hr class="text-text-secondary my-6">

            <form action='/comment' method='POST' class="mt-3 space-y-2 <?php echo isUserLoggedIn() ===
            false
                ? "hidden"
                : ""; ?>">
                <input type='hidden' name='blog_id' value="<?= $blog_id ?>">
                <input type='hidden' name='_method' value="POST">
                
                <textarea 
                    name='comment_content'
                    rows='2'
                    class='w-full bg-card-dark text-text-primary text-sm p-2 rounded-md focus:outline-none focus:ring-1 focus:ring-brand-hover'
                    placeholder='Write a reply...'
                ></textarea>
                <div class='flex justify-end gap-2'>                    
                    <button 
                        type='submit'
                        class='bg-brand hover:bg-brand-hover text-text-primary px-3 py-1 rounded-md text-sm'
                    >
                        Post
                    </button>
                </div>
            </form>

             <!-- Comments -->
            <div>
                <h2 class="text-2xl font-semibold mb-6 text-text-primary" id="comments">Comments (<?= $comment_count ?>)</h2>
                <?php renderComments(0, $comment_tree); ?>
            </div>

        </div>  

        <div class="bg-red-400">Related</div>
    </div>
</div>


<script>
  lucide.createIcons();
</script>

<?php view("partials/footer.php"); ?>
