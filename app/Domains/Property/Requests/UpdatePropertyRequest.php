<?php

namespace App\Domains\Property\Requests;

use App\Domains\Property\Enums\PropertyStatus;
use App\Domains\Property\Enums\PropertyType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        $property = $this->route('property');

        return $property && $this->user()?->can('update', $property);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:100',
            'postal_code' => 'sometimes|required|string|max:20',
            'property_type' => ['sometimes', 'required', 'string', Rule::enum(PropertyType::class)],
            'total_units' => 'sometimes|required|integer|min:1',
            'year_built' => 'sometimes|required|integer|min:1900|max:2100',
            'status' => ['sometimes', 'nullable', 'string', Rule::enum(PropertyStatus::class)],
        ];
    }
}
