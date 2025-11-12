

<div class="max-w-3xl mx-auto animate-fade-up my-10 px-4">
  <!-- Header -->
  <h1 class="text-2xl sm:text-3xl font-semibold mb-2">Submit an Appeal</h1>
  <p class="text-sm text-text-secondary mb-8">
    If your content or account has been moderated, you can request a review by submitting an appeal below.
  </p>

  <form action="/appeal" method="POST"
        class="bg-overlay-dark rounded-2xl shadow-lg border border-card-dark p-6 space-y-6">
    <!-- Select Content -->
     <input type="hidden" name="_method" value="POST">
    <div>
      <label for="content_id" class="block text-sm font-medium mb-2 text-text-secondary">
        Select the moderated content
      </label>
      <select id="content_id" name="blog_id"
        class="w-full rounded-xl bg-card-dark border border-card-dark text-text-primary px-4 py-2 focus:ring-2 focus:ring-brand focus:outline-none">
        <option value="">-- Choose content --</option>
        <?php foreach ($banned_blogs as $item): ?>
          <option value="<?= $item["id"] ?>">
            <?= htmlspecialchars($item["title"]) ?> (<?= $item[
     "blog_status"
 ] ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Reason -->
    <div>
      <label for="reason" class="block text-sm font-medium mb-2 text-text-secondary">
        Reason for Appeal <span class="text-brand">*</span>
      </label>
      <textarea id="reason" name="reason" rows="5" required
        class="w-full rounded-xl bg-card-dark border border-card-dark text-text-primary px-4 py-2 resize-none focus:ring-2 focus:ring-brand focus:outline-none"
        placeholder="Explain why this moderation decision should be reconsidered..."></textarea>
    </div>

    <!-- Submit -->
    <div class="flex justify-end">
      <button type="submit"
        class="bg-brand hover:bg-brand/90 text-white font-medium px-6 py-2 rounded-xl shadow-md transition">
        Submit Appeal
      </button>
    </div>
  </form>

  <p class="text-xs text-text-secondary mt-6 text-center">
    Appeals are reviewed by moderators within 3–5 business days. You’ll be notified once a decision is made.
  </p>
</div>


<?php view("partials/footer.php"); ?>
