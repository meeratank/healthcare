<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'healthcare_professional_id' => 'required|integer',
            'appointment_start_time' => 'required|date_format:Y-m-d H:i:s|after:1 hours|before:appointment_end_time',
            'appointment_end_time' => 'required|date_format:Y-m-d H:i:s|after:1 hours|after:appointment_start_time',
            //'status' => 'required|string|in:booked, completed, cancelled'

        ];
    }
}
