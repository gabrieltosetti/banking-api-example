<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Conversations\LoginConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;

class ChatbotController extends Controller
{
    private LoginConversation $loginConversation;

    public function __construct(
        LoginConversation $loginConversation
    ) {
        $this->loginConversation = $loginConversation;
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

        $botman->hears('(.*)', function (\BotMan\BotMan\BotMan $bot) {
            $bot->startConversation($this->loginConversation);
        });

        $botman->listen();
    }
}
