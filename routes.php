<?php
use Illuminate\Support\Facades\Route;

Route::get('/test-notification', function () {
    sendNotification([
        'notifiable_type' => \App\Models\User::class,
        'notifiable_id' => 1,
        'title' => 'Test',
        'body' => 'This is a test notification',
    ]);
});
