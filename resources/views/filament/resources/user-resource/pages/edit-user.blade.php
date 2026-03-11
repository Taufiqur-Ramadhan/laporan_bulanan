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
        /* Filament Form Overrides */
        .fi-fo-field-ctn label { font-weight: 700 !important; color: #100d1b !important; font-size: 0.825rem !important; }
        .dark .fi-fo-field-ctn label { color: #fff !important; }
        .fi-input { border-radius: 0.75rem !important; border: 1px solid #e9e7f3 !important; background: #f9f8fc !important; }
        .dark .fi-input { background: rgba(255,255,255,0.05) !important; border-color: rgba(255,255,255,0.1) !important; color: #fff !important; }
        .fi-section { border-radius: 1rem !important; border: 1px solid #e9e7f3 !important; box-shadow: none !important; }
        .dark .fi-section { border-color: rgba(255,255,255,0.1) !important; background: #1a1630 !important; }
        
        /* Sembunyikan topbar bawaan Filament */
        .fi-topbar { display: none !important; }
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
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/budgets">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">payments</span>
                        <span class="text-sm font-medium">Pengaturan Anggaran</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-[#2d284d] transition-colors text-[#100d1b] dark:text-white" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[#594c9a] dark:text-[#a397e0] text-[20px]">receipt_long</span>
                        <span class="text-sm font-medium">Log Aktivitas</span>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg active-nav" href="/dashboards/users">
                        <span class="material-symbols-outlined text-[20px]">group</span>
                        <span class="text-sm font-medium">Manajemen User</span>
                    </a>
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
                    <div class="size-9 rounded-full bg-cover bg-center border-2 border-admin-accent/20" style="background-image: url('{{ $adminAvatar }}')"></div>
                    <div class="flex flex-col">
                        <p class="text-xs font-bold truncate dark:text-white capitalize">{{ $adminName }}</p>
                        <span class="text-[10px] font-bold text-admin-accent uppercase">{{ $adminRole }}</span>
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
        <main class="flex-1 flex flex-col overflow-hidden">
            <div class="flex-1 overflow-y-auto">
                <div class="px-8 pt-8 pb-2">
                    <!-- Breadcrumb -->
                    <nav class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0] mb-4">
                        <a class="hover:text-primary transition-colors" href="/dashboards/users">Manajemen User</a>
                        <span class="material-symbols-outlined text-xs">chevron_right</span>
                        <span class="text-[#100d1b] dark:text-white font-medium">Edit User</span>
                    </nav>

                    <!-- Page Title -->
                    <div class="flex justify-between items-center mb-8">
                        <div>
                            <h2 class="text-3xl font-bold tracking-tight text-[#100d1b] dark:text-white">Edit User</h2>
                            <p class="text-[#594c9a] dark:text-gray-400 mt-1 font-medium">Perbarui informasi dan preferensi akun pengguna.</p>
                        </div>
                        <div class="flex gap-3">
                            <a href="/dashboards/users" class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-[#594c9a] dark:text-gray-300 bg-white dark:bg-[#1a1630] border border-[#e9e7f3] dark:border-white/10 rounded-xl hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <span class="material-symbols-outlined text-lg">arrow_back</span>
                                Kembali
                            </a>
                            @can('delete', $this->record)
                            <button type="button"
                                wire:click="mountAction('delete')"
                                wire:confirm="Yakin ingin menghapus user ini? Tindakan ini tidak dapat dibatalkan."
                                class="flex items-center gap-2 px-4 py-2 text-sm font-semibold text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors">
                                <span class="material-symbols-outlined text-lg">delete</span>
                                Hapus
                            </button>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="px-8 pb-8">
                    <div class="max-w-4xl">
                        <!-- User Card Header -->
                        <div class="bg-white dark:bg-[#1a1630] rounded-2xl shadow-sm border border-[#e9e7f3] dark:border-white/10 overflow-hidden">
                            <!-- Avatar Header -->
                            <div class="p-6 border-b border-[#e9e7f3] dark:border-white/10 bg-[#f9f8fc] dark:bg-[#16122d] flex items-center gap-6">
                                <div class="relative group">
                                    @php
                                        $initials = collect(explode(' ', $this->record->name))
                                            ->map(fn($w) => strtoupper(substr($w, 0, 1)))
                                            ->take(2)
                                            ->join('');
                                    @endphp
                                    <div class="w-20 h-20 rounded-full bg-primary dark:bg-primary flex items-center justify-center text-white text-2xl font-bold shadow-lg border-4 border-white dark:border-[#1a1630] overflow-hidden">
                                        @if($this->record->getFilamentAvatarUrl())
                                            <img src="{{ $this->record->getFilamentAvatarUrl() }}" alt="{{ $this->record->name }}" class="w-full h-full object-cover" />
                                        @else
                                            {{ $initials }}
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-[#100d1b] dark:text-white">{{ $this->record->name }}</h3>
                                    <p class="text-[#594c9a] dark:text-gray-400 text-sm mt-0.5">{{ $this->record->email }}</p>
                                    <span class="inline-flex items-center mt-2 px-2.5 py-0.5 rounded-full text-xs font-bold 
                                        {{ $this->record->role === 'admin' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400' }}">
                                        {{ ucfirst($this->record->role) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Form -->
                            <div class="p-8">
                                <!-- Validation Errors -->
                                @if ($errors->any())
                                    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800">
                                        <ul class="list-disc list-inside text-sm text-red-600 dark:text-red-400">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Filament Form -->
                                <div class="space-y-8">
                                    {{ $this->form }}
                                </div>

                                <!-- Form Footer -->
                                <div class="flex items-center justify-end gap-4 pt-8 mt-8 border-t border-[#e9e7f3] dark:border-white/10">
                                    <a href="/dashboards/users" class="px-6 py-2.5 text-sm font-semibold text-[#594c9a] dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-white/5 rounded-xl transition-colors border border-[#d3cfe7] dark:border-white/20">
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
                        </div>

                        <!-- Footer -->
                        <div class="mt-8 text-center pb-8">
                            <p class="text-[10px] text-[#594c9a] dark:text-gray-500 uppercase tracking-widest font-bold">© {{ date('Y') }} SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
