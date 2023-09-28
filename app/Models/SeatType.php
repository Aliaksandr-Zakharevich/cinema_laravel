<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeatType extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'price'
    ];

    public function seat(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
