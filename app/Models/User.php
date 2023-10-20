<?php

namespace App\Models;

use App\Models\Role;
use App\Traits\HasManySearch;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use 
    HasManySearch,
    HasFactory, 
    Notifiable , 
    InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'address',
        'contact',
        'email',
        'password',
        'role_id',
        'verification_token',
        'email_verified_at',
        'is_activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    // ==============================Relationship==================================================


    public function avatar():HasOne
    {
        return $this->hasOne(Media::class, 'model_id', 'id');
    }


    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

  
    // ============================== Accessor & Mutator ==========================================

    public function getAvatarProfileAttribute()
    {
        return $this->getFirstMedia('avatar_image')?->getUrl('avatar');
    }
    
    public function getAvatarThumbnailAttribute()
    {
        return $this->getFirstMedia('avatar_image')?->getUrl('thumbnail');
    }

    // ========================== Custom Methods ======================================================

    // media convertion
    public function registerMediaCollections(): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(300)
            ->nonQueued();

        $this->addMediaConversion('avatar')
            ->width(600)
            ->nonQueued();
    }


    public function hasRole($role)
    {
       return $this->role()->where('name', $role)->first() ? true : false;
    }


    // ========================== Scope ======================================================

    public function scopeByRole($query, $role)
    {
        return is_array($role) ? $query->whereIn('role_id', $role) : $query->whereRelation('role', 'name', $role);
    }

    public function scopeActive($query)
    {
        return $query->where('is_activated', true);
    }
    
    public function scopeInactive($query)
    {
        return $query->where('is_activated', false);
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role_id', '!=', Role::ADMIN);
    }
}