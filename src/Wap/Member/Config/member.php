<?php

use Haokeed\LaravelShop\Wap\Member\Models\User;

return [
    /*
     * 公众号
     */
    'wechat' => [
        'official_account' => [
            'default' => [
                'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID', 'haokeed-your-app-id'),         // AppID
                'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET', 'haokeed-your-app-secret'),    // AppSecret
                'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN', 'haokeed-your-token'),           // Token
                'aes_key' => env('WECHAT_OFFICIAL_ACCOUNT_AES_KEY', ''),                 // EncodingAESKey

                /*
                 * OAuth 配置
                 * snsapi_userinfo => 获取用户的详细信息
                 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
                 * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
                 */
                'oauth' => [
                    'scopes' => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES', 'snsapi_userinfo'))),
                    'callback' => env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_CALLBACK', '/examples/oauth_callback.php'),
                ],
            ],
        ]
    ],
    'auth' => [
        // 事先的动作,为了以后着想
        'controller' => Haokeed\LaravelShop\Wap\Member\Http\Controllers\AuthorizationsController::class, // 当前使用的守卫,只是定义
        'guard' => 'member',
        //
        // 定义的是守卫组
        'guards' => [
            'member' => [
                'driver' => 'session',
                'provider' => 'member',
            ],
        ],
        'providers' => [
            'member' => [
                'driver' => 'eloquent',
                'model' => Haokeed\LaravelShop\Wap\Member\Models\User::class,
            ],
        ],
    ],

];
