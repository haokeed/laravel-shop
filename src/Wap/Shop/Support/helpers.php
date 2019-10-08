<?php
/**
 *  haokeed/laravel-shop/composer.json 里面加载helpers.php文件
"autoload": {
    "files": [
    "src/Wap/Shop/Support/helpers.php"
    ],
},
 * 再使用 composer dump-autoload 重新加载
 */
if (!function_exists('shop_asset')) {
    function shop_asset($path, $secure = null)
    {
        return app('url')->asset("vendor\haokeed\laravel-wap-shop\\" . $path, $secure);
    }
}