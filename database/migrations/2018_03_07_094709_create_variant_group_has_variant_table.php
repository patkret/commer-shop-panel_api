<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVariantGroupHasVariantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variant_group_has_variant', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('variant_group_id')->unsigned();
            $table->integer('variant_id')->unsigned();

            $table->foreign('variant_group_id')
                ->references('id')
                ->on('variant_groups')
                ->onDelete('cascade');

            $table->foreign('variant_id')
                ->references('id')
                ->on('variants')
                ->onDelete('cascade');

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
        Schema::dropIfExists('variant_group_has_variant');
    }
}
