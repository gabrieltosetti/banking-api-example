<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories;

use App\Domain\DataAccessObjects\BankAccountDAOInterface;
use App\Domain\DataAccessObjects\CurrencyDAOInterface;
use App\Domain\DataAccessObjects\TransactionDAOInterface;
use App\Domain\DataAccessObjects\UserAccountDAOInterface;
use App\Domain\Entities\BankAccountEntity;
use App\Domain\Entities\UserAccountEntity;
use App\Domain\Repositories\BankAccountRepositoryInterface;

class BankAccountRepository extends AbstractRepository implements BankAccountRepositoryInterface
{
    private BankAccountDAOInterface $bankAccountDAO;
    private UserAccountDAOInterface $userAccountDAO;
    private CurrencyDAOInterface $currencyDAO;
    private TransactionDAOInterface $transactionDAO;

    public function __construct(
        BankAccountDAOInterface $bankAccountDAO,
        UserAccountDAOInterface $userAccountDAO,
        CurrencyDAOInterface $currencyDAO,
        TransactionDAOInterface $transactionDAO
    ) {
        $this->bankAccountDAO = $bankAccountDAO;
        $this->userAccountDAO = $userAccountDAO;
        $this->currencyDAO = $currencyDAO;
        $this->transactionDAO = $transactionDAO;
    }

    public function findByUserAccount(UserAccountEntity $userAccountEntity): BankAccountEntity
    {
        $bankAccountEntity = $this->bankAccountDAO->findByUserAccount($userAccountEntity);
        $bankAccountEntity
            ->setUserAccount($userAccountEntity)
            ->setCurrency($this->currencyDAO->findByBankAccount($bankAccountEntity))
            ->setTransactions($this->transactionDAO->findByBankAccount($bankAccountEntity));

        return $bankAccountEntity;
    }

    public function findByUserAccountEmail(string $email): BankAccountEntity
    {
        $userAccountEntity = $this->userAccountDAO->findByEmail($email);

        return $this->findByUserAccount($userAccountEntity);
    }

    public function findById(string $externalId): BankAccountEntity
    {
        $bankAccountEntity = $this->bankAccountDAO->findById($externalId);

        $bankAccountEntity
            ->setUserAccount($this->userAccountDAO->findByBankAccount($bankAccountEntity))
            ->setCurrency($this->currencyDAO->findByBankAccount($bankAccountEntity))
            ->setTransactions($this->transactionDAO->findByBankAccount($bankAccountEntity));

        return $bankAccountEntity;
    }
}
