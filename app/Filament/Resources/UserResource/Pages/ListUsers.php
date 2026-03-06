<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Request;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;
    protected static string $view = 'filament.pages.user-management';

    public function getViewData(): array
    {
        $perPage    = 15;
        $search     = Request::get('search', '');
        $roleFilter = Request::get('role', '');
        $page       = max(1, (int) Request::get('page', 1));

        $query = User::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('unit_kerja', 'like', "%{$search}%");
            });
        }
        if ($roleFilter) {
            $query->where('role', $roleFilter);
        }

        $total    = $query->count();
        $users    = $query->skip(($page - 1) * $perPage)->take($perPage)->get();
        $lastPage = max(1, (int) ceil($total / $perPage));

        return [
            'users'       => $users,
            'total'       => $total,
            'totalUsers'  => User::count(),
            'totalAdmins' => User::where('role', 'admin')->count(),
            'totalAnggota'=> User::where('role', 'anggota')->count(),
            'perPage'     => $perPage,
            'currentPage' => $page,
            'lastPage'    => $lastPage,
            'search'      => $search,
            'roleFilter'  => $roleFilter,
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

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
