<!DOCTYPE html>
<html lang="en" class="dark">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>You Are Banned — BPSU Bulletin</title>
  <link rel="stylesheet" href="/css/tailwind.css" />
</head>
<body class="min-h-screen flex items-center justify-center bg-[var(--color-bg-dark)] text-[var(--color-text-primary)] p-6">
  <main class="w-full max-w-md bg-[var(--color-overlay-dark)] border border-[var(--color-card-dark)] rounded-2xl p-8 text-center shadow-lg">
    
    <!-- Icon -->
    <div class="flex justify-center mb-5">
      <div class="bg-[var(--color-flag-violent-bg)] p-4 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[var(--color-flag-violent-text)]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M19.07 4.93L4.93 19.07M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
      </div>
    </div>

    <!-- Title -->
    <h1 class="text-2xl font-semibold text-[var(--color-brand)]">Access Denied</h1>

    <!-- Message -->
    <p class="mt-3 text-sm text-[var(--color-text-secondary)]">
      Your account has been permanently banned from the BPSU Bulletin.
    </p>
    <p class="mt-1 text-sm text-[var(--color-text-gray)]">
      You no longer have access to any features of this platform.
    </p>

    <!-- Divider -->
    <div class="mt-6 border-t border-[var(--color-card-dark)]"></div>

    <!-- Info -->
    <div class="mt-6 text-sm text-[var(--color-text-secondary)]">
      <p>This decision is <span class="font-semibold text-[var(--color-flag-violent-text)]">final</span> and cannot be appealed.</p>
      <p class="mt-2">
        If you believe this is a system error, please
        <a href="mailto:admin@bpsubulletin.edu.ph"
           class="text-[var(--color-brand)] hover:text-[var(--color-brand-hover)] font-medium underline underline-offset-2">
          contact an administrator
        </a>
        directly.
      </p>
    </div>

    <!-- Action -->
    <div class="mt-6">
      <a href="/" 
         class="inline-block px-4 py-2 rounded-lg border border-[var(--color-card-dark)] bg-[var(--color-card-light)] text-[var(--color-text-dark)] text-sm font-medium hover:bg-[var(--color-card-dark)] hover:text-[var(--color-text-primary)] transition-colors">
        Return to Home
      </a>
    </div>
  </main>
</body>
</html>
