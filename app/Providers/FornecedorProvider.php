<?php

namespace App\Providers;

use App\Http\Controllers\FornecedorController;
use App\Services\FornecedorService;
use Illuminate\Support\ServiceProvider;

class FornecedorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(FornecedorController::class)
            ->needs(FornecedorService::class)
            ->give(function() {
                return new FornecedorService();
            });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
