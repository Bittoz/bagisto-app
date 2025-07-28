<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::post('/telegram/webhook', function (Request $request) {
    // Log every incoming Telegram webhook request
    Log::info('🚀 Telegram webhook hit', [
        'payload' => $request->all(),
        'ip' => $request->ip(),
        'user_agent' => $request->userAgent(),
    ]);

    // Dispatch Telegram commands if any
    Telegram::commandsHandler(true);

    // Return success response to Telegram
    return response('ok', 200);
});
