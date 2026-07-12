<?php

namespace App\Domains\Maintenance\Requests;

use App\Domains\Maintenance\Enums\MaintenancePriority;
use App\Domains\Maintenance\Enums\MaintenanceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Maintenance\Models\MaintenanceRequest::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_id' => 'nullable|exists:tenants,id',
            'unit_id' => 'required|exists:units,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'priority' => ['required', 'string', Rule::enum(MaintenancePriority::class)],
            'status' => ['required', 'string', Rule::enum(MaintenanceStatus::class)],
            'assigned_to' => 'nullable|string|max:100',
        ];
    }
}
