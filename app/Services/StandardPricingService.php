<?php

namespace App\Services;

use App\Contracts\PricingStrategyInterface;
use App\Models\Trip;

class StandardPricingService implements PricingStrategyInterface
{
    public function calculatePrice(Trip $trip): float
    {
        return (float) $trip->base_price;
    }
}
