<?php

namespace App\Domains\Payment\Actions;

use App\Domains\Payment\Models\Payment;
use Illuminate\Support\Facades\DB;

class DeletePaymentAction
{
    public function handle(Payment $payment): void
    {
        DB::transaction(function () use ($payment) {
            $payment->delete();
        });
    }
}
