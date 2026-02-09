<div class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display transition-colors duration-200">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3211d4",
                        "success": "#22c55e",
                        "background-light": "#f6f6f8",
                        "background-dark": "#131022",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer base {
            body {
                font-family: "Public Sans", sans-serif;
            }
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        @keyframes draw-check {
            0% { stroke-dashoffset: 48; }
            100% { stroke-dashoffset: 0; }
        }
        .animate-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: draw-check 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards 0.2s;
        }
        @keyframes progress {
            0% { transform: translateX(-100%); }
            50% { transform: translateX(0%); }
            100% { transform: translateX(100%); }
        }
    </style>

    <header class="w-full bg-white dark:bg-background-dark border-b border-gray-200 dark:border-gray-800 px-6 md:px-10 py-3">
        <div class="flex items-center">
            <div class="flex items-center gap-3 text-primary">
                <div class="size-8 flex items-center justify-center bg-transparent rounded-lg overflow-hidden">
                    <img src="https://tse4.mm.bing.net/th/id/OIP.nlDBMwT5zvAB9btG3QMmVQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="w-full h-full object-contain" />
                </div>
                <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-tight uppercase">SIGAT</h2>
            </div>
            <div class="flex items-center gap-6">
                <div class="size-8 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden border border-gray-100 dark:border-gray-800">
                    <img alt="User Avatar" class="w-full h-full object-cover" src="{{ $userAvatar }}"/>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-[480px] bg-white dark:bg-[#1c192e] rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 overflow-hidden relative">
            <div class="p-8 pb-0 flex flex-col items-center text-center opacity-30 grayscale pointer-events-none select-none">
                <div class="flex items-center gap-3 mb-4 text-left">
                    <div class="w-12 h-12 flex items-center justify-center bg-transparent rounded-xl overflow-hidden">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.nlDBMwT5zvAB9btG3QMmVQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="w-full h-full object-contain" />
                    </div>
                    <div>
                        <h1 class="text-gray-900 dark:text-white text-2xl font-bold leading-tight uppercase">SIGAT</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-[10px] font-medium uppercase tracking-wider">Sistem Input Kegiatan</p>
                    </div>
                </div>
            </div>

            <div class="p-8 pt-4 pb-12 flex flex-col items-center text-center">
                <div class="relative mb-8">
                    <div class="w-24 h-24 rounded-full bg-success/10 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-success flex items-center justify-center shadow-lg shadow-success/20">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                                <path class="animate-check" d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 w-24 h-24 rounded-full border-2 border-success/30 animate-ping opacity-20"></div>
                </div>
                <h2 class="text-2xl font-bold text-[#100d1b] dark:text-white mb-2">Selamat Datang!</h2>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-8">Halo, <strong>{{ $userName }}</strong>. Autentikasi berhasil. Mengarahkan Anda ke Dashboard...</p>
                
                <div class="w-full max-w-[240px] h-1.5 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                    <div class="h-full bg-primary rounded-full w-2/3 animate-[progress_2s_ease-in-out_infinite]"></div>
                </div>
                
                <div class="mt-6 flex items-center gap-2 text-primary font-medium text-xs uppercase tracking-widest">
                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" fill="none" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"></path>
                    </svg>
                    Memuat Data Dashboard
                </div>
            </div>

            <div class="px-8 pb-8 text-center opacity-40">
                <p class="text-xs text-gray-400 dark:text-gray-500">
                    © 2024 SIGAT. All rights reserved.<br/>
                    Sistem Input Kegiatan Instansi Pemerintah
                </p>
            </div>
        </div>
    </main>

    <div class="fixed -z-10 bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-primary/5 to-transparent pointer-events-none"></div>
    <div class="fixed -z-10 top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
    <div class="fixed -z-10 bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -ml-48 -mb-48 pointer-events-none"></div>

    <script>
        // Otomatis redirect ke dashboard setelah 3 detik
        setTimeout(function() {
            window.location.href = "{{ $dashboardUrl }}";
        }, 3000);
    </script>
</div>
