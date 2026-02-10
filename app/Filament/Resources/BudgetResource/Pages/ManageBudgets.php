<?php

namespace App\Filament\Resources\BudgetResource\Pages;

use App\Filament\Resources\BudgetResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageBudgets extends ManageRecords
{
    protected static string $resource = BudgetResource::class;

    protected static string $view = 'filament.resources.budget-resource.pages.manage-budgets';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Alokasi')
                ->after(fn () => $this->dispatch('show-success-animation', message: 'Anggaran Berhasil Ditambahkan!')),
        ];
    }

    protected function getViewData(): array
    {
        $totalBudget = \App\Models\Budget::sum('amount');
        $usedBudget = \App\Models\Kegiatan::where('status', 'approved')->sum('anggaran');
        $remainingBudget = $totalBudget - $usedBudget;
        $utilizationRate = $totalBudget > 0 ? ($usedBudget / $totalBudget) * 100 : 0;

        return [
            'totalBudget' => $totalBudget,
            'usedBudget' => $usedBudget,
            'remainingBudget' => $remainingBudget,
            'utilizationRate' => $utilizationRate,
            'userName' => auth()->user()->name,
            'userRole' => auth()->user()->role,
            'userAvatar' => auth()->user()->getFilamentAvatarUrl() ?? 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name).'&color=3211d4&background=e9e7f3',
        ];
    }
}
