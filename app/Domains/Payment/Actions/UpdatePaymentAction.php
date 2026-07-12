<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\Payment;
use Illuminate\Support\Facades\DB;

class UpdatePaymentAction
{
    public function handle(Payment $payment, array $validatedData): Payment
    {
        return DB::transaction(function () use ($payment, $validatedData) {
            $payment->update($validatedData);
            $payment->refresh();
            $payment->invoice?->refresh()->reconcile();

            return $payment;
        });
    }
}
