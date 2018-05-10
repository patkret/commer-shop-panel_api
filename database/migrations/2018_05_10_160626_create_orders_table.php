<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('shipping_method_id')->unsigned();
            $table->foreign('shipping_method_id')
                ->references('id')
                ->on('shipping_methods');
            $table->integer('payment_method_id')->unsigned();
            $table->foreign('payment_method_id')
                ->references('id')
                ->on('payment_methods');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('client_id')->unsigned();
            $table->foreign('client_id')
                ->references('id')
                ->on('clients');
            $table->integer('discount_threshold_id')->unsigned();
            $table->foreign('discount_threshold_id')
                ->references('id')
                ->on('discount_thresholds');
            $table->string('status');
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
