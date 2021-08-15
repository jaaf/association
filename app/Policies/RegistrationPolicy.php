<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registration;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class RegistrationPolicy
{
    use HandlesAuthorization;
    
    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->role == 'admin') {
            return Response::allow();
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Registration $registration)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Registration $registration)
    {
        return $user->id == $registration->agent_id
                ? Response::allow()
                : Response::deny(("Vous ne pouvez modifier une inscription que vous n'avez pas faite vous-même !"));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Registration $registration)
    {
        return $user->id === $registration->agent_id
                ? Response::allow()
                : Response::deny(("Vous ne pouvez supprimer une inscription que vous n'avez pas faite vous-même !"));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Registration $registration)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Registration  $registration
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Registration $registration)
    {
        return false;
    }
}
