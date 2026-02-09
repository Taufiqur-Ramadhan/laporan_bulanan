<div class="bg-background-light dark:bg-background-dark min-h-screen flex font-display standalone-profile">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;900&display=swap" rel="stylesheet"/>
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
            font-family: 'Public Sans', sans-serif;
            margin: 0 !important;
            padding: 0 !important;
            overflow: hidden;
        }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        /* Ensure the container takes full height/width and sits on top */
        .standalone-profile {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: 9999;
            overflow: hidden;
        }
    </style>
    <!-- Sidebar -->
    <aside class="w-64 flex-shrink-0 border-r border-[#e9e7f3] dark:border-[#2d2a3d] bg-white dark:bg-[#1a1630] flex flex-col justify-between p-4 hidden md:flex">
        <div class="flex flex-col gap-8">
            <div class="flex gap-3 items-center">
                <div class="size-8 flex items-center justify-center bg-transparent rounded-lg overflow-hidden shrink-0">
                    <img src="/images/logo.png" alt="Logo" class="w-full h-full object-contain" />
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center gap-1">
                        <h1 class="text-[#100d1b] dark:text-white text-lg font-bold leading-none uppercase">SIGAT</h1>
                        <span class="material-symbols-outlined text-primary text-sm">verified_user</span>
                    </div>
                    <p class="text-[#594c9a] dark:text-[#a199c9] text-[10px] font-normal uppercase tracking-wider">Sistem Input Kegiatan</p>
                </div>
            </div>
            <nav class="flex flex-col gap-1">
                <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a199c9] uppercase tracking-wider px-3 mb-2">Menu Utama</p>
                <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a199c9] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards">
                    <span class="material-symbols-outlined text-[24px]">dashboard</span>
                    <p class="text-sm font-medium leading-normal">Dashboard</p>
                </a>
                
                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a199c9] uppercase tracking-wider px-3 mb-2">Manajemen</p>
                    <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a397e0] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards/kegiatans">
                        <span class="material-symbols-outlined text-[24px]">assignment</span>
                        <p class="text-sm font-medium leading-normal">Kegiatan</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a397e0] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards/budgets">
                        <span class="material-symbols-outlined text-[24px]">payments</span>
                        <p class="text-sm font-medium leading-normal">Pengaturan Anggaran</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a199c9] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards/activity-logs">
                        <span class="material-symbols-outlined text-[24px]">receipt_long</span>
                        <p class="text-sm font-medium leading-normal">Log Aktivitas</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a199c9] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards/users">
                        <span class="material-symbols-outlined text-[24px]">group</span>
                        <p class="text-sm font-medium leading-normal">Manajemen User</p>
                    </a>
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">Pelaporan</p>
                    <a class="flex items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a199c9] hover:bg-primary/10 hover:text-primary rounded-lg transition-colors" href="/dashboards/reports">
                        <span class="material-symbols-outlined text-[24px]">description</span>
                        <p class="text-sm font-medium leading-normal">Export</p>
                    </a>
                </div>

                <div class="pt-6">
                    <p class="text-[10px] font-bold text-[#594c9a] dark:text-[#a397e0] uppercase tracking-wider px-3 mb-2">System</p>
                    <a class="flex items-center gap-3 px-3 py-2 rounded-lg bg-primary text-white" href="/dashboards/profile">
                        <span class="material-symbols-outlined text-[24px]">person</span>
                        <p class="text-sm font-medium leading-normal">Profil Pengguna</p>
                    </a>
                </div>
            </nav>
        </div>
        <div>
            <form action="/dashboards/logout" method="post">
                @csrf
                <button type="submit" class="flex w-full items-center gap-3 px-3 py-2 text-[#594c9a] dark:text-[#a199c9] hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 rounded-lg transition-colors">
                    <span class="material-symbols-outlined text-[24px]">logout</span>
                    <p class="text-sm font-medium leading-normal">Logout</p>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Top Header -->
        <header class="flex h-16 items-center justify-between border-b border-[#e9e7f3] dark:border-[#2d2a3d] bg-white dark:bg-[#1a1630] px-8 flex-shrink-0">
            <div class="flex items-center gap-2">
                <span class="text-[#594c9a] dark:text-[#a199c9] text-sm font-medium">Pages</span>
                <span class="text-[#594c9a] dark:text-[#a199c9] text-sm">/</span>
                <span class="text-[#100d1b] dark:text-white text-sm font-bold">Profil Pengguna</span>
            </div>
            <div class="flex items-center gap-6">
                <div class="flex items-center gap-6 border-l border-[#e9e7f3] dark:border-[#2d284d] pl-6">
                    <button class="relative p-1 text-[#594c9a] dark:text-[#a199c9] hover:bg-gray-50 dark:hover:bg-[#2d284d] rounded-full transition-colors">
                        <span class="material-symbols-outlined text-2xl">notifications</span>
                        <span class="absolute top-1 right-1 size-2 bg-red-500 rounded-full border-2 border-white dark:border-[#1a1630]"></span>
                    </button>
                    
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
            </div>
        </header>

        <!-- Main Area -->
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-8">
            <div class="max-w-[1200px] mx-auto flex flex-col gap-8">
                <!-- Heading -->
                <div class="flex flex-col gap-2 text-left">
                    <h2 class="text-[#100d1b] dark:text-white text-4xl font-black leading-tight tracking-tight uppercase">Profil Pengguna</h2>
                    <p class="text-[#594c9a] dark:text-[#a199c9] text-lg font-normal">Kelola informasi pribadi dan keamanan akun Anda untuk sistem SIGAT</p>
                </div>

                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Profile Card -->
                    <div class="lg:w-1/3 flex flex-col gap-6">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl p-8 border border-[#e9e7f3] dark:border-[#2d2a3d] shadow-sm flex flex-col items-center">
                            <div class="relative group mb-6">
                                <div class="size-36 rounded-full bg-cover bg-center border-4 border-[#e9e7f3] dark:border-[#2d2a3d]" style='background-image: url("{{ auth()->user()->getFilamentAvatarUrl() ?? "https://ui-avatars.com/api/?name=".urlencode(auth()->user()->name)."&color=3211d4&background=e9e7f3" }}");'></div>
                                <button onclick="document.querySelector('input[type=file]').click()" class="absolute bottom-0 right-0 size-10 bg-primary text-white rounded-full flex items-center justify-center border-4 border-white dark:border-[#1a1630] hover:scale-105 transition-transform shadow-lg">
                                    <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                                </button>
                            </div>
                            <div class="text-center mb-6">
                                <h3 class="text-[#100d1b] dark:text-white text-2xl font-bold">{{ auth()->user()->name }}</h3>
                                <p class="text-primary font-semibold text-sm uppercase">{{ auth()->user()->role }}</p>
                                <div class="mt-4 inline-flex items-center gap-2 px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-xs font-bold uppercase tracking-wider">
                                    <span class="size-2 bg-green-500 rounded-full"></span>
                                    Akun Aktif
                                </div>
                            </div>
                            <div class="w-full pt-6 border-t border-[#f0eff8] dark:border-[#2d2a3d]">
                                <div class="flex flex-col gap-4">
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-[#594c9a] dark:text-[#a199c9]">ID Pegawai</span>
                                        <span class="font-bold text-[#100d1b] dark:text-white">{{ auth()->user()->nip ?? '-' }}</span>
                                    </div>
                                    <div class="flex justify-between items-center text-sm">
                                        <span class="text-[#594c9a] dark:text-[#a199c9]">Bergabung</span>
                                        <span class="font-bold text-[#100d1b] dark:text-white">{{ auth()->user()->created_at->translatedFormat('F Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- Hidden File Upload for Avatar -->
                            <div class="hidden">
                                {{ $this->form }}
                            </div>
                            <button onclick="document.querySelector('input[type=file]').click()" class="mt-8 w-full flex items-center justify-center gap-2 rounded-lg bg-[#e9e7f3] dark:bg-[#2d2a3d] hover:bg-[#dcd9eb] text-[#100d1b] dark:text-white h-11 px-4 text-sm font-bold transition-colors">
                                <span class="material-symbols-outlined text-[20px]">image</span>
                                Ganti Foto Profil
                            </button>
                        </div>

                        <div class="bg-primary/5 dark:bg-primary/10 rounded-xl p-6 border border-primary/20">
                            <h4 class="text-primary font-bold text-sm mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-[18px]">verified_user</span>
                                Status Keamanan
                            </h4>
                            <p class="text-[#594c9a] dark:text-[#a199c9] text-xs leading-relaxed text-left">
                                @if(auth()->user()->email_verified_at)
                                    Email Anda telah terverifikasi. Kami menyarankan untuk mengganti password secara berkala setiap 6 bulan untuk menjaga keamanan data kegiatan.
                                @else
                                    Email Anda belum terverifikasi. Silakan lakukan verifikasi untuk keamanan optimal.
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Tabs & Forms -->
                    <div class="lg:w-2/3 h-full">
                        <div class="bg-white dark:bg-[#1a1630] rounded-xl border border-[#e9e7f3] dark:border-[#2d2a3d] shadow-sm overflow-hidden flex flex-col h-full">
                            <div class="px-8 border-b border-[#f0eff8] dark:border-[#2d2a3d]">
                                <div class="flex gap-8">
                                    <button class="flex items-center gap-2 border-b-[3px] border-primary text-primary py-5 font-bold text-sm">
                                        <span class="material-symbols-outlined text-[20px]">person</span>
                                        Informasi Pribadi
                                    </button>
                                </div>
                            </div>
                            <div class="p-8 flex-1">
                                <form wire:submit="save" class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="flex flex-col gap-2 text-left">
                                            <label class="text-sm font-bold text-[#100d1b] dark:text-white">Nama Lengkap</label>
                                            <input wire:model="data.name" class="w-full h-11 rounded-lg border-[#d3cfe7] dark:border-[#2d2a3d] bg-white dark:bg-[#131022] text-[#100d1b] dark:text-white focus:ring-primary focus:border-primary px-4 transition-all" type="text" required/>
                                        </div>
                                        <div class="flex flex-col gap-2 text-left">
                                            <label class="text-sm font-bold text-[#100d1b] dark:text-white">Email Instansi</label>
                                            <input wire:model="data.email" class="w-full h-11 rounded-lg border-[#d3cfe7] dark:border-[#2d2a3d] bg-white dark:bg-[#131022] text-[#100d1b] dark:text-white focus:ring-primary focus:border-primary px-4 transition-all" type="email" required/>
                                        </div>
                                        <div class="flex flex-col gap-2 text-left">
                                            <label class="text-sm font-bold text-[#100d1b] dark:text-white">NIP / Nomor Pegawai</label>
                                            <input wire:model="data.nip" class="w-full h-11 rounded-lg border-[#d3cfe7] dark:border-[#2d2a3d] bg-white dark:bg-[#131022] text-[#100d1b] dark:text-white focus:ring-primary focus:border-primary px-4 transition-all" type="text" placeholder="Masukkan NIP"/>
                                        </div>
                                        <div class="flex flex-col gap-2 text-left">
                                            <label class="text-sm font-bold text-[#100d1b] dark:text-white">Unit Kerja</label>
                                            <select wire:model="data.unit_kerja" class="w-full h-11 rounded-lg border-[#d3cfe7] dark:border-[#2d2a3d] bg-white dark:bg-[#131022] text-[#100d1b] dark:text-white focus:ring-primary focus:border-primary px-4 transition-all">
                                                <option value="">Pilih Unit Kerja</option>
                                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                                <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                                                <option value="Perencanaan & Keuangan">Perencanaan & Keuangan</option>
                                                <option value="Operasional">Operasional</option>
                                            </select>
                                        </div>
                                        <div class="md:col-span-2 flex flex-col gap-2 text-left">
                                            <label class="text-sm font-bold text-[#100d1b] dark:text-white">Alamat Kantor</label>
                                            <textarea wire:model="data.alamat" class="w-full rounded-lg border-[#d3cfe7] dark:border-[#2d2a3d] bg-white dark:bg-[#131022] text-[#100d1b] dark:text-white focus:ring-primary focus:border-primary px-4 py-2 transition-all" rows="3" placeholder="Masukkan alamat lengkap kantor..."></textarea>
                                        </div>
                                    </div>
                                    <div class="my-8 border-t border-[#f0eff8] dark:border-[#2d2a3d]"></div>
                                    <div class="flex items-center justify-end gap-3">
                                        <button type="button" class="px-6 h-11 rounded-lg text-sm font-bold text-[#594c9a] dark:text-[#a199c9] hover:bg-[#f0f0f5] dark:hover:bg-[#2d2a3d] transition-colors">
                                            Batalkan
                                        </button>
                                        <button type="submit" class="px-8 h-11 rounded-lg bg-primary text-white text-sm font-bold shadow-lg shadow-primary/30 hover:bg-[#280cb0] transition-all active:scale-95 flex items-center gap-2">
                                            <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                                                <span class="material-symbols-outlined text-[20px]">save</span>
                                                Simpan Perubahan
                                            </span>
                                            <span wire:loading wire:target="save" class="flex items-center gap-2">
                                                <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                    <path class="opacity-75" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z" fill="currentColor"></path>
                                                </svg>
                                                Menyimpan...
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
