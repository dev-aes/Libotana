<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'kilometer', 'fare', 'discounted_fare'];

    // ========================== Scope ======================================================

    public function scopeTricycle($query)
    {
        return $query->where('type', 'tricycle');
    }

    public function scopeJeepney($query)
    {
        return $query->where('type', 'jeepney');
    }
}