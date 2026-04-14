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
            font-family: 'Material Symbols Outlined' !important;
        }
        .active-nav {
            background-color: #3211d4;
            color: white !important;
        }
        .active-nav span { color: white !important; }
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
        .fi-fo-field-ctn label { font-weight: 700 !important; color: #100d1b !important; font-size: 0.825rem !important; }
        .dark .fi-fo-field-ctn label { color: #fff !important; }
        .fi-input { border-radius: 0.75rem !important; border: 1px solid #e9e7f3 !important; background: #f9f8fc !important; }
        .dark .fi-input { background: rgba(255,255,255,0.05) !important; border-color: rgba(255,255,255,0.1) !important; color: #fff !important; }
        .fi-section { border-radius: 1rem !important; border: 1px solid #e9e7f3 !important; box-shadow: none !important; }
        .dark .fi-section { border-color: rgba(255,255,255,0.1) !important; background: #1a1630 !important; }
        
        /* Sembunyikan topbar bawaan Filament agar tidak dobel */
        .fi-topbar { display: none !important; }

        /* === Animasi Sukses Overlay === */
        #success-overlay {
            position: fixed;
            inset: 0;
            background: rgba(3, 200, 100, 0.12);
            backdrop-filter: blur(6px);
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.35s ease;
        }
        #success-overlay.show {
            opacity: 1;
            pointer-events: all;
        }
        .success-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem 3rem;
            box-shadow: 0 20px 60px rgba(3,200,100,0.25);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            transform: scale(0.8);
            transition: transform 0.4s cubic-bezier(0.34,1.56,0.64,1);
        }
        #success-overlay.show .success-card {
            transform: scale(1);
        }
        .dark #success-overlay, .dark .success-card { /* handled in html */ }
        .success-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: linear-gradient(135deg, #03c864, #00a550);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 24px rgba(3,200,100,0.4);
            animation: pop 0.5s cubic-bezier(0.34,1.56,0.64,1) 0.1s both;
        }
        @keyframes pop {
            from { transform: scale(0.5); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
        .success-check {
            color: white;
            font-size: 2.5rem;
        }
        .success-title {
            font-size: 1.25rem;
            font-weight: 800;
            color: #100d1b;
        }
        .success-subtitle {
            font-size: 0.85rem;
            color: #594c9a;
        }
    </style>

    <!-- Animasi Sukses Overlay -->
    <div id="success-overlay">
        <div class="success-card" id="success-card">
            <div class="success-icon">
                <span class="material-symbols-outlined success-check" style="font-variation-settings: 'FILL' 1, 'wght' 700, 'GRAD' 0, 'opsz' 48;">check</span>
            </div>
            <div class="success-title">Perubahan Berhasil Disimpan!</div>
            <div class="success-subtitle">Mengalihkan ke riwayat kegiatan...</div>
            <div style="width:200px;height:4px;background:#e9e7f3;border-radius:999px;overflow:hidden;margin-top:4px">
                <div id="progress-bar" style="height:100%;width:0%;background:linear-gradient(90deg,#3211d4,#7c3aed);border-radius:999px;transition:width 1.8s linear;"></div>
            </div>
        </div>
    </div>

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
                        <p class="text-[#594c9a] dark:text-[#a397e0] text-xs font-medium uppercase tracking-tighter">{{ $userRole === 'admin' ? 'Admin Control Center' : 'Sistem Input Kegiatan' }}</p>
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/settings">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">settings</span>
                        <span class="text-sm font-medium">Pengaturan</span>
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

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                        <span class="font-medium">Pages</span>
                        <span class="text-[#594c9a] dark:text-[#a199c9] text-xs">/</span>
                        <span class="text-[#100d1b] dark:text-white font-bold tracking-tight">Edit Kegiatan</span>
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-6 border-l border-[#e9e7f3] dark:border-[#2d284d] pl-6">
                        <button id="notif-btn" onclick="SIGAT.toggleNotifPanel()" class="relative p-1 text-[#594c9a] dark:text-[#a397e0] hover:bg-gray-50 dark:hover:bg-[#2d284d] rounded-full transition-colors">
                            <span class="material-symbols-outlined text-2xl">notifications</span>
                            <span id="notif-badge" class="absolute top-1 right-1 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a1630]"></span>
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
            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-4xl mx-auto">
                    <div class="mb-8 flex items-center justify-between">
                        <div>
                            <h1 class="text-3xl font-black tracking-tight text-[#100d1b] dark:text-white uppercase">Edit Kegiatan</h1>
                            <p class="text-[#594c9a] dark:text-gray-400 mt-2 font-medium">Perbarui informasi laporan kegiatan yang telah diinput sebelumnya.</p>
                        </div>
                        @can('delete', $this->record)
                        <div class="flex items-center gap-3">
                            <button type="button"
                                wire:click="mountAction('delete')"
                                wire:confirm="Yakin ingin menghapus kegiatan ini? Tindakan ini tidak dapat dibatalkan."
                                class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 font-bold text-sm hover:bg-red-100 dark:hover:bg-red-900/40 border border-red-200 dark:border-red-800 transition-colors">
                                <span class="material-symbols-outlined text-lg">delete</span>
                                Hapus
                            </button>
                        </div>
                        @endcan
                    </div>

                    <form class="space-y-6">
                        @if ($errors->any())
                            <div class="p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                                <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="bg-white dark:bg-[#1a1630] rounded-2xl shadow-sm border border-[#e9e7f3] dark:border-white/10 overflow-hidden p-8">
                            {{ $this->form }}

                            <div class="mt-8 pt-8 border-t border-[#e9e7f3] dark:border-white/10 flex items-center justify-end gap-4">
                                <a href="/dashboards/kegiatans" class="px-6 py-2.5 rounded-xl border border-[#d3cfe7] dark:border-white/20 text-[#100d1b] dark:text-white font-bold text-center text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                    Batal
                                </a>
                                <button type="button" 
                                    wire:click="save"
                                    wire:loading.attr="disabled"
                                    wire:target="save"
                                    class="px-8 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:bg-opacity-90 active:scale-[0.98] transition-all flex items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                                    <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                                        <span class="material-symbols-outlined text-lg">save</span>
                                        Simpan Perubahan
                                    </span>
                                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                                        <svg class="animate-spin h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Menyimpan...
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mt-8 text-center pb-8">
                        <p class="text-[10px] text-[#594c9a] dark:text-gray-500 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('kegiatan-saved', (event) => {
            const overlay  = document.getElementById('success-overlay');
            const bar      = document.getElementById('progress-bar');
            const redirectUrl = event.redirectUrl || '/dashboards/kegiatans';

            // Ubah warna overlay gelap jika mode gelap aktif
            if (document.documentElement.classList.contains('dark')) {
                overlay.style.background = 'rgba(3,200,100,0.08)';
                document.getElementById('success-card').style.background = '#1a1630';
                document.querySelector('.success-title').style.color = '#fff';
            }

            overlay.classList.add('show');

            // Animasi progress bar
            setTimeout(() => { bar.style.width = '100%'; }, 50);

            // Redirect setelah 2 detik
            setTimeout(() => {
                window.location.href = redirectUrl;
            }, 2000);
        });
    });
</script>
