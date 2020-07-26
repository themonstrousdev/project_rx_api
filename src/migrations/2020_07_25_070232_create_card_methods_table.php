<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("card_methods", function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('code');
            $table->bigInteger('account_id');
            $table->string('account_code');
            $table->string('last4');
            $table->string('token');
            $table->string('bank_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_methods');
    }
}
