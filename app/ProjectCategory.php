<?php

namespace App;

use App\Concerns\Models\ScopeStatus;
use Illuminate\Database\Eloquent\Model;
use App\Concerns\Models\ScopeListedBySlug;
use App\Packages\Localization\Facades\Localization;
use App\Packages\EloquentTranslatable\TranslatableTrait;

/**
 * Class ProjectCategory
 * @package App
 */
class ProjectCategory extends Model
{
    use ScopeStatus;
    use ScopeListedBySlug;
    use TranslatableTrait;

    protected $table = 'projects_category';

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
     * @var array
     */
    protected $appends = ['path'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function services()
    {
        return $this->belongsToMany(
            Project::class,
            'projects_to_categories',
            'category_id',
            'project_id'
        );
    }

    /**
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    public function getPathAttribute()
    {
        return url(implode('/', array_filter([
            Localization::getCurrentLocale(),
            str_slug($this->getTranslation()->slug)
        ])));
    }
}
