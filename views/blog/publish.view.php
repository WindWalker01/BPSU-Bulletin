<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="/css/tailwind.css" rel="stylesheet">
    <link href="/css/tiptap.css" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=publish" />
</head>
<body class=" bg-bg-dark bg-background-dark text-foreground-dark [background-image:radial-gradient(circle_at_25%_15%,rgb(192_0_0/0.2),transparent_40%),radial-gradient(circle_at_75%_85%,rgb(192_0_0/0.15),transparent_40%)]">

<div class="flex flex-row w-screen h-screen">

  <!-- Blog Preview -->
  <div class="w-screen h-screen text-text-primary">
    <article class="tiptap-content">
      <div class="flex flex-row justify-center">
        <h1 class="items-center"><?= $title ?></h1>
      </div>
      <?= $tiptap_html ?>
    </article>
  </div>

  <div class="w-screen h-screen flex flex-col justify-center pl-8">
    
    <h1 class="text-xl mb-6 text-text-primary">Publishing to: <span class="font-bold"><?= $username ??
        "Ruzzel Mendoza" ?></span></h1>

    <p class="mb-1.5 text-text-primary">Add some tags for better discoverability and so that readers know what your blog is about.</p>

    <!-- Form for publishing-->
    <form action="" method="POST">
      <input type="hidden" name="_method" value="POST">
      
      <!-- Tags Input -->
      <input type="text" name="tags" id="tags" placeholder="eg. #technology #education #ccst" class="block mb-4 w-xs pl-3 pr-3 py-2 bg-bg-dark/80 rounded-xs text-text-primary placeholder-text-secondary border-1 border-text-primary focus:outline-none focus:border-transparent">
      
      <!-- Scheduling -->
      <div class="hidden" id="schedule-ui">
        <label for="schedule" class="text-text-primary">Schedule a time to publish: </label>
        <input type="datetime-local" value=<?= $date_now ??
            "2018-06-12T19:30" ?> name="schedule" id="schedule"class="block w-xs pl-3 mb-4 pr-3 py-2 bg-bg-dark/80 rounded-xs text-text-primary placeholder-text-secondary border-1 border-text-primary focus:outline-none focus:border-transparent">

        <p class="mb-2 text-text-primary">This story will be published automatically within five minutes of the specified time</p>
      </div>
      
      <!-- Publish Buttons -->
      <div class="flex flex-row gap-4">
        <button type="submit" class="text-text-primary bg-brand p-2 rounded-md">Publish now</button>
        <button id="schedule-for-later" type="button" onclick="ScheduleUI" class="text-sm text-text-secondary">Schedule for later</button>
      </div>

    </form>
  </div>
</div>

<script>
  let scheduleButton = document.getElementById("schedule-for-later");
  scheduleButton.addEventListener("click", () =>  {
    scheduleUI();
  });


  function scheduleUI(){
    let schedule = document.getElementById("schedule-ui");
    if(schedule.classList.contains("hidden")){
      schedule.classList.remove("hidden");
      scheduleButton.textContent = "Cancel scheduling";
    }else{
      schedule.classList.add("hidden");
      scheduleButton.textContent = "Schedule for later";
    }
  }

</script>

<?php view("partials/footer.php"); ?>

