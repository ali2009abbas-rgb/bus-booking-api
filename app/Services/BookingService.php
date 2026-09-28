<?php

namespace App\Services;

use App\Contracts\PricingStrategyInterface;
use App\Enums\BookingStatus;
use App\Exceptions\SeatNotAvailableException;
use App\Exceptions\TripNotFoundException;
use App\Models\Booking;
use App\Models\Trip;
use App\Traits\LoggableTrait;
use Illuminate\Support\Facades\DB;

class BookingService
{
    use LoggableTrait;

    // حقن العقد الخاص بالتسعير عبر الـ Constructor Injection
    public function __construct(
        protected PricingStrategyInterface $pricingStrategy
    ) {}

    /**
     * تنفيذ عملية حجز مقعد مع الحماية من الحجز المضاعف
     */
    public function createBooking(array $data): Booking
    {
        return DB::transaction(function () use ($data) {
            // 1. جلب الرحلة أو إطلاق Exception مخصص عند عدم وجودها
            $trip = Trip::find($data['trip_id']);
            if (!$trip) {
                throw new TripNotFoundException();
            }

            // 2. التحقق من توفر المقعد ورقم المقعد المسموح به
            if ($data['seat_number'] > $trip->total_seats) {
                throw new SeatNotAvailableException("رقم المقعد يتجاوز سعة الحافلة المتاحة ({$trip->total_seats})!");
            }

            $isSeatTaken = Booking::where('trip_id', $trip->id)
                ->where('seat_number', $data['seat_number'])
                ->whereIn('status', [BookingStatus::PENDING->value, BookingStatus::CONFIRMED->value])
                ->exists();

            if ($isSeatTaken) {
                throw new SeatNotAvailableException("المقعد رقم ({$data['seat_number']}) مخصص لزبون آخر مسبقاً!");
            }

            // 3. حساب السعر النهائي عبر الاستراتيجية المحقونة
            $finalPrice = $this->pricingStrategy->calculatePrice($trip);

            // 4. إنشاء الحجز
            $booking = Booking::create([
                'customer_id' => $data['customer_id'],
                'trip_id'     => $trip->id,
                'seat_number' => $data['seat_number'],
                'final_price' => $finalPrice,
                'status'      => BookingStatus::PENDING,
            ]);

            // 5. تسجيل الحدث زمنيًا عبر الـ Trait
            $this->logAction("تم تسجيل حجز جديد برقم [{$booking->id}] للمقعد [{$booking->seat_number}] بقيمة [{$finalPrice}] ل.س.");

            return $booking;
        });
    }
}
