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
                    'text' => 'inline',
                    LoginUrl::make([
                        "url" => "test.net"
                    ])
                ])
            ]);

        $this->replyWithMessage([
            "text" => "info info",
            "reply_markup" => $reply_markup
        ]);
    }
}
