<?php

namespace App\Http\SluggableHandlers\Page;

use App\Page;
use App\ServiceCategory;
use App\Packages\Sluggable\Routing\Slug;
use App\Packages\Sluggable\Routing\Handler;
use App\Packages\Sluggable\Routing\ControllerBag;
use App\Http\Controllers\Page\ServiceCategoryController;

/**
 * Class ServicePageHandler
 * @package App\Http\SluggableHandlers\Page
 */
class ServiceCategoryHandler extends Handler
{
    /**
     * Expected slug-type pairs.
     *
     * @var array
     */
    protected $expectedSlugs = [
        'slug' => Slug::class,
    ];

    /**
     * Use the current slug collection to create and return
     * a ControllerBag object, or return false.
     *
     * @return \App\Packages\Sluggable\Contracts\Routing\ControllerBag|bool
     */
    protected function makeControllerBag()
    {
        $slugs = $this->slugCollection->getSlug('slug');

        if (null === $serviceCategory = $this->findServiceCategoryBySlug($slugs)) {
            return false;
        }
        
        \LanguageSelector::setLanguages($serviceCategory);
        
        return new ControllerBag(
            ServiceCategoryController::class,
            'show',
            [null, $serviceCategory]
        );
    }

    /**
     * @param Query $slugs
     * @return ServiceCategory|null
     */
    protected function findServiceCategoryBySlug(Slug $slugs)
    {
        if (null === $slug = $slugs->getValue()) {
            return null;
        }
        
        return ServiceCategory::listedBySlug($slug)->first();
    }
}
