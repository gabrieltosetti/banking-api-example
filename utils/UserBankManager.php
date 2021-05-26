<?php

namespace Utils;

use App\Models\BankAccount;
use App\Models\Currency;
use App\Models\CurrencyBalance;
use App\Models\UserAccount;

class UserBankManager
{
    private UserAccount $userAccount;
    private BankAccount $bankAccount;

    /**
     * key   = Currency code
     * value = CurrencyBalance object
     * @var Array<string, CurrencyBalance>
     */
    private array $currencyBalances;

    public function __construct(UserAccount $userAccount)
    {
        $this->userAccount = $userAccount;
        $this->bankAccount = $this->userAccount->bankAccount;

        foreach ($this->bankAccount->currencyBalances as $balance) {
            $this->currencyBalances[$balance->currency->code] = $balance;
        }
    }

    public function getDefaultCurrencyBalance(): CurrencyBalance
    {
        return $this->currencyBalances[$this->bankAccount->defaultCurrency->code];
    }

    public function getCurrencyBalanceOrCreate(Currency $currency): CurrencyBalance
    {
        $defaultCurrencyBalance = $this->getDefaultCurrencyBalance();

        if ($defaultCurrencyBalance->code === $currency->code) {
            return $defaultCurrencyBalance;
        }

        if (array_key_exists($currency->code, $this->currencyBalances)) {
            return $this->currencyBalances[$currency->code];
        }

        // create a currency balance for the default user currency
        $currencyBalance = new CurrencyBalance();
        $currencyBalance->bank_account_id = $this->bankAccount->id;
        $currencyBalance->currency_id = $currency->id;
        $currencyBalance->save();

        return $currencyBalance;
    }

    public function deposit(float $value, Currency $currency = null)
    {
        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $currencyBalance = $this->getDefaultCurrencyBalance();

        if ($currency) {
            $currencyBalance = $this->getCurrencyBalanceOrCreate($currency);
        }

        $currencyBalance->value += $value;
        $currencyBalance->save();

        return;
    }
}
