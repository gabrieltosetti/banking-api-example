<?php

declare(strict_types=1);

use App\Domain\Utils\UserBankManager;
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

// =================================================
// ||              Testing
// =================================================

Route::get('/create-user', function (Request $request) {
    // Create the user account
    $user = new \App\Infrastructure\Models\UserAccount();
    $user->name = 'test';
    $user->email = 'test@example.com' . rand(999, 999999);
    $user->password = \Illuminate\Support\Facades\Hash::make('123');

    $user->save();

    // create a bank account for the user
    $bankAccount = new \App\Infrastructure\Models\BankAccount();
    $bankAccount->user_account_id = $user->id;
    $bankAccount->currency_id = \App\Infrastructure\Models\Currency::findByCode('USD')->id;
    $bankAccount->balance = 100.0;
    $bankAccount->save();

    return [
        'user_account' => \App\Infrastructure\Models\UserAccount::find($user->id),
        'default_currency' => \App\Infrastructure\Models\Currency::find($bankAccount->currency_id),
        'bank_account' => \App\Infrastructure\Models\BankAccount::where('user_account_id', $user->id)->first(),
    ];
});

Route::get('/deposit', function (Request $request) {
    $userAccount = \App\Infrastructure\Models\UserAccount::find(1);

    $userBankManager = new UserBankManager($userAccount);
    $userBankManager->deposit(500, \App\Infrastructure\Models\Currency::findByCode('BRL'));
    $userBankManager->deposit(100, \App\Infrastructure\Models\Currency::findByCode('USD'));

    return 'value deposited';
});

Route::get('/withdraw', function (Request $request) {
    $userAccount = \App\Infrastructure\Models\UserAccount::find(1);

    $userBankManager = new UserBankManager($userAccount);
    $userBankManager->withdraw(500, \App\Infrastructure\Models\Currency::findByCode('BRL'));
    $userBankManager->withdraw(100, \App\Infrastructure\Models\Currency::findByCode('USD'));

    return 'amount withdrawn';
});

Route::get('/set-default-currency', function (Request $request) {
    $userAccount = \App\Infrastructure\Models\UserAccount::find(1);

    $userBankManager = new UserBankManager($userAccount);
    $userBankManager->setDefaultCurrency(\App\Infrastructure\Models\Currency::findByCode('USD'));

    return 'default currency changed';
});

Route::get('/show-balance', function (Request $request) {
    $userAccount = \App\Infrastructure\Models\UserAccount::find(1);

    return [
        'balance' => $userAccount->bankAccount->balance,
        'currency' => $userAccount->bankAccount->currency->code,
    ];
});
