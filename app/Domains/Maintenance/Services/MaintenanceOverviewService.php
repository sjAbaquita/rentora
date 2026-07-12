<?php

namespace App\Domains\Maintenance\Services;

use App\Domains\Maintenance\Enums\MaintenancePriority;
use App\Domains\Maintenance\Enums\MaintenanceStatus;

class MaintenanceOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     priorities: array<int, array{value: string, label: string}>,
     *     statuses: array<int, array{value: string, label: string}>,
     *     requests: array<int, array{
     *         title: string,
     *         tenant_name: string,
     *         property_name: string,
     *         unit_name: string,
     *         priority: string,
     *         status: string,
     *         photo_count: int,
     *         reported_at: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Open requests',
                    'value' => '14',
                    'detail' => 'Requests currently waiting to be handled',
                ],
                [
                    'label' => 'In progress',
                    'value' => '6',
                    'detail' => 'Requests actively being worked on',
                ],
                [
                    'label' => 'Completed',
                    'value' => '38',
                    'detail' => 'Closed requests in the current cycle',
                ],
                [
                    'label' => 'With photos',
                    'value' => '11',
                    'detail' => 'Requests with image attachments',
                ],
            ],
            'priorities' => MaintenancePriority::options(),
            'statuses' => MaintenanceStatus::options(),
            'requests' => [
                [
                    'title' => 'Air conditioning leak',
                    'tenant_name' => 'Maria Santos',
                    'property_name' => 'Aurora Residences',
                    'unit_name' => 'A-1203',
                    'priority' => MaintenancePriority::High->label(),
                    'status' => MaintenanceStatus::Open->label(),
                    'photo_count' => 3,
                    'reported_at' => '2026-06-19',
                ],
                [
                    'title' => 'Bathroom faucet replacement',
                    'tenant_name' => 'John dela Cruz',
                    'property_name' => 'North Gate Building',
                    'unit_name' => 'B-2101',
                    'priority' => MaintenancePriority::Medium->label(),
                    'status' => MaintenanceStatus::InProgress->label(),
                    'photo_count' => 1,
                    'reported_at' => '2026-06-18',
                ],
                [
                    'title' => 'Dorm light bulb reset',
                    'tenant_name' => 'Angela Reyes',
                    'property_name' => 'Campus Stay',
                    'unit_name' => 'R-05',
                    'priority' => MaintenancePriority::Low->label(),
                    'status' => MaintenanceStatus::Completed->label(),
                    'photo_count' => 0,
                    'reported_at' => '2026-06-16',
                ],
                [
                    'title' => 'Door lock alignment',
                    'tenant_name' => 'Miguel Tan',
                    'property_name' => 'Harbor House',
                    'unit_name' => 'H-02',
                    'priority' => MaintenancePriority::Medium->label(),
                    'status' => MaintenanceStatus::Open->label(),
                    'photo_count' => 2,
                    'reported_at' => '2026-06-20',
                ],
            ],
            'nextSteps' => [
                'Add tenant request submission and photo upload forms.',
                'Route requests through priority and status workflows.',
                'Attach maintenance records to units and tenants.',
                'Send notifications when request status changes.',
            ],
        ];
    }
}