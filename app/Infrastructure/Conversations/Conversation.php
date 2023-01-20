<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation as BotManConversation;
use BotMan\BotMan\Messages\Incoming\Answer;

abstract class Conversation extends BotManConversation
{
    protected ConversationFactory $conversationFactory;

    public function __construct(
        ConversationFactory $conversationFactory
    ) {
        $this->conversationFactory = $conversationFactory;
    }

    protected function startRegisterConversation(): void
    {
        $this->bot->startConversation($this->conversationFactory->createRegisterConversation());
    }

    protected function startMenuConversation(UserAccount $userAccount): void
    {
        $this->bot->startConversation($this->conversationFactory->createMenuConversation($userAccount));
    }

    protected function startBalanceConversation(UserAccount $userAccount): void
    {
        $this->bot->startConversation($this->conversationFactory->createBalanceConversation($userAccount));
    }

    protected function startChangeCurrencyConversation(UserAccount $userAccount): void
    {
        $this->bot->startConversation($this->conversationFactory->createChangeCurrencyConversation($userAccount));
    }

    protected function startDepositConversation(UserAccount $userAccount): void
    {
        $this->bot->startConversation($this->conversationFactory->createDepositConversation($userAccount));
    }

    protected function startWithdrawConversation(UserAccount $userAccount): void
    {
        $this->bot->startConversation($this->conversationFactory->createWithdrawConversation($userAccount));
    }

    protected function buttonWasPressed(Answer $answer): bool
    {
        return $answer->isInteractiveMessageReply();
    }
}