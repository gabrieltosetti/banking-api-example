<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyBalance extends Model
{
    use HasFactory;

    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
    }
}
