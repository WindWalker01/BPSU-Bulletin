<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="css/tailwind.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=edit_square" />
</head>
<body class="bg-bg-dark/80">
    
     <!-- Header -->
    <header class="bg-bg-dark/80 border-b border-card-dark">
            <div class="flex items-center justify-between w-full h-16 px-4 sm:px-6 lg:px-8">
                <!-- Left Section: Menu + Logo + Search -->
                <div class="flex items-center gap-4 flex-1">
                    <!-- Menu Button -->
                    <button class="text-text-primary hover:text-text-secondary p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>

                    <a href="#" class="flex items-center">
                        <img src="assets/logo.webp" class="w-23" alt="BPSU Bulletin">
                    </a>

                    <div class="flex-1 max-w-xs">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                placeholder="Search" 
                                class="block w-xs pl-10 pr-3 py-2 bg-overlay-dark border-1 border-card-dark rounded-full text-text-primary placeholder-text-secondary focus:outline-none focus:ring-2 focus:ring-brand focus:border-transparent"
                            >
                        </div>
                    </div>
                </div>

                <!-- Right Section: Write + Notifications + Profile -->
                <div class="flex items-center gap-4">
                    <!-- Write Button -->
                    <button class="flex items-center gap-2 text-text-secondary hover:text-text-primary">
                        <span class="material-symbols-outlined">
                            edit_square
                        </span>
                        <span class="text-sm font-medium">Write</span>

                    </button>

                    <!-- Notifications -->
                    <button class="text-text-secondary hover:text-text-primary p-2 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </button>

                    <!-- Profile Picture -->
                    <button class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-brand to-brand-hover flex items-center justify-center text-text-primary font-semibold overflow-hidden">
                            <img src="https://images.jammable.com/voices/f2e3aa8d-e446-4f3b-bce2-bf24c570d5a8.png" alt="Profile" class="w-full h-full object-cover">
                        </div>
                    </button>
                </div>
            </div>
    </header>
