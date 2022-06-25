<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Admin') ? true : null;
        });

        Gate::define('Admin', function (User $user) {
            return $user->role == Role::ADMIN; 
        });
        Gate::define('Seller', function (User $user) {
            return $user->getRoleNames()=="Seller"; 
        });
        Gate::define('Buyer', function (User $user) {
            return $user->getRoleNames()=="Buyer"; 
        });
    }
}
