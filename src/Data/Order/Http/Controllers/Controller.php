<?php
namespace Haokeed\LaravelShop\Data\Order\Http\Controllers;

use Haokeed\LaravelShop\Data\Goods\Logic\GoodsLogic;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($value="")
    {
        (new GoodsLogic())->index();

    }
}
