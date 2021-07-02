<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Team;
use App\Service;
use App\Partner;
use App\Http\Controllers\Controller;
use App\ServiceCategory;
use App\Realisation;


/**
 * Class ServicesController
 * @package App\Http\Controllers\Page
 */
class ServicesController extends Controller
{
    /**
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, string $view)
    {
        $services = Service::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->get();
        
        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();
        
        $teams = Team::active()
            ->translated()
            ->withTranslation()
            ->whereIsAboutUs(true)
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

            $realisations = Realisation::active()
            ->with('categories.translation')
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            // ->join('realisations_to_categories', 'realisations_to_categories.realisation_id', '=', 'realisations.id')
            ->get();


        return view('pages.services', compact('page', 'services', 'teams', 'partners', 'serviceCategories', 'realisations'));
    }

    /**
     * @param Page $page
     * @param ServiceCategory $serviceCategory
     * @return $this
     */
    public function show(Page $page, Service $service)
    {
        
        $childrens = $service
            ->childrens()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        if ($childrens->count()) {
            return view('services.index', [
                'page' => $service,
                'services' => $childrens
            ]);
        }

        $prev = Service::active()
            ->doesntHave('childrens')
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'desc')
            ->where('id', '<', $service->id)
            ->limit(1)
            ->first();

        $next = Service::active()
            ->doesntHave('childrens')
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->where('id', '>', $service->id)
            ->limit(1)
            ->first();

        $ids = [$service->id];

        if ($prev) {
            array_push($ids, $prev->id);
        }

        if ($next) {
            array_push($ids, $next->id);
        }
        
        $teams = Team::active()
        ->translated()
        ->withTranslation()
        ->whereIsAboutUs(true)
        ->orderBy('order')
        ->get();
        
        $services = Service::active()
        ->whereParentId(0)
        ->translated()
        ->withTranslation()
        ->orderBy('order', 'asc')
        ->get();

        $realisations = Realisation::active()
            ->with('categories.translation')
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            // ->join('realisations_to_categories', 'realisations_to_categories.realisation_id', '=', 'realisations.id')
            ->get();


        return view('services.show', compact('page', 'service', 'services', 'next', 'prev', 'teams', 'realisations'));
    }
}
