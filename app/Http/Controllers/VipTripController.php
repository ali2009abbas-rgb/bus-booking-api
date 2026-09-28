<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;

class VipTripController extends Controller
{
    public function __construct(
        protected BookingService $bookingService
    ) {}

    public function store(StoreBookingRequest $request): JsonResponse
    {
        $booking = $this->bookingService->createBooking($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء حجز الـ VIP بنجاح مع تطبيق زيادة الخدمة الممتازة (20%)!',
            'data'    => [
                'booking_id'  => $booking->id,
                'trip_id'     => $booking->trip_id,
                'seat_number' => $booking->seat_number,
                'final_price' => $booking->final_price,
                'status'      => $booking->status->label(),
                'logs'        => $this->bookingService->getLogs(),
            ]
        ], 201);
    }
}
