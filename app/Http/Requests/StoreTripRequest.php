<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'trip_number'    => 'required|string|unique:trips,trip_number',
            'origin'         => 'required|string',
            'destination'    => 'required|string',
            'departure_time' => 'required|date|after:now',
            'base_price'     => 'required|numeric|min:0',
            'total_seats'    => 'required|integer|min:1',
            'type'           => 'required|in:standard,vip',
        ];
    }
}
