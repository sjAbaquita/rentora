<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\Payment;
use Illuminate\Support\Facades\DB;

class CreatePaymentAction
{
    public function handle(array $validatedData): Payment
    {
        return DB::transaction(function () use ($validatedData) {
            $payment = Payment::create($validatedData);
            $payment->invoice?->refresh()->reconcile();

            return $payment;
        });
    }
}
