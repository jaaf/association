<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdherentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    } 
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
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user)
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
        return ($user->role ==='manager')
                ? Response::allow()
                : Response::deny("Vous n'êtes pas autorisé à inscrire un adhérent. Pour cela un administrateur doit vous donner le statut de manager.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user)
    {
        return $user->role ==='manager'
                ? Response::allow()
                : Response::deny(("Vous n'êtes pas autorisé à modifier les données d'un adhérent. Pour cela un administrateur doit vous donner le statut de manager."));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user)
    {
        return $user->role ==='manager'
                ? Response::allow()
                : Response::deny(__("Vous n'êtes pas autorisé à supprimer un adhérent. Pour cela un administrateur doit vous donner le statut de manager.."));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user)
    {
        return Response::deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user)
    {
        return Response::deny();
    }
}

