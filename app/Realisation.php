<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class Realisation
 *
 * @package App
 */
class Realisation extends Model
{
    use TranslatableTrait;

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
    protected $fillable = ['image', 'status'];

    /**
     * @var array
     */
    protected $appends = ['image_path'];

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
     * @return string
     */
    public function getImagePathAttribute()
    {
        return $this->image ? asset('upload/' . $this->image) : null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            RealisationCategory::class,
            'realisations_to_categories',
            'realisation_id',
            'category_id'
        );
    }
}
