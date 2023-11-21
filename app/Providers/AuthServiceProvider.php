<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Models\PegawaiCuti' => 'App\Policies\PegawaiCutiPolicy',
        'App\Models\PegawaiSaldoCuti' => 'App\Policies\PegawaiSaldoCutiPolicy',
        'App\Models\PegawaiRiwayatJabatan' => 'App\Policies\PegawaiRiwayatJabatanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
