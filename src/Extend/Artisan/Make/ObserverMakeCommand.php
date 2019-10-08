<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ObserverMakeCommand as Commad;
use Illuminate\Support\Str;

class ObserverMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'shop-make:observer';

    protected $defaultNamespace = "\Observers";


    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);

        // $namespaceModel = $this->laravel->getNamespace().$model;
        $namespaceModel = $this->rootNamespace().'\\'.$this->getPackageInput().'\\'.'Models\\'.$model;

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }

        $stub = str_replace(
            "use {$namespaceModel};\nuse {$namespaceModel};", "use {$namespaceModel};", $stub
        );

        $model = class_basename(trim($model, '\\'));

        $stub = str_replace('DocDummyModel', Str::snake($model, ' '), $stub);

        $stub = str_replace('DummyModel', $model, $stub);

        return str_replace('dummyModel', Str::camel($model), $stub);
    }

}
