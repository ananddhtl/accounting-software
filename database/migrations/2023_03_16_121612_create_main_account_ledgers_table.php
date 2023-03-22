<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_account_led', function (Blueprint $table) {
            $table->id('sn');
            $table->text('shortNarration');
            $table->float('dr');
            $table->float('cr');
            $table->text('transactioncode');
            $table->bigInteger('cancel')->nullable()->default(0);
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
        Schema::dropIfExists('main_account_led');
    }
};
