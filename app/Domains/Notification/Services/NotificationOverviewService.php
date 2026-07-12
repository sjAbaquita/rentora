<?php

namespace App\Domains\Notification\Services;

use App\Domains\Notification\Enums\NotificationChannel;

class NotificationOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     channels: array<int, array{value: string, label: string}>,
     *     notifications: array<int, array{
     *         title: string,
     *         channel: string,
     *         recipient: string,
     *         sent_at: string,
     *         status: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Delivered',
                    'value' => '241',
                    'detail' => 'Messages sent across email and database channels',
                ],
                [
                    'label' => 'Pending',
                    'value' => '18',
                    'detail' => 'Queued notifications awaiting dispatch',
                ],
                [
                    'label' => 'Failed',
                    'value' => '2',
                    'detail' => 'Needs delivery retry or channel review',
                ],
                [
                    'label' => 'Channels',
                    'value' => '3',
                    'detail' => 'Email, database, and SMS paths',
                ],
            ],
            'channels' => NotificationChannel::options(),
            'notifications' => [
                [
                    'title' => 'Rent reminder sent',
                    'channel' => NotificationChannel::Email->label(),
                    'recipient' => 'All tenants',
                    'sent_at' => '2026-06-20 09:00',
                    'status' => 'Delivered',
                ],
                [
                    'title' => 'New announcement in portal',
                    'channel' => NotificationChannel::Database->label(),
                    'recipient' => 'Maria Santos',
                    'sent_at' => '2026-06-21 08:15',
                    'status' => 'Delivered',
                ],
                [
                    'title' => 'Maintenance window alert',
                    'channel' => NotificationChannel::Email->label(),
                    'recipient' => 'North Gate Building',
                    'sent_at' => '2026-06-22 07:30',
                    'status' => 'Pending',
                ],
                [
                    'title' => 'Payment receipt notice',
                    'channel' => NotificationChannel::Sms->label(),
                    'recipient' => 'Jun Reyes',
                    'sent_at' => '2026-06-22 12:10',
                    'status' => 'Failed',
                ],
            ],
            'nextSteps' => [
                'Connect notification dispatch to announcement, invoice, and maintenance events.',
                'Add per-user notification preferences.',
                'Create retry handling and delivery logs.',
                'Expose an in-app notification inbox for tenants and staff.',
            ],
        ];
    }
}