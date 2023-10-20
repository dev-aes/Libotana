<?php 

namespace App\Traits;

use App\Models\Search;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySearch {

    /**
     * this model has many searches
     *
     * @return HasMany
     */
    public function searches():HasMany
    {
        return $this->hasMany(Search::class);
    }
}