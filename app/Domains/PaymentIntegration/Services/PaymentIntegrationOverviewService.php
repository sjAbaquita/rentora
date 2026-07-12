<?php

namespace App\Domains\PaymentIntegration\Services;

use App\Domains\PaymentIntegration\Enums\PaymentGateway;

class PaymentIntegrationOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     gateways: array<int, array{value: string, label: string}>,
     *     integrations: array<int, array{
     *         gateway: string,
     *         status: string,
     *         live_mode: string,
     *         configured_at: string,
     *         transaction_count: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Active gateways',
                    'value' => '3',
                    'detail' => 'GCash, Maya, and Stripe configured',
                ],
                [
                    'label' => 'Total transactions',
                    'value' => '4,281',
                    'detail' => 'Processed across all channels',
                ],
                [
                    'label' => 'Settlement rate',
                    'value' => '99.7%',
                    'detail' => 'Reliable payment flow',
                ],
                [
                    'label' => 'Currency support',
                    'value' => 'PHP / USD',
                    'detail' => 'Local and international',
                ],
            ],
            'gateways' => PaymentGateway::options(),
            'integrations' => [
                [
                    'gateway' => PaymentGateway::GCash->label(),
                    'status' => 'Active',
                    'live_mode' => 'Yes',
                    'configured_at' => '2025-12-15',
                    'transaction_count' => '2,845',
                ],
                [
                    'gateway' => PaymentGateway::Maya->label(),
                    'status' => 'Active',
                    'live_mode' => 'Yes',
                    'configured_at' => '2026-01-08',
                    'transaction_count' => '1,236',
                ],
                [
                    'gateway' => PaymentGateway::Stripe->label(),
                    'status' => 'Test',
                    'live_mode' => 'No',
                    'configured_at' => '2026-03-22',
                    'transaction_count' => '200',
                ],
            ],
            'nextSteps' => [
                'Implement webhook handlers for payment status updates.',
                'Add reconciliation and settlement tracking.',
                'Create refund and dispute management flows.',
                'Configure payout schedules per gateway.',
            ],
        ];
    }
}
