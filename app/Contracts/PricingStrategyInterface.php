<?php

namespace App\Contracts;

use App\Models\Trip;

interface PricingStrategyInterface
{
    /**
     * حساب السعر النهائي للتذكرة بناءً على الرحلة
     */
    public function calculatePrice(Trip $trip): float;
}
