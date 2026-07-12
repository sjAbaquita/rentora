<?php

namespace App\Domains\Unit\Services;

use App\Domains\Unit\Enums\UnitStatus;

class UnitOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     statuses: array<int, array{value: string, label: string}>,
     *     units: array<int, array{
     *         property_name: string,
     *         name: string,
     *         floor: string,
     *         bedrooms: int,
     *         monthly_rent: string,
     *         status: string,
     *         tenant_name: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Total units',
                    'value' => '96',
                    'detail' => 'Tracked across active properties',
                ],
                [
                    'label' => 'Occupied units',
                    'value' => '78',
                    'detail' => 'Currently tied to active leases',
                ],
                [
                    'label' => 'Reserved units',
                    'value' => '6',
                    'detail' => 'Allocated for incoming tenants',
                ],
                [
                    'label' => 'Maintenance',
                    'value' => '4',
                    'detail' => 'Temporarily unavailable for occupancy',
                ],
            ],
            'statuses' => UnitStatus::options(),
            'units' => [
                [
                    'property_name' => 'Aurora Residences',
                    'name' => 'A-1203',
                    'floor' => '12',
                    'bedrooms' => 2,
                    'monthly_rent' => '18,500.00',
                    'status' => UnitStatus::Occupied->label(),
                    'tenant_name' => 'Maria Santos',
                ],
                [
                    'property_name' => 'North Gate Building',
                    'name' => 'B-2101',
                    'floor' => '21',
                    'bedrooms' => 3,
                    'monthly_rent' => '24,000.00',
                    'status' => UnitStatus::Occupied->label(),
                    'tenant_name' => 'John dela Cruz',
                ],
                [
                    'property_name' => 'Harbor House',
                    'name' => 'H-02',
                    'floor' => 'Ground',
                    'bedrooms' => 1,
                    'monthly_rent' => '12,500.00',
                    'status' => UnitStatus::Reserved->label(),
                    'tenant_name' => 'For assignment',
                ],
                [
                    'property_name' => 'Campus Stay',
                    'name' => 'R-05',
                    'floor' => '2',
                    'bedrooms' => 1,
                    'monthly_rent' => '9,800.00',
                    'status' => UnitStatus::Maintenance->label(),
                    'tenant_name' => 'Unavailable',
                ],
            ],
            'nextSteps' => [
                'Persist unit occupancy state and availability transitions.',
                'Connect each unit to the property and lease tables.',
                'Add create, edit, delete, and availability actions.',
                'Display unit occupancy data in property occupancy statistics.',
            ],
        ];
    }
}