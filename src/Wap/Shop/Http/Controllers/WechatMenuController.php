<?php
namespace Haokeed\LaravelShop\Wap\Shop\Http\Controllers;


class WechatMenuController extends Controller
{
    public function index(){
        $buttons = [
            [
                "type" => "view",
                "name" => "laravel-shop",
                "url"  => "http://develop.ashswa.com/wap/shop"
            ],
            [
                "type" => "view",
                "name" => "测试授权登入",
                "url"  => "http://develop.ashswa.com/wap/member/wechatStore"
            ],

        ];
        return app('wechat.official_account')->menu->create($buttons);
    }
}
