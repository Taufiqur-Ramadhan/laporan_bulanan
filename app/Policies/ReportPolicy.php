<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReportPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    public function view(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }

    public function restore(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }

    public function forceDelete(User $user, Report $report): bool
    {
        return $user->isAdmin();
    }
}
