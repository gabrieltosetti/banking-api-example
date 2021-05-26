<?php

namespace Utils;

use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\UserAccount;

class UserBankManager
{
    private UserAccount $userAccount;
    private BankAccount $bankAccount;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
        $this->bankAccount = $this->userAccount->bankAccount;
    }

    public function deposit(float $value, Currency $currency = null)
    {
        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }



        $exchangeRate = 1;
        if ($currency && $currency->id !== $this->bankAccount->currency_id) {
            // TODO: Convert value
        }

        $this->bankAccount->balance += $value * $exchangeRate;
        $this->bankAccount->save();

        $transaction = new Transaction();
        $transaction->bank_account_id = $this->bankAccount->id;
        $transaction->bank_account_currency_id = $this->bankAccount->currency_id;
        $transaction->target_currency_id = $currency->id ?? $this->bankAccount->currency_id;
        $transaction->value = $value;
        $transaction->exchange_rate = $exchangeRate;
        $transaction->save();

        return;
    }

    public function withdraw(float $value, Currency $currency = null)
    {
        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $exchangeRate = 1;
        if ($currency && $currency->id !== $this->bankAccount->currency_id) {
            // TODO: Convert value
        }

        $convertedValue = $value * $exchangeRate;

        if ($this->bankAccount->balance < $convertedValue) {
            $balance = $this->bankAccount->balance;
            throw new \Exception(
                "Withdraw value ($convertedValue) is greater than your account balance ($balance)."
            );
        }

        $this->bankAccount->balance -= $convertedValue;
        $this->bankAccount->save();

        $transaction = new Transaction();
        $transaction->bank_account_id = $this->bankAccount->id;
        $transaction->bank_account_currency_id = $this->bankAccount->currency_id;
        $transaction->target_currency_id = $currency->id ?? $this->bankAccount->currency_id;
        $transaction->value = -$value;
        $transaction->exchange_rate = $exchangeRate;
        $transaction->save();

        return;
    }

    public function setDefaultCurrency(Currency $currency)
    {
        // TODO: Convert value
        $this->bankAccount->currency_id = $currency->id;
        $this->bankAccount->save();
    }
}
