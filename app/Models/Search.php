<?php

namespace App\Models;

use App\Traits\BelongsToDestination;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use 
    BelongsToDestination,
    BelongsToUser,
    HasFactory;

    protected $fillable = [
        'destination_id',
        'user_id',
    ];
}