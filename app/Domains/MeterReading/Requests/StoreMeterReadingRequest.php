<?php

namespace App\Domains\MeterReading\Requests;

use App\Domains\MeterReading\Enums\MeterReadingType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMeterReadingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\MeterReading\Models\MeterReading::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'unit_id' => 'nullable|exists:units,id',
            'reading_type' => ['required', 'string', Rule::enum(MeterReadingType::class)],
            'previous_reading' => 'required|numeric|min:0',
            'current_reading' => 'required|numeric|gt:previous_reading',
            'recorded_at' => 'required|date',
        ];
    }
}
