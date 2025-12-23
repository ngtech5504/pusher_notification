<?php

namespace App\Addons\PusherNotification\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class PushNotificationEvent implements ShouldBroadcast
{
    use SerializesModels;

    public $notification;
    protected $channel;

    public function __construct($notification, $channel)
    {
        $this->notification = $notification;
        $this->channel = $channel;
    }

    public function broadcastOn()
    {
        return new PrivateChannel($this->channel);
    }

    public function broadcastAs()
    {
        return config('notification.pusher.event');
    }
}
