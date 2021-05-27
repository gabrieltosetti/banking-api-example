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
            $table->foreignId('bank_account_currency_id')->nullable(false)->constrained('currencies');
            $table->foreignId('target_currency_id')->nullable(false)->constrained('currencies');
            $table->float('value', 10, 2)->nullable(false);
            $table->float('rate', 10, 8)->nullable(false);
            $table->tinyInteger('type')->nullable(false);
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
