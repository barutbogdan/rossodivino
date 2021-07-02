<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Page;
use App\PageImage;


/**
 * Class ServicesEquipeController
 *
 * @package App\Http\Controllers
 */
class ServicesEquipeController extends Controller
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

        $servicesImages = PageImage::where('page_id', $page->id)->where('status', 1)
            ->translated()
            ->orderBy('order')
            ->get();

            return view($view)->with(compact('page', 'servicesImages'));
    }
}