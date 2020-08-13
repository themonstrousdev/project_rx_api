<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateLedgersTableAddPaymentPayloadAndPaymentPayloadValue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('ledgers', function (Blueprint $table){
            $table->string("payment_payload")->after("currency")->nullable();
            $table->string("payment_payload_value")->after("payment_payload")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
