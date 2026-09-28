<?php

namespace App\Models;

use App\Enums\BookingStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'trip_id', 'seat_number', 'final_price', 'status'
    ];
    protected $casts = [
        'status' => BookingStatus::class,
    ];
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function trip(): BelongsTo
    {
        return $this->belongsTo(Trip::class);
    }
}
