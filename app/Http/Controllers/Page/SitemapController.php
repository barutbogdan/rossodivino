<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Article;
use App\ServiceCategory;
use App\Project;
use App\ProjectCategory;
use Illuminate\Http\Response;

/**
 * Class SitemapController
 * @package App\Http\Controllers\Page
 */
class SitemapController
{
    /**
     * @return Response
     */
    public function index()
    {
        $pages = Page::query()
            ->where('handler_controller', '!=', 'HomeController')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();
        
        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        $categories = ServiceCategory::translated()
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

        $projects = Project::with(
            'images',
            'categories.translation'
        )
            ->active()
            ->withTranslation()
            ->orderBy('order')
            ->get();

        return response()->view('pages.sitemap', compact('pages','articles','categories','projects'))->header('Content-Type', 'text/xml');
    }
}
