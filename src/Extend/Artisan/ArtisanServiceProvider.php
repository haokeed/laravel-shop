<?php

namespace Haokeed\LaravelShop\Extend\Artisan;

use Haokeed\LaravelShop\Extend\Artisan\Make\ClassMakeCommand;
use Illuminate\Support\ServiceProvider;

class ArtisanServiceProvider extends ServiceProvider
{
    // 这是命令的注册地点
    protected $command = [
        Make\ModelMakeCommand::class,
        Make\ControllerMakeCommand::class,
//        Make\ClassMakeCommand::class,
        Make\MigrateMakeCommand::class,
        Make\SeederMakeCommand::class,
        Make\ObserverMakeCommand::class,
    ];


    public function register()
    {
        $this->commands($this->command);
    }

    public function boot()
    {
    }
}
