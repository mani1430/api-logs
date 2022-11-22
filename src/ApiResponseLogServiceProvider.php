<?php

namespace Ocw\ApiResponseLog;

use App\Http\Kernel;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Ocw\ApiResponseLog\Http\ApiResponseLogMiddleware;

class ApiResponseLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('apiResponseLog',ApiResponseLogMiddleware::class);
    }
}