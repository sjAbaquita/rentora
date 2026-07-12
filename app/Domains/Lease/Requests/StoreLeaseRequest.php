<?php

namespace App\Domains\Lease\Requests;

use App\Domains\Lease\Enums\LeaseStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLeaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Lease\Models\Lease::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_id' => 'required|exists:units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'lease_start' => 'required|date',
            'lease_end' => 'nullable|date|after:lease_start',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
            'status' => ['required', 'string', Rule::enum(LeaseStatus::class)],
        ];
    }
}
