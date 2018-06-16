<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('street');
            $table->string('apartment_no')->nullable();
            $table->string('house_no');
            $table->string('zip_code');
            $table->string('city');
            $table->string('phone_no');
            $table->string('NIP')->nullable();
            $table->boolean('status');
            $table->string('confirmation_code')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
