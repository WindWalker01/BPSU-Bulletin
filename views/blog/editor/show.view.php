<?php view("partials/head.php"); ?>
<link rel="stylesheet" href="/dist/assets/index.css">




<script>
      window.__APP_DATA__ = {
        blogId: <?php echo json_encode($blog_id); ?>,
        draftContent: <?php echo json_encode($draft_content); ?>
      };

      console.log(<?= $blog_id ?>);
      console.log(<?= $draft_content ?>);
</script>


<div id="root"></div>

<script src="/dist/assets/index.js"></script>

<?php view("partials/footer.php"); ?>

