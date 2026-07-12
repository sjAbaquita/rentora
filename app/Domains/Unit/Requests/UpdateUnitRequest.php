<?php

namespace App\Domains\Unit\Requests;

use App\Domains\Unit\Enums\UnitStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        $unit = $this->route('unit');

        return $unit && $this->user()?->can('update', $unit);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'sometimes|required|exists:properties,id',
            'unit_number' => 'sometimes|required|string|max:50',
            'unit_type' => ['sometimes', 'required', 'string'],
            'floor_number' => 'sometimes|required|integer|min:0',
            'area_sqm' => 'sometimes|required|numeric|min:0',
            'bedrooms' => 'sometimes|required|integer|min:0',
            'bathrooms' => 'sometimes|required|integer|min:0',
            'status' => ['sometimes', 'nullable', 'string', Rule::enum(UnitStatus::class)],
        ];
    }
}
