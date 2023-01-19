<?php

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Conversations\LoginConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;

class ChatbotController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = BotManFactory::create(
            config('botman.config') + config('botman.web'),
            new LaravelCache()
        );

        $botman->hears('(.*)', function($bot) {
            $bot->startConversation(new LoginConversation());
        });

        $botman->listen();
    }
}
