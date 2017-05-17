<?php

namespace App\Providers;

use App\Ssh\SshClient;
use App\Ssh\SshClientGateway;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SshClientGateway::class, SshClient::class);
    }
}
