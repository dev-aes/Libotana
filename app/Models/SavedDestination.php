<?php

namespace App\Models;

use App\Traits\BelongsToDestination;
use App\Traits\BelongsToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedDestination extends Model
{
    use 
    BelongsToDestination,
    BelongsToUser,
    HasFactory;
}