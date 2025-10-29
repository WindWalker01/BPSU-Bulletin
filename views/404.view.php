<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
      <link href="/css/tailwind.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,1,-50..200" />

    <style type="text/tailwindcss">
        @import "tailwindcss";

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-8px); 
            }
        }

   
        @layer utilities {
            .animate-fade-up {
                opacity: 0;
                animation: fadeUp 1s cubic-bezier(0.22, 1, 0.36, 1) forwards;
            
                animation-timeline: view();
                animation-range: entry 0% cover 35%;
                will-change: opacity, transform;
            }

            .bg-gradient-dark {
                background-image:
                    radial-gradient(circle at 25% 15%, rgba(192, 0, 0, 0.2), transparent 40%),
                    radial-gradient(circle at 75% 85%, rgba(192, 0, 0, 0.15), transparent 40%);
            }

            .fill-1 {

                font-variation-settings: "FILL" 1;
            }

            .animate-float {
                animation: float 2s ease-in-out infinite;
            }
        }

   
        @theme {
            --font-family-sans:
                "Inter", ui-sans-serif, system-ui, sans-serif, "Apple Color Emoji",
                "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";

            --color-brand: #c00000;
            --color-brand-hover: #d55454;

            --color-bg-dark: #f5f5f5;
            --color-card-dark: #e5e5e5;
            --color-overlay-dark: #ffffff;
            --color-bg-light: #ffffff;
            --color-card-light: #e5e5e5;
            --color-text-primary: #000000;
            --color-text-secondary: #737373;
            --color-text-dark: #000000;
            --color-text-gray: #737373;

   
            --color-accent-green: #22c55e;
            --color-accent-light-green: #4ade80;
            --color-accent-dark-green: #248045;
            --color-accent-blue: #3b82f6;
            --color-accent-navy: #406a9d;
        }

      
        .dark {
            --color-bg-dark: #0d0d0d;
            --color-card-dark: #2e2e2e;
            --color-overlay-dark: #1a1a1a;
            --color-bg-light: #0d0d0d;
            --color-card-light: #2e2e2e;
            --color-text-primary: #ffffff;
            --color-text-secondary: #a3a3a3;
            --color-text-dark: #ffffff;
            --color-text-gray: #a3a3a3;
        }

        @layer base {
            body {
                font-family: var(--font-family-sans);
            }
        }
    </style>
</head>
<body class="bg-[var(--color-bg-dark)] text-[var(--color-text-primary)] min-h-screen flex items-center justify-center p-8 bg-gradient-dark overflow-hidden">

    <main class="text-center flex flex-col items-center ">
        
        <!-- "ERROR" Text -->
        <p class="text-white font-extrabold text-4xl tracking-widest uppercase animate-fade-up">
            Error
        </p>

        <!-- 404 Text and Ghost -->
        <div class="relative my-4">
            <!-- Ghost Emoji -->
    
            <div class="text-5xl sm:text-7xl absolute top-0 -right-4 sm:-right-8 md:-right-12 -translate-y-1/4 animate-float" style="animation-delay: 0.1s;">
                👻
            </div>

            <!-- 404 Heading -->
            <h1 class="text-brand bg-clip-text bg-gradient-to-b from-brand to-[#5A0000] text-[40vw] sm:text-[200px] md:text-[250px] lg:text-[300px] font-extrabold leading-none tracking-tighter animate-fade-up" style="animation-delay: 0.1s;">
                404
            </h1>
        </div>

        <!-- Subheadings -->
        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-[var(--color-text-primary)] animate-fade-up" style="animation-delay: 0.2s;">
            You've gone off the <span class="text-[var(--color-brand)]">treyd.</span>
        </h2>
        
        <p class="text-base sm:text-lg text-[var(--color-text-secondary)] mt-2 max-w-xs sm:max-w-lg animate-fade-up" style="animation-delay: 0.3s;">
            This page seems to have wandered outside the campus.
        </p>

        <!-- "Take me Home" Button -->
         <div class="w-full flex justify-end">
                <a href="/" class="mt-8 bg-brand hover:bg-[var(--color-brand-hover)] text-white font-semibold py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition-all duration-300 transform hover:scale-105 animate-fade-up" style="animation-delay: 0.4s;">
       
            <span class="material-symbols-outlined fill-1">
                arrow_back
            </span>
            Take me Home
        </a>
         </div>
        

    </main>

</body>
</html>
