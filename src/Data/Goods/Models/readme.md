快捷创建模型和对应迁移文件
```php
php artisan shop-make:model Data\\Goods Goods -m
php artisan shop-make:model Data\\Goods GoodsDescription -m
php artisan shop-make:model Data\\Goods Sku -m
php artisan shop-make:model Data\\Goods Picture -m
php artisan shop-make:model Data\\Goods Shop -m
php artisan shop-make:model Data\\Goods Brand -m
php artisan shop-make:model Data\\Goods Category -m
php artisan shop-make:model Data\\Goods Attribute -m
php artisan shop-make:model Data\\Goods AttributeValue -m
php artisan shop-make:model Data\\Goods GoodsAttributeValue -m
```


执行
```php
php artisan migrate
```