<?php

namespace App\Telegram\Commands;

use Telegram\Bot\Commands\Command;

class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected string $name = 'start';

    /**
     * @var string Command Description
     */
    protected string $description = 'Start command to welcome the user and show available commands';

    /**
     * Handle the /start command
     */
    public function handle()
    {
        $this->replyWithMessage([
            'text' => "👋 Welcome to Bittoz Bot!\n\nHere are some available commands:"
        ]);

        $commands = $this->getTelegram()->getCommands();
        $response = '';

        foreach ($commands as $name => $command) {
            $response .= "/{$name} - " . $command->getDescription() . PHP_EOL;
        }

        $this->replyWithMessage(['text' => $response]);
    }
}
