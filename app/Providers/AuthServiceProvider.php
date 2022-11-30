<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
        Gate::define('isOwner', function ($user) {
            return $user->level === User::OWNER;
        });

        Gate::define('isAdmin', function ($user) {
            return $user->level === User::ADMIN;
        });

        Gate::define('isKasir', function ($user) {
            return $user->level === User::KASIR;
        });

        $this->registerPolicies();

        //
    }
}
