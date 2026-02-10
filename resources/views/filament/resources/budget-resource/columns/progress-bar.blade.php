@php
    $state = (float) $getState();
    $colorClass = 'bg-primary';
    if ($state < 1) {
        $colorClass = 'bg-slate-300 dark:bg-slate-600';
    } elseif ($state < 40) {
        $colorClass = 'bg-orange-500';
    } elseif ($state > 90) {
        $colorClass = 'bg-red-500';
    }
@endphp

<div class="flex flex-col gap-1.5 min-w-[120px] py-2">
    <div class="flex justify-between text-[10px] font-bold dark:text-gray-400">
        <span>{{ number_format($state, 1) }}%</span>
    </div>
    <div class="w-full bg-[#e9e7f3] dark:bg-white/5 h-2 rounded-full overflow-hidden">
        <div class="{{ $colorClass }} h-full rounded-full transition-all duration-500" style="width: {{ $state }}%"></div>
    </div>
</div>
