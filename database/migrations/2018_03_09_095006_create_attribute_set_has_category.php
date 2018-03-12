<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeSetHasCategory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_set_has_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_set_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->foreign('attribute_set_id')
                ->references('id')
                ->on('attribute_sets')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
