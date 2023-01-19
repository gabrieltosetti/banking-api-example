<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Conversations\LoginConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;

class ChatbotController extends Controller
{
    public function __construct(
        private LoginConversation $loginConversation
    ) {
    }

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = BotManFactory::create(
            config('botman.config') + config('botman.web'),
            new LaravelCache()
        );

        $botman->hears('(.*)', function ($bot) {
            $bot->startConversation($this->loginConversation);
        });

        $botman->listen();
    }
}
