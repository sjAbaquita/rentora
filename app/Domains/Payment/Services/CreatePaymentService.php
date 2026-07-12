<?php

namespace App\Domains\Payment\Services;

use App\Domains\Payment\Models\Payment;
use App\Domains\Payment\Requests\StorePaymentRequest;
use App\Domains\Payment\Requests\UpdatePaymentRequest;

class CreatePaymentService
{
    /**
     * @param StorePaymentRequest $request
     * @return Payment
     */
    public function store(StorePaymentRequest $request): Payment
    {
        return Payment::create($request->validated());
    }

    /**
     * @param Payment $payment
     * @param UpdatePaymentRequest $request
     * @return Payment
     */
    public function update(Payment $payment, UpdatePaymentRequest $request): Payment
    {
        $payment->update($request->validated());

        return $payment;
    }

    /**
     * @param Payment $payment
     * @return bool|null
     */
    public function destroy(Payment $payment): ?bool
    {
        return $payment->delete();
    }
}
