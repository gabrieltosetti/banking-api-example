<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations;

use App\Infrastructure\Conversations\Menu\BalanceConversation;
use App\Infrastructure\Conversations\Menu\DepositConversation;
use App\Infrastructure\Conversations\Menu\WithdrawConversation;
use App\Infrastructure\Conversations\Menu\ChangeCurrencyConversation;
use App\Infrastructure\Models\UserAccount;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;

class MenuConversation extends Conversation
{
    protected UserAccount $userAccount;

    protected $balanceChoice = 1;
    protected $depositChoice = 2;
    protected $withdrawChoice = 3;
    protected $changeCurrencyChoice = 4;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
    }

    public function askForMenuChoice()
    {
        $question = Question::create('Please choose one of the options:')
            ->fallback('Invalid option')
            ->callbackId('menu')
            ->addButtons([
                Button::create('1.Show balance')->value($this->balanceChoice),
                Button::create('2.Deposit')->value($this->depositChoice),
                Button::create('3.Withdraw')->value($this->withdrawChoice),
                Button::create('4.Change Currency')->value($this->changeCurrencyChoice),
            ]);

        $this->ask($question, function (Answer $answer) {
            $selectedValue = (int) $answer->getText();

            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $selectedValue = (int) $answer->getValue();
            }

            switch ($selectedValue) {
                case $this->balanceChoice:
                    return $this->bot->startConversation(new BalanceConversation($this->userAccount));
                case $this->depositChoice:
                    return $this->bot->startConversation(new DepositConversation($this->userAccount));
                case $this->withdrawChoice:
                    return $this->bot->startConversation(new WithdrawConversation($this->userAccount));
                case $this->changeCurrencyChoice:
                    return $this->bot->startConversation(new ChangeCurrencyConversation($this->userAccount));
                default:
                    $this->say("Sorry i don't know that option yet.");
                    return $this->repeat();
            }
        });
    }

    public function run()
    {
        $this->askForMenuChoice();
    }
}
