<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProFormaInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_forma_invoices', function (Blueprint $table) {
                $table->increments('id');
                $table->string('number');
                $table->string('NIP');
                $table->string('company');
                $table->string('address');
                $table->integer('order_id')->unsigned();
                $table->foreign('order_id')
                    ->references('id')
                    ->on('orders');
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
        Schema::dropIfExists('pro_forma_invoices');
    }
}
