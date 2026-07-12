<?php

namespace App\Domains\Tenant\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Tenant\Models\Tenant::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|unique:tenants,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'nationality' => 'required|string|max:100',
        ];
    }
}
