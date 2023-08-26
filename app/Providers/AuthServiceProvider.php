<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('MahasiswaKoordinator', function ($user) {
            return in_array($user->level_user, ['mahasiswa', 'koordinator']);
        });

        Gate::define('KoordinatorKaprodiDekan', function ($user) {
            return in_array($user->level_user, ['koordinator', 'kaprodi', 'dekan']);
        });

        Gate::define('KaprodiDekan', function ($user) {
            return in_array($user->level_user, ['kaprodi', 'dekan']);
        });

    }
}
