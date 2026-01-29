<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class ActivitiesChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Kegiatan per Bulan';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $query = \App\Models\Kegiatan::query();

        $data = $query->selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
            7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
        ];

        $chartData = [];
        foreach (range(1, 12) as $m) {
            $chartData[] = $data[$m] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Kegiatan',
                    'data' => $chartData,
                    'backgroundColor' => '#1e3a8a',
                    'borderColor' => '#1e3a8a',
                ],
            ],
            'labels' => array_values($months),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
