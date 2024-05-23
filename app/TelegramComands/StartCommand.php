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

        $reply_markup = Keyboard::make()
            ->setResizeKeyboard(true)
            ->setOneTimeKeyboard(true)
            ->row([
                Keyboard::inlineButton([
                    'text' => 'Login',
                    "login_url" => route("webhookLogin")
                ])
            ]);

        $this->replyWithMessage([
            "text" => route("webhookLogin"),
            "reply_markup" => $reply_markup
        ]);
    }
}
