<?php

namespace App;

use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class RealisationCategory
 * @package App
 */
class RealisationCategory extends Model
{
    use ScopeStatus;
    use ScopeListedBySlug;
    use TranslatableTrait;

    /**
     * @var string
     */
    protected $table = 'realisations_category';

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
    protected $fillable = ['status'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function realisations()
    {
        return $this->belongsToMany(
            Realisation::class,
            'realisations_to_categories',
            'category_id',
            'realisation_id'
        );
    }

    public function serviceCategory()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }
}
