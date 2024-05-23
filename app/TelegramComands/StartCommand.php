<?php

namespace App\TelegramComands;

use \Telegram\Bot\Commands\Command;

final class StartCommand extends Command
{


    protected string $name = 'start';
    protected string $description = 'Start System ';

    public function handle()
    {

        $this->replyWithMessage([
            "text" => "info info"
        ]);
    }
}
