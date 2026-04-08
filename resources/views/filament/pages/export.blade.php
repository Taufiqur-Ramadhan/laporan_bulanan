<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-export overflow-hidden">
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
        .active-nav .material-symbols-outlined { color: white !important; }
        .standalone-export {
            position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            z-index: 9999; overflow: hidden;
        }

        /* ===== TOAST ANIMASI ===== */
        @keyframes toastSlideDown {
            from { opacity: 0; transform: translateX(-50%) translateY(-24px); }
            to   { opacity: 1; transform: translateX(-50%) translateY(0); }
        }
        @keyframes toastSlideUp {
            from { opacity: 1; transform: translateX(-50%) translateY(0); }
            to   { opacity: 0; transform: translateX(-50%) translateY(-20px); }
        }
        #export-toast {
            display: none;
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 999999;
        }
        #export-toast.show {
            display: flex;
            animation: toastSlideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }
        #export-toast.hide {
            display: flex;
            animation: toastSlideUp 0.35s ease both;
        }

        /* Tombol export card hover */
        .export-card {
            transition: transform 0.18s ease, box-shadow 0.18s ease, border-color 0.18s ease;
        }
        .export-card:hover { transform: translateY(-2px); }
        .export-card.loading .btn-label { display: none; }
        .export-card.loading .btn-spinner { display: flex; }
        .btn-spinner { display: none; }
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
                        <h1 class="text-xl font-bold leading-none uppercase">SIGAT</h1>
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
                    <!-- Export — AKTIF -->
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-[20px]">file_download</span>
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
                    <span class="font-medium">Pelaporan</span>
                    <span class="text-xs">/</span>
                    <span class="text-[#100d1b] dark:text-white font-bold">Export Data</span>
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
                <div class="max-w-5xl mx-auto">

                    <!-- Page Heading -->
                    <div class="mb-8">
                        <h2 class="text-[#100d1b] dark:text-white text-3xl font-black leading-tight tracking-tight uppercase">Ekspor Data Kegiatan</h2>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-base mt-2">Sesuaikan filter untuk mengunduh laporan aktivitas dalam format Excel atau Word.</p>
                    </div>

                    <!-- Stats mini -->
                    <div class="grid grid-cols-3 gap-4 mb-8">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-4 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm flex items-center gap-3">
                            <div class="size-9 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-[18px]">assignment</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Total Kegiatan</p>
                                <p class="text-xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalKegiatan) }}</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-4 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm flex items-center gap-3">
                            <div class="size-9 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-emerald-600 text-[18px]">check_circle</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Disetujui</p>
                                <p class="text-xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalApproved) }}</p>
                            </div>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-4 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm flex items-center gap-3">
                            <div class="size-9 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-amber-600 text-[18px]">pending</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Menunggu</p>
                                <p class="text-xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalPending) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Filter & Export Card -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl shadow-sm border border-[#e9e7f3] dark:border-[#2d284d] overflow-hidden">

                        <!-- Card Header -->
                        <div class="p-6 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-[22px]">filter_alt</span>
                            <h3 class="text-lg font-black uppercase tracking-tight text-[#100d1b] dark:text-white">Filter Laporan</h3>
                        </div>

                        <!-- Filter Controls -->
                        <div class="p-8">
                            {{-- Filter ini akan di-pass sebagai query string ke link download --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                            
                                <!-- Tanggal -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Tanggal Spesifik</label>
                                    <input type="date" id="filter-tanggal" class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <p class="text-[10px] text-[#594c9a] mt-1 -mb-2">Isi jika ingin spesifik per hari.</p>
                                </div>

                                <!-- Bulan -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Bulan</label>
                                    <div class="relative">
                                        <select id="filter-bulan" class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                            <option value="">Semua Bulan</option>
                                            @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $i => $bln)
                                            <option value="{{ $i + 1 }}" {{ (request('bulan') == $i + 1) ? 'selected' : '' }}>{{ $bln }}</option>
                                            @endforeach
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>

                                <!-- Tahun -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Tahun</label>
                                    <div class="relative">
                                        <select id="filter-tahun" class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                            <option value="">Semua Tahun</option>
                                            @for($y = date('Y'); $y >= 2023; $y--)
                                            <option value="{{ $y }}" {{ (request('tahun') == $y) ? 'selected' : '' }}>{{ $y }}</option>
                                            @endfor
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <!-- Status -->
                                <div class="flex flex-col gap-2">
                                    <label class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Status Kegiatan</label>
                                    <div class="relative">
                                        <select id="filter-status" class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                            <option value="">Semua Status</option>
                                            <option value="approved"  {{ request('status') === 'approved'  ? 'selected' : '' }}>Disetujui</option>
                                            <option value="pending"   {{ request('status') === 'pending'   ? 'selected' : '' }}>Menunggu</option>
                                            <option value="revision"  {{ request('status') === 'revision'  ? 'selected' : '' }}>Perlu Revisi</option>
                                            <option value="rejected"  {{ request('status') === 'rejected'  ? 'selected' : '' }}>Ditolak</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>

                                <!-- Unit Kerja -->
                                <div class="flex flex-col gap-2">
                                <label class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Unit Kerja</label>
                                <div class="relative">
                                    <select id="filter-unit-kerja" class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                        <option value="">Semua Unit Kerja</option>
                                        @foreach($unitKerjaList as $uk)
                                        <option value="{{ $uk }}" {{ request('unit_kerja') === $uk ? 'selected' : '' }}>{{ $uk }}</option>
                                        @endforeach
                                    </select>
                                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                </div>
                            </div>
                            <!-- Akhir Grid Status & Unit Kerja -->
                            </div>

                            <!-- Export Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Excel Card -->
                                <a id="btn-excel" href="#" onclick="openExcelModal(event)"
                                   class="export-card group relative flex flex-col items-start p-6 rounded-xl border-2 border-emerald-500 bg-emerald-50/50 dark:bg-emerald-900/20 shadow-[0_0_20px_rgba(16,185,129,0.12)] text-left overflow-hidden cursor-pointer hover:shadow-[0_0_28px_rgba(16,185,129,0.22)]">
                                    <div class="size-12 bg-emerald-500 rounded-lg flex items-center justify-center text-white mb-4 shadow-lg shadow-emerald-500/20">
                                        <span class="material-symbols-outlined text-3xl">table_view</span>
                                    </div>
                                    <h4 class="text-lg font-black text-emerald-900 dark:text-emerald-400">Ekspor ke Excel</h4>
                                    <p class="text-sm text-emerald-700/80 dark:text-emerald-500/60 mt-1">Unduh data lengkap dalam format <strong>.xlsx</strong> untuk pengolahan data lebih lanjut.</p>
                                    <div class="btn-label absolute top-4 right-4 flex items-center gap-1 bg-white/80 dark:bg-[#1a1630] px-2 py-1 rounded-full text-xs font-bold border border-emerald-100 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-sm">download</span>
                                        Unduh
                                    </div>
                                    <div class="btn-spinner absolute top-4 right-4 items-center gap-1 bg-white/80 dark:bg-[#1a1630] px-2 py-1 rounded-full text-xs font-bold border border-emerald-100 dark:border-emerald-800 text-emerald-600 dark:text-emerald-400">
                                        <span class="material-symbols-outlined text-sm animate-spin">progress_activity</span>
                                        Proses...
                                    </div>
                                </a>

                                <!-- Word Card -->
                                <a id="btn-word" href="#" onclick="openWordModal(event)"
                                   class="export-card group relative flex flex-col items-start p-6 rounded-xl border-2 border-[#e9e7f3] dark:border-[#2d284d] bg-blue-50/30 dark:bg-blue-900/10 hover:border-blue-500 hover:shadow-[0_0_20px_rgba(59,130,246,0.15)] text-left overflow-hidden cursor-pointer transition-all">
                                    <div class="size-12 bg-blue-500/20 dark:bg-blue-500/10 rounded-lg flex items-center justify-center text-blue-600 dark:text-blue-400 mb-4">
                                        <span class="material-symbols-outlined text-3xl">description</span>
                                    </div>
                                    <h4 class="text-lg font-black text-[#100d1b] dark:text-white">Ekspor ke Word</h4>
                                    <p class="text-sm text-[#594c9a] dark:text-[#a397e0] mt-1">Unduh laporan narasi berformat <strong>.docx</strong> lengkap dengan foto kegiatan.</p>
                                    <div class="btn-label absolute top-4 right-4 flex items-center gap-1 bg-white/80 dark:bg-[#1a1630] px-2 py-1 rounded-full text-xs font-bold border border-[#e9e7f3] dark:border-[#2d284d] text-blue-600 dark:text-blue-400 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <span class="material-symbols-outlined text-sm">download</span>
                                        Unduh
                                    </div>
                                    <div class="btn-spinner absolute top-4 right-4 items-center gap-1 bg-white/80 dark:bg-[#1a1630] px-2 py-1 rounded-full text-xs font-bold border border-[#e9e7f3] dark:border-[#2d284d] text-blue-600 dark:text-blue-400">
                                        <span class="material-symbols-outlined text-sm animate-spin">progress_activity</span>
                                        Proses...
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="p-6 bg-[#f6f6f8] dark:bg-[#131022]/50 border-t border-[#e9e7f3] dark:border-[#2d284d] flex flex-col sm:flex-row items-center justify-between gap-4">
                            <div class="flex items-center gap-6 text-xs text-[#594c9a] dark:text-[#a397e0]">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-emerald-500">security</span>
                                    Aman &amp; Terenkripsi
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-emerald-500">update</span>
                                    Data Real-time
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-sm text-primary">help</span>
                                    Butuh bantuan?
                                </div>
                            </div>
                            <p class="text-xs text-[#594c9a] dark:text-[#a397e0] font-medium">
                                {{ number_format($totalKegiatan) }} data kegiatan siap diekspor
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 text-center pb-4">
                        <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]/50 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- Modal Ekspor Excel -->
    <div id="excel-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-[#100d1b]/40 dark:bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeExcelModal()"></div>
        
        <!-- Modal Card -->
        <div class="relative bg-white dark:bg-[#1a1630] w-full max-w-lg rounded-xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-200" id="excel-modal-card">
            <!-- Header -->
            <div class="px-8 pt-8 pb-6 text-center">
                <h2 class="text-2xl font-black text-primary dark:text-white tracking-tight">Opsi Ekspor Excel</h2>
                <p class="text-[#594c9a] dark:text-[#a397e0] mt-2 text-sm leading-relaxed">Pilih format lembar kerja yang sesuai dengan kebutuhan pelaporan Anda.</p>
            </div>
            
            <!-- Options Container -->
            <div class="px-8 space-y-4">
                <!-- Option A : Summary -->
                <button id="opt-summary" onclick="selectExcelType('summary')" class="group w-full flex items-start p-5 rounded-xl border-2 border-primary bg-transparent hover:border-primary/50 hover:bg-primary/5 dark:hover:bg-primary/10 transition-all text-left">
                    <div class="bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 p-3 rounded-lg mr-4 transition-colors group-hover:bg-emerald-500 group-hover:text-white">
                        <span class="material-symbols-outlined block text-2xl">table_chart</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#100d1b] dark:text-white text-lg leading-tight">Tabel Rekapitulasi (1 Sheet)</h3>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-sm mt-1">Semua data digabungkan dalam satu lembar kerja untuk analisis ringkas.</p>
                    </div>
                </button>
                
                <!-- Option B : Separated -->
                <button id="opt-separated" onclick="selectExcelType('separated')" class="group w-full flex items-start p-5 rounded-xl border-2 border-[#e9e7f3] dark:border-[#2d284d] bg-transparent hover:border-primary/50 hover:bg-primary/5 dark:hover:bg-primary/10 transition-all text-left">
                    <div class="bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 p-3 rounded-lg mr-4 transition-colors group-hover:bg-indigo-500 group-hover:text-white">
                        <span class="material-symbols-outlined block text-2xl">layers</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#100d1b] dark:text-white text-lg leading-tight">Rincian Terpisah (Beda Sheet)</h3>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-sm mt-1">Data dipisahkan berdasarkan kegiatan ke dalam lembar kerja berbeda.</p>
                    </div>
                </button>
            </div>
            
            <!-- Footer -->
            <div class="p-8 mt-4 bg-gray-50 dark:bg-[#131022] border-t border-[#e9e7f3] dark:border-[#2d284d] flex flex-col sm:flex-row-reverse gap-3">
                <button onclick="confirmExcelModal(event)" class="flex-1 bg-primary text-white py-3 rounded-xl font-bold shadow-lg hover:bg-blue-800 transition-colors active:scale-95">
                    Mulai Ekspor
                </button>
                <button onclick="closeExcelModal()" class="flex-1 bg-white dark:bg-[#1a1630] border border-[#e9e7f3] dark:border-[#2d284d] text-[#100d1b] dark:text-white py-3 rounded-xl font-bold hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors active:scale-95">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Ekspor Word -->
    <div id="word-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 hidden">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-[#100d1b]/40 dark:bg-black/60 backdrop-blur-sm transition-opacity" onclick="closeWordModal()"></div>
        
        <!-- Modal Card -->
        <div class="relative bg-white dark:bg-[#1a1630] w-full max-w-lg rounded-xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-200" id="word-modal-card">
            <!-- Header -->
            <div class="px-8 pt-8 pb-6 text-center">
                <h2 class="text-2xl font-black text-blue-600 dark:text-blue-400 tracking-tight">Opsi Ekspor Word</h2>
                <p class="text-[#594c9a] dark:text-[#a397e0] mt-2 text-sm leading-relaxed">Pilih format dokumen Word yang sesuai dengan kebutuhan pelaporan Anda.</p>
            </div>
            
            <!-- Options Container -->
            <div class="px-8 space-y-4">
                <!-- Option A : Detailed -->
                <button id="opt-word-detailed" onclick="selectWordType('detailed')" class="group w-full flex items-start p-5 rounded-xl border-2 border-blue-500 bg-transparent hover:border-blue-500/50 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all text-left">
                    <div class="bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 p-3 rounded-lg mr-4 transition-colors group-hover:bg-blue-500 group-hover:text-white">
                        <span class="material-symbols-outlined block text-2xl">description</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#100d1b] dark:text-white text-lg leading-tight">Format Rincian Lengkap</h3>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-sm mt-1">Satu kegiatan per halaman, lengkap dengan deskripsi, keterangan, dan lampiran foto.</p>
                    </div>
                </button>
                
                <!-- Option B : Summary -->
                <button id="opt-word-summary" onclick="selectWordType('summary')" class="group w-full flex items-start p-5 rounded-xl border-2 border-[#e9e7f3] dark:border-[#2d284d] bg-transparent hover:border-blue-500/50 hover:bg-blue-50 dark:hover:bg-blue-900/10 transition-all text-left">
                    <div class="bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 p-3 rounded-lg mr-4 transition-colors group-hover:bg-indigo-500 group-hover:text-white">
                        <span class="material-symbols-outlined block text-2xl">toc</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-[#100d1b] dark:text-white text-lg leading-tight">Format Tabel Rekapitulasi</h3>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-sm mt-1">Daftar baris tabel sederhana untuk merangkum seluruh kegiatan tanpa foto dokumentasi.</p>
                    </div>
                </button>
            </div>
            
            <!-- Footer -->
            <div class="p-8 mt-4 bg-gray-50 dark:bg-[#131022] border-t border-[#e9e7f3] dark:border-[#2d284d] flex flex-col sm:flex-row-reverse gap-3">
                <button onclick="confirmWordModal(event)" class="flex-1 bg-blue-600 text-white py-3 rounded-xl font-bold shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-colors active:scale-95">
                    Mulai Ekspor
                </button>
                <button onclick="closeWordModal()" class="flex-1 bg-white dark:bg-[#1a1630] border border-[#e9e7f3] dark:border-[#2d284d] text-[#100d1b] dark:text-white py-3 rounded-xl font-bold hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors active:scale-95">
                    Batal
                </button>
            </div>
        </div>
    </div>

    <!-- ===== TOAST NOTIFIKASI SUKSES EXPORT ===== -->
    <div id="export-toast" role="alert"
         class="bg-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl items-center gap-3 border border-white/20 min-w-[320px]">
        <span class="material-symbols-outlined text-2xl shrink-0" style="font-variation-settings: 'FILL' 1;">check_circle</span>
        <div class="flex flex-col flex-1">
            <p class="font-black text-sm leading-tight" id="toast-title">Laporan Berhasil Diekspor!</p>
            <p class="text-xs text-emerald-100 mt-0.5" id="toast-subtitle">Cek folder unduhan Anda.</p>
        </div>
        <button onclick="hideToast()" class="ml-2 p-1 hover:bg-white/20 rounded-full transition-colors shrink-0">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>

    <script>
        let toastTimer;
        let activeExcelType = 'summary';
        let activeWordType  = 'detailed';

        /* Ekspor EXCEL */
        function openExcelModal(event) {
            event.preventDefault();
            const modal = document.getElementById('excel-modal');
            const card  = document.getElementById('excel-modal-card');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeExcelModal() {
            const modal = document.getElementById('excel-modal');
            const card  = document.getElementById('excel-modal-card');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function selectExcelType(type) {
            activeExcelType = type;
            const btnSummary   = document.getElementById('opt-summary');
            const btnSeparated = document.getElementById('opt-separated');
            
            if (type === 'summary') {
                btnSummary.classList.add('border-primary');
                btnSummary.classList.remove('border-[#e9e7f3]', 'dark:border-[#2d284d]');
                
                btnSeparated.classList.remove('border-primary');
                btnSeparated.classList.add('border-[#e9e7f3]', 'dark:border-[#2d284d]');
            } else {
                btnSeparated.classList.add('border-primary');
                btnSeparated.classList.remove('border-[#e9e7f3]', 'dark:border-[#2d284d]');
                
                btnSummary.classList.remove('border-primary');
                btnSummary.classList.add('border-[#e9e7f3]', 'dark:border-[#2d284d]');
            }
        }

        function confirmExcelModal(event) {
            closeExcelModal();
            doExport(event, 'excel', activeExcelType);
        }

        /* Ekspor WORD */
        function openWordModal(event) {
            event.preventDefault();
            const modal = document.getElementById('word-modal');
            const card  = document.getElementById('word-modal-card');
            modal.classList.remove('hidden');
            setTimeout(() => {
                card.classList.remove('scale-95', 'opacity-0');
                card.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeWordModal() {
            const modal = document.getElementById('word-modal');
            const card  = document.getElementById('word-modal-card');
            card.classList.remove('scale-100', 'opacity-100');
            card.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 200);
        }

        function selectWordType(type) {
            activeWordType = type;
            const btnDetailed = document.getElementById('opt-word-detailed');
            const btnSummary  = document.getElementById('opt-word-summary');
            
            if (type === 'detailed') {
                btnDetailed.classList.add('border-blue-500');
                btnDetailed.classList.remove('border-[#e9e7f3]', 'dark:border-[#2d284d]');
                
                btnSummary.classList.remove('border-blue-500');
                btnSummary.classList.add('border-[#e9e7f3]', 'dark:border-[#2d284d]');
            } else {
                btnSummary.classList.add('border-blue-500');
                btnSummary.classList.remove('border-[#e9e7f3]', 'dark:border-[#2d284d]');
                
                btnDetailed.classList.remove('border-blue-500');
                btnDetailed.classList.add('border-[#e9e7f3]', 'dark:border-[#2d284d]');
            }
        }

        function confirmWordModal(event) {
            closeWordModal();
            doExport(event, 'word', activeWordType);
        }

        /* CORE EXPORT LOGIC */
        function buildExportUrl(type, customType = null) {
            const tanggal   = document.getElementById('filter-tanggal').value;
            const bulan     = document.getElementById('filter-bulan').value;
            const tahun     = document.getElementById('filter-tahun').value;
            const status    = document.getElementById('filter-status').value;
            const unitKerja = document.getElementById('filter-unit-kerja').value;

            const params = new URLSearchParams();
            if (tanggal)   params.append('tanggal', tanggal);
            if (bulan)     params.append('bulan', bulan);
            if (tahun)     params.append('tahun', tahun);
            if (status)    params.append('status', status);
            if (unitKerja) params.append('unit_kerja', unitKerja);
            
            if (type === 'excel' && customType) {
                params.append('excel_type', customType);
            }
            if (type === 'word' && customType) {
                params.append('word_type', customType);
            }

            const base = type === 'excel'
                ? '/dashboards/reports/export-excel'
                : '/dashboards/reports/export-word';

            return base + (params.toString() ? '?' + params.toString() : '');
        }

        function doExport(event, type, customType = null) {
            if (event) event.preventDefault();

            const card = document.getElementById('btn-' + type);
            if (card) card.classList.add('loading');

            const iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.src = buildExportUrl(type, customType);
            document.body.appendChild(iframe);

            setTimeout(() => {
                if (card) card.classList.remove('loading');
                document.body.removeChild(iframe);

                const label = type === 'excel' ? 'Excel (.xlsx)' : 'Word (.docx)';
                showToast('Laporan Berhasil Diekspor!', 'File ' + label + ' ada di folder unduhan Anda.');
            }, 2500);
        }

        function showToast(title, subtitle) {
            const toast = document.getElementById('export-toast');
            document.getElementById('toast-title').textContent    = title;
            document.getElementById('toast-subtitle').textContent = subtitle;

            toast.classList.remove('hide');
            toast.classList.add('show');

            clearTimeout(toastTimer);
            toastTimer = setTimeout(hideToast, 4500);
        }

        function hideToast() {
            const toast = document.getElementById('export-toast');
            toast.classList.remove('show');
            toast.classList.add('hide');
            setTimeout(() => toast.classList.remove('hide'), 400);
        }
    </script>
</div>
