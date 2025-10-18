<script src="https://unpkg.com/lucide@latest"></script>

<div class="flex flex-row justify-center px-16">

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 mt-8 gap-4">
        <div class="text-text-primary ml-4 col-span-1 md:col-span-3">
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
                <div class="flex flex-row gap-4 <?= isUserLoggedIn()
                    ? ""
                    : "hidden" ?>">
                    <p class="text-text-primary">Reactions: </p>
                    <button id="up-button" class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                        <span id="up-icon" class="material-symbols-outlined text-xl">thumb_up</span> <p id="like-count"><?= $like_count ?></p>
                    </button>
                    
                    <button id="down-button" class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                        <span id="down-icon" class="material-symbols-outlined text-xl">thumb_down</span> <p id="dislike-count"><?= $dislike_count ?></p>
                    </button>   
                </div>

                <button class="flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                    <span class="material-symbols-outlined text-xl">share</span> Share
                </button>
            </div>

            <hr class="text-text-secondary my-6">

            <form action='/comment' method='POST' class="mt-3 space-y-2 <?php echo isUserLoggedIn()
                ? ""
                : "hidden"; ?>">
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


document.addEventListener('DOMContentLoaded', () => {
    const upButton = document.getElementById('up-button');
    const downButton = document.getElementById('down-button');
    const upIcon = document.getElementById('up-icon');
    const downIcon = document.getElementById('down-icon');
    
    const POST_ID = <?= (int) $blog_id ?>; 

    if(<?= $current_user_reaction ?> == 1){
        upIcon.classList.add("fill-1");
    }else if(<?= $current_user_reaction ?> == 2){
        downIcon.classList.add("fill-1");

    }

    upButton.addEventListener('click', () => {
        handleReactionClick(upIcon, 'like', POST_ID);
    });

    downButton.addEventListener('click', () => {
        handleReactionClick(downIcon, 'dislike', POST_ID);
    });

    async function handleReactionClick(clickedIcon, reactionType, postId) {
        
        const otherIcon = clickedIcon.id === 'up-icon' ? downIcon : upIcon;
        const currentIconState = clickedIcon.classList.contains('fill-1') ? 'filled' : 'unfilled';
        
        // 1. Determine the ACTION to send to the server
        let action;
        let likeChange = 0;
        let dislikeChange = 0;

        if (currentIconState === 'filled') {
            // User is clicking the same button to UNDO the reaction (Scenario C)
            action = 'undo'; 
            clickedIcon.classList.remove('fill-1');

            if (reactionType === 'like') likeChange = -1;
            else dislikeChange = -1;

        } else if (otherIcon.classList.contains('fill-1')) {
            // User is switching from the other reaction (Scenario D)
            action = 'switch';
            otherIcon.classList.remove('fill-1');
            clickedIcon.classList.add('fill-1');

            if (reactionType === 'like') {
                likeChange = 1;      // Increment like
                dislikeChange = -1;  // Decrement dislike
            } else {
                likeChange = -1;     // Decrement like
                dislikeChange = 1;   // Increment dislike
            }

            clickedIcon.classList.add('fill-1');

            if (reactionType === 'like') likeChange = 1;
            else dislikeChange = 1;
        } else {
            // User is setting a brand new reaction (Scenario A or B)
            action = 'set';
            clickedIcon.classList.add('fill-1');

            if (reactionType === 'like') likeChange = 1;
            else dislikeChange = 1;
        }

        const like_count = document.getElementById('like-count');
        const dislike_count = document.getElementById('dislike-count');

        dislike_count.textContent = parseInt(dislike_count.textContent) + dislikeChange;
        like_count.textContent = parseInt(like_count.textContent) + likeChange;

        // 2. Prepare the data to send to the server
        const formData = new FormData();
        formData.append('_method', "POST");
        formData.append('post_id', postId);
        formData.append('reaction_type', reactionType);
        formData.append('action', action);

        // 3. Send the request to the PHP endpoint
        try {
            const response = await fetch('http://localhost:8069/react', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            console.log(result);


        } catch (error) {
            console.error('There was a problem with the fetch operation:', error);
            // Handle network/connection errors
        }
    }
});


</script>

<?php view("partials/footer.php"); ?>
