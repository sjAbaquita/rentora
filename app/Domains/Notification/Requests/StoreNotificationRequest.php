<?php

namespace App\Domains\Notification\Requests;

use App\Domains\Notification\Enums\NotificationChannel;
use App\Domains\Notification\Enums\NotificationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', \App\Domains\Notification\Models\PortalNotification::class) ?? false;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'channel' => ['required', 'string', Rule::enum(NotificationChannel::class)],
            'recipient' => 'required|string|max:255',
            'sent_at' => 'nullable|date',
            'status' => ['required', 'string', Rule::enum(NotificationStatus::class)],
        ];
    }
}
