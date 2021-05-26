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
    $bankAccount->currency_id = \App\Models\Currency::findByCode('USD')->id;
    $bankAccount->balance = 100.0;
    $bankAccount->save();

    return [
        'user_account' => \App\Models\UserAccount::find($user->id),
        'default_currency' => \App\Models\Currency::find($bankAccount->currency_id),
        'bank_account' => \App\Models\BankAccount::where('user_account_id', $user->id)->first(),
    ];
});

Route::get('/deposit', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->deposit(500, \App\Models\Currency::findByCode('BRL'));
    $userBankManager->deposit(100, \App\Models\Currency::findByCode('USD'));

    return 'value deposited';
});

Route::get('/withdraw', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->withdraw(500, \App\Models\Currency::findByCode('BRL'));
    $userBankManager->withdraw(100, \App\Models\Currency::findByCode('USD'));

    return 'amount withdrawn';
});

Route::get('/set-default-currency', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    $userBankManager = new \Utils\UserBankManager($userAccount);
    $userBankManager->setDefaultCurrency(\App\Models\Currency::findByCode('USD'));

    return 'default currency changed';
});

Route::get('/show-balance', function (Request $request) {
    $userAccount = \App\Models\UserAccount::find(1);

    return [
        'balance' => $userAccount->bankAccount->balance,
        'currency' => $userAccount->bankAccount->currency->code,
    ];
});
