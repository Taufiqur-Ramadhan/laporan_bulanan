<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-actlog overflow-hidden">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Tailwind CDN -->
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
                    fontFamily: { "display": ["Public Sans", "sans-serif"] },
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
        .active-nav .material-symbols-outlined {
            color: white !important;
        }
        .standalone-actlog {
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
        <!-- ===== SIDEBAR ===== -->
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
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-xs font-medium uppercase tracking-tighter">{{ $userRole === 'admin' ? 'Admin Control Center' : 'Sistem Input Kegiatan' }}</p>
                    </div>
                </div>
            </div>
            <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Menu Utama</p>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards">
                    <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">dashboard</span>
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[20px]">receipt_long</span>
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/settings">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">settings</span>
                        <span class="text-sm font-medium">Pengaturan</span>
                    </a>
                </div>
            </nav>
            <div class="p-4 border-t border-[#e9e7f3] dark:border-[#2d284d]">
                <div class="flex items-center gap-3 p-2">
                    <div class="size-9 rounded-full bg-cover bg-center border-2 border-[#7c3aed]/20" style="background-image: url('{{ $userAvatar }}')"></div>
                    <div class="flex flex-col">
                        <p class="text-xs font-bold truncate capitalize">{{ $userName }}</p>
                        <span class="text-[10px] font-bold text-[#7c3aed] uppercase">{{ $userRole }}</span>
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

        <!-- ===== MAIN CONTENT ===== -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                    <span class="font-medium">Pages</span>
                    <span class="text-xs">/</span>
                    <span class="text-[#100d1b] dark:text-white font-bold">Log Aktivitas</span>
                </div>
                <div class="flex items-center gap-6 border-l border-[#e9e7f3] dark:border-[#2d284d] pl-6">
                    <div class="relative">
                        <button id="notif-btn" onclick="SIGAT.toggleNotifPanel()" class="relative p-1 text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] rounded-full transition-colors">
                            <span class="material-symbols-outlined text-2xl">notifications</span>
                            <span id="notif-badge" class="absolute top-1 right-1 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a1630]" style="display:none"></span>
                        </button>
                        @include('filament.components.notif-panel')
                    </div>
                    <a href="/dashboards/profile" class="flex items-center gap-3 pl-2 group cursor-pointer">
                        <div class="flex flex-col items-end hidden sm:flex text-right">
                            <span class="text-xs font-bold text-[#100d1b] dark:text-white leading-none capitalize">{{ $userName }}</span>
                            <span class="text-[10px] font-bold text-primary uppercase tracking-tighter mt-1">{{ $userRole }}</span>
                        </div>
                        <div class="size-10 rounded-xl overflow-hidden border-2 border-primary/10 group-hover:border-primary transition-all shadow-sm">
                            <img src="{{ $userAvatar }}" alt="Profile" class="w-full h-full object-cover" />
                        </div>
                    </a>
                </div>
            </header>

            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-8 bg-background-light dark:bg-background-dark">
                <div class="max-w-[1400px] mx-auto">

                    <!-- Page Heading -->
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                        <div>
                            <h2 class="text-[#100d1b] dark:text-white text-3xl font-black tracking-tight uppercase">Log Aktivitas</h2>
                            <p class="text-[#594c9a] dark:text-[#a397e0] mt-1 font-medium">Pantau seluruh aktivitas pengguna dan riwayat sistem untuk keperluan audit.</p>
                        </div>
                        <a href="/dashboards/activity-logs" class="flex items-center gap-2 px-4 py-2.5 bg-white dark:bg-[#1a1630] border border-[#e9e7f3] dark:border-[#2d284d] rounded-xl text-sm font-bold hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors shadow-sm">
                            <span class="material-symbols-outlined text-[18px] text-[#594c9a]">refresh</span>
                            Refresh
                        </a>
                    </div>

                    <!-- Stats Overview -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Total Log</p>
                                <div class="size-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-[18px]">receipt_long</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format($total) }}</h3>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Aktivitas Hari Ini</p>
                                <div class="size-8 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-emerald-600 dark:text-emerald-400 text-[18px]">today</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format(\Spatie\Activitylog\Models\Activity::whereDate('created_at', now())->count()) }}</h3>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Aktivitas Bulan Ini</p>
                                <div class="size-8 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-amber-600 dark:text-amber-400 text-[18px]">calendar_month</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format(\Spatie\Activitylog\Models\Activity::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count()) }}</h3>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm p-6 mb-6">
                        <form method="GET" action="/dashboards/activity-logs">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                                <!-- Search -->
                                <div>
                                    <label class="block text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Pencarian</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] text-[20px]">search</span>
                                        <input name="search" value="{{ $search }}" type="text" placeholder="Cari deskripsi atau nama user..." class="w-full pl-10 pr-4 py-2.5 bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                                    </div>
                                </div>

                                <!-- Filter Aksi -->
                                <div>
                                    <label class="block text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Tipe Aksi</label>
                                    <select name="event" class="w-full py-2.5 px-4 bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                        <option value="">Semua Aksi</option>
                                        <option value="created" {{ $event === 'created' ? 'selected' : '' }}>Created</option>
                                        <option value="updated" {{ $event === 'updated' ? 'selected' : '' }}>Updated</option>
                                        <option value="deleted" {{ $event === 'deleted' ? 'selected' : '' }}>Deleted</option>
                                        <option value="login" {{ $event === 'login' ? 'selected' : '' }}>Login</option>
                                    </select>
                                </div>

                                <!-- Tombol -->
                                <div class="flex gap-2">
                                    <button type="submit" class="flex-1 flex items-center justify-center gap-2 bg-primary text-white font-bold py-2.5 rounded-lg text-sm hover:bg-[#280cb0] transition-colors">
                                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                                        Terapkan
                                    </button>
                                    <a href="/dashboards/activity-logs" class="px-3 flex items-center justify-center bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] text-[#594c9a] dark:text-[#a397e0] rounded-lg hover:bg-[#e9e7f3] dark:hover:bg-[#2d284d] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">close</span>
                                    </a>
                                </div>
                            </div>

                            @if($search || $event)
                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <span class="text-xs text-[#594c9a] dark:text-[#a397e0] font-bold">Filter Aktif:</span>
                                @if($search)
                                <span class="flex items-center gap-1 bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">
                                    Cari: "{{ $search }}"
                                </span>
                                @endif
                                @if($event)
                                <span class="flex items-center gap-1 bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold">
                                    Aksi: {{ ucfirst($event) }}
                                </span>
                                @endif
                            </div>
                            @endif
                        </form>
                    </div>

                    <!-- Data Table -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-lg uppercase tracking-tight">Riwayat Aktivitas</h4>
                                <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">
                                    Menampilkan {{ $logs->count() }} dari {{ number_format($total) }} log
                                </p>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-[#f6f6f8] dark:bg-[#131022] border-b border-[#e9e7f3] dark:border-[#2d284d]">
                                    <tr>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Waktu</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Pelaku</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Aksi</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Deskripsi</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Modul</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#f0eff8] dark:divide-[#2d284d]">
                                    @forelse($logs as $log)
                                    <tr class="hover:bg-[#f6f6f8]/60 dark:hover:bg-[#2d284d]/30 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <p class="text-xs font-bold text-[#100d1b] dark:text-white">{{ $log->created_at->format('d M Y') }}</p>
                                            <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]">{{ $log->created_at->format('H:i:s') }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->causer)
                                            <p class="text-sm font-semibold text-[#100d1b] dark:text-white capitalize">{{ $log->causer?->name ?? 'Sistem' }}</p>
                                            <p class="text-[10px] font-bold text-primary uppercase">{{ $log->causer->role ?? '-' }}</p>
                                            @else
                                            <p class="text-sm font-semibold text-[#594c9a] dark:text-[#a397e0]">Sistem</p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $eventColors = [
                                                    'created' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                    'updated' => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400',
                                                    'deleted' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                                                    'login'   => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400',
                                                ];
                                                $colorClass = $eventColors[$log->event] ?? 'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400';
                                            @endphp
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase {{ $colorClass }}">
                                                {{ $log->event ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 max-w-xs">
                                            <p class="text-sm text-[#100d1b] dark:text-white truncate">{{ $log->description }}</p>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($log->subject_type)
                                            <span class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0]">
                                                {{ str_replace('App\\Models\\', '', $log->subject_type) }}
                                                @if($log->subject_id) #{{ $log->subject_id }} @endif
                                            </span>
                                            @else
                                            <span class="text-xs text-[#594c9a]/50">—</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-16 text-center">
                                            <span class="material-symbols-outlined text-[48px] text-[#594c9a]/30 dark:text-[#a397e0]/30 block mb-3">receipt_long</span>
                                            <p class="text-[#594c9a] dark:text-[#a397e0] font-bold">Belum ada log aktivitas</p>
                                            <p class="text-xs text-[#594c9a]/70 dark:text-[#a397e0]/70 mt-1">Log akan muncul setelah ada aktivitas di sistem</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($lastPage > 1)
                        <div class="px-6 py-4 bg-[#f6f6f8] dark:bg-[#131022]/50 flex items-center justify-between border-t border-[#e9e7f3] dark:border-[#2d284d]">
                            <p class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0]">
                                Halaman {{ $currentPage }} dari {{ $lastPage }}
                            </p>
                            <div class="flex gap-1">
                                @if($currentPage > 1)
                                <a href="?page={{ $currentPage - 1 }}&search={{ $search }}&event={{ $event }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                                </a>
                                @endif

                                @php
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage = min($lastPage, $currentPage + 2);
                                @endphp

                                @for($i = $startPage; $i <= $endPage; $i++)
                                <a href="?page={{ $i }}&search={{ $search }}&event={{ $event }}" class="size-8 flex items-center justify-center rounded-lg text-sm font-bold transition-colors {{ $i === $currentPage ? 'bg-primary text-white shadow-md shadow-primary/30' : 'border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#100d1b] dark:text-white hover:bg-gray-50 dark:hover:bg-[#2d284d]' }}">
                                    {{ $i }}
                                </a>
                                @endfor

                                @if($endPage < $lastPage)
                                <span class="size-8 flex items-center justify-center text-[#594c9a] dark:text-[#a397e0] text-sm">…</span>
                                <a href="?page={{ $lastPage }}&search={{ $search }}&event={{ $event }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-sm font-bold text-[#100d1b] dark:text-white hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    {{ $lastPage }}
                                </a>
                                @endif

                                @if($currentPage < $lastPage)
                                <a href="?page={{ $currentPage + 1 }}&search={{ $search }}&event={{ $event }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Security Alert: jika ada banyak aktivitas deleted dalam waktu singkat -->
                    @php
                        $recentDeleteCount = \Spatie\Activitylog\Models\Activity::where('event', 'deleted')
                            ->where('created_at', '>=', now()->subMinutes(30))
                            ->count();
                    @endphp
                    @if($recentDeleteCount >= 3)
                    <div class="mt-6 p-4 bg-orange-50 dark:bg-orange-900/10 border border-orange-200 dark:border-orange-800 rounded-xl flex items-start gap-4">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/30 rounded-lg text-orange-600 dark:text-orange-400 shrink-0">
                            <span class="material-symbols-outlined">warning</span>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-orange-800 dark:text-orange-400">Peringatan Aktivitas Mencurigakan</h4>
                            <p class="text-xs text-orange-700 dark:text-orange-500 mt-1">Terdeteksi <strong>{{ $recentDeleteCount }} penghapusan data</strong> dalam 30 menit terakhir. Harap tinjau aktivitas ini untuk memastikan keamanan data.</p>
                        </div>
                    </div>
                    @endif

                    <div class="mt-8 text-center pb-4">
                        <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]/50 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>
