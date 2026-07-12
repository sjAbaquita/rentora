<?php

namespace App\Domains\Maintenance\Requests;

use App\Domains\Maintenance\Enums\MaintenancePriority;
use App\Domains\Maintenance\Enums\MaintenanceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        $maintenance = $this->route('maintenance');

        return $maintenance && $this->user()?->can('update', $maintenance);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_id' => 'sometimes|nullable|exists:tenants,id',
            'unit_id' => 'sometimes|required|exists:units,id',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:2000',
            'priority' => ['sometimes', 'required', 'string', Rule::enum(MaintenancePriority::class)],
            'status' => ['sometimes', 'required', 'string', Rule::enum(MaintenanceStatus::class)],
            'assigned_to' => 'nullable|string|max:100',
        ];
    }
}
