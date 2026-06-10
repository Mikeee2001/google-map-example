<?php

namespace App\Notifications;

use App\Models\EmergencyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class EmergencyAlertNotification extends Notification
{
    use Queueable;

    protected $emergency;

    public function __construct(EmergencyRequest $emergency)
    {
        $this->emergency = $emergency;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => '🚨 Emergency Request',
            'message' => $this->emergency->user->fullname . ' submitted an emergency request.',
            'emergency_id' => $this->emergency->id,
            'user_id' => $this->emergency->user_id,
            'latitude' => $this->emergency->latitude,
            'longitude' => $this->emergency->longitude,
            'created_at' => now()->format('Y-m-d H:i:s'),
        ];
    }
}
