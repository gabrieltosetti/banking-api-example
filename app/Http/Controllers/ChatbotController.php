<?php

namespace App\Http\Controllers;

use App\Conversations\LoginConversation;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;

class ChatbotController extends Controller
{
    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        // $botman = app('botman');
        $botman = BotManFactory::create(
            [
                'matchingData' => [
                    'driver' => 'web',
                ],
                'conversation_cache_time' => 40,
                'user_cache_time' => 30,
            ],
            new LaravelCache()
        );

        $botman->hears('(.*)', function($bot) {
            $bot->startConversation(new LoginConversation());
        });

        $botman->listen();

    }
}
