<?php

namespace App\Domains\Document\Services;

use App\Domains\Document\Enums\DocumentType;

class DocumentOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     documentTypes: array<int, array{value: string, label: string}>,
     *     documents: array<int, array{
     *         title: string,
     *         document_type: string,
     *         owner: string,
     *         uploaded_at: string,
     *         notes: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Stored files',
                    'value' => '128',
                    'detail' => 'Leases, receipts, IDs, and permits',
                ],
                [
                    'label' => 'Linked to tenants',
                    'value' => '92',
                    'detail' => 'Documents associated with tenant profiles',
                ],
                [
                    'label' => 'Compliance items',
                    'value' => '24',
                    'detail' => 'Permits and verification assets',
                ],
                [
                    'label' => 'Archive rate',
                    'value' => '98%',
                    'detail' => 'Well-structured document retention',
                ],
            ],
            'documentTypes' => DocumentType::options(),
            'documents' => [
                [
                    'title' => 'Tenant lease agreement - Unit 4B',
                    'document_type' => DocumentType::Lease->label(),
                    'owner' => 'Maria Santos',
                    'uploaded_at' => '2026-06-01 10:15',
                    'notes' => 'Signed lease file attached to the active tenancy.',
                ],
                [
                    'title' => 'June rent receipt - Unit 2A',
                    'document_type' => DocumentType::Receipt->label(),
                    'owner' => 'Jun Reyes',
                    'uploaded_at' => '2026-06-03 08:40',
                    'notes' => 'Generated after successful payment reconciliation.',
                ],
                [
                    'title' => 'Government ID - Tenant verification',
                    'document_type' => DocumentType::Identification->label(),
                    'owner' => 'Lara Gomez',
                    'uploaded_at' => '2026-06-04 14:20',
                    'notes' => 'Used for onboarding and identity confirmation.',
                ],
                [
                    'title' => 'Fire safety permit',
                    'document_type' => DocumentType::Permit->label(),
                    'owner' => 'North Gate Building',
                    'uploaded_at' => '2026-05-28 16:00',
                    'notes' => 'Compliance record for the building administration.',
                ],
            ],
            'nextSteps' => [
                'Add upload, preview, replace, and archive actions.',
                'Store files against tenants, units, leases, and maintenance cases.',
                'Add secure access policies and download permissions.',
                'Generate document events for audit and notification flows.',
            ],
        ];
    }
}