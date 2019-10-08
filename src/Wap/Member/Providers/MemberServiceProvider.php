<?php

namespace Haokeed\LaravelShop\Wap\Member\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Arr;
use EasyWeChat\OfficialAccount\Application as OfficialAccount;

class MemberServiceProvider extends ServiceProvider
{

    // member组件需要注入的中间件
    protected $routeMiddleware = [
        'wechat.oauth' => \Overtrue\LaravelWeChat\Middleware\OAuthAuthenticate::class,
    ];

    protected $middlewareGroups = [];

    // 这是命令的注册地点
    protected $commands = [
        \Haokeed\LaravelShop\Wap\Member\Console\Commands\InstallCommand::class,
    ];

    /**
     *
     * 从laravel执行来说 register 会先执行
     * 所有的操作都可以写在一个方法中,但是有的时候有些功能上的区分,可以区分到register和boot中
     *
     *
     * 意义 方法名的意义,执行区别不大,主要是名字的意义区分
     * register 注册文件(注册服务)
     *
     * boot 开启事件,启动某些功能
     */


    /**
     * Register any application services.
     * 设定所有的容器绑定的对应关系
     * @return void
     */
    public function register()
    {
        //echo "这是sjunit 服务提供者";
        // 注册组件路由
        $this->registerRoutes();
        // 指定的组件的名称,自定义的资源目录地址
//        $this->loadViewsFrom(
//            __DIR__.'/../../resources/views', 'sjunit'
//        );

        // 加载config配置文件
        $this->mergeConfigFrom(__DIR__ . '/../Config/member.php', "wap.member");

        // 注册中间件
        $this->registerRouteMiddleware();

        // 发布配置文件
        // php artisan vendor:publish --provider="Haokeed\LaravelShop\Wap\Member\Providers\MemberServiceProvider"
        $this->registerPublishing();


    }


    /**
     * Bootstrap any application services.
     * 设定所有的单例模式容器绑定的对应关系
     * @return void
     */
    public function boot()
    {
        // 该方法在所有服务提供者被注册以后才会被调用
        // 这就是说我们可以在其中访问框架已注册的所有其它服务s

        //加载配置文件
        $this->loadMemberConfig();

        //数据库迁移处理
        $this->loadMigrations();

        //加载命令行
        $this->commands($this->commands);


        //为了解决easywechart比该组件先加载导致的APPID等配置不加载的问题
        $this->app->singleton("wechat.official_account.default", function ($laravelApp) {
            $app = new OfficialAccount(array_merge(config('wechat.official_account.default', []), config('wechat.official_account')));

            if (config('wechat.defaults.use_laravel_cache')) {
                $app['cache'] = $laravelApp['cache.store'];
            }
            $app['request'] = $laravelApp['request'];
            return $app;
        });

    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../Http/routes.php');
        });
    }


    public function registerPublishing()
    {
        // 判断是否在命令行中运行
        if ($this->app->runningInConsole()) {
            // [当前组件的配置文件路径 =》 这个配置复制那个目录] , 文件标识
            // 1. 不填就是默认的地址 config_path 的路径 发布配置文件名不会改变
            // 2. 不带后缀就是一个文件夹
            // 3. 如果是一个后缀就是一个文件
            $this->publishes([__DIR__ . '/../Config' => config_path('wap')], 'laravel-shop-wap-member');
        }
    }

    protected function loadMemberConfig()
    {

        //把数组1的参数值,合并到指定的数组中
        config(Arr::dot(config('wap.member.wechat', []), 'wechat.'));
        config(Arr::dot(config('wap.member.auth', []), 'auth.'));
    }

    // 加载数据库迁移文件
    public function loadMigrations()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../Database/migrations');
        }

    }

    protected function registerRouteMiddleware()
    {
        foreach ($this->middlewareGroups as $key => $middleware) {
            $this->app['router']->middlewareGroup($key, $middleware);
        }

        foreach ($this->routeMiddleware as $key => $middleware) {
            $this->app['router']->aliasMiddleware($key, $middleware);
        }

    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            // 定义访问路由的域名
            // 'domain' => config('telescope.domain', null),
            // 定义路由的命名空间
            'namespace' => 'Haokeed\LaravelShop\Wap\Member\Http\Controllers',
            // 这是前缀
            'prefix' => 'wap/member',
            //这是中间件
            'middleware' => 'web',
        ];
    }


}