<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class BudgetChart extends ChartWidget
{
    protected static ?string $heading = 'Tren Penggunaan Anggaran';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $query = \App\Models\Kegiatan::query();

        if (! auth()->user()->isAdmin()) {
            $query->where('user_id', auth()->id());
        }

        $data = $query->selectRaw('SUM(anggaran) as total, MONTH(created_at) as month')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
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
                    'label' => 'Anggaran (Rp)',
                    'data' => $chartData,
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(5, 150, 105, 0.1)',
                    'borderColor' => '#059669',
                ],
            ],
            'labels' => array_values($months),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
