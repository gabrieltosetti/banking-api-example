<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;

abstract class AbstractConversation extends Conversation
{
    protected ConversationFactory $conversationFactory;

    public function __construct(
        ConversationFactory $conversationFactory
    ) {
        $this->conversationFactory = $conversationFactory;
    }

    protected function startRegisterConversation(): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createRegisterConversation()
        );
    }

    protected function startMenuConversation(array $bankAccountEntityArray): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createMenuConversation($bankAccountEntityArray)
        );
    }

    protected function startBalanceConversation(array $bankAccountEntityArray): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createBalanceConversation($bankAccountEntityArray)
        );
    }

    protected function startChangeCurrencyConversation(array $bankAccountEntityArray): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createChangeCurrencyConversation($bankAccountEntityArray)
        );
    }

    protected function startDepositConversation(array $bankAccountEntityArray): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createDepositConversation($bankAccountEntityArray)
        );
    }

    protected function startWithdrawConversation(array $bankAccountEntityArray): void
    {
        $this->bot->startConversation(
            $this->conversationFactory->createWithdrawConversation($bankAccountEntityArray)
        );
    }

    protected function buttonWasPressed(Answer $answer): bool
    {
        return $answer->isInteractiveMessageReply();
    }
}
