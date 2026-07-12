<?php

namespace App\Domains\Organization\Services;

class OrganizationOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     organization: array{name: string, email: string, country: string, timezone: string, created_at: string},
     *     teamMembers: array<int, array{name: string, email: string, role: string, status: string}>,
     *     billingInfo: array{plan: string, monthly_cost: string, next_billing: string, status: string},
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Organization',
                    'value' => '1',
                    'detail' => 'Single entity in the current account',
                ],
                [
                    'label' => 'Team members',
                    'value' => '3',
                    'detail' => 'Active users with assigned roles',
                ],
                [
                    'label' => 'Properties managed',
                    'value' => '11',
                    'detail' => 'Across all property types',
                ],
                [
                    'label' => 'Plan status',
                    'value' => 'Active',
                    'detail' => 'Standard subscription with upsize path',
                ],
            ],
            'organization' => [
                'name' => 'Aurora Properties Inc.',
                'email' => 'billing@auroraproperties.ph',
                'country' => 'Philippines',
                'timezone' => 'Asia/Manila',
                'created_at' => '2025-10-01',
            ],
            'teamMembers' => [
                [
                    'name' => 'Alice Johnson',
                    'email' => 'alice@auroraproperties.ph',
                    'role' => 'Owner',
                    'status' => 'Active',
                ],
                [
                    'name' => 'Bob Chen',
                    'email' => 'bob@auroraproperties.ph',
                    'role' => 'Manager',
                    'status' => 'Active',
                ],
                [
                    'name' => 'Carol Williams',
                    'email' => 'carol@auroraproperties.ph',
                    'role' => 'Staff',
                    'status' => 'Active',
                ],
            ],
            'billingInfo' => [
                'plan' => 'Standard (11 properties)',
                'monthly_cost' => '₱12,000',
                'next_billing' => '2026-07-21',
                'status' => 'Paid',
            ],
            'nextSteps' => [
                'Add RBAC and permission management to team roles.',
                'Implement billing and subscription upgrade workflows.',
                'Build API key management for integrations.',
                'Add audit logs for compliance and governance.',
            ],
        ];
    }
}
