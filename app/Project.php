<?php

namespace App;

use App\Http\Searchable\Searchable;
use App\Http\Searchable\SearchResult;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\Localization\Facades\Localization;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class Project
 *
 * @package App
 */
class Project extends Model implements Searchable
{
    use HasSeoMeta,
        TranslatableTrait,
        ScopeListedBySlug;

    /**
     * @var integer
     */
    const STATUS_ON = 1;

    /**
     * @var integer
     */
    const STATUS_OFF = 0;

    /**
     * @var array
     */
    protected $fillable = ['image', 'published_at', 'status'];

    /**
     * @var array
     */
    protected $casts = [
        'published_at' => 'date'
    ];

    /**
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', self::STATUS_ON);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            ProjectCategory::class,
            'projects_to_categories',
            'project_id',
            'category_id'
        );
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        $page = page('ProjectsController');

        return url(implode('/', array_filter([
            $page ? $page->path : Localization::getCurrentLocale(),
            str_slug($this->getTranslation()->slug ?? '')
        ])));
    }

    /**
     * @return SearchResult
     */
    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->getTranslation()->name,
            $this->path
        );
    }
}
