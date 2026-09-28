<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_number', 'origin', 'destination',
        'departure_time', 'base_price', 'total_seats', 'type'
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    // حساب المقاعد المتبقية ديناميكياً
    public function availableSeatsCount(): int
    {
        $bookedSeats = $this->bookings()
            ->whereIn('status', ['confirmed', 'pending'])
            ->count();

        return $this->total_seats - $bookedSeats;
    }
}
