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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('usuarios-listar',function($usuario){
            return $usuario->rol->nombre == 'Administrador';
        });
        Gate::define('usuarios-modificar',function($usuario){
            return $usuario->rol->nombre == 'Administrador';
        });
        Gate::define('roles-listar',function($usuario){
            return $usuario->rol->nombre == 'Administrador';
        });
    }
}
