<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
//use App\Packages\EloquentTranslatable\TranslationTrait;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class PageImage
 * @package App
 */
class PageImage extends Model
{
    use TranslatableTrait;

    protected $table = 'pages_image';

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
        'page_id',
        'file',
    ];

    /**
     * @var array
     */
    protected $appends = [
        'path'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

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
    public function getPathAttribute()
    {
        return $this->file ? asset('upload/' . $this->file) : null;
    }
}


