<?php


namespace Haokeed\LaravelShop\Wap\Member;

use Illuminate\Support\Facades\Auth;

/**
 * Class Member
 * 提供给用户的工具类
 * @package Haokeed\LaravelShop\Wap\Member
 */
class Member
{
    public function gurad()
    {
        return Auth::guard(config("wap.member.guard"));
    }


    // 可以写魔术方法,实现快速的登录方法

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return $this->gurad()->$name(...$arguments);
    }
}