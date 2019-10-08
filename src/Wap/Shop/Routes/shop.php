<?php
//Route::get('/', function(){
//    echo shop_asset("122");
//    return "商城的首页";
//});

Route::get('/', 'IndexController@index');

Route::get('/wechat-menu', "WechatMenuController@index");
