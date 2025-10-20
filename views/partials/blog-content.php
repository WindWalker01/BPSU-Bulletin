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
        <p class="text-text-primary text-s"><?= $username ?? "Unknown" ?></p>
        <p class="text-s mx-0.5">  &bull;  </p>
        <p class="text-text-secondary text-s">Published on <?= $date ?></p>
    </div>

    <!-- Blog Content -->
    <article class="tiptap-content mb-12">
        <?= $blog_html ?>
    </article>
    
</div>