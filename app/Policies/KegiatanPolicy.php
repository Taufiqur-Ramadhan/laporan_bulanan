<?php

namespace App\Policies;

use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class KegiatanPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin() || $kegiatan->user_id === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin() || $kegiatan->user_id === $user->id;
    }

    public function delete(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin() || $kegiatan->user_id === $user->id;
    }

    public function approve(User $user, Kegiatan $kegiatan): bool
    {
        return $user->isAdmin();
    }
}
