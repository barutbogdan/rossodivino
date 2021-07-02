<?php

namespace App;

use App\Concerns\Models\ScopeIsHome;
use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class TeamCategory
 * @package App
 */
class TeamCategory extends Model
{
    use ScopeStatus;
    use ScopeIsHome;
    use ScopeListedBySlug;
    use TranslatableTrait;

    /**
     * @var string
     */
    protected $table = 'team_category';

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
    public function teams()
    {
        return $this->belongsToMany(
            Team::class,
            'team_to_category',
            'category_id',
            'team_id'
        );
    }
}
