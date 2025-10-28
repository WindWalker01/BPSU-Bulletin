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

            <?php view("partials/blog-content.php", [
                "title" => $title,
                "blog_html" => $blog_html,
                "username" => $author_name,
                "published_at" => $published_at,
                "author_profile" => $author_profile,
            ]); ?>

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
                <?php renderComments(0, $comment_tree, 0, $db); ?>
            </div>

        </div>  

        <aside class="flex flex-col gap-4">
            <div class="lg:col-span-4 space-y-8 lg:top-24 order-1 lg:order-2">
                <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
                    <h3 class="text-lg font-bold mb-4 text-text-primary">Related Arcticles</h3>
                    <div class="space-y-3">
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">BPSU Main Campus Expansion Project Groundbreaking</a>
                        <p class="text-sm text-text-secondary">October 20, 2023</p>
                    </div>
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">University Research Symposium Highlights Student Innovations</a>
                        <p class="text-sm text-text-secondary">October 15, 2023</p>
                    </div>
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">New Scholarship Opportunities for Engineering Students</a>
                        <p class="text-sm text-text-secondary">October 10, 2023</p>
                    </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8 lg:top-24 order-1 lg:order-2">
                <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
                    <h3 class="text-lg font-bold mb-4 text-text-primary">Related Arcticles</h3>
                    <div class="space-y-3">
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">BPSU Main Campus Expansion Project Groundbreaking</a>
                        <p class="text-sm text-text-secondary">October 20, 2023</p>
                    </div>
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">University Research Symposium Highlights Student Innovations</a>
                        <p class="text-sm text-text-secondary">October 15, 2023</p>
                    </div>
                    <div>
                        <a class="font-semibold text-text-primary hover:text-brand transition-colors" href="#">New Scholarship Opportunities for Engineering Students</a>
                        <p class="text-sm text-text-secondary">October 10, 2023</p>
                    </div>
                    </div>
                </div>
            </div>
        </aside>
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

<script>
document.addEventListener('DOMContentLoaded', () => {

    document.body.addEventListener('click', (event) => {
        const clickedButton = event.target.closest('.reaction-button');

        if (clickedButton) {
            const wrapper = clickedButton.closest('.reaction-wrapper');
            
            // ❌ FIX 1: Retrieve commentId correctly from the hidden element
            const commentIdElement = wrapper.querySelector('.comment-id');
            // If you used the data attribute method:
            // const commentId = wrapper.dataset.commentId; 
            
            // If you used the hidden paragraph content:
            const commentId = parseInt(commentIdElement.textContent.trim());

            if (isNaN(commentId)) {
                console.error("Error: Could not determine valid comment ID.");
                return; 
            }

            // Get the elements specific to this wrapper
            const clickedIcon = clickedButton.querySelector('.reaction-icon');
            const otherButton = clickedButton.classList.contains('up-button') 
                ? wrapper.querySelector('.down-button') 
                : wrapper.querySelector('.up-button');
            const otherIcon = otherButton.querySelector('.reaction-icon');
            
            const reactionType = clickedButton.classList.contains('up-button') ? 'like' : 'dislike';

            handleReactionClick(clickedIcon, otherIcon, reactionType, commentId, wrapper);
        }
    });

    async function handleReactionClick(clickedIcon, otherIcon, reactionType, commentId, wrapper) {
        
        // Ensure you are comparing against the string 'fill-1', not a boolean.
        const isCurrentlyFilled = clickedIcon.classList.contains('fill-1');

        // Find the count elements specific to this comment wrapper
        const likeCountEl = wrapper.querySelector('.like-count');
        const dislikeCountEl = wrapper.querySelector('.dislike-count');

        // 1. Determine the ACTION and calculate changes (Optimistic Update)
        let action;
        let likeChange = 0;
        let dislikeChange = 0;

        if (isCurrentlyFilled) {
            // SCENARIO C: UNDO (Clicking already filled icon)
            action = 'undo'; 
            clickedIcon.classList.remove('fill-1');
            
            if (reactionType === 'like') likeChange = -1;
            else dislikeChange = -1;

        } else if (otherIcon.classList.contains('fill-1')) {
            // SCENARIO D: SWITCH (Changing from one reaction to the other)
            action = 'switch';
            otherIcon.classList.remove('fill-1'); // Unfill the other
            clickedIcon.classList.add('fill-1');   // Fill the clicked one
            
            if (reactionType === 'like') {
                likeChange = 1;      // +1 for like
                dislikeChange = -1;  // -1 for dislike
            } else { // reactionType is 'dislike'
                likeChange = -1;     // -1 for like
                dislikeChange = 1;   // +1 for dislike
            }

        } else {
            // SCENARIO A/B: SET (Setting a new reaction)
            action = 'set';
            clickedIcon.classList.add('fill-1');

            if (reactionType === 'like') likeChange = 1;
            else dislikeChange = 1;
        }
        
        // ❌ FIX 2: Apply the immediate (fake) count update correctly
        likeCountEl.textContent = parseInt(likeCountEl.textContent) + likeChange;
        dislikeCountEl.textContent = parseInt(dislikeCountEl.textContent) + dislikeChange;


        // 2. Prepare and Send the Request
        const formData = new FormData();
        formData.append('_method', "POST");
        formData.append('comment_id', commentId);
        formData.append('reaction_type', reactionType);
        formData.append('action', action);
        
        try {
            const response = await fetch('http://localhost:8069/comment/react', {
                method: 'POST',
                body: formData
            });

           
            const result = await response.json();
            

        } catch (error) {
            
        }
    }
});
</script>

<?php view("partials/footer.php"); ?>
