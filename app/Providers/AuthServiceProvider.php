<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
        $this->registerPolicies();

        //
        Gate::define('is_user', function (User $user) {
            return $user->is_admin;
        });

        Gate::define('is_admin', function (User $user) {
            return $user->is_admin;
        });

        Validator::extend('phone_starts_with', function ($attribute, $value, $parameters, $validator) {
            return substr($value, 0, 2) === '08';
        });
    }
}
