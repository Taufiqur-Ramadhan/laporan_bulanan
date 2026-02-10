<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-kegiatan">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    
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
                    }
                },
            },
        }
    </script>

    <style>
        body { font-family: 'Public Sans', sans-serif; margin: 0 !important; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .standalone-kegiatan { position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9999; overflow: hidden; }
        
        /* Filament Form Overrides for Premium Look */
        .fi-fo-field-ctn label { font-weight: 700 !important; color: #100d1b !important; font-size: 0.875rem !important; }
        .dark .fi-fo-field-ctn label { color: #fff !important; }
        .fi-input { border-radius: 0.75rem !important; border: 1px solid #d3cfe7 !important; background: #f9f8fc !important; padding: 0.75rem 1rem !important; }
        .dark .fi-input { background: rgba(255,255,255,0.05) !important; border-color: rgba(255,255,255,0.1) !important; color: #fff !important; }
        .fi-input:focus { ring: 2px !important; ring-color: rgba(50,17,212,0.2) !important; border-color: #3211d4 !important; }
        .fi-section { border-radius: 1rem !important; border: 1px solid #e9e7f3 !important; box-shadow: none !important; }
        .dark .fi-section { border-color: rgba(255,255,255,0.1) !important; background: #1a1630 !important; }
    </style>

    <!-- Sidebar -->
    <aside class="w-72 bg-white dark:bg-[#1a1630] border-r border-[#e9e7f3] dark:border-[#2d284d] flex flex-col shrink-0 hidden lg:flex">
        <div class="p-6">
            <div class="flex items-center gap-3">
                <div class="size-10 flex items-center justify-center bg-transparent rounded-lg overflow-hidden shrink-0">
                    <img src="/images/logo.png" alt="Logo" class="w-full h-full object-contain" />
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1.5">
                        <h1 class="text-xl font-bold leading-none uppercase">SIGAT</h1>
                    </div>
                    <p class="text-[#594c9a] dark:text-[#a397e0] text-[10px] font-medium uppercase tracking-tighter">System Administrator</p>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
            <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Menu Utama</p>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#594c9a] hover:bg-primary/5 transition-colors" href="/dashboards">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span class="text-sm font-medium">Dashboard</span>
            </a>
            
            <div class="pt-6">
                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Manajemen</p>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary" href="/dashboards/kegiatans">
                    <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1">assignment</span>
                    <span class="text-sm font-medium">Kegiatan</span>
                </a>
                @if($userRole === 'admin')
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#594c9a] hover:bg-gray-100 transition-colors" href="/dashboards/budgets">
                    <span class="material-symbols-outlined text-[20px]">payments</span>
                    <span class="text-sm font-medium">Pengaturan Anggaran</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#594c9a] hover:bg-gray-100 transition-colors" href="/dashboards/activity-logs">
                    <span class="material-symbols-outlined text-[20px]">receipt_long</span>
                    <span class="text-sm font-medium">Log Aktivitas</span>
                </a>
                <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[#594c9a] hover:bg-gray-100 transition-colors" href="/dashboards/users">
                    <span class="material-symbols-outlined text-[20px]">group</span>
                    <span class="text-sm font-medium">Manajemen User</span>
                </a>
                @endif
            </div>
        </nav>

        <div class="p-4 border-t border-[#e9e7f3] dark:border-[#2d284d]">
            <a href="/dashboards/profile" class="flex items-center gap-3 p-2 hover:bg-gray-50 dark:hover:bg-white/5 rounded-xl transition-colors">
                <div class="size-9 rounded-full bg-cover bg-center border-2 border-primary/20" style="background-image: url('{{ $userAvatar }}')"></div>
                <div class="flex flex-col">
                    <p class="text-xs font-bold truncate dark:text-white">{{ $userName }}</p>
                    <span class="text-[10px] font-bold text-primary uppercase">{{ $userRole }}</span>
                </div>
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden bg-background-light dark:bg-background-dark">
        <!-- Header -->
        <header class="h-16 bg-white dark:bg-[#1a1630] border-b border-[#e9e7f3] dark:border-[#2d284d] flex items-center justify-between px-8 shrink-0">
            <div class="flex items-center gap-2 text-sm text-[#594c9a] dark:text-[#a397e0]">
                <span class="font-medium">Pages</span>
                <span class="text-[#594c9a] dark:text-[#a199c9] text-xs">/</span>
                <span class="text-[#100d1b] dark:text-white font-bold uppercase tracking-tight">Input Kegiatan</span>
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
            <div class="max-w-4xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-3xl font-black tracking-tight text-[#100d1b] dark:text-white uppercase">Input Kegiatan Baru</h1>
                    <p class="text-[#594c9a] dark:text-gray-400 mt-2">Lengkapi formulir di bawah ini untuk melaporkan kegiatan yang telah dilaksanakan.</p>
                </div>

                <form wire:submit="create" class="space-y-6">
                    <div class="bg-white dark:bg-[#1a1630] rounded-2xl shadow-sm border border-[#e9e7f3] dark:border-white/10 overflow-hidden p-8">
                        {{ $this->form }}

                        <div class="mt-8 pt-8 border-t border-[#e9e7f3] dark:border-white/10 flex items-center justify-end gap-4">
                            <a href="/dashboards/kegiatans" class="px-6 py-2.5 rounded-xl border border-[#d3cfe7] dark:border-white/20 text-[#100d1b] dark:text-white font-bold text-sm hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                Batal
                            </a>
                            <button type="submit" class="px-8 py-2.5 rounded-xl bg-primary text-white font-bold text-sm shadow-lg shadow-primary/20 hover:bg-opacity-90 active:scale-[0.98] transition-all flex items-center gap-2">
                                <span class="material-symbols-outlined text-lg">save</span>
                                Simpan Kegiatan
                            </button>
                        </div>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-[10px] text-[#594c9a] dark:text-gray-500 uppercase tracking-widest">© 2024 SIGAT System - Seluruh Hak Cipta Dilindungi.</p>
                </div>
            </div>
        </div>
    </main>
</div>
