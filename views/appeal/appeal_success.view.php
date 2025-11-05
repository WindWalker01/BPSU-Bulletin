<div class="max-w-2xl mx-auto animate-fade-up my-16 px-4 text-center">
  <div class="bg-overlay-dark rounded-2xl border border-card-dark shadow-lg p-10 space-y-6">
    <!-- Success Icon -->
    <div class="mx-auto w-16 h-16 flex items-center justify-center rounded-full bg-green-500/10 border border-green-500">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
      </svg>
    </div>

    <!-- Text -->
    <div>
      <h1 class="text-2xl font-semibold text-text-primary mb-2">Appeal Submitted Successfully</h1>
      <p class="text-text-secondary text-sm">
        Thank you for submitting your appeal. Our moderation team will review it soon.
      </p>
      <p class="text-text-secondary text-sm mt-2">
        You’ll be notified once a decision is made.
      </p>
    </div>

    <!-- Button -->
    <div>
      <a href="/dashboard"
         class="inline-block bg-brand hover:bg-brand-hover/90 text-white font-medium px-6 py-2 rounded-xl shadow-md transition">
        Return to Dashboard
      </a>
    </div>
  </div>
</div>

<?php view("partials/footer.php"); ?>
