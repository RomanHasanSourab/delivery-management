<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialMerchantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_merchants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('merchant_id')->nullable();
            $table->integer('district_id_from')->nullable();
            $table->integer('district_id_to')->nullable();
            $table->string('charge')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('special_merchants');
    }
}
