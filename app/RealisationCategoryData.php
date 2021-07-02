<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class RealisationCategoryData
 * @package App
 */
class RealisationCategoryData extends Model
{
    use TranslationTrait;

    /**
     * @var string
     */
    protected $table = 'realisations_category_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'realisation_category_id',
        'locale',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'name',
        'short_description',
        'description'
    ];
}
