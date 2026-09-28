<?php

namespace App\Services;

use App\Contracts\PricingStrategyInterface;
use App\Models\Trip;

class VipPricingService implements PricingStrategyInterface
{
    public function calculatePrice(Trip $trip): float
    {
        // إضافة 20% على السعر الأساسي لرحلات الـ VIP
        return round($trip->base_price * 1.20, 2);
    }
}
