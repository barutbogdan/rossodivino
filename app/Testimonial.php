<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class Testimonial
 *
 * @package App
 */
class Testimonial extends Model
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
     * @param Builder $builder
     *
     * @return Builder
     */
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', self::STATUS_ON);
    }

    public function hasImage()
    {
        return Storage::disk('admin')->exists($this->image);
    }

    /**
     * @return string
     */
    public function imagePath()
    {
        return asset('upload/' . $this->image);
    }
}
