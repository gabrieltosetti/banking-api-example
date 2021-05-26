<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('bank_accounts')->insert([
            'user_account_id' => UserAccount::where('email', 'user@email.com')->first()->id,
            'currency_id' => Currency::where('code', 'USD')->first()->id,
            'balance' => 0.0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
