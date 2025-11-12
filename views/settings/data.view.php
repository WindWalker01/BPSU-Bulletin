<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <!-- Back Button -->
  <a href="/settings" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
    <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
    Back
  </a>

  <h1 class="text-3xl font-bold text-text-primary mb-2">Author Application</h1>
  <p class="text-text-secondary mb-10">
    Tell us why you'd be a great author for our platform. It's time to publish your ideas.
  </p>

  <!-- Feedback Form -->
  <form id="authorForm" onsubmit="createMailto(event)" novalidate>
    <div class="space-y-6">
      <!-- Email Address -->
      <div>
        <label for="email" class="block text-lg font-medium text-text-primary">Email Address</label>
        <div class="mt-1">
          <input
            type="email"
            id="email"
            name="email"
            aria-required="true"
            aria-describedby="emailError"
            class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
            placeholder="johndoe@gmail.com"
            required
          >
        </div>
        <p id="emailError" class="mt-2 text-sm text-red-500 hidden" role="alert"></p>
      </div>

      <!-- Reason -->
      <div>
        <label for="reason" class="block text-lg font-medium text-text-primary">Why you want to be an Author?</label>
        <div class="mt-1">
          <textarea
            id="reason"
            name="reason"
            rows="5"
            aria-required="true"
            aria-describedby="reasonError"
            class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
            placeholder="Share your experience, expertise, and what topics you're passionate about..."
            required
          ></textarea>
        </div>
        <p id="reasonError" class="mt-2 text-sm text-red-500 hidden" role="alert"></p>
      </div>

      <!-- Submit Button -->
      <div class="flex justify-between pt-4">
        <p class="text-text-secondary">
          Approval takes <span class="text-text-brand">2–3 days.</span> We will notify you by <span class="text-text-brand">email.</span>
        </p>
        <button
          type="submit"
          class="bg-brand text-text-primary px-6 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-bg-dark focus:ring-brand-hover"
        >
          Submit Application
        </button>
      </div>
    </div>
  </form>
</div>

<!-- Popup Modal -->
<div
  id="submittedModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4"
  aria-hidden="true"
  role="dialog"
  aria-modal="true"
  aria-labelledby="submittedTitle"
>
  <div class="max-w-md w-full bg-bg-dark rounded-2xl p-6 shadow-lg">
    <h2 id="submittedTitle" class="text-lg font-semibold text-text-primary mb-2">Thank you for applying!</h2>
    <p class="text-text-secondary mb-4">Wait 2–3 days for confirmation. We will contact you by email.</p>
    <div class="flex justify-end">
      <button
        id="closeModalBtn"
        class="px-4 py-2 rounded-lg bg-card-dark hover:bg-card-dark/80 text-text-primary focus:outline-none focus:ring-2 focus:ring-brand"
      >
        Close
      </button>
    </div>
  </div>
</div>

<script>
  
  function checkEmailExistsMock(email) {
    const existing = ["john.doe@gmail.com", "johndoe@gmail.com", "demo@example.com"];
    return existing.includes(email.toLowerCase());
  }

  function showError(elementId, message) {
    const el = document.getElementById(elementId);
    el.textContent = message;
    el.classList.remove("hidden");
  }

  function hideError(elementId) {
    const el = document.getElementById(elementId);
    el.textContent = "";
    el.classList.add("hidden");
  }

  function setInputErrorVisual(inputEl, hasError) {
    if (hasError) {
      inputEl.classList.add("border-red-600", "ring-1", "ring-red-600");
      inputEl.setAttribute("aria-invalid", "true");
    } else {
      inputEl.classList.remove("border-red-600", "ring-1", "ring-red-600");
      inputEl.removeAttribute("aria-invalid");
    }
  }

  function validateFields() {
    const emailInput = document.getElementById("email");
    const reasonInput = document.getElementById("reason");
    let valid = true;

    if (!emailInput.checkValidity()) {
      showError("emailError", "Please enter a valid email address.");
      setInputErrorVisual(emailInput, true);
      valid = false;
    } else if (checkEmailExistsMock(emailInput.value.trim())) {
      showError("emailError", "An account with this email already exists.");
      setInputErrorVisual(emailInput, true);
      valid = false;
    } else {
      hideError("emailError");
      setInputErrorVisual(emailInput, false);
    }

  
    if (!reasonInput.value.trim()) {
      showError("reasonError", "Please share your experience — this field is required.");
      setInputErrorVisual(reasonInput, true);
      valid = false;
    } else {
      hideError("reasonError");
      setInputErrorVisual(reasonInput, false);
    }

    return valid;
  }

  
  function createMailto(event) {
    event.preventDefault();
    if (!validateFields()) return;

    const email = document.getElementById("email").value.trim();
    const reason = document.getElementById("reason").value.trim();
    const subject = encodeURIComponent("Author Application from " + email);
    const body = encodeURIComponent("Email: " + email + "\n\nReason for applying:\n" + reason);


    window.open(`mailto:bpsubulletin@gmail.com?subject=${subject}&body=${body}`);

    
    const newUrl = window.location.pathname + "?submitted=1";
    window.location.href = newUrl;
  }

  
  function showSubmittedModal() {
    const modal = document.getElementById("submittedModal");
    modal.classList.remove("hidden");
    modal.classList.add("flex");
    modal.setAttribute("aria-hidden", "false");
    const url = new URL(window.location);
    url.searchParams.delete("submitted");
    window.history.replaceState({}, "", url.pathname);
  }

  function hideSubmittedModal() {
    const modal = document.getElementById("submittedModal");
    modal.classList.add("hidden");
    modal.setAttribute("aria-hidden", "true");
  }

  document.getElementById("closeModalBtn").addEventListener("click", hideSubmittedModal);

  document.addEventListener("DOMContentLoaded", () => {
    const params = new URLSearchParams(window.location.search);
    if (params.get("submitted") === "1") {
      showSubmittedModal();
      document.getElementById("authorForm").reset();
    }
  });


  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") hideSubmittedModal();
  });
</script>
