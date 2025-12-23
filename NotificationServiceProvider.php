<?php
namespace App\Addons\PusherNotification;

use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/notification.php', 'notification');
    }

    // NotificationServiceProvider.php

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/config/notification.php' => config_path('notification.php'),
            __DIR__ . '/database/migrations' => database_path('migrations')
        ], 'notification-addon');

        // Load helper
        if (file_exists($file = __DIR__ . '/Helpers/helpers.php')) {
            require $file;
        }
    }

}
