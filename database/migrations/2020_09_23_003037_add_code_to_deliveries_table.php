<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCodeToDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->text('pickup_address')->nullable();
            $table->string('code')->nullable();
            $table->integer('district_id_from')->nullable();
            $table->integer('delivery_status')->default('1');
            $table->text('delivery_remark')->nullable();
            $table->integer('delivery_status_changed_by')->nullable();
            $table->timestamp('delivery_status_changed_at')->nullable();
            $table->integer('paid_status')->default('2');
            $table->timestamp('paid_at')->nullable();
            $table->integer('paid_status_changed_by')->nullable();
//            $table->bigInteger('assigned_agent_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            //
        });
    }
}
