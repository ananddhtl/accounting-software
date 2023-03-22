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
        Schema::create('main_account_ledger_des', function (Blueprint $table) {
            $table->id('vno');
            $table->date('createddate');
            $table->text('mainNarration');
            $table->text('transactionCode');
            $table->smallInteger('userId');
            $table->date('updatedDate');
            $table->date('numericDate');
            $table->text('voucherType');
            $table->text('voucher_generation');
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
        Schema::dropIfExists('main_account_ledger_de');
    }
};
