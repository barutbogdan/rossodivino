<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Realisation;
use App\RealisationCategory;
use App\Http\Controllers\Controller;
use App\Partner;

/**
 * Class RealisationsController
 * @package App\Http\Controllers\Page
 */
class RealisationsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Page $page
     * @param string $view
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page, string $view)
    {
        $realisations = Realisation::active()
            ->with('categories.translation')
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $categories = RealisationCategory::with('realisations')->active()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get(); 

        $groupedRealisations = collect();
        $group = 0;
        foreach($categories as $key => $category) {
            $groupedRealisations->put($key,collect());
            $groupedRealisations[$key]->put($group,collect());
            $i = 0;
            foreach($category->realisations as $rkey => $realisation){
                if($i < 6){
                    $groupedRealisations[$key][$group]->push($realisation);
                    $i++;
                }else{
                    $i = 0;
                    $group = $group+1;
                    $groupedRealisations[$key]->put($group,collect());
                    $groupedRealisations[$key][$group]->push($realisation);
                }
            }
        }

        $partners = Partner::active()
            ->orderBy('order', 'asc')
            ->get();

        return view($view)->with(compact('page', 'categories', 'realisations', 'groupedRealisations', 'partners'));
    }
}
