<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');

        DB::table('user_accounts')->insert([
            'name' => 'New User',
            'email' => 'user@email.com',
            'password' => Hash::make('123'),
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
