<?php

use App\Addons\PusherNotification\Services\NotificationService;

if (!function_exists('sendPushNotification')) {
    function sendPushNotification(array $payload)
    {
        return app(NotificationService::class)->send($payload);
    }
}
