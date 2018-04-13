<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('symbol');
            $table->string('barcode');
            $table->string('pkwiuCode');
            $table->double('weight')->nullable();
            $table->double('height')->nullable();
            $table->double('width')->nullable();
            $table->double('depth')->nullable();
            $table->integer('vendor')->unsigned()->nullable();
            $table->foreign('vendor')
                ->references('id')
                ->on('vendors')
                ->onDelete('set null');
            $table->boolean('visibility');
            $table->integer('vat_rate')->unsigned()->nullable();
            $table->foreign('vat_rate')
                ->references('id')
                ->on('vat_rates')
                ->onDelete('set null');
            $table->string('shortDescription')->nullable();
            $table->text('longDescription')->nullable();
            $table->double('price');
            $table->double('intoStockPrice');
            $table->integer('stock');
            $table->integer('stockAvail');
            $table->text('attributeSets')->nullable();
            $table->text('variantSets')->nullable();
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
        Schema::dropIfExists('products');
    }
}
