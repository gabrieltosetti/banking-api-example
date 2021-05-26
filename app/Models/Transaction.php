<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }

    public function bankAccountCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'bank_account_currency_id');
    }

    public function targetCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'target_currency_id');
    }
}
