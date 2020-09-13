<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
//use Illuminate\Contracts\Auth\Access\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return ($user->role == 'admin');
        });

        /* define a manager user role */
        Gate::define('isManager', function($user) {
            return $user->role == 'manager';
        });
        Gate::define('isAtLeastManager',function($user){
             return ($user->role == 'admin' or $user->role == 'manager');
        });
       /* define a writer user role */
        Gate::define('isWriter', function($user) {
            return $user->role == 'writer';
        });
        Gate::define('isAtLeastWriter',function($user){
            return ($user->role == 'admin' or $user->role == 'manager' or $user->role == 'writer');
       });
        /* define a photoprovider user role */
        Gate::define('isPhotoprovider', function($user) {
            return $user->role == 'photoprovider';
        });
        Gate::define('isAtLeastPhotoprovider',function($user){
            return ($user->role == 'admin' or $user->role == 'manager' or $user->role == 'writer' or $user->role == 'photoprovider');
       });
        

        /* define a user role */
        Gate::define('isUser', function($user) {
            return $user->role == 'user';
 });
        //
    }
}
