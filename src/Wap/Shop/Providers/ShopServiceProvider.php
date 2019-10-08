<?php

namespace Haokeed\LaravelShop\Wap\Shop\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ShopServiceProvider extends ServiceProvider
{
    public function register()
    {
        // 注册配置文件
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'wap.shop');
        $this->registerRoutes();
        $this->registerPublishing();
    }

    public function boot()
    {
        $this->loadViewsFrom(
            __DIR__ . '/../Resources/views', 'wap.shop'
        );
    }

    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Routes/shop.php');
        });
    }

    private function routeConfiguration()
    {
        return [
            'namespace' => "Haokeed\LaravelShop\Wap\Shop\Http\Controllers",
            'prefix' => 'wap/shop',
            'middleware' => 'web',
        ];
    }


    // 发布文件
    // php artisan vendor:publish --provider="Haokeed\LaravelShop\Wap\Shop\Providers\ShopServiceProvider"
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            // 发布资源文件
            $this->publishes([
                __DIR__ . '/../Resources/assets' => public_path('vendor/haokeed/laravel-wap-shop'),
            ], 'wap-shop');
        }

    }
}
