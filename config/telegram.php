<?php

use Telegram\Bot\Commands\HelpCommand;

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Chat ID
    |--------------------------------------------------------------------------
    |
    | This is the chat ID to which your bot will send admin notifications.
    |
    */
    'admin_chat_id' => env('TELEGRAM_ADMIN_CHAT_ID'),

    /*
    |--------------------------------------------------------------------------
    | Available Bots
    |--------------------------------------------------------------------------
    */
    'bots' => [
        'mybot' => [
            'token'             => env('TELEGRAM_BOT_TOKEN'),
            'certificate_path'  => env('TELEGRAM_CERTIFICATE_PATH'),
            'webhook_url'       => env('TELEGRAM_WEBHOOK_URL'),
            'allowed_updates'   => null,

            // Bot-specific commands
            'commands' => [
                App\Telegram\Commands\StartCommand::class,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Bot Name
    |--------------------------------------------------------------------------
    */
    'default' => 'mybot',

    /*
    |--------------------------------------------------------------------------
    | Send Requests Asynchronously
    |--------------------------------------------------------------------------
    */
    'async_requests' => env('TELEGRAM_ASYNC_REQUESTS', false),

    /*
    |--------------------------------------------------------------------------
    | Command Dependency Resolution
    |--------------------------------------------------------------------------
    */
    'resolve_command_dependencies' => true,

    /*
    |--------------------------------------------------------------------------
    | Global Commands
    |--------------------------------------------------------------------------
    */
    'commands' => [
        HelpCommand::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Shared Commands
    |--------------------------------------------------------------------------
    */
    'shared_commands' => [
        'start' => App\Telegram\Commands\StartCommand::class,
    ],

];
