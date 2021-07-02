<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Partner
 * @package App
 */
class Partner extends Model
{
    /**
     * @var integer
     */
    const STATUS_ON = 1;

    /**
     * @var integer
     */
    const STATUS_OFF = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'link',
        'order',
        'status'
    ];

    /**
     * @var array
     */
    protected $appends = [
        'image_path'
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
     * @return string
     */
    public function getImagePathAttribute()
    {
        return $this->image ? asset('upload/' . $this->image) : null;
    }
}
