<?php

namespace App\Domains\Payment\Requests;

use App\Domains\Payment\Enums\PaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        $payment = $this->route('payment');

        return $payment && $this->user()?->can('update', $payment);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'invoice_id' => 'sometimes|required|exists:invoices,id',
            'tenant_id' => 'sometimes|nullable|exists:tenants,id',
            'amount' => 'sometimes|required|numeric|min:0',
            'method' => ['sometimes', 'required', 'string', Rule::enum(PaymentMethod::class)],
            'paid_at' => 'sometimes|required|date',
            'reference_number' => 'nullable|string|max:100',
            'proof_status' => 'nullable|string|max:50',
        ];
    }
}
