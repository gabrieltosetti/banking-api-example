<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    public function userAccount()
    {
        return $this->hasOne(UserAccount::class);
    }

    public function currencyBalances()
    {
        return $this->hasMany(CurrencyBalance::class);
    }

    public function defaultCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'default_currency_id');
    }
}
