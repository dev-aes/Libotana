<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'routes',
        'terminal'
    ];

    // ==============================Relationship==================================================

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function destinations():BelongsToMany
    {
        return $this->belongsToMany(Destination::class)->withTimestamps()->using(DestinationVehicle::class);
    }
}