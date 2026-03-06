<?php

namespace App\Filament\Resources\ActivityLogResource\Pages;

use App\Filament\Resources\ActivityLogResource;
use Filament\Resources\Pages\ListRecords;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Request;

class ListActivityLogs extends ListRecords
{
    protected static string $resource = ActivityLogResource::class;
    protected static string $view = 'filament.pages.activity-log';

    public function getViewData(): array
    {
        $perPage = 15;
        $search  = Request::get('search', '');
        $event   = Request::get('event', '');
        $page    = max(1, (int) Request::get('page', 1));

        $query = Activity::with('causer')->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhereHas('causer', fn ($q2) => $q2->where('name', 'like', "%{$search}%"));
            });
        }
        if ($event) {
            $query->where('event', $event);
        }

        $total    = $query->count();
        $logs     = $query->skip(($page - 1) * $perPage)->take($perPage)->get();
        $lastPage = max(1, (int) ceil($total / $perPage));

        return [
            'logs'        => $logs,
            'total'       => $total,
            'perPage'     => $perPage,
            'currentPage' => $page,
            'lastPage'    => $lastPage,
            'search'      => $search,
            'event'       => $event,
            'userName'    => auth()->user()->name,
            'userRole'    => auth()->user()->role,
            'userAvatar'  => auth()->user()->getFilamentAvatarUrl()
                              ?? "https://ui-avatars.com/api/?name=" . urlencode(auth()->user()->name) . "&color=7c3aed&background=f0f0f5",
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }
}
