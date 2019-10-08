<?php

namespace Haokeed\LaravelShop\Wap\Shop\Http\Controllers;


class IndexController extends Controller
{
    public function index()
    {
        return view('wap.shop::index.index');
    }
}
