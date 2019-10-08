<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Foundation\Console\ModelMakeCommand as Commad;

class ClassMakeCommand extends Commad
{
    // trait 方法的优先级大于继承
    use GeneratorCommand;

    protected $signature = 'shop-make:class {name}';


}
