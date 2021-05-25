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

    public function fromCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'from_currency_id');
    }

    public function toCurrency()
    {
        return $this->hasOne(Currency::class, 'id', 'to_currency_id');
    }
}
