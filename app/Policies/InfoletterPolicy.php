<?php

namespace App\Policies;

use App\Models\Infoletter;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Validation\Rules\In;

class InfoletterPolicy
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
                : Response::deny("Vous n'êtes pas autorisé à rédiger une info-lettre. Pour cela un administrateur doit vous donner le statut de manager.");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user,Infoletter $infoletter)
    {
        return ($user->role ==='manager' && $user->id === $infoletter->author_id)
                ? Response::allow()
                : Response::deny(("Vous n'êtes pas autorisé à modifier les données d'une info-letttre. Pour cela un administrateur doit vous donner le statut de manager."));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user,Infoletter $infoletter)
    {
        return ($user->role ==='manager' && $user->id === $infoletter->author_id)
                ? Response::allow()
                : Response::deny(__("Vous n'êtes pas autorisé à supprimer une info-lettre. Pour cela un administrateur doit vous donner le statut de manager.."));
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

