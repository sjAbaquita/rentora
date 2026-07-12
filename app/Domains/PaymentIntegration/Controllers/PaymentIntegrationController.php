<?php

namespace App\Domains\PaymentIntegration\Controllers;

use App\Domains\PaymentIntegration\Services\PaymentIntegrationOverviewService;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class PaymentIntegrationController extends Controller
{
    public function __construct(
        private readonly PaymentIntegrationOverviewService $paymentIntegrationOverviewService,
    ) {
    }

    /**
     * Show the payment integration overview.
     */
    public function index(): Response
    {
        $this->authorize('viewAny', \App\Domains\PaymentIntegration\Enums\PaymentGateway::class);

        return Inertia::render('payment-integration/Index', $this->paymentIntegrationOverviewService->overview());
    }
}
