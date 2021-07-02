<?php

namespace App\Http\Controllers;

use App\Page;
use App\Project;
use App\Service;
use App\Team;
use App\Partner;
use App\Realisation;
use App\Slide;
use App\Article;
use App\ServiceCategory;
use App\ArticleCategory;
use App\ProjectCategory;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $welcome = Page::getWelcomePage();

        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsHome(true)
            ->orderBy('order','asc')
            ->get();
        
        $slides = Slide::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order','asc')
            ->get();

        $services = Service::active()
            ->with([
                'categories' => function($q) {
                    $q->active()
                        ->translated()
                        ->withTranslation()
                        ->with(['page' => function($q) {
                            $q->active()
                                ->translated()
                                ->withTranslation();
                        }]);
                }
            ])
            ->translated()
            ->withTranslation()
            ->whereIsHome(true)
            ->orderBy('order','asc')
            ->get();

        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->limit(6)
            ->get();

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();

        $projects = Project::with(
            'images',
            'categories.translation'
        )
            ->active()
            ->withTranslation()
            ->orderBy('order')
            ->limit(4)
            ->latest()
            ->get();
        
        $categories = ProjectCategory::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $serviceCategories = ServiceCategory::translated()
            ->with(['page' => function($q) {
                $q->active()->translated()->withTranslation();
            }])
            ->withTranslation()
            ->active()
            ->isHome()
            ->orderBy('order_home', 'asc')
            //->limit(1)
            ->get();
            
        $articleCategories = ArticleCategory::translated()
            ->withTranslation()
            ->active()
            ->limit(7)
            ->get();
        
        $realisations = Realisation::active()
            ->with('categories.translation')
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->limit(3)
            ->get();

//        dd($welcome);
            
        return view(
            'homepage',
            compact(
                'teams',
                'welcome',
                'articles',
                'projects',
                'partners',
                'slides',
                'services',
                'serviceCategories',
                'articleCategories',
                'categories',
                'realisations'
            )
        );
    }
}
