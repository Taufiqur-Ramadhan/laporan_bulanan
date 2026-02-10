<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-dashboard">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Tailwind CDN for specific custom config -->
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
            color: white;
        }
        /* Hard Fix for Filament collision */
        .standalone-dashboard {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            overflow: hidden;
        }
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
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards">
                    <span class="material-symbols-outlined text-[20px]">dashboard</span>
                    <span class="text-sm font-medium">Dashboard</span>
                </a>
                
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Manajemen</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/kegiatans">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">assignment</span>
                        <span class="text-sm font-medium">Kegiatan</span>
                    </a>
                    @if($userRole === 'admin')
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/budgets">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">payments</span>
                        <span class="text-sm font-medium">Pengaturan Anggaran</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">receipt_long</span>
                        <span class="text-sm font-medium">Log Aktivitas</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/users">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">group</span>
                        <span class="text-sm font-medium">Manajemen User</span>
                    </a>
                    @endif
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Pelaporan</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">description</span>
                        <span class="text-sm font-medium">Export</span>
                    </a>
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">System</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/profile">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">person</span>
                        <span class="text-sm font-medium">Profil Pengguna</span>
                    </a>
                </div>
            </nav>
            <div class="p-4 border-t border-[#e9e7f3] dark:border-[#2d284d]">
                <div class="flex items-center gap-3 p-2">
                    <div class="size-9 rounded-full bg-cover bg-center border-2 border-admin-accent/20" style="background-image: url('{{ $userAvatar }}')"></div>
                    <div class="flex flex-col">
                        <p class="text-xs font-bold truncate">{{ $userName }}</p>
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

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                        <span class="font-medium">Pages</span>
                        <span class="text-[#594c9a] dark:text-[#a199c9] text-xs">/</span>
                        <span class="text-[#100d1b] dark:text-white font-bold">Dashboard</span>
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

            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="text-left">
                        <h2 class="text-2xl font-bold text-[#100d1b] dark:text-white uppercase">Selamat datang, {{ $userName }}! 👋</h2>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-sm mt-1">Overview statistik sistem dan manajemen kegiatan seluruh unit kerja.</p>
                    </div>
                    <div class="flex gap-3">
                        @if($userRole === 'anggota')
                        <a href="/dashboards/kegiatans" class="flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-purple-500/20 hover:bg-admin-accent/90 transition-all active:scale-95">
                            <span class="material-symbols-outlined text-lg">add_circle</span>
                            Kelola Kegiatan
                        </a>
                        @elseif($userRole === 'admin')
                        <a href="/dashboards/reports" class="flex items-center gap-2 bg-admin-accent text-white px-5 py-2.5 rounded-xl font-semibold text-sm shadow-lg shadow-purple-500/20 hover:bg-admin-accent/90 transition-all active:scale-95">
                            <span class="material-symbols-outlined text-lg">description</span>
                            Export Data
                        </a>
                        <a href="/dashboards/activity-logs" class="flex items-center gap-2 bg-white dark:bg-[#1a1630] text-[#100d1b] dark:text-white border border-[#e9e7f3] dark:border-[#2d284d] px-5 py-2.5 rounded-xl font-semibold text-sm shadow-sm hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-all active:scale-95">
                            <span class="material-symbols-outlined text-lg">history</span>
                            Audit Log
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-[#1a1630] p-6 rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="size-10 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">analytics</span>
                            </div>
                        </div>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider text-left">Total Seluruh Kegiatan</p>
                        <h3 class="text-2xl font-bold mt-1 text-left">{{ number_format($totalKegiatan) }}</h3>
                    </div>
                    <div class="bg-white dark:bg-[#1a1630] p-6 rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="size-10 bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">rule</span>
                            </div>
                        </div>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider text-left">Menunggu Persetujuan</p>
                        <h3 class="text-2xl font-bold mt-1 text-left">{{ number_format($pendingKegiatan) }}</h3>
                    </div>
                    <div class="bg-white dark:bg-[#1a1630] p-6 rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="size-10 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">account_balance_wallet</span>
                            </div>
                        </div>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider text-left">Anggaran Terpakai</p>
                        <h3 class="text-2xl font-bold mt-1 text-left">Rp {{ number_format($totalAnggaran / 1000000, 1) }}M</h3>
                    </div>
                    <div class="bg-white dark:bg-[#1a1630] p-6 rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                        <div class="flex items-center justify-between mb-4">
                            <div class="size-10 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined">group</span>
                            </div>
                        </div>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider text-left">Total User Aktif</p>
                        <h3 class="text-2xl font-bold mt-1 text-left">{{ number_format($totalUser) }}</h3>
                    </div>
                </div>

                <!-- Global Activity Stats -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] p-6 shadow-sm">
                        <div class="flex items-center justify-between mb-6">
                            <div class="text-left">
                                <h4 class="font-bold text-lg uppercase">Statistik Aktivitas Global ({{ now()->year }})</h4>
                                <p class="text-xs text-[#594c9a]">Tren frekuensi input kegiatan per bulan di seluruh unit kerja</p>
                            </div>
                        </div>
                        <div class="h-64 flex items-end justify-between gap-4 px-2">
                            @php
                                $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                                $maxMonthly = max($monthlyActivityStats ?: [0]) ?: 1;
                            @endphp
                            @foreach($monthNames as $index => $name)
                                @php 
                                    $monthNum = $index + 1;
                                    $count = $monthlyActivityStats[$monthNum] ?? 0;
                                    // Calculate height proportionally to 200px (standard height for the flex container)
                                    $height = ($count / $maxMonthly) * 200;
                                @endphp
                                <div class="flex-1 flex flex-col items-center gap-2">
                                    <div class="w-full bg-admin-accent/10 dark:bg-admin-accent/20 rounded-t-lg relative group" style="height: {{ max($height, 8) }}px">
                                        <div class="absolute inset-x-0 bottom-0 bg-primary rounded-t-lg transition-all group-hover:bg-admin-accent h-full"></div>
                                        @if($count > 0)
                                        <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-primary text-white text-[11px] font-black px-2 py-1 rounded shadow-lg opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                            {{ $count }}
                                        </div>
                                        @endif
                                    </div>
                                    <span class="text-[10px] {{ $monthNum == now()->month ? 'text-primary font-black scale-110' : 'text-[#594c9a] font-bold' }} uppercase transition-all">{{ $name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] p-6 shadow-sm flex flex-col">
                        <h4 class="font-bold text-lg mb-4 uppercase text-left">Informasi Sistem</h4>
                        <div class="space-y-4 flex-1">
                            <div class="p-4 bg-gray-50 dark:bg-[#2d284d]/30 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d]">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-xs font-bold uppercase tracking-wider text-[#594c9a]">Server Status</span>
                                    <span class="flex items-center gap-1.5 text-[10px] font-bold text-emerald-600">
                                        <span class="size-2 bg-emerald-500 rounded-full animate-pulse"></span> ONLINE
                                    </span>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between text-[10px]">
                                        <span class="text-[#594c9a] font-bold uppercase">Memory Usage</span>
                                        <span class="font-bold">28%</span>
                                    </div>
                                    <div class="w-full h-1.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                        <div class="bg-admin-accent h-full w-[28%]"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-3">
                                <p class="text-[10px] font-bold text-[#594c9a] uppercase text-left border-b border-[#f0eff8] pb-1">Ringkasan Hari Ini</p>
                                <div class="flex items-center justify-between p-3 rounded-lg bg-indigo-50 dark:bg-indigo-900/10 border border-indigo-100 dark:border-indigo-900/20 text-left">
                                    <div>
                                        <p class="text-[10px] font-bold text-indigo-600 uppercase">Input Baru</p>
                                        <p class="text-lg font-black text-indigo-900 dark:text-indigo-200">{{ $inputHariIni }}</p>
                                    </div>
                                    <span class="material-symbols-outlined text-indigo-400">event_available</span>
                                </div>
                                <div class="flex items-center justify-between p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-100 dark:border-emerald-900/20 text-left">
                                    <div>
                                        <p class="text-[10px] font-bold text-emerald-600 uppercase">Unit Teraktif</p>
                                        <p class="text-xs font-black text-emerald-900 dark:text-emerald-200 truncate w-32">
                                            {{ $globalActivityStats->sortByDesc('total')->first()?->unit_kerja ?? '-' }}
                                        </p>
                                    </div>
                                    <span class="material-symbols-outlined text-emerald-400">workspace_premium</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities Table -->
                <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between">
                        <div class="text-left">
                            <h4 class="font-bold text-lg uppercase">Kegiatan Terbaru</h4>
                            <p class="text-xs text-[#594c9a]">Daftar input kegiatan terbaru dari sistem</p>
                        </div>
                        <a href="/dashboards/kegiatans" class="bg-background-light dark:bg-[#2d284d] px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-background-light dark:bg-[#1a1630] text-[10px] uppercase text-[#594c9a] dark:text-[#a397e0] font-bold tracking-widest border-b border-[#e9e7f3] dark:border-[#2d284d]">
                                <tr>
                                    <th class="px-6 py-4">Nama Kegiatan</th>
                                    <th class="px-6 py-4">Penginput</th>
                                    <th class="px-6 py-4">Anggaran</th>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-[#e9e7f3] dark:divide-[#2d284d]">
                                @forelse($recentKegiatans as $kegiatan)
                                <tr class="hover:bg-gray-50 dark:hover:bg-[#2d284d]/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-semibold">{{ $kegiatan->nama_kegiatan }}</p>
                                        <span class="text-[10px] text-[#594c9a]">ID: ACT-{{ str_pad($kegiatan->id, 5, '0', STR_PAD_LEFT) }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-semibold">{{ $kegiatan->user->name }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-xs font-bold text-primary">Rp {{ number_format($kegiatan->anggaran, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-xs">{{ $kegiatan->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-4">
                                        <span class="flex items-center gap-1.5 text-[10px] font-bold px-2 py-1 rounded-full w-fit {{ $kegiatan->status === 'pending' ? 'text-amber-600 bg-amber-50' : 'text-emerald-600 bg-emerald-50' }}">
                                            <span class="size-1.5 rounded-full {{ $kegiatan->status === 'pending' ? 'bg-amber-600' : 'bg-emerald-600' }}"></span> 
                                            {{ strtoupper($kegiatan->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 text-sm">Belum ada data kegiatan terbaru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
