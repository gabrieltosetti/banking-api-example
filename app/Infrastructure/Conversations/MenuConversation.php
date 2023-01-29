<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Domain\Builders\BankAccountEntityBuilder;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class MenuConversation extends AbstractConversation
{
    protected array $bankAccountEntityArray;

    protected const BALANCE_CHOICE = 1;
    protected const DEPOSIT_CHOICE = 2;
    protected const WITHDRAW_CHOICE = 3;
    protected const CHANGE_CURRENCY_CHOICE = 4;

    public function __construct(
        ConversationFactory $conversationFactory,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        array $bankAccountEntityArray
    ) {
        parent::__construct($conversationFactory, $bankAccountEntityBuilder);
        $this->bankAccountEntityArray = $bankAccountEntityArray;
    }

    public function run(): void
    {
        $this->askForMenuChoice();
    }

    public function askForMenuChoice(): void
    {
        $question = Question::create('Please choose one of the options:')
            ->fallback('Invalid option')
            ->callbackId('menu')
            ->addButtons([
                Button::create('1.Show balance')->value(self::BALANCE_CHOICE),
                Button::create('2.Deposit')->value(self::DEPOSIT_CHOICE),
                Button::create('3.Withdraw')->value(self::WITHDRAW_CHOICE),
                Button::create('4.Change Currency')->value(self::CHANGE_CURRENCY_CHOICE),
            ]);

        $this->ask($question, fn (Answer $answer) => $this->askForMenuChoiceAnswer($answer));
    }

    public function askForMenuChoiceAnswer(Answer $answer): void
    {
        $selectedValue = (int) $answer->getText();

        if ($this->buttonWasPressed($answer)) {
            $selectedValue = (int) $answer->getValue();
        }

        switch ($selectedValue) {
            case self::BALANCE_CHOICE:
                $this->startBalanceConversation($this->bankAccountEntityArray);
                break;
            case self::DEPOSIT_CHOICE:
                $this->startdepositConversation($this->bankAccountEntityArray);
                break;
            case self::WITHDRAW_CHOICE:
                $this->startWithdrawConversation($this->bankAccountEntityArray);
                break;
            case self::CHANGE_CURRENCY_CHOICE:
                $this->startChangeCurrencyConversation($this->bankAccountEntityArray);
                break;
            default:
                $this->say("Sorry i don't know that option yet.");
                $this->repeat();
                return;
        }
        return;
    }
}
