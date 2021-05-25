<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currency_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->nullable(false)->constrained();
            $table->foreignId('currency_id')->nullable(false)->constrained();
            $table->float('value', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currency_balances');
    }
}
