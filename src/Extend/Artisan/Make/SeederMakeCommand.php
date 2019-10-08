<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Database\Console\Seeds\SeederMakeCommand as Commad;
use Symfony\Component\Console\Input\InputArgument;

class SeederMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $name = 'shop-make:seeder';

    protected function getPath($name)
    {
        return $this->packagePath.'/'.$this->getPackageInput().'/Database/seeds/'.$name.'.php';
    }
}
