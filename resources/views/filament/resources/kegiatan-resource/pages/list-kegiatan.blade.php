<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-dashboard overflow-hidden">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#3211d4",
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
    <style>
        body {
            font-family: "Public Sans", sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            font-family: 'Material Symbols Outlined' !important;
        }
        .standalone-dashboard {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            overflow: hidden;
        }
        
        /* Filament Overrides */
        .fi-ta { border-radius: 1rem !important; overflow: hidden !important; border: 1px solid #e9e7f3 !important; box-shadow: none !important; }
        .dark .fi-ta { border-color: rgba(255,255,255,0.1) !important; }
        .fi-ta-header { background: #fff !important; border-bottom: 1px solid #e9e7f3 !important; }
        .dark .fi-ta-header { background: #1a1630 !important; border-color: rgba(255,255,255,0.1) !important; }
        .fi-ta-header-cell-label { font-weight: 800 !important; color: #594c9a !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.05em !important; }
    </style>

    <div class="flex h-screen w-full overflow-hidden">
        <!-- Sidebar Navigation -->
        <aside class="w-64 border-r border-[#e9e7f3] dark:border-white/10 bg-white dark:bg-[#1a1630] hidden lg:flex flex-col sticky top-0 h-screen shrink-0">
            <div class="p-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-primary size-10 rounded-lg flex items-center justify-center text-white">
                        <span class="material-symbols-outlined">bolt</span>
                    </div>
                    <div>
                        <h1 class="text-base font-bold leading-none">SIGAT System</h1>
                        <p class="text-xs text-[#594c9a] dark:text-primary/70 mt-1 font-medium">{{ $userRole }}</p>
                    </div>
                </div>
                <nav class="flex flex-col gap-1">
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-primary/5 text-[#594c9a] dark:text-gray-400" href="/dashboards">
                        <span class="material-symbols-outlined text-xl">dashboard</span>
                        Dashboard
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-primary/5 text-[#594c9a] dark:text-gray-400" href="/dashboards/kegiatan/lapor">
                        <span class="material-symbols-outlined text-xl">add_box</span>
                        Input Kegiatan
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium bg-primary/10 text-primary" href="/dashboards/kegiatan">
                        <span class="material-symbols-outlined text-xl" style="font-variation-settings: 'FILL' 1">history</span>
                        Riwayat
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-primary/5 text-[#594c9a] dark:text-gray-400" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-xl">description</span>
                        Laporan
                    </a>
                    <div class="my-4 border-t border-[#e9e7f3] dark:border-white/5"></div>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium hover:bg-primary/5 text-[#594c9a] dark:text-gray-400" href="/dashboards/profile">
                        <span class="material-symbols-outlined text-xl">settings</span>
                        Pengaturan
                    </a>
                </nav>
            </div>
            <div class="mt-auto p-6">
                <div class="bg-primary/5 dark:bg-white/5 rounded-xl p-4">
                    <p class="text-xs font-semibold text-primary uppercase tracking-wider">Pusat Bantuan</p>
                    <p class="text-xs text-[#594c9a] dark:text-gray-400 mt-1">Butuh bantuan teknis?</p>
                    <button class="mt-3 text-xs font-bold text-primary flex items-center gap-1">
                        Hubungi Support <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </button>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col min-w-0 bg-background-light dark:bg-background-dark overflow-hidden">
            <!-- Top Navigation Bar -->
            <header class="flex items-center justify-between px-8 py-4 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-white/10 sticky top-0 z-10 shrink-0">
                <div class="flex items-center gap-8">
                    <h2 class="text-lg font-bold tracking-tight">SIGAT - Sistem Input Kegiatan</h2>
                    <div class="hidden md:flex items-center gap-6">
                        <a class="text-sm font-medium text-[#594c9a] hover:text-primary transition-colors" href="#">Bantuan</a>
                        <a class="text-sm font-medium text-[#594c9a] hover:text-primary transition-colors" href="#">Panduan</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative hidden sm:block">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#594c9a] text-xl pointer-events-none">search</span>
                        <input class="bg-[#e9e7f3] dark:bg-white/5 border-none rounded-lg py-2 pl-10 pr-4 text-sm w-64 focus:ring-2 focus:ring-primary/50 transition-all outline-none text-[#100d1b] dark:text-white placeholder-[#594c9a]" placeholder="Cari data..." type="text"/>
                    </div>
                    <button class="size-10 flex items-center justify-center rounded-lg bg-[#e9e7f3] dark:bg-white/5 text-[#100d1b] dark:text-white hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined">notifications</span>
                    </button>
                    <div class="flex items-center gap-3 pl-2 border-l border-[#e9e7f3] dark:border-white/10">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold leading-none dark:text-white capitalize">{{ $userName }}</p>
                            <p class="text-[10px] text-[#594c9a] dark:text-gray-400 mt-1">Active Now</p>
                        </div>
                        <img class="size-10 rounded-full border-2 border-primary/20 object-cover" src="{{ $userAvatar }}" />
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-[1400px] mx-auto w-full">
                    <!-- Breadcrumbs -->
                    <nav class="flex items-center gap-2 mb-4 text-sm font-medium">
                        <a class="text-[#594c9a] hover:text-primary transition-colors" href="/dashboards">Dashboard</a>
                        <span class="text-[#594c9a]">/</span>
                        <span class="text-primary">Riwayat Kegiatan</span>
                    </nav>
                    
                    <!-- Page Heading -->
                    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-black tracking-tight text-[#100d1b] dark:text-white uppercase transition-colors">Riwayat Kegiatan</h1>
                            <p class="text-[#594c9a] dark:text-gray-400 mt-2 font-medium">Kelola dan pantau seluruh laporan kegiatan unit kerja.</p>
                        </div>
                        @if(count($this->getHeaderActions()))
                        <div class="flex items-center gap-3">
                             @foreach($this->getHeaderActions() as $action)
                                {{ $action }}
                             @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Table Card -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl shadow-sm border border-[#e9e7f3] dark:border-white/10 overflow-hidden min-h-[500px]">
                        {{ $this->table }}
                    </div>

                    <div class="mt-8 text-center pb-8">
                        <p class="text-xs text-[#594c9a] dark:text-gray-500 uppercase tracking-tight">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
