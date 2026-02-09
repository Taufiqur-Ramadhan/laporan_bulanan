<div class="bg-background-light dark:bg-background-dark min-h-screen flex flex-col font-display standalone-login">
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    
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
    </style>

    <!-- Top Navigation Bar -->
    <header class="w-full bg-white dark:bg-background-dark border-b border-gray-200 dark:border-gray-800 px-6 md:px-10 py-3">
        <div class="flex items-center">
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
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow flex items-center justify-center py-12 px-4">
        <div class="w-full max-w-[480px] bg-white dark:bg-[#1c192e] rounded-xl shadow-xl border border-gray-100 dark:border-gray-800 overflow-hidden relative">
            <!-- Card Header Branding -->
            <div class="p-8 pb-0 flex flex-col items-center text-center">
                <div class="flex items-center gap-3 mb-4 text-left">
                    <div class="w-12 h-12 flex items-center justify-center bg-transparent rounded-xl overflow-hidden">
                        <img src="https://tse4.mm.bing.net/th/id/OIP.nlDBMwT5zvAB9btG3QMmVQAAAA?rs=1&pid=ImgDetMain&o=7&rm=3" alt="Logo" class="w-full h-full object-contain" />
                    </div>
                    <div>
                        <h1 class="text-gray-900 dark:text-white text-2xl font-bold leading-tight uppercase">SIGAT</h1>
                        <p class="text-gray-500 dark:text-gray-400 text-[10px] font-medium uppercase tracking-wider">Sistem Input Kegiatan</p>
                    </div>
                </div>
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mt-6 uppercase">Masuk ke Akun</h2>
                <div class="flex items-center gap-1.5 mt-1">
                    <span class="text-gray-500 dark:text-gray-400 text-sm font-medium">Belum punya akun?</span>
                    <a class="text-primary font-bold text-sm hover:underline" href="{{ $registerUrl }}">Daftar di sini</a>
                </div>
            </div>

            <!-- Login Form Content -->
            <div class="p-8 pt-6">
                <!-- SSO Option -->
                <div class="mb-6">
                    <a href="{{ url('/auth/google/redirect') }}" class="w-full flex items-center justify-center gap-3 h-12 px-5 bg-white dark:bg-[#25223d] border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800 rounded-lg text-gray-700 dark:text-gray-200 text-base font-semibold transition-colors">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"></path>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"></path>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"></path>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"></path>
                        </svg>
                        <span>Masuk dengan Google</span>
                    </a>
                </div>

                <!-- Divider -->
                <div class="relative flex items-center justify-center my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200 dark:border-gray-800"></div>
                    </div>
                    <span class="relative bg-white dark:bg-[#1c192e] px-4 text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-widest">Atau gunakan email</span>
                </div>

                <!-- Email/Password Form -->
                <form wire:submit="authenticate" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-1.5" for="email">Alamat Email*</label>
                        <div class="relative">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <input wire:model="data.email" class="w-full h-12 pl-10 pr-4 rounded-lg border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-[#25223d] text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none text-sm" id="email" placeholder="nama@instansi.go.id" type="email" required/>
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200" for="password">Kata Sandi*</label>
                            <a class="text-xs text-primary font-bold hover:underline" href="{{ url('/dashboards/password-reset/request') }}">Lupa Password?</a>
                        </div>
                        <div class="relative" x-data="{ show: false }">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <input wire:model="data.password" class="w-full h-12 pl-10 pr-10 rounded-lg border border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-[#25223d] text-gray-900 dark:text-white focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all outline-none text-sm" id="password" placeholder="••••••••" :type="show ? 'text' : 'password'" required/>
                            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200" type="button" @click="show = !show">
                                <template x-if="!show">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </template>
                                <template x-if="show">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.04m4.066-1.56a10.048 10.048 0 014.113-.898c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-2.101-2.101L3 3m9 8a3 3 0 013 3m0 0l-1.414-1.414" />
                                    </svg>
                                </template>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <input wire:model="data.remember" class="w-4 h-4 rounded border-gray-300 dark:border-gray-700 text-primary focus:ring-primary bg-gray-50 dark:bg-gray-800" id="remember" type="checkbox"/>
                        <label class="ml-2 text-sm text-gray-600 dark:text-gray-400 font-semibold cursor-pointer" for="remember">Ingat saya</label>
                    </div>

                    <button class="w-full h-12 bg-primary hover:bg-opacity-90 text-white font-bold rounded-lg shadow-lg shadow-primary/20 transition-all active:scale-[0.98] mt-4" type="submit">
                        <span wire:loading.remove wire:target="authenticate">Masuk Sekarang</span>
                        <span wire:loading wire:target="authenticate">Memproses...</span>
                    </button>
                </form>
            </div>

            <!-- Footer Meta -->
            <div class="px-8 pb-8 text-center opacity-40">
                <p class="text-[10px] text-gray-500 dark:text-gray-400 font-medium uppercase tracking-widest">
                    © 2024 SIGAT. Seluruh Hak Cipta Dilindungi.<br/>
                    Sistem Input Kegiatan Instansi Pemerintah
                </p>
            </div>
        </div>
    </main>

    <!-- Background Decorative Elements -->
    <div class="fixed -z-10 bottom-0 left-0 w-full h-1/2 bg-gradient-to-t from-primary/5 to-transparent pointer-events-none"></div>
    <div class="fixed -z-10 top-0 right-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -mr-48 -mt-48 pointer-events-none"></div>
    <div class="fixed -z-10 bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl -ml-48 -mb-48 pointer-events-none"></div>
</div>
