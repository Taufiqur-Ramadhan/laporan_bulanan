<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-dashboard overflow-hidden">
    <!-- Fonts & Icons -->
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
                        "admin-accent": "#7c3aed",
                        "background-light": "#f6f6f8",
                        "background-dark": "#131022",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>

    <style>
        body { 
            font-family: 'Public Sans', sans-serif; 
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .active-nav {
            background-color: #3211d4;
            color: white !important;
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
        .fi-ta-record:hover { background: rgba(50, 17, 212, 0.02) !important; }
        .dark .fi-ta-record:hover { background: rgba(255, 255, 255, 0.02) !important; }
        
        /* Font Fixes for user complaint */
        .standalone-dashboard * { font-family: 'Public Sans', sans-serif !important; }
        .material-symbols-outlined { font-family: 'Material Symbols Outlined' !important; }
    </style>

    <div class="flex h-screen w-full overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-72 bg-white dark:bg-[#1a1630] border-r border-[#e9e7f3] dark:border-[#2d284d] flex flex-col shrink-0">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="size-10 flex items-center justify-center bg-transparent rounded-lg overflow-hidden shrink-0">
                        <img src="/images/logo.png" alt="Logo" class="w-full h-full object-contain" />
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center gap-1.5">
                            <h1 class="text-xl font-bold leading-none uppercase">SIGAT</h1>
                        </div>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-xs font-medium uppercase tracking-tighter">Admin Control Center</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Menu Utama</p>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 transition-colors" href="/dashboards">
                    <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">dashboard</span>
                    <span class="text-sm font-medium text-[#100d1b] dark:text-white">Dashboard</span>
                </a>
                
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Manajemen</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/kegiatans">
                        <span class="material-symbols-outlined text-[20px]">assignment</span>
                        <span class="text-sm font-medium">Kegiatan</span>
                    </a>
                    @if($userRole === 'admin')
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/budgets">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">payments</span>
                        <span class="text-sm font-medium">Pengaturan Anggaran</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">receipt_long</span>
                        <span class="text-sm font-medium">Log Aktivitas</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/users">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">group</span>
                        <span class="text-sm font-medium">Manajemen User</span>
                    </a>
                    @endif
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Pelaporan</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">description</span>
                        <span class="text-sm font-medium">Export</span>
                    </a>
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">System</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/profile">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">person</span>
                        <span class="text-sm font-medium">Profil Pengguna</span>
                    </a>
                </div>
            </nav>
            <div class="p-4 border-t border-[#e9e7f3] dark:border-[#2d284d]">
                <div class="flex items-center gap-3 p-2">
                    <div class="size-9 rounded-full bg-cover bg-center border-2 border-admin-accent/20" style="background-image: url('{{ $userAvatar }}')"></div>
                    <div class="flex flex-col">
                        <p class="text-xs font-bold truncate dark:text-white">{{ $userName }}</p>
                        <span class="text-[10px] font-bold text-admin-accent uppercase">{{ $userRole }}</span>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                        <span class="font-medium">Pages</span>
                        <span class="text-[#594c9a] dark:text-[#a199c9] text-xs">/</span>
                        <span class="text-[#100d1b] dark:text-white font-bold uppercase tracking-tight">Daftar Kegiatan</span>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-6 border-l border-[#e9e7f3] dark:border-[#2d284d] pl-6">
                        <button class="relative p-1 text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] rounded-full transition-colors">
                            <span class="material-symbols-outlined text-2xl">notifications</span>
                            <span class="absolute top-1 right-1 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a1630]"></span>
                        </button>
                        
                        <div class="flex items-center gap-3 pl-2 group cursor-pointer">
                            <div class="flex flex-col items-end hidden sm:flex text-right">
                                <span class="text-xs font-bold text-[#100d1b] dark:text-white leading-none">{{ $userName }}</span>
                                <span class="text-[10px] font-bold text-primary uppercase tracking-tighter mt-1">{{ $userRole }}</span>
                            </div>
                            <div class="size-10 rounded-xl overflow-hidden border-2 border-primary/10 group-hover:border-primary transition-all shadow-sm">
                                <img src="{{ $userAvatar }}" alt="Profile" class="w-full h-full object-cover" />
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-[1400px] mx-auto">
                    <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h1 class="text-3xl font-black tracking-tight text-[#100d1b] dark:text-white uppercase">Daftar Kegiatan</h1>
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

                    <div class="bg-white dark:bg-[#1a1630] rounded-2xl shadow-sm border border-[#e9e7f3] dark:border-white/10 overflow-hidden min-h-[500px]">
                        {{ $this->table }}
                    </div>

                    <div class="mt-8 text-center pb-8">
                        <p class="text-[10px] text-[#594c9a] dark:text-gray-500 uppercase tracking-widest font-bold">© 2024 SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
