<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

trait GeneratorCommand
{
    protected $packagePath = __DIR__ . "/../../..";

    // DummyRootName
    protected function rootNamespace()
    {
        return "Haokeed\LaravelShop";
    }

    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), $this->rootNamespace() . '\\' . $this->getPackageInput() . '\\', $this->userProviderModel()],
            $stub
        );
        return $this;
    }

    protected function getPath($name)
    {
        // 进行命名空间的完善 自动添加前
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        return $this->packagePath . '/' . str_replace('\\', '/', $name) . '.php';
    }

    // 这是获取输入的组件的包目录
    protected function getPackageInput()
    {
        return str_replace('/', '\\', trim($this->argument('package')));
    }

    protected function getArguments()
    {
        return [
            ['package', InputArgument::REQUIRED, 'The package of the class'],
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\' . $this->getPackageInput() . $this->defaultNamespace;
    }

}

//
