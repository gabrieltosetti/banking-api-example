<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    public function defaultCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'default_currency_id');
    }

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class, 'user_account_id', 'id');
    }
}
