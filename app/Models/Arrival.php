<?php

namespace App\Models;

use App\Traits\BelongsToDestination;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Arrival extends Model
{
    use 
    BelongsToDestination,
    BelongsToUser,
    HasFactory;

    protected $fillable = ['user_id', 'destination_id'];

    // ==============================Relationship==================================================
}