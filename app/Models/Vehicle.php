<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Vehicle extends Model implements HasMedia
{
    use 
    InteractsWithMedia,
    HasFactory;

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
        return $this->belongsToMany(Destination::class)->withPivot('duration', 'fare')->withTimestamps()->using(DestinationVehicle::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('featured_photo')?->getUrl('card');
    }
    
    // public function getAvgRatingsAttribute()
    // {
    //     return $this->ratings()->avg('rating');
    // }

    // ========================== Custom Methods ======================================================
    

    //media convertion
    public function registerMediaCollections(): void
    {
        // $this
        // ->addMediaConversion('original')
        // ->width(512)
        // ->keepOriginalImageFormat()
        // ->nonQueued();

        $this
        ->addMediaConversion('card')
        ->width(650)
        ->nonQueued();
    }
}