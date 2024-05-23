<?php

namespace App\TelegramComands;

use Telegram\Bot\Commands\Command;


final class LoginCommand extends Command
{
    protected string $name = 'login';
    protected string $description = 'Login To System';

    public function handle()
    {
        $this->replyWithMessage([
            "text" => "Ini Menu Login"
        ]);
    }
}
