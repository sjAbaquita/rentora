<?php

namespace App\Domains\Invoice\Requests;

use App\Domains\Invoice\Enums\InvoiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        $invoice = $this->route('invoice');

        return $invoice && $this->user()?->can('update', $invoice);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $invoice = $this->route('invoice');

        return [
            'lease_id' => 'sometimes|required|exists:leases,id',
            'invoice_number' => [
                'sometimes',
                'required',
                'string',
                'max:100',
                Rule::unique('invoices', 'invoice_number')->ignore($invoice?->id),
            ],
            'billing_period' => 'sometimes|nullable|string|max:100',
            'amount_due' => 'sometimes|required|numeric|min:0',
            'late_fee' => 'sometimes|nullable|numeric|min:0',
            'due_date' => 'sometimes|required|date',
            'status' => ['sometimes', 'required', 'string', Rule::enum(InvoiceStatus::class)],
            'description' => 'nullable|string|max:1000',
        ];
    }
}
