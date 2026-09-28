<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'customer_id' => 'required|exists:customers,id',
            'trip_id'     => 'required|exists:trips,id',
            'seat_number' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'customer_id.required' => 'الرجاء تحديد الزبون.',
            'customer_id.exists'   => 'الزبون المختار غير موجود في النظام.',
            'trip_id.required'     => 'الرجاء تحديد الرحلة.',
            'trip_id.exists'       => 'الرحلة المختارة غير موجودة.',
            'seat_number.required' => 'رقم المقعد مطلوب.',
            'seat_number.min'      => 'رقم المقعد يجب أن يكون 1 أو أكثر.',
        ];
    }
}
