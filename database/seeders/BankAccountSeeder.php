<?php

namespace Database\Seeders;

use App\Infrastructure\Models\Currency;
use App\Infrastructure\Models\UserAccount;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

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
            'external_id' => Uuid::uuid4()->toString(),
            'user_account_id' => UserAccount::where('email', 'user@email.com')->first()->id,
            'currency_id' => Currency::where('code', 'USD')->first()->id,
            'balance' => 100.0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
