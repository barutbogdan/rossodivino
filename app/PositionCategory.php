<?php

namespace App;

use App\Concerns\Models\ScopeListedBySlug;
use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class PositionCategory
 * @package App
 */
class PositionCategory extends Model
{
    use ScopeStatus;
    use ScopeListedBySlug;
    use TranslatableTrait;

    /**
     * @var string
     */
    protected $table = 'positions_category';

    /**
     * @var integer
     */
    const ENUM_ACTIVE = 'active';

    /**
     * @var integer
     */
    const ENUM_INACTIVE = 'inactive';

    /**
     * @var array
     */
    protected $fillable = ['image', 'status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function positions()
    {
        return $this->belongsToMany(
            Position::class,
            'positions_to_category',
            'category_id',
            'position_id'
        );
    }
}
