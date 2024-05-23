<?php

namespace App\TelegramComands;

use Telegram\Bot\Commands\Command;


final class LoginCommand extends Command
{
    protected string $name = 'start';
    protected string $description = 'Start Command to get you started';

    public function handle()
    {
        $this->replyWithMessage([
            'text' => 'Hey, there! Welcome to our bot!',
        ]);
    }
}
