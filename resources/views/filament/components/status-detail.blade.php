<div class="space-y-4">
    @if($record->status === 'revision')
        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
            <div class="flex items-start gap-3">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 flex-shrink-0" />
                <div>
                    <h4 class="font-medium text-blue-800 dark:text-blue-200">Catatan Revisi</h4>
                    <p class="text-blue-700 dark:text-blue-300 mt-1">{{ $record->catatan_revisi ?? 'Tidak ada catatan revisi.' }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($record->status === 'approved')
        <div class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
            <div class="flex items-start gap-3">
                <x-heroicon-o-check-circle class="w-5 h-5 text-green-600 dark:text-green-400 mt-0.5 flex-shrink-0" />
                <div>
                    <h4 class="font-medium text-green-800 dark:text-green-200">Laporan Disetujui</h4>
                    <p class="text-green-700 dark:text-green-300 mt-1">Laporan ini telah diverifikasi dan disetujui.</p>
                </div>
            </div>
        </div>
    @endif

    @if($record->status === 'rejected')
        <div class="p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
            <div class="flex items-start gap-3">
                <x-heroicon-o-x-circle class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5 flex-shrink-0" />
                <div>
                    <h4 class="font-medium text-red-800 dark:text-red-200">Laporan Ditolak</h4>
                    <p class="text-red-700 dark:text-red-300 mt-1">Laporan ini tidak memenuhi kriteria dan telah ditolak.</p>
                </div>
            </div>
        </div>
    @endif

    @if(in_array($record->status, ['approved', 'revision', 'rejected']))
        <div class="border-t dark:border-gray-700 pt-4 mt-4">
            <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-3">Informasi Verifikasi</h4>
            <dl class="grid grid-cols-2 gap-4">
                <div>
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Diverifikasi oleh</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ $record->verifier?->name ?? 'Tidak diketahui' }}
                    </dd>
                </div>
                <div>
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Tanggal verifikasi</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-gray-100">
                        {{ $record->verified_at ? $record->verified_at->format('d M Y, H:i') : 'Tidak diketahui' }}
                    </dd>
                </div>
            </dl>
        </div>
    @endif
</div>
