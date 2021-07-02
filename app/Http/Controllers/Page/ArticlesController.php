<?php

namespace App\Http\Controllers\Page;

use App\Page;
use App\Article;
use App\Partner;
use App\Team;
use App\Http\Controllers\Controller;

/**
 * Class ArticlesController
 * @package App\Http\Controllers\Page
 */
class ArticlesController extends Controller
{
    /**
     * @param Page $page
     * @param $view
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Page $page, $view)
    {
        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
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

        return view($view, compact('page', 'articles', 'partners', 'teams'));
    }

    /**
     * @param Page $page
     * @param Article $article
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page, Article $article)
    {
        
        $articles = Article::translated()
            ->with('categories.translation')
            ->withTranslation()
            ->active()
            ->orderBy('order', 'asc')
            ->get();

            $prev = Article::active()
                ->translated()
                ->withTranslation()
                ->orderBy('order', 'desc')
                ->where('id', '<', $article->id)
                ->limit(1)
                ->first();

        $next = Article::active()
            ->translated()
            ->withTranslation()
            ->orderBy('order', 'asc')
            ->where('id', '>', $article->id)
            ->limit(1)
            ->first();

        $ids = [$article->id];

        if ($prev) {
            array_push($ids, $prev->id);
        }

        if ($next) {
            array_push($ids, $next->id);
        }
        
            return view('pages.article', compact('page', 'article', 'articles', 'next', 'prev'));
    }
}
