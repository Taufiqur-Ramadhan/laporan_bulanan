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
        <!-- Sidebar Navigation -->
        <aside class="w-64 flex flex-col bg-white dark:bg-[#1a1630] border-r border-[#e9e7f3] dark:border-white/10 shrink-0">
            <div class="p-6 flex flex-col gap-1">
                <div class="flex items-center gap-3">
                    <div class="size-10 rounded-lg bg-primary flex items-center justify-center text-white shadow-lg shadow-primary/20">
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-[#100d1b] dark:text-white text-lg font-bold leading-tight">SIGAT</h1>
                        <p class="text-[#594c9a] dark:text-gray-400 text-[10px] font-bold uppercase tracking-tight">Budgeting System</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-gray-400 hover:bg-[#e9e7f3] dark:hover:bg-white/5 rounded-lg transition-colors" href="/dashboards">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-gray-400 hover:bg-[#e9e7f3] dark:hover:bg-white/5 rounded-lg transition-colors" href="/dashboards/kegiatans">
                    <span class="material-symbols-outlined">assignment</span>
                    <span class="text-sm font-medium">Kegiatan</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 active-nav rounded-lg transition-colors" href="/dashboards/budgets">
                    <span class="material-symbols-outlined">payments</span>
                    <span class="text-sm font-medium">Pengaturan Anggaran</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-gray-400 hover:bg-[#e9e7f3] dark:hover:bg-white/5 rounded-lg transition-colors" href="/dashboards/reports">
                    <span class="material-symbols-outlined">description</span>
                    <span class="text-sm font-medium">Laporan</span>
                </a>
                @if($userRole === 'admin')
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-gray-400 hover:bg-[#e9e7f3] dark:hover:bg-white/5 rounded-lg transition-colors" href="/dashboards/users">
                    <span class="material-symbols-outlined">group</span>
                    <span class="text-sm font-medium">Manajemen Pengguna</span>
                </a>
                @endif
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-gray-400 hover:bg-[#e9e7f3] dark:hover:bg-white/5 rounded-lg transition-colors" href="/dashboards/profile">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="text-sm font-medium">Pengaturan</span>
                </a>
            </nav>
            <div class="p-4 border-t border-[#e9e7f3] dark:border-white/5">
                <form action="/dashboards/logout" method="post">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center gap-2 px-4 py-2.5 bg-red-50 text-red-600 dark:bg-red-900/20 dark:text-red-400 text-sm font-bold rounded-lg hover:bg-red-100 transition-colors">
                        <span class="material-symbols-outlined text-sm">logout</span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden bg-background-light dark:bg-background-dark">
            <!-- Top Navigation Bar -->
            <header class="h-16 flex items-center justify-between px-8 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-white/10 shrink-0 sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <h2 class="text-[#100d1b] dark:text-white text-lg font-bold tracking-tight">SIGAT Budget Management</h2>
                </div>
                <div class="flex items-center gap-6">
                    <div class="hidden md:flex items-center bg-[#f0eff5] dark:bg-white/5 rounded-lg px-3 py-1.5 w-64 border border-transparent focus-within:border-primary transition-all">
                        <span class="material-symbols-outlined text-[#594c9a] text-xl">search</span>
                        <input class="bg-transparent border-none focus:ring-0 text-sm w-full placeholder:text-[#594c9a]/60 dark:text-white" placeholder="Cari data..." type="text"/>
                    </div>
                    <div class="flex items-center gap-2">
                        <button class="p-2 text-[#594c9a] hover:bg-[#f0eff5] dark:hover:bg-white/5 rounded-full relative">
                            <span class="material-symbols-outlined">notifications</span>
                            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a1630]"></span>
                        </button>
                    </div>
                    <div class="flex items-center gap-3 pl-4 border-l border-[#e9e7f3] dark:border-white/10">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-[#100d1b] dark:text-white leading-tight capitalize">{{ $userName }}</p>
                            <p class="text-[10px] text-[#594c9a] dark:text-gray-400 font-bold uppercase leading-tight">{{ $userRole }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden border-2 border-primary/20 shrink-0">
                            <img alt="Avatar User" class="w-full h-full object-cover" src="{{ $userAvatar }}"/>
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
</div>
