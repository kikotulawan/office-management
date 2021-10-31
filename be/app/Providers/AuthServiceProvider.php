<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::define('has_branches', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_branches', $user) ? true : false;
        });

        Gate::define('`has_departments`', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_departments', $user) ? true : false;
        });

        Gate::define('has_positions', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_positions', $user) ? true : false;
        });

        Gate::define('has_employees', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_employees', $user) ? true : false;
        });

        Gate::define('has_applicants', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_applicants', $user) ? true : false;
        });

        Gate::define('has_jobopening', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_jobopening', $user) ? true : false;
        });

        Gate::define('has_holidays', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_holidays', $user) ? true : false;
        });

        Gate::define('has_breaks', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_breaks', $user) ? true : false;
        });

        Gate::define('has_memos', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_memos', $user) ? true : false;
        });

        Gate::define('has_policies', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_policies', $user) ? true : false;
        });

        Gate::define('has_payperiods', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_payperiods', $user) ? true : false;
        });

        Gate::define('has_leaves', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_leaves', $user) ? true : false;
        });

        Gate::define('has_permissions', function (User $user) {
            $user = $user->role->permission->pluck('permission')->toArray();
            return in_array('has_permissions', $user) ? true : false;
        });

    }
}
