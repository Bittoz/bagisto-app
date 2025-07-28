<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Telegram\Commands\StartCommand;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix for older MySQL/MariaDB key length limit
        Schema::defaultStringLength(191);

        // ✅ Register Telegram command
        Telegram::addCommands([
            StartCommand::class,
        ]);
    }
}
