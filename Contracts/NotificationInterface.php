<?php
namespace App\Addons\PusherNotification\Contracts;

interface NotificationInterface
{
    public function send(array $payload);
}
