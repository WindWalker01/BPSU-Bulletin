<div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

    <h1 class="text-3xl font-bold text-text-primary mb-10">Settings</h1>

    <section class="mb-8">
        <h2 class="text-xl font-semibold text-text-primary ">Account</h2>
        <div class="border-b border-card-dark mt-4"></div>
        <a href="/user_profile" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                    <span class="material-symbols-outlined  text-brand">person</span>
                </div>
                <div>
                    <p class="text-text-primary font-medium">Account Settings</p>
                    <p class="text-text-secondary text-sm">Manage your account details, including your name, email, and password.</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </a>
    </section>

    <section class="mb-8">
        <h2 class="text-xl font-semibold text-text-primary mb-4">Preferences</h2>
            <div class="border-b border-card-dark mt-4"></div>
        <a href="preferences" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-brand">shield</span>
                </div>
                <div>
                    <p class="text-text-primary font-medium">Preferences</p>
                    <p class="text-text-secondary text-sm">Customize how you receive notifications, including email and in-app alerts.</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </a>
    </section>

    <section class="mb-8">
        <h2 class="text-xl font-semibold text-text-primary mb-4">Contribution</h2>
            <div class="border-b border-card-dark mt-4"></div>
        <a href="data" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-brand">edit_note</span>
                </div>
                <div>
                    <p class="text-text-primary font-medium">Want to be an Author?</p>
                    <p class="text-text-secondary text-sm">Find out how you can contribute and share your expertise with the community.</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </a>
    </section>

    <section class="mb-8">
        <h2 class="text-xl font-semibold text-text-primary mb-4">Feedback</h2>
                    <div class="border-b border-card-dark mt-4"></div>
        <a href="feedback" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-brand">feedback</span>
                </div>
                <div>
                    <p class="text-text-primary font-medium">Provide Feedback</p>
                    <p class="text-text-secondary text-sm">Share your thoughts and suggestions with us.</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </a>
    </section>
     <section class="mb-8">
        <h2 class="text-xl font-semibold text-text-primary mb-4">Learn About Bulletin</h2>
                    <div class="border-b border-card-dark mt-4"></div>
        <a href="/about" class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-brand/20 flex items-center justify-center">
                    <span class="material-symbols-outlined text-brand">contract</span>
                </div>
                <div>
                    <p class="text-text-primary font-medium">Explore the BPSU Bulletin</p>
                    <p class="text-text-secondary text-sm">Find details about our purpose, policies, and contact page.</p>
                </div>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </a>
    </section>

    <section class="">
        <h2 class="text-xl font-semibold text-text-brand mb-4">Account Removal</h2>
        <div class="border-b border-card-dark mt-4"></div>
        
        <button id="open-deactivate-modal" type="button" class="flex w-full items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group">
            <div>
                <p class="text-brand-hover font-medium group-hover:text-brand-hover/85 transition-colors text-left">Deactivate account</p>
                <p class="text-text-secondary text-sm text-left">Deactivating will suspend your account until you sign back in.</p>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </button>
        
        <button id="open-delete-modal" type="button" class="flex w-full items-center justify-between py-4 px-2 -mx-2 rounded-lg hover:bg-brand/5 transition-colors duration-200 group mt-2">
            <div>
                <p class="text-brand-hover font-medium group-hover:text-brand-hover/85 transition-colors text-left">Delete account</p>
                <p class="text-text-secondary text-sm text-left">Permanently delete your account and all your content.</p>
            </div>
            <span class="material-symbols-outlined text-text-secondary">chevron_right</span>
        </button>
    </section>

</div>

<div id="confirmation-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4 hidden">
  <div class="w-full max-w-sm rounded-lg border border-card-dark bg-overlay-dark p-6 shadow-lg">
    <h3 id="modal-title" class="text-lg font-bold text-text-primary">Confirm Action</h3>
    <p id="modal-message" class="mt-2 text-sm text-text-secondary">
      Are you sure you want to proceed?
    </p>

    <form id="modal-form" method="POST" class="mt-6 flex justify-end gap-4">
      
      <input type="hidden" id="modal-method-input" name="_method" value="POST">
      
      <button id="modal-cancel-btn" type="button" class="rounded-lg bg-card-dark px-4 py-2 text-sm font-medium text-text-primary transition-colors hover:bg-card-dark/70">
        Cancel
      </button>
      <button id="modal-confirm-btn" type="submit" class="rounded-lg bg-brand px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-brand-hover">
        Confirm
      </button>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  // --- Get Modal Elements ---
  const modal = document.getElementById('confirmation-modal');
  const modalForm = document.getElementById('modal-form');
  const modalTitle = document.getElementById('modal-title');
  const modalMessage = document.getElementById('modal-message');
  const modalCancelBtn = document.getElementById('modal-cancel-btn');
  const modalConfirmBtn = document.getElementById('modal-confirm-btn');
  const modalMethodInput = document.getElementById('modal-method-input');

  // --- Get Button Triggers ---
  const deactivateBtn = document.getElementById('open-deactivate-modal');
  const deleteBtn = document.getElementById('open-delete-modal');

  // --- Modal Open/Close Functions ---
  const openModal = () => modal.classList.remove('hidden');
  const closeModal = () => modal.classList.add('hidden');

  // --- Attach Listeners ---
  
  // 1. Open Deactivate Modal
  deactivateBtn.addEventListener('click', () => {
    modalTitle.textContent = 'Deactivate Account?';
    modalMessage.textContent = 'Your profile and posts will be hidden until you log back in. Are you sure?';
    modalConfirmBtn.textContent = 'Deactivate';
    
    // Set form to POST (soft delete)
    modalForm.action = '/account/deactivate';
    modalMethodInput.value = 'POST';
    
    // Make button normal red
    modalConfirmBtn.classList.remove('bg-red-700', 'hover:bg-red-800');
    modalConfirmBtn.classList.add('bg-brand', 'hover:bg-brand-hover');

    openModal();
  });

  // 2. Open Delete Modal
  deleteBtn.addEventListener('click', () => {
    modalTitle.textContent = 'Delete Account?';
    modalMessage.textContent = 'This action is permanent and cannot be undone. All your posts, comments, and data will be lost forever.';
    modalConfirmBtn.textContent = 'Delete Forever';
    
    // Set form to DELETE (hard delete)
    modalForm.action = '/account/delete';
    modalMethodInput.value = 'DELETE'; // This assumes your router handles a _method field

    // Make button a scarier red
    modalConfirmBtn.classList.remove('bg-brand', 'hover:bg-brand-hover');
    modalConfirmBtn.classList.add('bg-red-700', 'hover:bg-red-800'); // A different, more dangerous red
    
    openModal();
  });

  // 3. Modal Close Listeners
  modalCancelBtn.addEventListener('click', closeModal);
  modal.addEventListener('click', (e) => {
    // Close if backdrop is clicked
    if (e.target === modal) {
      closeModal();
    }
  });
});
</script>

<?php view("partials/footer.php"); ?>