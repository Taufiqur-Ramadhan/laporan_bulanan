<div>
    <div class="fi-wi-widget fi-wi-custom-welcome">
        <div class="relative overflow-hidden rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10"
             style="background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);">
            
            <!-- Efek Gradasi/Cahaya Tambahan -->
            <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/20 blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 h-40 w-40 rounded-full bg-purple-500/30 blur-3xl"></div>

            <div class="relative flex items-center gap-6">
                <!-- Foto Profil atau Inisial -->
                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full border-4 border-white/30 bg-white/10 shadow-lg backdrop-blur-md">
                    @if($this->getUser()->avatar_url)
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($this->getUser()->avatar_url) }}" 
                             alt="Avatar" 
                             class="h-full w-full rounded-full object-cover">
                    @else
                        <span class="text-3xl font-bold text-white">
                            {{ substr($this->getUser()->name, 0, 1) }}
                        </span>
                    @endif
                </div>

                <!-- Teks Selamat Datang -->
                <div class="flex-1 text-white">
                    <h2 class="text-2xl font-bold tracking-tight md:text-3xl">
                        Selamat {{ \Carbon\Carbon::now()->translatedFormat('H') < 11 ? 'Pagi' : (\Carbon\Carbon::now()->translatedFormat('H') < 15 ? 'Siang' : (\Carbon\Carbon::now()->translatedFormat('H') < 19 ? 'Sore' : 'Malam')) }}, {{ $this->getUser()->name }}!
                    </h2>
                    <p class="mt-1 text-sm font-medium text-indigo-100 md:text-base opacity-90">
                        Selamat datang kembali di sistem **SIGAT**. Anda login sebagai <span class="rounded-lg bg-white/20 px-2 py-0.5 text-xs uppercase tracking-wider font-bold">{{ $this->getUser()->role }}</span>.
                    </p>
                    <div class="mt-4 flex items-center gap-4">
                        <div class="flex items-center gap-2 text-xs text-white/80">
                            <x-heroicon-m-calendar class="h-4 w-4" />
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </div>
                    </div>
                </div>

                <!-- Ilustrasi/Icon Samping -->
                <div class="hidden md:block">
                    <x-heroicon-o-sparkles class="h-16 w-16 text-white/20" />
                </div>
            </div>
        </div>
    </div>

    <style>
        .fi-wi-custom-welcome h2 {
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
    </style>
</div>
