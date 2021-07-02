<?php

namespace App;

use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;
use App\Packages\EloquentTaggable\Taggable\TaggableTrait;

/**
 * Class Page
 *
 * @package App
 */
class Team extends Model
{
    use ScopeStatus,
        TaggableTrait,
        ScopeListedBySlug,
        TranslatableTrait;

    /**
     * @var string
     */
    protected $table = 'team';

    /**
     * @var string
     */
    const ENUM_ACTIVE = 'active';

    /**
     * @var string
     */
    const ENUM_INACTIVE = 'inactive';

    /**
     * @var array
     */
    protected $appends = ['image_path'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['image', 'order', 'is_home', 'is_about_us', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            TeamCategory::class,
            'team_to_category',
            'team_id',
            'category_id'
        );
    }

    /**
     * @return null|string
     */
    public function getImagePathAttribute()
    {
        return $this->image ? asset('upload/' . $this->image) : null;
    }
}
