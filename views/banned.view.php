<!DOCTYPE html>
<html lang="en" class="h-full bg-bg-dark text-text-primary">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Banned | BPSU Bulletin</title>
  <link href="/css/tailwind.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
</head>
<body class="flex items-center justify-center min-h-screen bg-bg-dark text-text-primary">
  <div class="bg-overlay-dark border border-card-dark rounded-2xl shadow-xl p-8 w-[90%] max-w-md text-center animate-fade-up">
    <span class="material-symbols-outlined text-6xl text-red-500 mb-4">block</span>
    <h1 class="text-2xl font-semibold mb-2">Your Account Has Been Banned</h1>
    <p class="text-sm text-text-secondary mb-6">
      Your account has been restricted due to violations of our community guidelines.<br>
      You can no longer post, comment, or log in.
    </p>

    <!-- Optional Appeal Section -->
    <div class="space-y-3">
      <p class="text-xs text-text-secondary/80">
        If you believe this was a mistake, you may contact the admin team for review.
      </p>
      <a 
        href="mailto:bpsubulletin@gmail.com" 
        class="inline-flex items-center justify-center px-4 py-2 bg-brand hover:bg-brand-hover rounded-md text-sm text-text-primary transition"
      >
        <span class="material-symbols-outlined text-base mr-1">mail</span>
        Contact Admin
      </a>
    </div>

    <!-- Go Back Home -->
    <div class="mt-6">
      <a 
        href="/" 
        class="text-sm text-text-secondary hover:text-text-primary transition underline underline-offset-4"
      >
        Return to Home
      </a>
    </div>
  </div>
</body>
</html>
