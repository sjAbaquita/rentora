<?php

namespace App\Domains\Payment\Requests;

use App\Domains\Payment\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Payment\Models\Payment::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => 'required|exists:invoices,id',
            'tenant_id' => 'nullable|exists:tenants,id',
            'amount' => 'required|numeric|min:0',
            'method' => ['required', 'string', Rule::enum(PaymentMethod::class)],
            'paid_at' => 'required|date',
            'reference_number' => 'nullable|string|max:100',
            'proof_status' => 'nullable|string|max:50',
        ];
    }
}
