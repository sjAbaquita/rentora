<?php

namespace App\Domains\MeterReading\Requests;

use App\Domains\MeterReading\Enums\MeterReadingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMeterReadingRequest extends FormRequest
{
    public function authorize(): bool
    {
        $meterReading = $this->route('meter_reading');

        return $meterReading && $this->user()?->can('update', $meterReading);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'sometimes|required|exists:properties,id',
            'unit_id' => 'sometimes|nullable|exists:units,id',
            'reading_type' => ['sometimes', 'required', 'string', Rule::enum(MeterReadingType::class)],
            'previous_reading' => 'sometimes|required|numeric|min:0',
            'current_reading' => 'sometimes|required|numeric|gt:previous_reading',
            'recorded_at' => 'sometimes|required|date',
        ];
    }
}
