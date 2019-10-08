<?php
return [
    'database' => [
        'observes' => [//批量添加关注者
            'Category' => 'CategoryObserver'
        ],
        // 这是 goods 组件的 默认的连接属性
        'connection' => [
            // 定义数据类连接类型
            'type' => 'mysql',// sqlserver,oracle
            'name' => 'goods',
        ],
        // 这是连接属性值
        'goods' => [
            'prefix' => 'data_',
            // 'host' => '192.163.1.1',
        ],
    ]


];
