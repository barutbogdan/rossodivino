<?php

namespace App\Http\Searchable\Aspects;

use App\Article;
use Illuminate\Support\Collection;
use App\Http\Searchable\SearchAspect;

/**
 * Class ArticleAspect
 * @package App\Http\Searchable\Aspects
 */
class ArticleAspect extends SearchAspect
{
    /**
     * @param string $term
     * @return Collection
     */
    public function getResults(string $term): Collection
    {
        return Article::active()
            ->translated()
            ->withTranslation()
            ->whereTranslation('name', 'LIKE', '%' . $term . '%')
            ->get();
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return trans('search.articles');
    }
}