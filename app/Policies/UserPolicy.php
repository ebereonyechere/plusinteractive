<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        foreach ($user->roles as $role) {
            if (in_array('View Admin Dashboard', $role->permissions()->pluck('name')->toArray())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        foreach ($user->roles as $role) {
            if (in_array('Administer Users', $role->permissions()->pluck('name')->toArray())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        foreach ($user->roles as $role) {
            if (in_array('Administer Users', $role->permissions()->pluck('name')->toArray())) {
                return true;
            }
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        foreach ($user->roles as $role) {
            if (in_array('Administer Users', $role->permissions()->pluck('name')->toArray())) {
                return true;
            }
        }

        return false;
    }
}
