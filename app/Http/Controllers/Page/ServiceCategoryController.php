<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\ServiceCategory;
use App\Http\Controllers\Controller;
use App\RealisationCategory;


/**
 * Class ServiceCategoryController
 * @package App\Http\Controllers\Page
 */
class ServiceCategoryController extends Controller
{
    /**
     * @param Page $page
     * @param ServiceCategory $serviceCategory
     * @return $this
     */
    
    public function show(Page $page = null, ServiceCategory $serviceCategory)
    {
        $services = $serviceCategory
            ->services()
            ->translated()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        $realisationCategory = $serviceCategory->realisationCategory;

        // $realisationCategory = RealisationCategory::where('name', $serviceCategory->name)->with('realisations')->get();


        // $realisations = $realisationCategory->realisations
        //     ->active()
        //     ->with('categories.translation')
        //     ->translated()
        //     ->withTranslation()
        //     ->orderBy('order')
        //     // ->join('realisations_to_categories', 'realisations_to_categories.realisation_id', '=', 'realisations.id')
        //     ->get();

        return view('services.show', compact('page', 'serviceCategory', 'services', 'realisationCategory'));
    }
}
