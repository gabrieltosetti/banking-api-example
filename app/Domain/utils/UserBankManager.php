<?php

namespace Utils\Domain;

use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\Transaction;
use App\Infrastructure\Models\UserAccount;

class UserBankManager
{
    private UserAccount $userAccount;
    private BankAccount $bankAccount;
    private CurrencyExchanger $currencyExchanger;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
        $this->bankAccount = $this->userAccount->bankAccount;
        $this->currencyExchanger = new CurrencyExchanger();
    }

    public function deposit(float $value, Currency $currency = null)
    {
        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $rate = 1;
        $convertedValue = $value;

        if ($currency && $currency->id !== $this->bankAccount->currency_id) {
            $exchange = $this->currencyExchanger->convert(
                $currency,
                $this->bankAccount->currency,
                $value
            );

            $convertedValue = $exchange['value'];
            $rate = $exchange['rate'];
        }

        $this->bankAccount->balance += $convertedValue;
        $this->bankAccount->save();

        $transaction = new Transaction();
        $transaction->bank_account_id = $this->bankAccount->id;
        $transaction->bank_account_currency_id = $this->bankAccount->currency_id;
        $transaction->target_currency_id = $currency->id ?? $this->bankAccount->currency_id;
        $transaction->value = $value;
        $transaction->rate = $rate;
        $transaction->type = Transaction::TYPE_DEPOSIT;
        $transaction->save();

        return;
    }

    public function withdraw(float $value, Currency $currency = null)
    {
        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $rate = 1;
        $convertedValue = $value;

        if ($currency && $currency->id !== $this->bankAccount->currency_id) {
            $exchange = $this->currencyExchanger->convert(
                $currency,
                $this->bankAccount->currency,
                $value
            );

            $convertedValue = $exchange['value'];
            $rate = $exchange['rate'];
        }

        if ($this->bankAccount->balance < $convertedValue) {
            $code = $this->bankAccount->currency->code;
            $convertedValue = '$' . number_format($convertedValue, 2, ',', '.') . " $code";
            $balance = '$' . number_format($this->bankAccount->balance, 2, ',', '.') . " $code";

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
        $transaction->rate = $rate;
        $transaction->type = Transaction::TYPE_WITHDRAW;
        $transaction->save();

        return;
    }

    public function setDefaultCurrency(Currency $targetCurrency)
    {
        $oldCurrencyId = $this->bankAccount->currency_id;
        $oldAccountBalance = $this->bankAccount->balance;
        $newCurrencyId = $targetCurrency->id;

        $exchange = $this->currencyExchanger->convert(
            $this->bankAccount->currency,
            $targetCurrency,
            $this->bankAccount->balance
        );

        $this->bankAccount->currency_id = $targetCurrency->id;
        $this->bankAccount->balance = $exchange['value'];
        $this->bankAccount->save();

        $this->bankAccount->refresh();

        $transaction = new Transaction();
        $transaction->bank_account_id = $this->bankAccount->id;
        $transaction->bank_account_currency_id = $oldCurrencyId;
        $transaction->target_currency_id = $newCurrencyId;
        $transaction->value = $oldAccountBalance;
        $transaction->rate = $exchange['rate'];
        $transaction->type = Transaction::TYPE_CHANGE_CURRENCY;
        $transaction->save();
    }
}
