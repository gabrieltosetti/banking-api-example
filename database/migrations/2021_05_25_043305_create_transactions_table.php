<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_account_id')->nullable(false)->constrained();
            $table->foreignId('from_currency_id')->nullable(false)->constrained('currencies');
            $table->float('from_currency_value')->nullable(false);
            $table->foreignId('to_currency_id')->nullable(false)->constrained('currencies');
            $table->float('to_currency_value')->nullable(false);
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
        Schema::dropIfExists('transactions');
    }
}
