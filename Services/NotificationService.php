<?php
namespace App\Addons\PusherNotification\Services;

use App\Addons\PusherNotification\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Pusher\Pusher;

class NotificationService
{
    public function send(array $payload)
    {
        // return $payload;
        $notification = Notification::create([
            'notifiable_type' => $payload['notifiable_type'],
            'notifiable_id' => $payload['notifiable_id'],
            'title' => $payload['title'],
            'body' => $payload['body'],
            'type' => $payload['type'] ?? null,
            'data' => $payload['data'] ?? null
        ]);

        $channel = match (true) {
            $payload['notifiable_type'] === User::class => 'private-user-' . $payload['notifiable_id'],
            $payload['notifiable_type'] === User::class => 'private-expert-' . $payload['notifiable_id'],
            default => 'admin-global'
        };

        $pusher = new Pusher(
            config('broadcasting.connections.pusher.key'),
            config('broadcasting.connections.pusher.secret'),
            config('broadcasting.connections.pusher.app_id'),
            [
                'cluster' => config('broadcasting.connections.pusher.options.cluster'),
                'useTLS' => true
            ]
        );

        $pusher->trigger($channel, 'notification.received', $notification->toArray());

        return $notification;
    }
}

// Global helper function (anywhere in project)
if (!function_exists('sendNotification')) {
    function sendNotification(array $payload)
    {
        return (new \App\Addons\Notification\Services\NotificationService())->send($payload);
    }
}
