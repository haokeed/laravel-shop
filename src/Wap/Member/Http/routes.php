<?php
Route::get("wechatStore", "AuthorizationsController@wechatStore")->middleware("wechat.oauth");