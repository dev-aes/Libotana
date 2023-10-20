<?php 

namespace App\Traits;

use App\Models\Destination;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToDestination {

    /**
     * this model belongs to destination
     *
     * @return BelongsTo
     */
    public function destination():BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}