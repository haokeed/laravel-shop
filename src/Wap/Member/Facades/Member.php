<?php


namespace Haokeed\LaravelShop\Wap\Member\Facades;

use Illuminate\Support\Facades\Facade;


/**
 * Class Member
 * 提供给用户的工具类
 * @package Haokeed\LaravelShop\Wap\Member
 */
class Member extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \ShineYork\LaravelShop\Wap\Member\Member::class;
    }

    public function gurad(){
        return \Haokeed\LaravelShop\Wap\Member\Member::class;
    }
}