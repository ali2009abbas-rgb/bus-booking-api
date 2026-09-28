<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Trip;
use Illuminate\Http\JsonResponse;

class TripController extends Controller
{
    // عرض قائمة كافة الرحلات مع عدد المقاعد المتبقية
    public function index(): JsonResponse
    {
        $trips = Trip::all()->map(function ($trip) {
            return [
                'id'              => $trip->id,
                'trip_number'     => $trip->trip_number,
                'route'           => "{$trip->origin} -> {$trip->destination}",
                'departure_time'  => $trip->departure_time,
                'base_price'      => $trip->base_price,
                'total_seats'     => $trip->total_seats,
                'available_seats' => $trip->availableSeatsCount(),
                'type'            => $trip->type,
            ];
        });

        return response()->json([
            'success' => true,
            'data'    => $trips
        ], 200);
    }

    // إضافة رحلة جديدة
    public function store(StoreTripRequest $request): JsonResponse
    {
        $trip = Trip::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الرحلة بنجاح!',
            'data'    => $trip
        ], 201);
    }
}
