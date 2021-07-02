<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class ProjectData
 * @package App
 */
class ProjectData extends Model
{
    use TranslationTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_id',
        'locale',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'name',
        'image',
        'author',
        'services',
        'short_description',
        'description'
    ];

    /**
     * @return string
     */
    public function getPathAttribute()
    {
        return route('projects.view', [
            'project' => str_slug($this->slug,'-')
        ]);
    }
}
