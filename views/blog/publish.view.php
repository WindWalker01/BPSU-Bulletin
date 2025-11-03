<style>
  /* This is the updated style block. 
    It now correctly fades out days from the previous/next month.
  */

  .flatpickr-calendar {
    background: var(--color-overlay-dark) !important;
    border: 1px solid var(--color-card-dark) !important;
    color: var(--color-text-primary) !important;
    border-radius: 0.75rem !important;
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
  }

  /* --- Month/Year Text and Arrows --- */
  .flatpickr-months .flatpickr-month {
    color: var(--color-text-primary) !important;
    fill: var(--color-text-primary) !important;
  }
  .flatpickr-prev-month svg,
  .flatpickr-next-month svg {
    color: var(--color-text-secondary) !important;
    fill: var(--color-text-secondary) !important;
  }
  .flatpickr-prev-month:hover svg,
  .flatpickr-next-month:hover svg {
    color: var(--color-brand) !important;
    fill: var(--color-brand) !important;
  }

  /* --- Month Dropdown --- */
  .flatpickr-monthDropdown-months {
    background: var(--color-overlay-dark) !important;
    border: 1px solid var(--color-card-dark) !important;
    color: var(--color-text-primary) !important;
  }
  .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month {
    background: var(--color-overlay-dark) !important;
    color: var(--color-text-primary) !important;
  }
  .flatpickr-monthDropdown-months .flatpickr-monthDropdown-month:hover {
    background: var(--color-card-dark) !important;
  }

  /* --- Year Input --- */
  .flatpickr-current-month .numInputWrapper {
    color: var(--color-text-primary) !important;
  }
  
  /* --- Days of the Week (Sun, Mon, etc) --- */
  .flatpickr-weekdays {
    border-bottom: 1px solid var(--color-card-dark) !important;
  }
  span.flatpickr-weekday {
    color: var(--color-text-secondary) !important;
    font-weight: 500 !important;
  }
  
  /* --- Day Styling --- */
  .flatpickr-day {
    color: var(--color-text-secondary) !important;
  }
  
  /* ===============================================================
    THIS IS THE NEW FIX: Fades out prev/next month days
    ===============================================================
  */
  .flatpickr-day.prevMonthDay,
  .flatpickr-day.nextMonthDay {
    color: var(--color-text-secondary) !important;
    opacity: 0.3 !important; /* Makes them faint */
  }
  
  .flatpickr-day.flatpickr-disabled {
    color: var(--color-text-secondary) !important;
    opacity: 0.3 !important;
  }
  .flatpickr-day:hover, .flatpickr-day:focus {
    background: var(--color-card-dark) !important;
    color: var(--color-text-primary) !important;
    border-color: var(--color-card-dark) !important;
  }
  .flatpickr-day.selected {
    background: var(--color-brand) !important;
    color: #ffffff !important;
    border-color: var(--color-brand) !important;
  }
  .flatpickr-day.today {
    border-color: var(--color-brand) !important;
    color: var(--color-brand) !important;
  }
  
  /* --- Time Inputs (AM/PM, Hour, Minute) --- */
  .flatpickr-time {
    border-top: 1px solid var(--color-card-dark) !important;
  }
  .flatpickr-time input {
    background: transparent !important;
    color: var(--color-text-primary) !important;
    border: none !important;
    box-shadow: none !important;
  }
  .flatpickr-time .flatpickr-am-pm {
    background: var(--color-card-dark) !important;
    color: var(--color-text-secondary) !important;
    border: 1px solid var(--color-card-dark) !important;
  }
  .flatpickr-time input:hover,
  .flatpickr-time .flatpickr-am-pm:hover,
  .flatpickr-time .flatpickr-am-pm:focus,
  .flatpickr-time .numInputWrapper:hover {
    background: var(--color-card-dark) !important;
    color: var(--color-text-primary) !important;
  }
  .flatpickr-time .flatpickr-am-pm:checked {
    background: var(--color-brand) !important;
    color: #ffffff !important;
    opacity: 0.8 !important;
  }
  .flatpickr-time .flatpickr-time-separator {
    color: var(--color-text-secondary) !important;
  }
  .numInputWrapper:hover,
  .arrowUp:hover, 
  .arrowDown:hover {
    background: var(--color-card-dark) !important;
  }
  .arrowUp {
    border-bottom-color: var(--color-text-secondary) !important;
  }
  .arrowDown {
    border-top-color: var(--color-text-secondary) !important;
  }
</style>

<div class="flex flex-col lg:flex-row w-full min-h-screen  text-text-primary ">

  <div class="w-full lg:w-2/5 flex flex-col justify-center items-center bg-bg-light h-auto lg:h-screen p-6 lg:p-12 overflow-y-auto">
    
    <div class="w-full max-w-md">
      <h1 class="text-3xl font-bold mb-2 text-text-primary">Ready to Publish?</h1>
      
     <p class="mb-4 text-sm text-text-secondary">
        Publishing to <span class="font-medium text-brand"><?= $username ?? $author_name ?></span>.
      </p>
      <p class="mb-4 text-text-secondary ">
        Add tags and choose categories so your readers can easily find your post.
      </p>

      <form action="/blog/publish" method="POST" class="space-y-6">
  <input type="hidden" name="_method" value="PATCH">
  <input type="hidden" name="blog_id" value="<?= $blog_id ?>">
  
  <input type="hidden" name="is_schedule" id="schedule-value" value="">

  <div>
    <label for="tags" class="block text-sm font-medium mb-2 text-text-primary">Tags</label>
    <input 
      type="text" 
      name="tags" 
      id="tags" 
      placeholder="e.g. technology, education, ccst" 
      class="w-full pl-4 pr-4 py-2.5 bg-bg-light rounded-lg text-text-primary placeholder-text-secondary/60 border border-card-dark focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition"
    >
     <p class="text-xs text-text-secondary mt-2">Separate tags with a comma.</p>
  </div>

  <div>
    <label for="categories" class="block text-sm font-medium mb-2 text-text-primary">Category</label>
    <div class="relative group">
      <select 
        name="categories[]" id="categories" 
        class="w-full pl-4 pr-10 py-2.5 bg-bg-light rounded-lg text-text-primary border border-card-dark appearance-none focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition"
        required
      >
        <option value="" disabled selected>Select a category</option>
        <?php foreach ($categories as $c): ?>
          <option value="<?= $c["id"] ?>"><?= $c["value"] ?></option>
        <?php endforeach; ?>
      </select>
      
      <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-text-secondary transition-transform duration-300 group-focus-within:rotate-180">
        <span class="material-symbols-outlined text-xl">
          expand_more
        </span>
      </div>
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-2 text-text-primary">Publish</label>
    <div class="grid grid-cols-2 gap-3">
      <div>
        <input type="radio" name="publish_option" id="publish-now" value="now" class="sr-only peer" checked>
        <label for="publish-now" class="flex flex-col items-center justify-center w-full p-4 rounded-lg border border-card-dark cursor-pointer text-text-secondary peer-checked:border-brand peer-checked:text-brand peer-checked:bg-brand/10 transition hover:bg-overlay-dark">
          <span class="material-symbols-outlined w-6 h-6 mb-1">publish</span>
          <span class="text-sm font-semibold">Publish Now</span>
        </label>
      </div>
      <div>
        <input type="radio" name="publish_option" id="publish-later" value="later" class="sr-only peer">
        <label for="publish-later" class="flex flex-col items-center justify-center w-full p-4 rounded-lg border border-card-dark cursor-pointer text-text-secondary peer-checked:border-brand peer-checked:text-brand peer-checked:bg-brand/10 transition hover:bg-overlay-dark">
          <span class="material-symbols-outlined w-6 h-6 mb-1">schedule</span>
          <span class="text-sm font-semibold">Schedule</span>
        </label>
      </div>
    </div>
  </div>

  <div id="schedule-ui" class="hidden">
    <label for="schedule-picker" class="block text-sm font-medium mb-2 text-text-primary">Publish Date & Time</label>
    <input 
      type="text" 
      id="schedule-picker" 
      name="schedule" 
      placeholder="Select date and time..."
      class="w-full pl-4 pr-4 py-2.5 bg-bg-light rounded-lg text-text-primary placeholder-text-secondary/60 border border-card-dark focus:outline-none focus:border-brand focus:ring-1 focus:ring-brand transition"
    >
  </div>

  <div class="pt-2">
    <button 
      type="submit" 
      id="publish-btn"
      class="w-full bg-brand text-white px-5 py-3 rounded-lg font-bold text-base hover:bg-brand-hover transition"
    >
      Publish Now
    </button>
  </div>
</form>
    </div>
  </div>

<div class="hidden lg:block lg:w-3/5 h-screen overflow-y-auto p-12  bg-overlay-dark border-l border-card-dark">
    <h2 class="text-2xl font-bold text-text-primary mb-2">Live Preview</h2>
    <p class="text-text-secondary italic mb-8">This is how your post will appear to readers.</p>
    
    <div class="text-text-primary">
      <?php view("partials/blog-content.php", [
          "title" => $title,
          "blog_html" => $blog_html,
          "username" => $author_name,
          "published_at" => $published_at,
          "author_profile" => $author_profile,
      ]); ?>
    </div>
  </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', () => {
  if (typeof flatpickr === 'undefined') {
    console.error("Flatpickr library is not loaded. Please add it to your <head>.");
    return;
  }

  const publishNowRadio = document.getElementById('publish-now');
  const publishLaterRadio = document.getElementById('publish-later');
  const scheduleUI = document.getElementById('schedule-ui');
  const schedulePicker = document.getElementById('schedule-picker'); // This is name="schedule"
  const scheduleHiddenValue = document.getElementById('schedule-value'); // This is name="is_schedule"
  const publishBtn = document.getElementById('publish-btn');

  const fp = flatpickr(schedulePicker, {
    enableTime: true,
    dateFormat: "Y-m-d\\TH:i",
    altInput: true, 
    altFormat: "F j, Y at h:i K",
    minDate: "today",
  });

  publishNowRadio.addEventListener('change', () => {
    scheduleUI.classList.add('hidden');
    scheduleHiddenValue.value = ''; // Set 'is_schedule' to empty string
    publishBtn.textContent = 'Publish Now';
  });

  publishLaterRadio.addEventListener('change', () => {
    scheduleUI.classList.remove('hidden');
    scheduleHiddenValue.value = '1'; // Set 'is_schedule' to 1
    publishBtn.textContent = 'Schedule Post';
    
    if (!fp.selectedDates.length) {
      let tomorrow = new Date();
      tomorrow.setDate(tomorrow.getDate() + 1);
      fp.setDate(tomorrow);
    }
  });

});
</script>

<?php view("partials/footer.php"); ?>