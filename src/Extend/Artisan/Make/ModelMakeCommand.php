<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;
use Illuminate\Support\Str;

class ModelMakeCommand extends Commad
{
    // trait 方法的优先级大于继承
    use GeneratorCommand;
    protected $name = 'shop-make:model';

    protected $defaultNamespace = "\Models";

    // 重写父类方法
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));
        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }
        $this->call('shop-make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
            '--path' => $this->getPackageInput()
        ]);
    }
}
