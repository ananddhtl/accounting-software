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
        Schema::create('crediton_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('accno');
            $table->string('particulars');
            $table->float('amount');
            $table->float('taxable_amount');
            $table->float('vat_amount');
            $table->string('tcode');
            $table->bigInteger('user_id');
            $table->float('cancel')->default(0);
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
        Schema::dropIfExists('crediton_purchases');
    }
};
