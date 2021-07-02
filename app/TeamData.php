<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class PageData
 *
 * @package App
 */
class TeamData extends Model
{
    use TranslationTrait;

    /**
     * @var string
     */
    protected $table = 'team_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_id',
        'locale',
        'slug',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'name',
        'link',
        'position',
        'short_description',
        'description'
    ];
}
