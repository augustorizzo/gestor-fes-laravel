<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Planejamento\PlanoAcao;
use App\Models\Planejamento\PlanoAcaoAnexo;
use App\Observers\Planejamento\PlanoAcaoObserver;
use App\Observers\Planejamento\PlanoAcaoAnexoObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //observer's
        PlanoAcao::observe(PlanoAcaoObserver::class);
        PlanoAcaoAnexo::observe(PlanoAcaoAnexoObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
