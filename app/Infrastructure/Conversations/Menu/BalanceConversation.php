<?php

declare(strict_types=1);

namespace App\Infrastructure\Conversations\Menu;

use App\Domain\Builders\BankAccountEntityBuilder;
use App\Infrastructure\Conversations\AbstractConversation;
use App\Infrastructure\Conversations\ConversationFactory;

class BalanceConversation extends AbstractConversation
{
    protected array $bankAccountEntityArray;
    protected BankAccountEntityBuilder $bankAccountEntityBuilder;

    public function __construct(
        ConversationFactory $conversationFactory,
        BankAccountEntityBuilder $bankAccountEntityBuilder,
        array $bankAccountEntityArray
    ) {
        parent::__construct($conversationFactory);
        $this->bankAccountEntityBuilder = $bankAccountEntityBuilder;
        $this->bankAccountEntityArray = $bankAccountEntityArray;
    }

    public function run()
    {
        $this->showBalance();
    }

    public function showBalance()
    {
        $bankAccount = $this->bankAccountEntityBuilder->setFromArray($this->bankAccountEntityArray)->get();
        $code = $bankAccount->getCurrency()->getCode();
        $balance = $bankAccount->getBalance();
        $balance = number_format($balance, 2, ',', '.');

        $this->say("Your balance is $" . $balance . " $code");

        $this->startMenuConversation($this->bankAccountEntityArray);
    }
}
