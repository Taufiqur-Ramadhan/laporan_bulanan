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
    <header class="w-full flex items-center justify-between border-b border-solid border-gray-200 dark:border-gray-800 bg-white dark:bg-background-dark px-6 md:px-10 py-3">
        <div class="flex items-center gap-3 text-primary">
            <div class="size-8 flex items-center justify-center bg-primary text-white rounded-lg">
                <span class="material-symbols-outlined text-xl">account_balance</span>
            </div>
            <h2 class="text-gray-900 dark:text-white text-lg font-bold leading-tight tracking-tight">SIGAT</h2>
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
                    <span class="material-symbols-outlined text-primary text-5xl">shield_person</span>
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
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">person</span>
                        <input wire:model="data.name" class="w-full pl-10 pr-4 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Masukkan nama lengkap Anda" type="text" required/>
                    </div>
                </div>

                {{-- Email --}}
                <div class="text-left">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Alamat Email*</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">mail</span>
                        <input wire:model="data.email" class="w-full pl-10 pr-4 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="nama@email.com" type="email" required/>
                    </div>
                </div>

                {{-- Password --}}
                <div class="text-left" x-data="{ show: false }">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Kata Sandi*</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock</span>
                        <input wire:model="data.password" :type="show ? 'text' : 'password'" class="w-full pl-10 pr-10 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Min. 8 karakter" required/>
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <span class="material-symbols-outlined text-lg" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password --}}
                <div class="text-left" x-data="{ show: false }">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">Konfirmasi Kata Sandi*</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg">lock_reset</span>
                        <input wire:model="data.passwordConfirmation" :type="show ? 'text' : 'password'" class="w-full pl-10 pr-10 h-11 bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-lg focus:ring-primary focus:border-primary dark:text-white placeholder-gray-400" placeholder="Ulangi kata sandi" required/>
                        <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <span class="material-symbols-outlined text-lg" x-text="show ? 'visibility_off' : 'visibility'"></span>
                        </button>
                    </div>
                </div>

                <!-- Terms -->
                <div class="flex items-start gap-3 pt-2 text-left">
                    <input class="mt-1 size-4 rounded border-gray-300 dark:border-gray-700 text-primary focus:ring-primary bg-gray-50 dark:bg-gray-800" id="terms" type="checkbox" required/>
                    <label class="text-sm text-gray-600 dark:text-gray-400 leading-tight" for="terms">
                        Saya setuju dengan <a class="text-primary hover:underline" href="#">Syarat dan Ketentuan</a> serta <a class="text-primary hover:underline" href="#">Kebijakan Privasi</a>.
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
