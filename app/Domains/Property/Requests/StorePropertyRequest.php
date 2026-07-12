<?php

namespace App\Domains\Property\Requests;

use App\Domains\Property\Enums\PropertyStatus;
use App\Domains\Property\Enums\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Property\Models\Property::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'property_type' => ['required', 'string', Rule::enum(PropertyType::class)],
            'total_units' => 'required|integer|min:1',
            'year_built' => 'required|integer|min:1900|max:2100',
            'status' => ['nullable', 'string', Rule::enum(PropertyStatus::class)],
        ];
    }
}
