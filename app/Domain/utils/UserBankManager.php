<?php

declare(strict_types=1);

namespace App\Domain\Utils;

use App\Domain\Entities\BankAccountEntity;
use App\Domain\Repositories\BankAccountRepositoryInterface;
use App\Domain\ValueObjects\CurrencyValueObject;
use App\Infrastructure\Models\BankAccount;
use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\Transaction;
use Ramsey\Uuid\Uuid;

class UserBankManager
{
    private CurrencyExchanger $currencyExchanger;

    public function deposit(
        BankAccountEntity $bankAccountEntity,
        float $value,
        CurrencyValueObject $currencyVO = null
    ) {
        // TODO: Change this to a Use Case

        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $bankAccountModel = BankAccount::query()->where('external_id', $bankAccountEntity->getId())->first();
        $currencyModel = $currencyVO
            ? Currency::query()->where('code', $currencyVO->getCode())->first()
            : null;

        $rate = 1;
        $convertedValue = $value;

        if ($currencyModel && $currencyModel->id !== $bankAccountModel->currency_id) {
            $exchange = $this->currencyExchanger->convert(
                $currencyModel,
                $bankAccountModel->currency,
                $value
            );

            $convertedValue = $exchange['value'];
            $rate = $exchange['rate'];
        }

        $bankAccountModel->balance += $convertedValue;
        $bankAccountModel->save();

        $transaction = new Transaction();
        $transaction->external_id = Uuid::uuid4()->toString();
        $transaction->bank_account_id = $bankAccountModel->id;
        $transaction->bank_account_currency_id = $bankAccountModel->currency_id;
        $transaction->target_currency_id = $currencyModel->id ?? $bankAccountModel->currency_id;
        $transaction->value = $value;
        $transaction->rate = $rate;
        $transaction->type = Transaction::TYPE_DEPOSIT;
        $transaction->save();

        /** @var BankAccountRepositoryInterface */
        $bankAccountRepository = app(BankAccountRepositoryInterface::class);

        return $bankAccountRepository->findById($bankAccountModel->external_id);
    }

    public function withdraw(
        BankAccountEntity $bankAccountEntity,
        float $value,
        CurrencyValueObject $currencyVO = null
    ): BankAccountEntity {
        // TODO: Change this to a Use Case

        $bankAccountModel = BankAccount::query()->where('external_id', $bankAccountEntity->getId())->first();
        $currencyModel = $currencyVO
            ? Currency::query()->where('code', $currencyVO->getCode())->first()
            : null;

        if (!$value) {
            throw new \Exception('Deposit value not specified', 400);
        }

        $rate = 1;
        $convertedValue = $value;

        if ($currencyModel && $currencyModel->id !== $bankAccountModel->currency_id) {
            $exchange = $this->currencyExchanger->convert(
                $currencyModel,
                $bankAccountModel->currency,
                $value
            );

            $convertedValue = $exchange['value'];
            $rate = $exchange['rate'];
        }

        if ($bankAccountModel->balance < $convertedValue) {
            $code = $bankAccountModel->currency->code;
            $convertedValue = '$' . number_format($convertedValue, 2, ',', '.') . " $code";
            $balance = '$' . number_format($bankAccountModel->balance, 2, ',', '.') . " $code";

            throw new \Exception(
                "Withdraw value ($convertedValue) is greater than your account balance ($balance)."
            );
        }

        $bankAccountModel->balance -= $convertedValue;
        $bankAccountModel->save();

        $transaction = new Transaction();
        $transaction->external_id = Uuid::uuid4()->toString();
        $transaction->bank_account_id = $bankAccountModel->id;
        $transaction->bank_account_currency_id = $bankAccountModel->currency_id;
        $transaction->target_currency_id = $currencyModel->id ?? $bankAccountModel->currency_id;
        $transaction->value = -$value;
        $transaction->rate = $rate;
        $transaction->type = Transaction::TYPE_WITHDRAW;
        $transaction->save();

        /** @var BankAccountRepositoryInterface */
        $bankAccountRepository = app(BankAccountRepositoryInterface::class);

        return $bankAccountRepository->findById($bankAccountModel->external_id);
    }

    public function setDefaultCurrency(
        BankAccountEntity $bankAccountEntity,
        CurrencyValueObject $targetCurrency
    ): BankAccountEntity {
        // TODO: Change this to a Use Case

        $bankAccountModel = BankAccount::query()->where('external_id', $bankAccountEntity->getId())->first();
        $targetCurrencyModel = Currency::query()->where('code', $targetCurrency->getCode())->first();

        $oldCurrencyId = $bankAccountModel->currency_id;
        $oldAccountBalance = $bankAccountModel->balance;
        $newCurrencyId = $targetCurrencyModel->id;

        $exchange = $this->currencyExchanger->convert(
            $bankAccountModel->currency,
            $targetCurrencyModel,
            $bankAccountModel->balance
        );

        $bankAccountModel->currency_id = $targetCurrencyModel->id;
        $bankAccountModel->balance = $exchange['value'];
        $bankAccountModel->save();

        $bankAccountModel->refresh();

        $transaction = new Transaction();
        $transaction->external_id = Uuid::uuid4()->toString();
        $transaction->bank_account_id = $bankAccountModel->id;
        $transaction->bank_account_currency_id = $oldCurrencyId;
        $transaction->target_currency_id = $newCurrencyId;
        $transaction->value = $oldAccountBalance;
        $transaction->rate = $exchange['rate'];
        $transaction->type = Transaction::TYPE_CHANGE_CURRENCY;
        $transaction->save();

        /** @var BankAccountRepositoryInterface */
        $bankAccountRepository = app(BankAccountRepositoryInterface::class);

        return $bankAccountRepository->findById($bankAccountModel->external_id);
    }
}
