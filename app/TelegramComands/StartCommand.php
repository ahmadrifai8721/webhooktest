<?php

namespace App\TelegramComands;

use \Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Objects\LoginUrl;

final class StartCommand extends Command
{


    protected string $name = 'start';
    protected string $description = 'Start System ';

    public function handle()
    {

        $reply_markup = LoginUrl::make([
            "url" => route('login')
        ]);

        $this->replyWithMessage([
            "text" => "info info",
            "reply_markup" => $reply_markup
        ]);
    }
}
