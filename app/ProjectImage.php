<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Packages\EloquentTranslatable\TranslationTrait;

/**
 * Class ProjectImage
 * @package App
 */
class ProjectImage extends Model
{
    use TranslationTrait;

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
        'project_id',
        'file',
        'name',
        'short_description',
        'description'
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
    public function project()
    {
        return $this->belongsTo(Project::class);
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
