<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Page;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class AboutController extends Controller
{
    /**
     * Display the page content.
     *
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, $view)
    {
        return view($view)->with(compact('page', 'teams', 'partners'));
    }
}