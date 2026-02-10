<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-dashboard overflow-hidden">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
        .active-nav {
            background-color: #3211d4;
            color: white !important;
        }
        .active-nav .material-symbols-outlined {
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
        
        /* Filament Table Overrides */
        .fi-ta { border: none !important; box-shadow: none !important; }
        .fi-ta-header { background: transparent !important; border-bottom: 1px solid #e9e7f3 !important; }
        .dark .fi-ta-header { border-color: rgba(255,255,255,0.1) !important; }
        .fi-ta-header-cell-label { font-weight: 800 !important; color: #594c9a !important; text-transform: uppercase !important; font-size: 10px !important; letter-spacing: 0.1em !important; }
        .fi-ta-row:hover { background-color: rgba(240, 239, 245, 0.3) !important; }
        .dark .fi-ta-row:hover { background-color: rgba(255, 255, 255, 0.02) !important; }
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards">
                    <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Manajemen</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/kegiatans">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">assignment</span>
                        <span class="text-sm font-medium">Kegiatan</span>
                    </a>
                    @if($userRole === 'admin')
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/budgets">
                        <span class="material-symbols-outlined text-[20px]">payments</span>
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
                        <p class="text-xs font-bold truncate dark:text-white capitalize">{{ $userName }}</p>
                        <span class="text-[10px] font-bold text-admin-accent uppercase">{{ $userRole }}</span>
                    </div>
                </div>
                <form action="/dashboards/logout" method="post" class="mt-2">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-1.5 text-xs font-bold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        Sign Out
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden bg-background-light dark:bg-background-dark">
            <!-- Top Navigation Bar -->
            <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                        <span class="font-medium">Pages</span>
                        <span class="text-[#594c9a] dark:text-[#a199c9] text-xs">/</span>
                        <span class="text-[#100d1b] dark:text-white font-bold tracking-tight">Pengaturan Anggaran</span>
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
                                <span class="text-xs font-bold text-[#100d1b] dark:text-white leading-none capitalize">{{ $userName }}</span>
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
            <main class="flex-1 overflow-y-auto p-8">
                <div class="max-w-[1400px] mx-auto w-full">
                    <!-- Page Heading -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                        <div>
                            <h1 class="text-[#100d1b] dark:text-white text-3xl font-black tracking-tight uppercase">Pengaturan Anggaran</h1>
                            <p class="text-[#594c9a] dark:text-gray-400 mt-1 font-medium">Kelola dan monitor alokasi anggaran tahunan serta realisasi kegiatan.</p>
                        </div>
                        @if(count($this->getHeaderActions()))
                        <div class="flex items-center gap-3">
                             @foreach($this->getHeaderActions() as $action)
                                {{ $action }}
                             @endforeach
                        </div>
                        @endif
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-6 border border-[#d3cfe7] dark:border-white/10 shadow-sm transition-all hover:shadow-md">
                            <div class="flex justify-between items-start mb-4">
                                <p class="text-[#594c9a] dark:text-gray-400 text-[10px] font-bold uppercase tracking-wider">Total Anggaran Tahunan</p>
                                <div class="p-2 bg-primary/10 rounded-lg">
                                    <span class="material-symbols-outlined text-primary">account_balance</span>
                                </div>
                            </div>
                            <h3 class="text-[#100d1b] dark:text-white text-2xl font-black">Rp {{ number_format($totalBudget, 0, ',', '.') }}</h3>
                            <div class="mt-4 flex items-center gap-2 text-green-600 dark:text-green-400 text-xs font-bold">
                                <span class="material-symbols-outlined text-base">trending_up</span>
                                <span>Total Alokasi Tersimpan</span>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-6 border border-[#d3cfe7] dark:border-white/10 shadow-sm transition-all hover:shadow-md">
                            <div class="flex justify-between items-start mb-4">
                                <p class="text-[#594c9a] dark:text-gray-400 text-[10px] font-bold uppercase tracking-wider">Anggaran Terpakai</p>
                                <div class="p-2 bg-orange-100 dark:bg-orange-900/20 rounded-lg">
                                    <span class="material-symbols-outlined text-orange-600 dark:text-orange-400">shopping_cart_checkout</span>
                                </div>
                            </div>
                            <h3 class="text-[#100d1b] dark:text-white text-2xl font-black">Rp {{ number_format($usedBudget, 0, ',', '.') }}</h3>
                            <div class="mt-4 flex items-center gap-2 text-orange-600 dark:text-orange-400 text-xs font-bold">
                                <span class="material-symbols-outlined text-base">analytics</span>
                                <span>{{ number_format($utilizationRate, 1) }}% Terutilisasi</span>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-6 border border-[#d3cfe7] dark:border-white/10 shadow-sm transition-all hover:shadow-md">
                            <div class="flex justify-between items-start mb-4">
                                <p class="text-[#594c9a] dark:text-gray-400 text-[10px] font-bold uppercase tracking-wider">Sisa Anggaran</p>
                                <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400">savings</span>
                                </div>
                            </div>
                            <h3 class="text-[#100d1b] dark:text-white text-2xl font-black">Rp {{ number_format($remainingBudget, 0, ',', '.') }}</h3>
                            <div class="mt-4 flex items-center gap-2 text-blue-600 dark:text-blue-400 text-xs font-bold">
                                <span class="material-symbols-outlined text-base">info</span>
                                <span>{{ number_format(100 - $utilizationRate, 1) }}% Tersedia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#d3cfe7] dark:border-white/10 shadow-sm overflow-hidden min-h-[500px]">
                        <div class="p-6 border-b border-[#e9e7f3] dark:border-white/10">
                            <h4 class="font-bold text-lg uppercase tracking-tight">Daftar Rincian Anggaran Tahunan</h4>
                        </div>
                        <div class="p-4">
                            {{ $this->table }}
                        </div>
                    </div>

                    <div class="mt-8 text-center pb-8">
                        <p class="text-[10px] text-[#594c9a] dark:text-gray-500 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Success Animation Overlay -->
    @include('filament.resources.budget-resource.pages.success-overlay')
</div>
