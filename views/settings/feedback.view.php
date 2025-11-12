<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <!-- Back Button -->
  <a
    href="/settings"
    class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group"
  >
    <span
      class="material-symbols-outlined transition-transform group-hover:-translate-x-1"
      >arrow_back</span
    >
    Back
  </a>

  <h1 class="text-3xl font-bold text-text-primary mb-2">Submit Feedback</h1>
  <p class="text-text-secondary mb-10">
    We'd love to hear your thoughts. Let us know how we can improve.
  </p>

  <!-- Feedback Form -->
  <form id="feedbackForm" novalidate>
    <div class="space-y-6">
      <!-- Feedback Type -->
      <div>
        <label for="feedback-type" class="block text-sm font-medium text-text-primary">
          Feedback type
        </label>
        <div class="relative mt-1">
          <select
            id="feedback-type"
            name="feedback-type"
            class="block w-full appearance-none bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
          >
            <option>Bug Report</option>
            <option>Feature Request</option>
            <option>General Feedback</option>
          </select>
          <span
            class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none"
            >expand_more</span
          >
        </div>
      </div>

      <!-- Title -->
      <div>
        <label for="title" class="block text-sm font-medium text-text-primary">
          Title
        </label>
        <div class="mt-1">
          <input
            type="text"
            name="title"
            id="title"
            class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
            placeholder="e.g., Improve dashboard loading speed"
            required
          />
        </div>
        <p id="titleError" class="mt-2 text-sm text-red-500 hidden" role="alert"></p>
      </div>

      <!-- Description -->
      <div>
        <label for="description" class="block text-sm font-medium text-text-primary">
          Description
        </label>
        <div class="mt-1">
          <textarea
            id="description"
            name="description"
            rows="5"
            class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
            placeholder="Please provide as much detail as possible..."
            required
          ></textarea>
        </div>
        <p id="descriptionError" class="mt-2 text-sm text-red-500 hidden" role="alert"></p>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-end pt-4">
        <button
          id="feedbackSubmitBtn"
          type="submit"
          class="bg-brand text-text-primary px-6 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-bg-dark focus:ring-brand-hover"
        >
          Submit Feedback
        </button>
      </div>
    </div>
  </form>
</div>


<div
  id="feedbackModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
  aria-hidden="true"
  role="dialog"
  aria-modal="true"
  aria-labelledby="feedbackModalTitle"
>
  <div class="max-w-md w-full bg-bg-dark rounded-2xl p-6 shadow-lg">
    <h2 id="feedbackModalTitle" class="text-lg font-semibold text-text-primary mb-2">
      Thank you for your feedback!
    </h2>
    <p class="text-text-secondary mb-4">
      We appreciate your feedback! We'll review it and act accordingly.
    </p>
    <div class="flex justify-end">
      <button
        id="feedbackCloseBtn"
        class="px-4 py-2 rounded-lg bg-card-dark hover:bg-card-dark/80 text-text-primary focus:outline-none focus:ring-2 focus:ring-brand"
      >
        Close
      </button>
    </div>
  </div>
</div>

<script>
  const feedbackForm = document.getElementById("feedbackForm");
  const feedbackModal = document.getElementById("feedbackModal");
  const feedbackCloseBtn = document.getElementById("feedbackCloseBtn");

  function openFeedbackModal() {
    feedbackModal.classList.remove("hidden");
    feedbackModal.classList.add("flex");
    feedbackModal.setAttribute("aria-hidden", "false");
    feedbackCloseBtn.disabled = true;
    feedbackCloseBtn.classList.add("opacity-50", "cursor-not-allowed");

    setTimeout(() => {
      feedbackCloseBtn.disabled = false;
      feedbackCloseBtn.classList.remove("opacity-50", "cursor-not-allowed");
    }, 3000);
  }

  function closeFeedbackModal() {
    feedbackModal.classList.add("hidden");
    feedbackModal.classList.remove("flex");
    feedbackModal.setAttribute("aria-hidden", "true");
  }


  feedbackCloseBtn.addEventListener("click", () => {
    if (!feedbackCloseBtn.disabled) closeFeedbackModal();
  });
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && !feedbackCloseBtn.disabled) closeFeedbackModal();
  });

  feedbackForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const type = document.getElementById("feedback-type").value.trim();
    const title = document.getElementById("title").value.trim();
    const description = document.getElementById("description").value.trim();

    if (!title || !description) {
      alert("Please fill out all required fields.");
      return;
    }

    const subject = encodeURIComponent(`[${type}] ${title}`);
    const body = encodeURIComponent(
      `Feedback Type: ${type}\nTitle: ${title}\n\nDescription:\n${description}`
    );

    // This is the recipient email you requested
    const recipient = "bpsubulletin@gmail.com";
    const mailtoLink = `mailto:${recipient}?subject=${subject}&body=${body}`;

    // This part opens the user's email client
    const a = document.createElement("a");
    a.href = mailtoLink;
    a.style.display = "none";
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    feedbackForm.reset();

    openFeedbackModal();
  });


  window.addEventListener("pageshow", () => {
    feedbackModal.classList.add("hidden");
    feedbackModal.classList.remove("flex");
  });
</script>
