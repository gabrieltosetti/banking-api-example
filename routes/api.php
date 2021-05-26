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
    
    $user->save();

    // create a bank account for the user
    $bankAccount = new \App\Models\BankAccount();
    $bankAccount->user_account_id = $user->id;
    $bankAccount->default_currency_id = \App\Models\Currency::findByCode('USD')->id;
    $bankAccount->save();

    // create a currency balance for the default user currency
    $currencyBalance = new \App\Models\CurrencyBalance();
    $currencyBalance->bank_account_id = $bankAccount->id;
    $currencyBalance->currency_id = $user->default_currency_id;
    $currencyBalance->save();

    return [
        'user_account' => \App\Models\UserAccount::find($user->id),
        'default_currency' => \App\Models\Currency::find($user->default_currency_id),
        'bank_account' => \App\Models\BankAccount::where('user_account_id', $user->id)->first(),
        'currency_balances' => \App\Models\CurrencyBalance::where('bank_account_id', $bankAccount->id)->get(),
    ];
});

Route::get('/deposit', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->deposit(100);
    $userBankManager->deposit(200, \App\Models\Currency::findByCode('BRL'));
    $userBankManager->deposit(300, \App\Models\Currency::findByCode('EUR'));

    return 'value deposited';
});

Route::get('/withdraw', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->withdraw(200, \App\Models\Currency::findByCode('BRL'));

    return 'amount withdrawn';
});

Route::get('/set-default-currency', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->setDefaultCurrency(\App\Models\Currency::findByCode('BRL'));

    return 'default currency changed';
});

Route::get('/show-balance', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    return $userAccount->currencyBalances();
});