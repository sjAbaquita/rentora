<?php

namespace App\Domains\Lease\Requests;

use App\Domains\Lease\Enums\LeaseStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLeaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        $lease = $this->route('lease');

        return $lease && $this->user()?->can('update', $lease);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_id' => 'sometimes|required|exists:units,id',
            'tenant_id' => 'sometimes|required|exists:tenants,id',
            'lease_start' => 'sometimes|required|date',
            'lease_end' => 'sometimes|required|date|after:lease_start',
            'monthly_rent' => 'sometimes|required|numeric|min:0',
            'deposit' => 'sometimes|required|numeric|min:0',
            'status' => ['sometimes', 'required', 'string', Rule::enum(LeaseStatus::class)],
        ];
    }
}
