<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Destination extends Model implements HasMedia
{
    use 
    HasFactory,
    InteractsWithMedia
    ;

    protected $fillable = [
        'title',
        'address',
        'latitude',
        'longitude',
        'history',
    ];

    // ==============================Relationship==================================================
    
    public function vehicles():BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)->withPivot('duration')->withTimestamps()->using(DestinationVehicle::class);
    }

    // ============================== Accessor & Mutator ==========================================

    public function getFeaturedPhotoAttribute()
    {
        return $this->getFirstMedia('featured_photo')?->getUrl('card');
    }
    
    public function getOtherFeaturedPhotosAttribute()
    {
        return $this->getMedia('other_featured_photos')?->getUrl('card');
    }

    public function getAvgRatingsAttribute()
    {
        return $this->ratings()->avg('rating');
    }
 
    // ========================== Custom Methods ======================================================
    
    //media convertion
    public function registerMediaCollections(): void
    {
        $this
        ->addMediaConversion('card')
        ->width(650)
        ->nonQueued();
    }
 
}