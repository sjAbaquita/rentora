<?php

namespace App\Domains\Invoice\Requests;

use App\Domains\Invoice\Enums\InvoiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Invoice\Models\Invoice::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lease_id' => 'required|exists:leases,id',
            'invoice_number' => 'required|string|max:100|unique:invoices,invoice_number',
            'billing_period' => 'nullable|string|max:100',
            'amount_due' => 'required|numeric|min:0',
            'late_fee' => 'nullable|numeric|min:0',
            'due_date' => 'required|date',
            'status' => ['required', 'string', Rule::enum(InvoiceStatus::class)],
            'description' => 'nullable|string|max:1000',
        ];
    }
}
