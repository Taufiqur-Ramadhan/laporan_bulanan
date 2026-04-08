<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-usermgmt overflow-hidden">
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
        .standalone-usermgmt {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            overflow: hidden;
        }
        /* Modal generik */
        .sg-modal-wrap { display: none; }
        .sg-modal-wrap.active { display: flex; }

        /* Animasi scale-in untuk panel modal */
        @keyframes sgScaleIn {
            from { opacity: 0; transform: scale(0.88) translateY(16px); }
            to   { opacity: 1; transform: scale(1)   translateY(0); }
        }
        .sg-modal-panel {
            animation: sgScaleIn 0.28s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        /* Lingkaran sukses bounce */
        @keyframes sgBounceIn {
            0%   { transform: scale(0); opacity: 0; }
            60%  { transform: scale(1.15); opacity: 1; }
            80%  { transform: scale(0.93); }
            100% { transform: scale(1); }
        }
        .sg-check-circle {
            animation: sgBounceIn 0.55s cubic-bezier(0.34, 1.56, 0.64, 1) 0.12s both;
        }

        /* Fade-in teks sukses */
        @keyframes sgFadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .sg-success-text {
            animation: sgFadeUp 0.4s ease 0.4s both;
        }

        /* Ikon warning shake */
        @keyframes sgShake {
            0%, 100% { transform: translateX(0) rotate(0deg); }
            20%       { transform: translateX(-4px) rotate(-3deg); }
            40%       { transform: translateX(4px) rotate(3deg); }
            60%       { transform: translateX(-3px) rotate(-2deg); }
            80%       { transform: translateX(3px) rotate(2deg); }
        }
        .sg-warn-icon {
            animation: sgShake 0.5s ease 0.2s both;
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">receipt_long</span>
                        <span class="text-sm font-medium">Log Aktivitas</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/users">
                        <span class="material-symbols-outlined text-[20px]">group</span>
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
                    <span class="text-[#100d1b] dark:text-white font-bold">Manajemen User</span>
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
                            <h2 class="text-[#100d1b] dark:text-white text-3xl font-black tracking-tight uppercase">Manajemen User</h2>
                            <p class="text-[#594c9a] dark:text-[#a397e0] mt-1 font-medium">Kelola akun dan hak akses pengguna dalam sistem SIGAT.</p>
                        </div>
                        <button onclick="openCreateModal()" class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-primary/20 hover:bg-[#280cb0] transition-all active:scale-95">
                            <span class="material-symbols-outlined text-[18px]">person_add</span>
                            Tambah User Baru
                        </button>
                    </div>

                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Total Pengguna</p>
                                <div class="size-8 bg-primary/10 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-[18px]">group</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalUsers) }}</h3>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Admin</p>
                                <div class="size-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-[18px]">admin_panel_settings</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalAdmins) }}</h3>
                        </div>
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-5 border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-bold uppercase tracking-wider">Anggota</p>
                                <div class="size-8 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-indigo-600 dark:text-indigo-400 text-[18px]">person</span>
                                </div>
                            </div>
                            <h3 class="text-2xl font-black text-[#100d1b] dark:text-white">{{ number_format($totalAnggota) }}</h3>
                        </div>
                    </div>

                    <!-- Filter Section -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm p-5 mb-6">
                        <form method="GET" action="/dashboards/users">
                            <div class="flex flex-wrap items-end gap-4">
                                <!-- Search -->
                                <div class="flex-1 min-w-[260px]">
                                    <label class="block text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Cari Pengguna</label>
                                    <div class="relative">
                                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] text-[20px]">search</span>
                                        <input name="search" value="{{ $search }}" type="text" placeholder="Cari nama, email, atau unit kerja..." class="w-full pl-10 pr-4 py-2.5 bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                                    </div>
                                </div>

                                <!-- Filter Role -->
                                <div class="w-44">
                                    <label class="block text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Role</label>
                                    <select name="role" class="w-full py-2.5 px-4 bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                        <option value="">Semua Role</option>
                                        <option value="admin" {{ $roleFilter === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="anggota" {{ $roleFilter === 'anggota' ? 'selected' : '' }}>Anggota</option>
                                    </select>
                                </div>

                                <!-- Tombol -->
                                <div class="flex gap-2">
                                    <button type="submit" class="flex items-center gap-2 bg-primary text-white font-bold py-2.5 px-4 rounded-lg text-sm hover:bg-[#280cb0] transition-colors">
                                        <span class="material-symbols-outlined text-[18px]">filter_list</span>
                                        Filter
                                    </button>
                                    @if($search || $roleFilter)
                                    <a href="/dashboards/users" class="flex items-center justify-center px-3 bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] text-[#594c9a] dark:text-[#a397e0] rounded-lg hover:bg-[#e9e7f3] dark:hover:bg-[#2d284d] transition-colors">
                                        <span class="material-symbols-outlined text-[20px]">close</span>
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Data Table -->
                    <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between">
                            <div>
                                <h4 class="font-bold text-lg uppercase tracking-tight">Daftar Pengguna</h4>
                                <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">
                                    Menampilkan {{ $users->count() }} dari {{ number_format($total) }} pengguna
                                </p>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-[#f6f6f8] dark:bg-[#131022] border-b border-[#e9e7f3] dark:border-[#2d284d]">
                                    <tr>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider w-16">No.</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Nama Lengkap</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Email</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Unit Kerja</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Role</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider">Bergabung</th>
                                        <th class="px-6 py-4 text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-[#f0eff8] dark:divide-[#2d284d]">
                                    @forelse($users as $index => $user)
                                    <tr class="hover:bg-[#f6f6f8]/60 dark:hover:bg-[#2d284d]/30 transition-colors">
                                        <td class="px-6 py-4 text-sm font-bold text-[#594c9a] dark:text-[#a397e0]">
                                            {{ str_pad(($currentPage - 1) * $perPage + $index + 1, 2, '0', STR_PAD_LEFT) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                @php
                                                    $avatarUrl = $user->getFilamentAvatarUrl()
                                                        ?? "https://ui-avatars.com/api/?name=" . urlencode($user->name) . "&color=7c3aed&background=f0f0f5&size=64";
                                                @endphp
                                                <div class="size-9 rounded-full bg-cover bg-center border-2 border-[#e9e7f3] dark:border-[#2d284d] shrink-0" style="background-image: url('{{ $avatarUrl }}')"></div>
                                                <div>
                                                    <p class="text-sm font-bold text-[#100d1b] dark:text-white capitalize">{{ $user->name }}</p>
                                                    @if($user->nip)
                                                    <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]">NIP: {{ $user->nip }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-[#594c9a] dark:text-[#a397e0]">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-sm text-[#100d1b] dark:text-white">{{ $user->unit_kerja ?? '—' }}</td>
                                        <td class="px-6 py-4">
                                            @if($user->role === 'admin')
                                            <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] font-black uppercase rounded-full">Admin</span>
                                            @else
                                            <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-[10px] font-black uppercase rounded-full">Anggota</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-xs text-[#594c9a] dark:text-[#a397e0]">
                                            {{ $user->created_at->translatedFormat('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex justify-end gap-1">
                                                <a href="/dashboards/users/{{ $user->id }}/edit"
                                                   class="p-2 text-[#594c9a] dark:text-[#a397e0] hover:text-primary hover:bg-primary/5 rounded-lg transition-colors"
                                                   title="Edit user">
                                                    <span class="material-symbols-outlined text-[18px]">edit</span>
                                                </a>
                                                 <button type="button"
                                                         onclick="openDeleteModal('{{ $user->id }}', '{{ addslashes($user->name) }}')"
                                                         class="p-2 text-[#594c9a] dark:text-[#a397e0] hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition-colors"
                                                         title="Hapus user">
                                                     <span class="material-symbols-outlined text-[18px]">delete</span>
                                                 </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-16 text-center">
                                            <span class="material-symbols-outlined text-[48px] text-[#594c9a]/30 dark:text-[#a397e0]/30 block mb-3">person_off</span>
                                            <p class="text-[#594c9a] dark:text-[#a397e0] font-bold">Tidak ada pengguna ditemukan</p>
                                            <p class="text-xs text-[#594c9a]/70 dark:text-[#a397e0]/70 mt-1">Coba ubah kata kunci pencarian atau filter</p>
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
                                <a href="?page={{ $currentPage - 1 }}&search={{ $search }}&role={{ $roleFilter }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    <span class="material-symbols-outlined text-sm">chevron_left</span>
                                </a>
                                @endif

                                @php
                                    $startPage = max(1, $currentPage - 2);
                                    $endPage   = min($lastPage, $currentPage + 2);
                                @endphp

                                @for($i = $startPage; $i <= $endPage; $i++)
                                <a href="?page={{ $i }}&search={{ $search }}&role={{ $roleFilter }}" class="size-8 flex items-center justify-center rounded-lg text-sm font-bold transition-colors {{ $i === $currentPage ? 'bg-primary text-white shadow-md shadow-primary/30' : 'border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#100d1b] dark:text-white hover:bg-gray-50 dark:hover:bg-[#2d284d]' }}">
                                    {{ $i }}
                                </a>
                                @endfor

                                @if($endPage < $lastPage)
                                <span class="size-8 flex items-center justify-center text-[#594c9a] dark:text-[#a397e0] text-sm">…</span>
                                <a href="?page={{ $lastPage }}&search={{ $search }}&role={{ $roleFilter }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-sm font-bold text-[#100d1b] dark:text-white hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    {{ $lastPage }}
                                </a>
                                @endif

                                @if($currentPage < $lastPage)
                                <a href="?page={{ $currentPage + 1 }}&search={{ $search }}&role={{ $roleFilter }}" class="size-8 flex items-center justify-center rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-white dark:bg-[#1a1630] text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors">
                                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                                </a>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="mt-8 text-center pb-4">
                        <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]/50 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>

                </div>
            </main>
        </div>
    </div>

    <!-- ===== MODAL TAMBAH USER ===== -->
    <div id="modal-backdrop" class="sg-modal-wrap fixed inset-0 z-[99999] bg-black/50 backdrop-blur-sm items-center justify-center">
        <div class="sg-modal-panel bg-white dark:bg-[#1a1630] rounded-2xl shadow-2xl w-full max-w-lg mx-4 border border-[#e9e7f3] dark:border-[#2d284d]">
            <div class="flex items-center justify-between p-6 border-b border-[#e9e7f3] dark:border-[#2d284d]">
                <div>
                    <h3 class="text-lg font-black text-[#100d1b] dark:text-white uppercase">Tambah User Baru</h3>
                    <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">Isi data pengguna baru di bawah ini</p>
                </div>
                <button onclick="closeCreateModal()" class="p-2 hover:bg-[#f6f6f8] dark:hover:bg-[#2d284d] rounded-lg transition-colors text-[#594c9a] dark:text-[#a397e0]">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <form action="/dashboards/users/store" method="POST" class="p-6 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input name="name" type="text" required placeholder="Nama pengguna" class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">Email <span class="text-red-500">*</span></label>
                        <input name="email" type="email" required placeholder="email@instansi.go.id" class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">Password <span class="text-red-500">*</span></label>
                        <input name="password" type="password" required placeholder="Minimal 8 karakter" class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">Role <span class="text-red-500">*</span></label>
                        <select name="role" required class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            <option value="">Pilih Role</option>
                            <option value="admin">Admin</option>
                            <option value="anggota">Anggota</option>
                        </select>
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">NIP</label>
                        <input name="nip" type="text" placeholder="Nomor Induk Pegawai" class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all" />
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label class="text-xs font-bold text-[#100d1b] dark:text-white">Unit Kerja</label>
                        <select name="unit_kerja" class="w-full h-10 rounded-lg border border-[#e9e7f3] dark:border-[#2d284d] bg-[#f6f6f8] dark:bg-[#131022] text-[#100d1b] dark:text-white text-sm px-4 focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            <option value="">Pilih Unit Kerja</option>
                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                            <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                            <option value="Perencanaan & Keuangan">Perencanaan & Keuangan</option>
                            <option value="Operasional">Operasional</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-[#f0eff8] dark:border-[#2d284d]">
                    <button type="button" onclick="closeCreateModal()" class="px-5 h-10 rounded-lg text-sm font-bold text-[#594c9a] dark:text-[#a397e0] hover:bg-[#f0f0f5] dark:hover:bg-[#2d284d] transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-6 h-10 rounded-lg bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30 hover:bg-[#280cb0] transition-all active:scale-95 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ===== MODAL SUKSES TAMBAH USER ===== -->
    <div id="modal-success" class="sg-modal-wrap fixed inset-0 z-[199999] bg-black/60 backdrop-blur-sm items-center justify-center">
        <div class="sg-modal-panel bg-white dark:bg-[#1a1630] rounded-2xl shadow-2xl w-full max-w-md mx-4 p-10 border border-[#e9e7f3] dark:border-[#2d284d]">
            <div class="flex flex-col items-center text-center">
                <!-- Lingkaran + centang dengan animasi bounce -->
                <div class="sg-check-circle size-24 bg-emerald-500 rounded-full flex items-center justify-center mb-6 shadow-2xl shadow-emerald-500/30">
                    <span class="material-symbols-outlined text-white text-6xl" style="font-variation-settings: 'FILL' 1, 'wght' 700;">check</span>
                </div>
                <div class="sg-success-text">
                    <h3 class="text-[#100d1b] dark:text-white text-2xl font-black mb-2">User Berhasil Ditambahkan!</h3>
                    <p class="text-[#594c9a] dark:text-[#a397e0] text-sm leading-relaxed mb-8">Data pengguna baru telah tersimpan ke dalam sistem.</p>
                    <button onclick="closeSuccessModal()" class="w-full py-3.5 rounded-xl bg-primary text-white font-bold shadow-lg shadow-primary/30 hover:bg-[#280cb0] transition-all active:scale-95 text-base">
                        Selesai
                    </button>
                    <p class="mt-4 text-[#594c9a] dark:text-[#a397e0] text-xs" id="success-countdown">Halaman ini akan menutup secara otomatis dalam 3 detik.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== MODAL KONFIRMASI HAPUS USER ===== -->
    <div id="modal-delete" class="sg-modal-wrap fixed inset-0 z-[199999] bg-black/60 backdrop-blur-sm items-center justify-center">
        <div class="sg-modal-panel bg-white dark:bg-[#1a1630] rounded-2xl shadow-2xl w-full max-w-md mx-4 border border-[#e9e7f3] dark:border-[#2d284d] overflow-hidden">
            <div class="p-8 flex flex-col items-center text-center">
                <!-- Ikon warning dengan animasi shake -->
                <div class="sg-warn-icon size-16 bg-red-50 dark:bg-red-900/20 rounded-full flex items-center justify-center mb-5">
                    <span class="material-symbols-outlined text-red-600 text-4xl" style="font-variation-settings: 'FILL' 0, 'wght' 600;">warning</span>
                </div>
                <h3 class="text-xl font-black text-[#100d1b] dark:text-white mb-2">Hapus Pengguna?</h3>
                <p class="text-[#594c9a] dark:text-[#a397e0] text-sm leading-relaxed">
                    Apakah Anda yakin ingin menghapus
                    <span class="font-black text-[#100d1b] dark:text-white" id="delete-username"></span>?
                    Tindakan ini <strong class="text-red-600">tidak dapat dibatalkan</strong>.
                </p>
            </div>
            <div class="px-8 pb-8 flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-6 py-2.5 rounded-xl text-sm font-bold text-[#594c9a] dark:text-[#a397e0] hover:bg-[#f0f0f5] dark:hover:bg-[#2d284d] transition-colors border border-[#e9e7f3] dark:border-[#2d284d]">
                    Batal
                </button>
                <!-- Form hapus yang di-submit saat tombol Ya ditekan -->
                <form id="delete-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2.5 rounded-xl text-sm font-bold text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-200 dark:shadow-none transition-all active:scale-95">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        /* ---- Modal Tambah User ---- */
        function openCreateModal() {
            const el = document.getElementById('modal-backdrop');
            el.classList.add('active');
            // Re-trigger animasi setiap kali dibuka
            const panel = el.querySelector('.sg-modal-panel');
            panel.style.animation = 'none';
            requestAnimationFrame(() => { panel.style.animation = ''; });
        }
        function closeCreateModal() {
            document.getElementById('modal-backdrop').classList.remove('active');
        }
        document.getElementById('modal-backdrop').addEventListener('click', function(e) {
            if (e.target === this) closeCreateModal();
        });

        /* ---- Modal Sukses Tambah User ---- */
        let successTimer;
        function openSuccessModal() {
            const el = document.getElementById('modal-success');
            el.classList.add('active');
            const panel = el.querySelector('.sg-modal-panel');
            panel.style.animation = 'none';
            requestAnimationFrame(() => { panel.style.animation = ''; });

            let secs = 3;
            const countdownEl = document.getElementById('success-countdown');
            clearInterval(successTimer);
            successTimer = setInterval(() => {
                secs--;
                if (secs <= 0) {
                    clearInterval(successTimer);
                    closeSuccessModal();
                } else {
                    countdownEl.textContent = 'Halaman ini akan menutup secara otomatis dalam ' + secs + ' detik.';
                }
            }, 1000);
        }
        function closeSuccessModal() {
            clearInterval(successTimer);
            document.getElementById('modal-success').classList.remove('active');
        }

        /* ---- Modal Konfirmasi Hapus ---- */
        function openDeleteModal(userId, userName) {
            document.getElementById('delete-username').textContent = userName;
            document.getElementById('delete-form').action = '/dashboards/users/' + userId + '/destroy';
            const el = document.getElementById('modal-delete');
            el.classList.add('active');
            const panel = el.querySelector('.sg-modal-panel');
            panel.style.animation = 'none';
            requestAnimationFrame(() => { panel.style.animation = ''; });
        }
        function closeDeleteModal() {
            document.getElementById('modal-delete').classList.remove('active');
        }
        document.getElementById('modal-delete').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        /* ---- Auto-tampilkan sukses jika ada session flash ---- */
        @if(session('success'))
        window.addEventListener('DOMContentLoaded', function() {
            openSuccessModal();
        });
        @endif
    </script>
</div>
