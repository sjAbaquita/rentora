<?php

namespace App\Domains\Payment\Controllers;

use App\Domains\Payment\Actions\CreatePaymentAction;
use App\Domains\Payment\Actions\DeletePaymentAction;
use App\Domains\Payment\Actions\UpdatePaymentAction;
use App\Domains\Payment\Models\Payment;
use App\Domains\Payment\Requests\StorePaymentRequest;
use App\Domains\Payment\Requests\UpdatePaymentRequest;
use App\Domains\Payment\Services\PaymentService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class PaymentController extends Controller
{
    public function __construct(
        private readonly PaymentService $paymentService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Payment::class);

        return Inertia::render('payments/Index', [
            'payments' => $this->paymentService->getPayments(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Payment::class);

        return Inertia::render('payments/Create');
    }

    public function store(StorePaymentRequest $request, CreatePaymentAction $action): RedirectResponse
    {
        $this->authorize('create', Payment::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Payment created.')]);

        return to_route('payments.index');
    }

    public function edit(Payment $payment): Response
    {
        $this->authorize('update', $payment);

        return Inertia::render('payments/Edit', [
            'payment' => $payment,
        ]);
    }

    public function update(Payment $payment, UpdatePaymentRequest $request, UpdatePaymentAction $action): RedirectResponse
    {
        $this->authorize('update', $payment);

        $action->handle($payment, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Payment updated.')]);

        return to_route('payments.index');
    }

    public function destroy(Payment $payment, DeletePaymentAction $action): RedirectResponse
    {
        $this->authorize('delete', $payment);

        $action->handle($payment);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Payment deleted.')]);

        return to_route('payments.index');
    }
}
