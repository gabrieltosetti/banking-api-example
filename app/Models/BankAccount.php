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

    public function currency()
    {
        return $this->hasOne(Currency::class);
    }
}
