<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/create-user', function (Request $request) {
    // Create the user account
    $user = new \App\Models\UserAccount();
    $user->name = 'teste';
    $user->email = 'teste@example.com' . rand(999, 999999);
    $user->password = \Illuminate\Support\Facades\Hash::make('123');
    
    // if (\Illuminate\Support\Facades\Hash::check('plain-text', $hashedPassword)) {
    //     // The passwords match...
    // }
    
    $user->default_currency_id = \App\Models\Currency::where('code', 'USD')->first()->id;
    $user->save();

    // create a bank account for the user
    $bankAccount = new \App\Models\BankAccount();
    $bankAccount->user_account_id = $user->id;
    $bankAccount->save();

    // create a currency balance for the default user currency
    $currencyBalance = new \App\Models\CurrencyBalance();
    $currencyBalance->bank_account_id = $bankAccount->id;
    $currencyBalance->currency_id = $user->default_currency_id;
    $currencyBalance->value = 0.0;
    $currencyBalance->save();

    return [
        'user_account' => \App\Models\UserAccount::find($user->id),
        'default_currency' => \App\Models\Currency::find($user->default_currency_id),
        'bank_account' => \App\Models\BankAccount::where('user_account_id', $user->id)->first(),
        'currency_balances' => \App\Models\CurrencyBalance::where('bank_account_id', $bankAccount->id)->get(),
    ];
});