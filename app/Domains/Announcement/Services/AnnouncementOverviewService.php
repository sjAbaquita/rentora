<?php

namespace App\Domains\Announcement\Services;

use App\Domains\Announcement\Enums\AnnouncementStatus;

class AnnouncementOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     statuses: array<int, array{value: string, label: string}>,
     *     announcements: array<int, array{
     *         title: string,
     *         audience: string,
     *         publish_at: string,
     *         status: string,
     *         summary: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Published',
                    'value' => '12',
                    'detail' => 'Announcements visible to tenants and staff',
                ],
                [
                    'label' => 'Scheduled',
                    'value' => '3',
                    'detail' => 'Queued for future publishing',
                ],
                [
                    'label' => 'Drafts',
                    'value' => '5',
                    'detail' => 'Saved but not yet announced',
                ],
                [
                    'label' => 'Audience reach',
                    'value' => 'All tenants',
                    'detail' => 'Tenant portal and internal staff updates',
                ],
            ],
            'statuses' => AnnouncementStatus::options(),
            'announcements' => [
                [
                    'title' => 'June rent reminders',
                    'audience' => 'All tenants',
                    'publish_at' => '2026-06-01 08:00',
                    'status' => AnnouncementStatus::Published->label(),
                    'summary' => 'Reminder to settle monthly rent before the due date.',
                ],
                [
                    'title' => 'Water supply maintenance',
                    'audience' => 'Aurora Residences',
                    'publish_at' => '2026-06-22 06:00',
                    'status' => AnnouncementStatus::Scheduled->label(),
                    'summary' => 'Temporary interruption affecting the common water line.',
                ],
                [
                    'title' => 'Lobby cleaning schedule',
                    'audience' => 'North Gate Building',
                    'publish_at' => '2026-06-15 09:00',
                    'status' => AnnouncementStatus::Published->label(),
                    'summary' => 'Updated cleaning schedule for shared spaces and hallways.',
                ],
                [
                    'title' => 'Portal maintenance window',
                    'audience' => 'All tenants',
                    'publish_at' => '2026-06-25 23:00',
                    'status' => AnnouncementStatus::Draft->label(),
                    'summary' => 'Planned downtime for tenant portal maintenance and updates.',
                ],
            ],
            'nextSteps' => [
                'Add announcement create, edit, publish, and archive actions.',
                'Target announcements by property or tenant segment.',
                'Send email and database notifications when content is published.',
                'Expose announcement feeds in the tenant portal.'
            ],
        ];
    }
}