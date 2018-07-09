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
            $table->string('symbol')->nullable();
            $table->string('barcode');
            $table->string('barcode_simple');
            $table->string('pkwiuCode')->nullable();
            $table->double('weight')->nullable();
            $table->string('weight_unit')->nullable();
            $table->double('height')->nullable();
            $table->double('width')->nullable();
            $table->double('depth')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('url')->nullable();
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
            $table->double('wholesale_price');
            $table->integer('main_category')->unsigned();
            $table->foreign('main_category')
                ->references('id')
                ->on('categories');
            $table->integer('stockAvail');
            $table->text('attributeSets')->nullable();
            $table->text('variantSets')->nullable();
            $table->integer('selectedVariantSet')->nullable();
            $table->integer('stock')->unsigned()->nullable();
            $table->foreign('stock')
                ->references('id')
                ->on('warehouses')
                ->onDelete('set null');
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
