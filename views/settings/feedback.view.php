 <div class="max-w-3xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <!-- Back Button -->
        <a href="/settings" class="inline-flex items-center gap-2 text-text-secondary hover:text-text-primary mb-6 group">
            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
            Back
        </a>

        <h1 class="text-3xl font-bold text-text-primary mb-2">Submit Feedback</h1>
        <p class="text-text-secondary mb-10">We'd love to hear your thoughts. Let us know how we can improve.</p>
        
        <!-- Feedback Form -->
        <form action="#" method="POST">
            <div class="space-y-6">
                
                <!-- Feedback Type -->
                <div>
                    <label for="feedback-type" class="block text-sm font-medium text-text-primary">
                      Feedback type
                    </label>
                    <div class="relative mt-1">
                        <select id="feedback-type" name="feedback-type" class="block w-full appearance-none bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 pr-10 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent">
                            <option>Bug Report</option>
                            <option>Feature Request</option>
                            <option>General Feedback</option>
                        </select>
                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-text-secondary pointer-events-none">expand_more</span>
                    </div>
                </div>

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-text-primary">
                      Title
                    </label>
                    <div class="mt-1">
                        <input type="text" name="title" id="title" class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent" placeholder="e.g., Improve dashboard loading speed">
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-text-primary">
                      Description
                    </label>
                    <div class="mt-1">
                        <textarea id="description" name="description" rows="5" class="block w-full bg-overlay-dark/50 border border-card-dark text-text-primary rounded-lg py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent" placeholder="Please provide as much detail as possible..."></textarea>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-brand text-text-primary px-6 py-2 rounded-lg text-sm font-medium hover:bg-brand-hover transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-bg-dark focus:ring-brand-hover">
                        Submit Feedback
                    </button>
                </div>

            </div>
        </form>

    </div>

<?php view("partials/footer.php"); ?>