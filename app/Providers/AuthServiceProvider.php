<?php

namespace App\Providers;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Infoletter;
use App\Models\Registration;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use App\Policies\InfoletterPolicy;
use App\Policies\RegistrationPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',   
        Post::class => PostPolicy::class,
        Comment::class=>CommentPolicy::class,
        Registration::class=>RegistrationPolicy::class,
        Adherent::class=>AdherentPolicy::class, 
        Infoletter::class=>InfoletterPolicy::class
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
        

    
        //
    }
}
