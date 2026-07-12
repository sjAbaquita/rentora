<?php

namespace App\Domains\Unit\Requests;

use App\Domains\Unit\Enums\UnitStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Unit\Models\Unit::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'property_id' => 'required|exists:properties,id',
            'unit_number' => 'required|string|max:50',
            'unit_type' => ['required', 'string'],
            'floor_number' => 'required|integer|min:0',
            'area_sqm' => 'required|numeric|min:0',
            'bedrooms' => 'required|integer|min:0',
            'bathrooms' => 'required|integer|min:0',
            'status' => ['nullable', 'string', Rule::enum(UnitStatus::class)],
        ];
    }
}
