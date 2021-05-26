<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyBalanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $firstUser = UserAccount::where('email', 'user@email.com')->first();

        DB::table('currency_balances')->insert([
            'bank_account_id' => $firstUser->bankAccount->id,
            'currency_id' => $firstUser->default_currency_id,
            'value' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('currency_balances')->insert([
            'bank_account_id' => $firstUser->bankAccount->id,
            'currency_id' => Currency::where('code', 'BRL')->first()->id,
            'value' => 10,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
