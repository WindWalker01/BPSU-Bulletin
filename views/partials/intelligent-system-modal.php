
<!-- TOXICITY WARNING MODAL -->
<div 
  id="toxicityModal" 
  class="<?= $_GET["error"] === "content_not_safe"
      ? ""
      : "hidden" ?> fixed inset-0 bg-overlay-dark/80 backdrop-blur-sm flex items-center justify-center z-50"
>
  <div 
    class="bg-overlay-dark rounded-2xl shadow-xl w-[90%] max-w-md p-6 border border-card-dark animate-fade-up"
  >
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-text-primary">Content Warning</h2>
      <button 
        type="button" 
        onclick="closeToxicityModal()" 
        class="text-text-secondary hover:text-text-primary transition"
      >
        <span class="material-symbols-outlined">close</span>
      </button>
    </div>

    <!-- Message -->
    <p class="text-sm font-medium text-text-primary mb-1">
      Your content may violate our Community Guidelines.
    </p>
    <p class="text-xs text-text-secondary mb-4" id="toxicityMessage">
      Our Intelligent System detected possible <span class="text-red-400 font-semibold">toxic</span> or <span class="text-yellow-400 font-semibold">spam</span> language.  
      Please review your content.
    </p>

    <!-- ACTION BUTTONS -->
    <div class="flex justify-end mt-5 gap-2">
      <button 
        type="button" 
        onclick="closeToxicityModal()" 
        class="px-3 py-1.5 text-sm rounded-md text-text-secondary hover:text-text-primary transition"
      >
        I Understand
      </button>
    </div>
  </div>
</div>


<script>
    
function closeToxicityModal() {
  document.getElementById('toxicityModal').classList.add('hidden');
}


</script>