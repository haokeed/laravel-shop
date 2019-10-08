<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Routing\Console\ControllerMakeCommand as Command;
use Symfony\Component\Console\Input\InputArgument;


class ControllerMakeCommand extends Command
{
    use GeneratorCommand;

    protected $name = 'shop-make:controller';

    protected $defaultNamespace = "\Http\Controllers";


}
