<?php

namespace App;

use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class Position
 * @package App
 */
class Position extends Model
{
    use ScopeStatus,
        ScopeListedBySlug,
        TranslatableTrait;

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
    protected $fillable = ['order',  'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(
            PositionCategory::class,
            'positions_to_category',
            'position_id',
            'category_id'
        );
    }
}
