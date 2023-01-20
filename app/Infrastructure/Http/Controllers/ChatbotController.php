<?php

declare(strict_types=1);

namespace App\Infrastructure\Http\Controllers;

use App\Infrastructure\Conversations\ConversationFactory;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\LaravelCache;

class ChatbotController extends Controller
{
    private ConversationFactory $conversationFactory;

    public function __construct(
        ConversationFactory $conversationFactory
    ) {
        $this->conversationFactory = $conversationFactory;
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
            $bot->startConversation($this->conversationFactory->createLoginConversation());
        });

        $botman->listen();
    }
}
