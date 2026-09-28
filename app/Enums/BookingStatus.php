<?php

namespace App\Enums;

enum BookingStatus: string
{
    case PENDING   = 'pending';   // حجز معلق بانتظار التأكيد أو الدفع
    case CONFIRMED = 'confirmed'; // حجز مؤكد
    case CANCELLED = 'cancelled'; // حجز ملغى

    public function label(): string
    {
        return match($this) {
            self::PENDING   => 'حجز معلق',
            self::CONFIRMED => 'حجز مؤكد',
            self::CANCELLED => 'حجز ملغى',
        };
    }
}
