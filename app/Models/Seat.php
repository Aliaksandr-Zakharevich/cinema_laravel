<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'row',
        'number',
        'hall_id',
        'session_id',
        'seat_type_id',
        'seat_status_id',
        'is_active'
    ];


    public function hall(): BelongsTo
    {
        return $this->belongsTo(Hall::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function seatType(): BelongsTo
    {
        return $this->belongsTo(SeatType::class);
    }

    public function seatStatus(): BelongsTo
    {
        return $this->belongsTo(SeatStatus::class);
    }
}
