<?php

namespace App\Domains\Notification\Requests;

use App\Domains\Notification\Enums\NotificationChannel;
use App\Domains\Notification\Enums\NotificationStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        $notification = $this->route('notification');

        return $notification && $this->user()?->can('update', $notification);
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'channel' => ['sometimes', 'required', 'string', Rule::enum(NotificationChannel::class)],
            'recipient' => 'sometimes|required|string|max:255',
            'sent_at' => 'nullable|date',
            'status' => ['sometimes', 'required', 'string', Rule::enum(NotificationStatus::class)],
        ];
    }
}
