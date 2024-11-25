<?php

namespace App\Providers;

use App\Services\Fornecedor\FornecedorInterface;
use App\Services\Fornecedor\FornecedorProxy;
use App\Services\Fornecedor\FornecedorService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FornecedorInterface::class, function ($app) {
            return new FornecedorProxy($app->make(FornecedorService::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
