<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hall extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'rows_count',
        'seats_in_row',
        'opening_time',
        'closing_time',
        'cleaning_time',
    ];

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }
}
