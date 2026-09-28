<?php

namespace App\Providers;

use App\Contracts\PricingStrategyInterface;
use App\Http\Controllers\VipTripController;
use App\Services\StandardPricingService;
use App\Services\VipPricingService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // 1. الربط الافتراضي (Default Binding)
        // عند طلب PricingStrategyInterface في أي مكان، يتم تقديم StandardPricingService
        $this->app->bind(PricingStrategyInterface::class, StandardPricingService::class);

        // 2. الربط السياقي المبرر (Contextual Binding)
        // فقط عندما يتم طلب الحقن داخل VipTripController، يتم حقن VipPricingService
        $this->app->when(VipTripController::class)
            ->needs(PricingStrategyInterface::class)
            ->give(VipPricingService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
