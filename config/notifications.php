<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Notification Channels
    |--------------------------------------------------------------------------
    |
    | This file contains the notification channels that will be used to send
    | notifications to users. By default, we support the "mail" channel.
    |
    */

    'channels' => [
        'mail' => [
            'driver' => 'mail',
            'queue' => true,
        ],
        'database' => [
            'driver' => 'database',
            'table' => 'notifications',
        ],
        'broadcast' => [
            'driver' => 'broadcast',
            'queue' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default settings for notifications.
    |
    */

    'default' => env('NOTIFICATION_CHANNEL', 'mail'),

    /*
    |--------------------------------------------------------------------------
    | Notification Types
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the notification types that your application
    | sends. These notification types may be used to categorize the various
    | types of notifications sent by your application.
    |
    */

    'types' => [
        'password_reset' => [
            'name' => 'Password Reset',
            'description' => 'Notifications related to password resets.',
            'channels' => ['mail'],
        ],
    ],
];
