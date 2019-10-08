<?php

namespace Haokeed\LaravelShop\Wap\Member\Console\Commands;

use Illuminate\Console\Command;

class InstallCommand extends Command
{

    protected $signature = 'wap-member:install';

    protected $description = '这是wap下的组件安装命令';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // php artisan wap-member:install 命令执行  相当于以下全部命令执行

        // php artisan migrate 数据库迁移命令
        $this->call("migrate");

        // php artisan vendor:publish --provider="Haokeed\LaravelShop\Wap\Member\Providers\MemberServiceProvider"
        $this->call("vendor:publish",[
            "--provider"=>"Haokeed\LaravelShop\Wap\Member\Providers\MemberServiceProvider"
        ]);

        // php artisan seed:db 数据库填充命令
    }
}
