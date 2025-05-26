<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
/* public function boot(): void
    {
        Gate::define('view-citas', function (User $user) {
            return $user->rol == "D" || $user->rol === 'A';
        });

        Gate::define('view-medicamentor', function (User $user) {
            return $user->rol == "R" || $user->rol === 'T';
        });

        Gate::define('view-materialu', function (User $user) {
            return  $user->rol == "G" || $user->rol === 'F';
            //Admin
        });
        Gate::define('view-pacientes', function (User $user) {
            return  $user->rol == "A";
        });
        Gate::define('view-doctores', function (User $user) {
            return  $user->rol == "A";
        });
        Gate::define('view-consultorio', function (User $user) {
            return  $user->rol == "E";
        });
        Gate::define('view-especialidades', function (User $user) {
            return  $user->rol == "A";
        });
        Gate::define('view-medicamento', function (User $user) {
            return  $user->rol == "A";
        });
        Gate::define('view-material', function (User $user) {
            return  $user->rol == "G";
        });
        Gate::define('view-logs', function (User $user) {
            return  $user->rol == "A";
        });
    
    }*/
}
