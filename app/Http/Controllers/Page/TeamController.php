<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\TeamCategory;
use App\Team;
use App\Http\Controllers\Controller;
use App\Partner;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers
 */
class TeamController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, string $view)
    {
        $category = TeamCategory::with([
            'teams' => function ($q) {
                $q->active()
                    ->orderBy('order','asc')
                    ->translated()
                    ->withTranslation();
            }
        ])
            ->active()
            ->translated()
            ->withTranslation()
            ->get();
        
        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
            ->orderBy('order')
            ->get();
            
       $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();

            return view($view)->with(compact('page', 'teams', 'category', 'partners'));
    }
}
