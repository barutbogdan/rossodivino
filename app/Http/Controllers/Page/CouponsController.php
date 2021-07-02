<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Http\Controllers\Controller;
use App\Article;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class CouponsController extends Controller
{
    public function index()
    {
        return view(
            'pages/coupons'
        );
    }
}