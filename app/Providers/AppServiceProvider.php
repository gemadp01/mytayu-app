<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Gate::define('IsKoordinator', function (User $user) {
        //     return $user->is_koordinator;
        // });

        Gate::define('IsMahasiswa', function ($user) {
            return $user->level_user === 'Mahasiswa';
        });
        
        Gate::define('IsKoordinator', function ($user) {
            return $user->level_user === 'Koordinator';
        });

        Gate::define('IsKaprodi', function ($user) {
            return $user->level_user === 'Kaprodi';
        });

        Gate::define('IsDekan', function ($user) {
            return $user->level_user === 'Dekan';
        });

        Gate::define('IsAdmin', function ($user) {
            return $user->level_user === 'Admin';
        });

        Gate::define('IsDospem', function ($user) {
            return $user->level_user === 'Dospem';
        });

        Gate::define('sameAccess', function ($user) {
            return in_array($user->level_user, ['Mahasiswa', 'Koordinator']);
        });
    }
}
