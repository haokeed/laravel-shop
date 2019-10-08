<?php

namespace Haokeed\LaravelShop\Extend\Artisan\Make;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand as Commad;

class MigrateMakeCommand extends Commad
{
    use GeneratorCommand;

    protected $signature = 'shop-make:migration {name : The name of the migration}
        {--create= : The table to be created}
        {--table= : The table to migrate}
        {--path= : The location where the migration file should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migration}';


    // 对应的源码地址是在 Illuminate\Database\Console\Migrations\MigrateMakeCommand::getMigrationPath()
    protected function getMigrationPath()
    {
        return $this->packagePath . '/' . str_replace('\\', '/', trim($this->input->getOption('path'))) . '/Database/' . 'migrations';
    }
}
