<?php

namespace Haokeed\LaravelShop\Data\Goods\Models;

use Illuminate\Database\Eloquent\Model as  laravelModel;
use Haokeed\LaravelExtend\Database\Eloquent\SEvents;


class Model extends laravelModel
{
    use SEvents;

    public function __construct(array $attributes = [])
    {
        $this->setConnection(config('data.goods.database.connection.name'));
        parent::__construct($attributes);
    }
}
