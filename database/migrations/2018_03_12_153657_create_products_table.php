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
            $table->string('description')->nullable();
            $table->double('price');
            $table->double('weight');
            $table->integer('category')->unsigned()->nullable();
            $table->foreign('category')
                ->references('id')
                ->on('categories')
                ->onDelete('set null');
            $table->integer('variant_set')->unsigned()->nullable();
            $table->foreign('variant_set')
                ->references('id')
                ->on('variant_groups')
                ->onDelete('set null');
            $table->text('product_variant_set_values')->nullable();
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
