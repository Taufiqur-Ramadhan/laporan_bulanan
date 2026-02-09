<div class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display standalone-register">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&display=swap" rel="stylesheet"/>
    
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
        }
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            white-space: nowrap;
            animation: marquee 20s linear infinite;
        }
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            font-size: 24px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }
    </style>

    <!-- Top Navigation -->
    <header class="w-full flex items-center border-b border-solid border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark px-6 md:px-10 py-3">
        <div class="flex items-center gap-3 text-primary">
            <div class="size-8 flex items-center justify-center bg-transparent rounded-lg overflow-hidden">
                <img src="https://tse4.mm.bing.net/th/id/OIP.nlDBMwT5zvAB9btG3QMmVQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="w-full h-full object-contain" />
            </div>
            <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-tight uppercase">SIGAT</h2>
        </div>
        <!-- Running Text -->
        <div class="flex-grow overflow-hidden ml-6 hidden sm:block">
            <div class="animate-marquee whitespace-nowrap text-xs font-medium text-primary uppercase tracking-widest opacity-80 italic">
                Selamat Datang di SIGAT (Sistem Input Kegiatan) - Pantau dan Input Laporan Kegiatan Anda dengan Mudah dan Cepat - Pastikan Data yang Anda Masukkan Akurat dan Terverifikasi oleh Atasan.
            </div>
        </div>
        <a class="flex min-w-[84px] cursor-pointer items-center justify-center rounded-lg h-10 px-4 bg-primary text-white text-sm font-bold transition-colors hover:bg-opacity-90" href="{{ $loginUrl }}">
            Masuk
        </a>
    </header>

    <main class="flex-1 flex items-center justify-center p-6 sm:p-12">
        <div class="w-full max-w-[480px] bg-white dark:bg-[#1c1930] rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 overflow-hidden">
            <!-- Header Section -->
            <div class="pt-8 px-8 flex flex-col items-center text-center">
                <div class="mb-4">
                    <img src="https://tse4.mm.bing.net/th/id/OIP.nlDBMwT5zvAB9btG3QMmVQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="w-16 h-16 object-contain" />
                </div>
                <h1 class="text-gray-900 dark:text-white text-2xl font-bold">SIGAT</h1>
                <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">Sistem Input Kegiatan</p>
                <h2 class="text-gray-900 dark:text-white text-xl font-bold mt-8">Daftar Akun Baru</h2>
                <a class="text-primary text-sm font-medium mt-2 hover:underline" href="{{ $loginUrl }}">Sudah punya akun? Masuk di sini</a>
            </div>

            <!-- Social Sign Up -->
            <div class="px-8 mt-6">
                <a href="{{ url('/auth/google/redirect') }}" class="w-full flex items-center justify-center gap-3 border border-gray-300 dark:border-gray-600 rounded-lg h-12 px-5 bg-white dark:bg-transparent text-gray-700 dark:text-gray-200 text-base font-semibold transition-all hover:bg-gray-50 dark:hover:bg-gray-800">
                    <img alt="Google Logo" class="w-5 h-5" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCrSiCT9WUe2eSuIW8i7bPQNjMLPODYg5O2HbACZTkt0TdyROoIDilOvLs6f7rrgSW6AgXp_02-BPmGrEPObvEU2qCZvBRWudWjIs91rZQy1DJLyR_7FgwHY45ONbPPHA7FvkZ1WgeF-8ukyUnkwK98lbgGWz8rjNxx4yJ5sR1DMWEIkFR17TnOQvnvilV9rzlafGWs8CvIGEFAf_7dg0XW4dRhTBJiCMvxLHTWFSd9J5pnENcRxxyvusiZ77WT4KT4doUvj78B9kqJ" />
                    <span>Daftar dengan Google</span>
                </a>
            </div>

            <!-- Divider -->
            <div class="px-8 mt-6 flex items-center gap-4">
                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
                <span class="text-xs text-gray-400 uppercase tracking-widest font-medium">Atau daftar dengan email</span>
                <div class="flex-1 h-px bg-gray-200 dark:bg-gray-700"></div>
            </div>

            <!-- Form Fields -->
            <form wire:submit="register" class="px-8 py-6 space-y-4">
                {{-- Nama Lengkap --}}
                <div class="text-left">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Nama Lengkap*</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <input wire:model="data.name" class="w-full pl-10 pr-4 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Masukkan nama lengkap Anda" type="text" required/>
                    </div>
                </div>

                {{-- Email --}}
                <div class="text-left">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Alamat Email*</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input wire:model="data.email" class="w-full pl-10 pr-4 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Masukan email Anda" type="email" required/>
                    </div>
                </div>

                {{-- Password --}}
                <div class="text-left" x-data="{ show: false }">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kata Sandi*</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <input wire:model="data.password" :type="show ? 'text' : 'password'" class="w-full pl-10 pr-10 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Min. 8 karakter" required/>
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <!-- Eye Icon (Open) -->
                            <template x-if="!show">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                            <!-- Eye Icon (Closed) -->
                            <template x-if="show">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.04m4.066-1.56a10.048 10.048 0 014.113-.898c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-2.101-2.101L3 3m9 8a3 3 0 013 3m0 0l-1.414-1.414" />
                                </svg>
                            </template>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="text-left" x-data="{ show: false }">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Konfirmasi Kata Sandi*</label>
                    <div class="relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <input wire:model="data.passwordConfirmation" :type="show ? 'text' : 'password'" class="w-full pl-10 pr-10 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Ulangi kata sandi" required/>
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <!-- Eye Icon (Open) -->
                            <template x-if="!show">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </template>
                            <!-- Eye Icon (Closed) -->
                            <template x-if="show">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.04m4.066-1.56a10.048 10.048 0 014.113-.898c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-2.101-2.101L3 3m9 8a3 3 0 013 3m0 0l-1.414-1.414" />
                                </svg>
                            </template>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 pt-2 text-left">
                    <input class="mt-1 size-4 rounded border-gray-300 dark:border-gray-700 text-primary focus:ring-primary bg-gray-50 dark:bg-gray-800" id="terms" type="checkbox" required/>
                    <label class="text-sm text-gray-600 dark:text-gray-400 leading-tight" for="terms">
                        Saya setuju dengan <a class="text-primary hover:underline" href="{{ route('terms') }}" target="_blank">Syarat dan Ketentuan</a> serta <a class="text-primary hover:underline" href="{{ route('privacy') }}" target="_blank">Kebijakan Privasi</a>.
                    </label>
                </div>

                <!-- Submit -->
                <button class="w-full bg-primary hover:bg-opacity-90 text-white font-bold h-12 rounded-lg mt-4 transition-all shadow-lg shadow-primary/20" type="submit">
                    <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                    <span wire:loading wire:target="register">Memproses...</span>
                </button>
            </form>

            <div class="bg-gray-50 dark:bg-gray-900/50 px-8 py-4 border-t border-gray-100 dark:border-gray-800 text-center">
                <p class="text-xs text-gray-400 dark:text-gray-500 uppercase font-semibold">Resmi &amp; Terenkripsi</p>
            </div>
        </div>
    </main>

    <!-- Simple Footer -->
    <footer class="py-6 text-center text-gray-400 dark:text-gray-600 text-sm">
        <p>© 2024 SIGAT. Seluruh Hak Cipta Dilindungi.</p>
    </footer>
</div>
