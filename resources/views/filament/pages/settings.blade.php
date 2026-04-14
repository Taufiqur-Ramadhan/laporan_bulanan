<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-settings overflow-hidden">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
        .standalone-settings {
            position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            z-index: 9999; overflow: hidden;
        }

        /* Toggle switch */
        .toggle-checkbox:checked { right: 0; border-color: #3211d4; }
        .toggle-checkbox:checked + .toggle-label { background-color: #3211d4; }

        /* Toast animasi */
        @keyframes toastIn  { from { opacity:0; transform:translateX(-50%) translateY(-20px); } to { opacity:1; transform:translateX(-50%) translateY(0); } }
        @keyframes toastOut { from { opacity:1; transform:translateX(-50%) translateY(0); } to { opacity:0; transform:translateX(-50%) translateY(-16px); } }
        #settings-toast { display:none; position:fixed; top:24px; left:50%; transform:translateX(-50%); z-index:999999; }
        #settings-toast.show { display:flex; animation: toastIn 0.4s cubic-bezier(0.34,1.56,0.64,1) both; }
        #settings-toast.hide { display:flex; animation: toastOut 0.3s ease both; }

        /* Accent color picker active ring */
        .accent-btn.active { outline: 3px solid currentColor; outline-offset: 3px; }
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">file_download</span>
                        <span class="text-sm font-medium">Export</span>
                    </a>
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">System</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors" href="/dashboards/profile">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">person</span>
                        <span class="text-sm font-medium">Profil Pengguna</span>
                    </a>
                    <!-- Pengaturan — AKTIF -->
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/settings">
                        <span class="material-symbols-outlined text-[20px]" style="font-variation-settings:'FILL' 1,'wght' 400,'GRAD' 0,'opsz' 24">settings</span>
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
                    <span class="text-[#100d1b] dark:text-white font-bold">Pengaturan</span>
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
                        <div class="flex-col items-end hidden sm:flex text-right">
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
                <div class="max-w-4xl mx-auto">

                    <!-- Page Heading -->
                    <div class="mb-10">
                        <h2 class="text-[#100d1b] dark:text-white text-3xl font-black leading-tight tracking-tight uppercase">Pengaturan Umum</h2>
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-base mt-2">Kelola preferensi sistem dan konfigurasi akun utama Anda.</p>
                    </div>

                    <div class="space-y-10">

                        <!-- ===== TAMPILAN ===== -->
                        <section class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                            <div class="px-8 py-5 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">palette</span>
                                <h3 class="text-base font-black uppercase tracking-tight text-[#100d1b] dark:text-white">Tampilan</h3>
                            </div>
                            <div class="px-8 py-6 space-y-8">
                                <!-- Tema -->
                                <div>
                                    <p class="text-sm font-bold text-[#594c9a] dark:text-[#a397e0] mb-4 uppercase tracking-wider text-xs">Tema Sistem</p>
                                    <div class="flex w-full max-w-xs h-11 bg-[#e9e7f3] dark:bg-[#2d284d] p-1 rounded-xl gap-1">
                                        <button id="btn-light" onclick="setTheme('light')"
                                            class="flex-1 flex items-center justify-center gap-2 rounded-lg text-sm font-bold transition-all">
                                            <span class="material-symbols-outlined text-[18px]">light_mode</span>
                                            Terang
                                        </button>
                                        <button id="btn-dark" onclick="setTheme('dark')"
                                            class="flex-1 flex items-center justify-center gap-2 rounded-lg text-sm font-bold transition-all">
                                            <span class="material-symbols-outlined text-[18px]">dark_mode</span>
                                            Gelap
                                        </button>
                                    </div>
                                </div>

                                <!-- Warna Aksen -->
                                <div>
                                    <p class="text-xs font-bold text-[#594c9a] dark:text-[#a397e0] mb-4 uppercase tracking-wider">Warna Aksen Utama</p>
                                    <div class="flex gap-3 flex-wrap">
                                        <button onclick="SIGAT.applyAccent('#3211d4')" data-color="#3211d4" class="accent-btn size-9 rounded-full shadow-md transition-all hover:scale-110" style="background-color:#3211d4;color:#3211d4"></button>
                                        <button onclick="SIGAT.applyAccent('#10b981')" data-color="#10b981" class="accent-btn size-9 rounded-full shadow-md transition-all hover:scale-110" style="background-color:#10b981;color:#10b981"></button>
                                        <button onclick="SIGAT.applyAccent('#f43f5e')" data-color="#f43f5e" class="accent-btn size-9 rounded-full shadow-md transition-all hover:scale-110" style="background-color:#f43f5e;color:#f43f5e"></button>
                                        <button onclick="SIGAT.applyAccent('#f59e0b')" data-color="#f59e0b" class="accent-btn size-9 rounded-full shadow-md transition-all hover:scale-110" style="background-color:#f59e0b;color:#f59e0b"></button>
                                        <button onclick="SIGAT.applyAccent('#6366f1')" data-color="#6366f1" class="accent-btn size-9 rounded-full shadow-md transition-all hover:scale-110" style="background-color:#6366f1;color:#6366f1"></button>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- ===== NOTIFIKASI ===== -->
                        <section class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                            <div class="px-8 py-5 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">notifications_active</span>
                                <h3 class="text-base font-black uppercase tracking-tight text-[#100d1b] dark:text-white">Notifikasi</h3>
                            </div>
                            <div class="px-8 py-2 divide-y divide-[#f0eff8] dark:divide-[#2d284d]">
                                <!-- Toggle row template -->
                                @foreach([
                                    ['id'=>'notif-email', 'label'=>'Notifikasi Email', 'desc'=>'Terima rekap mingguan kegiatan melalui email.', 'default'=>true],
                                    ['id'=>'notif-system', 'label'=>'Peringatan Sistem', 'desc'=>'Dapatkan peringatan real-time untuk masalah kritis.', 'default'=>true],
                                    ['id'=>'notif-reminder', 'label'=>'Pengingat Kegiatan', 'desc'=>'Pesan pengingat sebelum batas waktu penginputan data.', 'default'=>false],
                                ] as $notif)
                                <div class="flex items-center justify-between py-5">
                                    <div>
                                        <p class="text-sm font-bold text-[#100d1b] dark:text-white">{{ $notif['label'] }}</p>
                                        <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">{{ $notif['desc'] }}</p>
                                    </div>
                                    <label class="relative inline-flex items-center cursor-pointer ml-4 shrink-0">
                                        <input type="checkbox" id="{{ $notif['id'] }}" class="sr-only peer" {{ $notif['default'] ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-[#e9e7f3] dark:bg-[#2d284d] rounded-full transition-all
                                            peer-checked:bg-primary
                                            after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                            after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all after:shadow-sm
                                            peer-checked:after:translate-x-5">
                                        </div>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </section>

                        <!-- ===== BAHASA & WILAYAH ===== -->
                        <section class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                            <div class="px-8 py-5 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">language</span>
                                <h3 class="text-base font-black uppercase tracking-tight text-[#100d1b] dark:text-white">Bahasa &amp; Wilayah</h3>
                            </div>
                            <div class="px-8 py-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Bahasa Utama</label>
                                    <div class="relative">
                                        <select class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                            <option selected>Bahasa Indonesia</option>
                                            <option>English (US)</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider mb-2">Zona Waktu</label>
                                    <div class="relative">
                                        <select class="w-full bg-[#f6f6f8] dark:bg-[#131022] border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg px-4 py-3 text-sm text-[#100d1b] dark:text-white focus:ring-2 focus:ring-primary focus:border-primary appearance-none transition-all">
                                            <option selected>(GMT+07:00) Jakarta</option>
                                            <option>(GMT+08:00) Makassar</option>
                                            <option>(GMT+09:00) Jayapura</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[#594c9a] dark:text-[#a397e0] pointer-events-none text-[20px]">expand_more</span>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- ===== INTEGRASI ===== -->
                        <section class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d284d] shadow-sm overflow-hidden">
                            <div class="px-8 py-5 border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-[22px]">hub</span>
                                <h3 class="text-base font-black uppercase tracking-tight text-[#100d1b] dark:text-white">Integrasi</h3>
                            </div>
                            <div class="px-8 py-6 space-y-4">
                                <div class="flex items-center p-4 border border-[#e9e7f3] dark:border-[#2d284d] rounded-xl">
                                    <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mr-4 shrink-0">
                                        <span class="material-symbols-outlined">database</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-sm text-[#100d1b] dark:text-white">Satu Data Indonesia</p>
                                        <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">Sinkronisasi otomatis dengan database nasional.</p>
                                    </div>
                                    <span class="ml-4 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-[10px] font-black px-2.5 py-1 rounded-full uppercase tracking-wider shrink-0">Terhubung</span>
                                </div>
                                <div class="flex items-center p-4 border border-[#e9e7f3] dark:border-[#2d284d] rounded-xl">
                                    <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary mr-4 shrink-0">
                                        <span class="material-symbols-outlined">cloud_sync</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="font-bold text-sm text-[#100d1b] dark:text-white">API Pemerintah Daerah</p>
                                        <p class="text-xs text-[#594c9a] dark:text-[#a397e0] mt-0.5">Integrasi data kegiatan antar dinas terkait.</p>
                                    </div>
                                    <button class="ml-4 text-primary text-xs font-black hover:underline shrink-0">Konfigurasi</button>
                                </div>
                            </div>
                        </section>


                        <!-- ===== FOOTER ACTIONS ===== -->
                        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pb-6">
                            <button onclick="SIGAT.resetSettings()"
                                class="text-red-500 text-sm font-bold hover:text-red-600 transition-colors flex items-center gap-1.5">
                                <span class="material-symbols-outlined text-[18px]">restart_alt</span>
                                Reset ke Default
                            </button>
                            <div class="flex gap-3 w-full sm:w-auto">
                                <a href="/dashboards" class="flex-1 sm:flex-none px-6 py-2.5 text-sm font-bold border border-[#e9e7f3] dark:border-[#2d284d] rounded-lg hover:bg-gray-50 dark:hover:bg-[#2d284d] transition-colors text-center text-[#100d1b] dark:text-white">
                                    Batal
                                </a>
                                <button onclick="SIGAT.saveSettings()"
                                    class="flex-1 sm:flex-none px-8 py-2.5 text-sm font-black bg-primary text-white rounded-lg hover:bg-[#280cb0] hover:shadow-lg hover:shadow-primary/20 active:scale-95 transition-all">
                                    Simpan Pengaturan
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="text-center pb-4">
                        <p class="text-[10px] text-[#594c9a] dark:text-[#a397e0]/50 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- ===== TOAST ===== -->
    <div id="settings-toast" role="alert"
         class="bg-emerald-600 text-white px-6 py-4 rounded-xl shadow-2xl items-center gap-3 border border-white/20 min-w-[300px]">
        <span class="material-symbols-outlined text-2xl shrink-0" style="font-variation-settings:'FILL' 1">check_circle</span>
        <div class="flex flex-col flex-1">
            <p class="font-black text-sm leading-tight" id="toast-msg">Pengaturan Berhasil Disimpan!</p>
            <p class="text-xs text-emerald-100 mt-0.5">Perubahan telah diterapkan.</p>
        </div>
        <button onclick="hideToast()" class="ml-2 p-1 hover:bg-white/20 rounded-full transition-colors shrink-0">
            <span class="material-symbols-outlined text-sm">close</span>
        </button>
    </div>

    <script>
        /* ---- Toast (lokal untuk settings page) ---- */
        let toastTimer;
        function showToast(msg) {
            const el = document.getElementById('settings-toast');
            document.getElementById('toast-msg').textContent = msg;
            el.classList.remove('hide');
            el.classList.add('show');
            clearTimeout(toastTimer);
            toastTimer = setTimeout(hideToast, 3500);
        }
        function hideToast() {
            const el = document.getElementById('settings-toast');
            el.classList.remove('show');
            el.classList.add('hide');
            setTimeout(() => el.classList.remove('hide'), 350);
        }

        /* ---- Tema (proxied ke SIGAT) ---- */
        function setTheme(mode) { SIGAT.applyTheme(mode); }
    </script>
</div>
