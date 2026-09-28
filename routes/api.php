<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\VipTripController;
use Illuminate\Support\Facades\Route;

// مسارات إدارة الرحلات
Route::get('/trips', [TripController::class, 'index']);
Route::post('/trips', [TripController::class, 'store']);

// مسار الحجز العادي (التسعير القياسي)
Route::post('/bookings', [BookingController::class, 'store']);

// مسار حجز VIP (التسعير المضاف تلقائياً عبر الـ Contextual Binding)
Route::post('/vip-bookings', [VipTripController::class, 'store']);
