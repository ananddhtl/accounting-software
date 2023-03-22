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
        Schema::create('main_accou', function (Blueprint $table) {
            $table->id("sn");
            $table->bigInteger("accno")->nullable()->default(0);
            $table->string("accname")->nullable()->default(0);
            $table->text("accounthead")->nullable()->default(0);
            $table->text("groups")->nullable()->default(0);
            $table->text("subgroups")->nullable()->default(0);
            $table->bigInteger("phoneno")->nullable()->default(0);
            $table->text("address")->nullable()->default(0);
            $table->bigInteger("mobno")->nullable()->default(0);
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
        Schema::dropIfExists('main_accou');
    }
};
