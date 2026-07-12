<?php

namespace App\Domains\Tenant\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        $tenant = $this->route('tenant');

        return $tenant && $this->user()?->can('update', $tenant);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $tenant = $this->route('tenant');

        return [
            'first_name' => 'sometimes|required|string|max:100',
            'last_name' => 'sometimes|required|string|max:100',
            'email' => [
                'sometimes',
                'required',
                'email',
                Rule::unique('tenants', 'email')->ignore($tenant?->id),
            ],
            'phone' => 'sometimes|required|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'nationality' => 'sometimes|required|string|max:100',
        ];
    }
}
