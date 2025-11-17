<script src="https://unpkg.com/lucide@latest"></script>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    <div class="grid grid-cols-1 lg:grid-cols-4 mt-8 gap-8">
    
        <div class="text-text-primary lg:col-span-3 min-w-0">
            
            <div class="flex flex-row justify-between items-center mb-4">
                
                <span class="ml-1 text-xs font-medium px-2 py-1 rounded-full <?= getBadgeColor(
                    $category_name,
                ) ?>">
                    <?= htmlspecialchars($category_name) ?>
                </span>
                <a href="/home" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
                     <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Back
                </a>
            </div>

            <?php view("partials/blog-content.php", [
                "title" => $title,
                "blog_html" => $blog_html,
                "username" => $author_name,
                "published_at" => $published_at,
                "author_profile" => $author_profile,
                "author_id" => $author_id,
                "isOwner" => $isOwner,
                "isFollowed" => $isFollowed,
            ]); ?>

            <hr class="text-text-secondary my-6">

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

                <div class="flex gap-6">
                    <button class="hidden flex items-center gap-1.5 text-text-secondary hover:text-brand transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-xl">share</span> Share
                    </button>
                    
                    <?php if (getLoggedInRole() !== "ADMIN"): ?>
                    <button 
                        type="button"
                        class="flex items-center gap-1 text-text-secondary hover:text-brand <?= isUserLoggedIn()
                            ? ""
                            : "hidden" ?>"
                        onclick='openReportModal(<?= $blog_id ?>, "BLOG")'
                    >
                        <span class="material-symbols-outlined text-base">flag</span>
                        Report
                    </button>
                    <?php else: ?>
                      <button 
                        type="button"
                        class="flex items-center gap-1 text-text-secondary hover:text-yellow-500 <?= isUserLoggedIn()
                            ? ""
                            : "hidden" ?>"
                        onclick="openModerationPanel(
                                'blog',
                                <?= $blog_id ?>, 
                                '<?= htmlspecialchars($title) ?>', 
                                '<?= htmlspecialchars($author_name) ?>', 
                                '<?= htmlspecialchars($author_profile) ?>', 
                                '<?= $author_id ?>'
                            )">
                        <span class="material-symbols-outlined text-base">gavel</span>
                        Moderate
                    </button>
                    <?php endif; ?>
                </div>

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
                        Comment
                    </button>
                </div>
            </form>

            <div>
                <h2 class="text-2xl font-semibold mb-6 text-text-primary" id="comments">Comments (<?= $comment_count ?>)</h2>
                <?php renderComments(0, $comment_tree, 0, $db); ?>
            </div>

        </div>  <aside class="lg:col-span-1 flex flex-col gap-6 lg:top-8 h-fit">
    
    <?php if (!empty($related_articles)): ?>
        <div class="bg-overlay-dark/50 border border-card-dark rounded-xl p-6 backdrop-blur-sm">
            <h3 class="text-lg font-bold mb-4 text-text-primary">You Might Like These</h3>
            <div class="space-y-4">

                <?php foreach ($related_articles as $article): ?>
                    <div>
                        <a 
                            class="font-semibold text-text-primary hover:text-brand transition-colors" 
                            href="/blog?id=<?= $article["id"] ?>"
                        >
                            <?= htmlspecialchars($article["title"]) ?>
                        </a>
                        <p class="text-sm text-text-secondary">
                            <?= date(
                                "F j, Y",
                                strtotime($article["published_at"]),
                            ) ?>
                        </p>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endif; ?>

</aside></div> </div> 

            
<div id="reportModal" class="hidden fixed inset-0 bg-overlay-dark/80 backdrop-blur-sm flex items-center justify-center z-50">
  <div class="bg-overlay-dark rounded-2xl shadow-xl w-[90%] max-w-md p-6 border border-card-dark animate-fade-up">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-text-primary">Report</h2>
      <button type="button" onclick="closeReportModal()" class="text-text-secondary hover:text-text-primary transition">
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>

    <p class="text-sm font-medium text-text-primary mb-1">What's going on?</p>
    <p class="text-xs text-text-secondary mb-4">
      We'll check for all Community Guidelines, so don't worry about making the perfect choice.
    </p>

    <form action="/report" method="POST" class="space-y-4">
      <input type="hidden" id="reportId" name="id">
      <input type="hidden" id="reportType" name="reportType">
      <input type="hidden" name="_method" value="POST">
      <input type="hidden" name="blogId" value="<?= $blog_id ?>">

      <div class="space-y-3">
        <?php
        $categories = [
            "SEXUAL" => "Sexual content",
            "VIOLENT" => "Violent or repulsive content",
            "HARMFUL" => "Harmful or dangerous acts",
            "HARASSMENT" => "Harassment or bullying",
            "SELF_HARM" => "Suicide or self-harm content",
            "SPAM" =>
                "Irrelevant or repetitive content intended to promote or clutter discussions.",
        ];
        foreach ($categories as $value => $label): ?>
        <label class="flex items-start gap-3 cursor-pointer group p-2 rounded-md hover:bg-overlay-dark/40 transition">
          <input 
            type="radio" 
            name="category" 
            value="<?= $value ?>" 
            required
            class="mt-1.5 appearance-none w-4 h-4 rounded-full border border-text-secondary checked:border-[5px] checked:border-brand checked:bg-transparent transition"
          >
          <span class="text-sm text-text-secondary group-hover:text-text-primary transition"><?= $label ?></span>
        </label>
        <?php endforeach;
        ?>
      </div>

      <div class="mt-5">
        <label class="block text-sm text-text-secondary mb-1">Additional details (optional):</label>
        <textarea 
          name="reason"
          rows="3"
          class="w-full bg-bg-dark border border-brand/30 rounded-md p-2 text-sm text-text-primary focus:ring-1 focus:ring-brand-hover focus:outline-none placeholder:text-text-gray"
          placeholder="Add any extra context..."
        ></textarea>
      </div>

      <div class="flex justify-end mt-5 gap-2">
        <button 
            type="button" 
            onclick="closeReportModal()" 
            class="px-3 py-1.5 text-sm rounded-md text-text-secondary hover:text-text-primary transition"
        >
          Cancel
        </button>
        <button
            disabled
            type="submit" 
            class="px-4 py-1.5 rounded-md text-sm text-text-primary bg-brand hover:bg-brand-hover transition"
        >
          Report
        </button>
      </div>
    </form>
  </div>
</div>


<div 
  id="moderationModal" 
  class="hidden fixed inset-0 bg-overlay-dark/80 backdrop-blur-sm flex items-center justify-center z-50 px-4"
>
  <div class="bg-overlay-dark rounded-2xl shadow-xl w-full max-w-lg p-6 border border-card-dark animate-fade-up max-h-[90vh] overflow-y-auto">
    <div class="flex justify-between items-center mb-4 sticky top-0 bg-overlay-dark/90 backdrop-blur-sm z-10 pb-2">
      <h2 class="text-lg font-semibold text-text-primary flex items-center gap-1">
        <span class="material-symbols-outlined text-brand">gavel</span>
        Moderate Content
      </h2>
      <button 
        type="button" 
        onclick="closeModerationModal()" 
        class="text-text-secondary hover:text-text-primary transition"
      >
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>

    <div class="bg-bg-dark border border-card-dark rounded-md p-3 text-sm text-text-secondary mb-5 overflow-y-auto max-h-[40vh]">
      <div class="flex flex-row items-start gap-3">
        <a href="" id="moderationCommentAccountLink" class="flex-shrink-0">
          <img src="" class="w-9 h-9 rounded-full" alt="Avatar" id="moderationCommentAvatar">
        </a>
        <div class="flex-1 space-y-1">
          <span class="font-semibold text-text-primary block" id="moderationCommentUsername"></span>
          <p id="moderationCommentText" class="leading-relaxed break-words">
            Loading content details...
          </p>
        </div>
      </div>
    </div>

    <div class="space-y-2">
      <button 
        type="button"
        onclick="deleteComment()"
        class="w-full px-4 py-2 rounded-md bg-brand hover:bg-brand-hover text-sm text-white transition flex items-center justify-center gap-2"
      >
        <span class="material-symbols-outlined text-base">delete</span>
        Delete Content
      </button>

      <button 
        type="button"
        onclick="banUser()"
        class="w-full px-4 py-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-sm text-black transition flex items-center justify-center gap-2"
      >
        <span class="material-symbols-outlined text-base">block</span>
        Ban User
      </button>
    </div>

    <div class="flex justify-end mt-5">
      <button 
        type="button" 
        onclick="closeModerationModal()" 
        class="px-3 py-1.5 text-sm rounded-md text-text-secondary hover:text-text-primary transition"
      >
        Cancel
      </button>
    </div>
  </div>
</div>

<?php view("partials/intelligent-system-modal.php"); ?>


            
<script>

let website_url = "<?= getConfig()["website_url"] ?>";
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
            const response = await fetch(website_url + "/react", {
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
            
            // Retrieve commentId correctly from the hidden element
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
        
        // Apply the immediate (fake) count update correctly
        likeCountEl.textContent = parseInt(likeCountEl.textContent) + likeChange;
        dislikeCountEl.textContent = parseInt(dislikeCountEl.textContent) + dislikeChange;


        // 2. Prepare and Send the Request
        const formData = new FormData();
        formData.append('_method', "POST");
        formData.append('comment_id', commentId);
        formData.append('reaction_type', reactionType);
        formData.append('action', action);
        
        try {
            const response = await fetch(website_url + 'comment/react', {
                method: 'POST',
                body: formData
            });

            
            const result = await response.json();
            

        } catch (error) {
            
        }
    }
});
</script>

<script>
document.querySelectorAll('input[name="category"]').forEach(input => {
    input.addEventListener('change', () => {
        document.querySelector('#reportModal button[type="submit"]').disabled = false;
    });
});
function openReportModal(id, reportType) {
    document.getElementById('reportModal').classList.remove('hidden');
    document.getElementById('reportId').value = id;
    document.getElementById('reportType').value = reportType;

    console.log(id);

}
function closeReportModal() {
    document.getElementById('reportModal').classList.add('hidden');
}
</script>


<script>
let selectedId = null;
let moderationType = null;

function openModerationPanel(moderation, commentId, content, username, avatar, accountId) {
  selectedId = commentId;
  moderationType = moderation;

  console.log(moderationType);

  document.getElementById("moderationCommentText").textContent = content;
  document.getElementById("moderationCommentUsername").textContent = `${username}: `;
  document.getElementById("moderationCommentAvatar").src = avatar;
  document.getElementById("moderationCommentAccountLink").href = `/account?id=${accountId}`;
  
  document.getElementById("moderationModal").classList.remove("hidden");
}

function closeModerationModal() {
  document.getElementById("moderationModal").classList.add("hidden");
}

function deleteComment() {
  console.log(moderationType);
  if (!confirm("Are you sure you want to delete this content?")) return;

  let uri = moderationType === "comment" ? `/admin/ban_comment?commentId=${selectedId}` : `/admin/ban_blog?blogId=${selectedId}&authorId=${<?= $author_id ?>}`; 

  fetch(`${uri}`, { method: 'PATCH' })
    .then(res => res.json())
    .then(data => alert(data.message || "Comment deleted."))
    .finally(closeModerationModal);

    // window.location.reload();
}

function banUser() {
  if (!confirm("Ban the user who posted this content?")) return;
  
  let uri = moderationType === "comment" ? `/admin/ban_user?id=${selectedId}&by=comment` : `/admin/ban_user?id=${<?= $author_id ?>}`; 
  
  fetch(`${uri}`, { method: 'PATCH' })
    .then(res => res.json())
    .then(data => alert(data.message || "User banned."))
    .finally(closeModerationModal);

    window.location.reload();
}
</script>



<?php view("partials/footer.php"); ?>
