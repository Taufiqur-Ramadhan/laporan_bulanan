<div x-data="{ 
    show: false, 
    message: '',
    init() {
        window.addEventListener('show-success-animation', (event) => {
            this.message = event.detail.message;
            this.show = true;
            setTimeout(() => { this.show = false; }, 2500);
        });
    }
}" 
x-show="show" 
x-cloak
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 scale-95"
x-transition:enter-end="opacity-100 scale-100"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 scale-100"
x-transition:leave-end="opacity-0 scale-95"
class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-black/40 backdrop-blur-sm">
    <div class="bg-white dark:bg-[#1c192e] rounded-2xl shadow-2xl border border-gray-100 dark:border-gray-800 overflow-hidden w-full max-w-[400px] relative">
        <div class="p-8 flex flex-col items-center text-center">
            <!-- Animation Container -->
            <div class="relative mb-6">
                <div class="w-20 h-20 rounded-full bg-green-500/10 flex items-center justify-center">
                    <div class="w-14 h-14 rounded-full bg-green-500 flex items-center justify-center shadow-lg shadow-green-500/20">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="4" viewBox="0 0 24 24">
                            <path x-show="show" 
                                  class="animate-[draw-check_0.6s_cubic-bezier(0.45,0,0.45,1)_forwards_0.2s]" 
                                  style="stroke-dasharray: 48; stroke-dashoffset: 48;"
                                  d="M5 13l4 4L19 7" 
                                  stroke-linecap="round" 
                                  stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
                <div class="absolute inset-0 w-20 h-20 rounded-full border-2 border-green-500/30 animate-ping opacity-20"></div>
            </div>

            <h2 class="text-xl font-bold text-[#100d1b] dark:text-white mb-2" x-text="message"></h2>
            <p class="text-gray-500 dark:text-gray-400 text-sm">Data telah berhasil diperbarui ke dabase.</p>
            
            <!-- Shimmer effect bar -->
            <div class="mt-6 w-full h-1 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                <div class="h-full bg-primary rounded-full w-full origin-left animate-[shimmer_2s_ease-in-out]"></div>
            </div>
        </div>
    </div>

    <style>
        @keyframes draw-check {
            to { stroke-dashoffset: 0; }
        }
        @keyframes shimmer {
            0% { transform: scaleX(0); }
            100% { transform: scaleX(1); }
        }
    </style>
</div>
