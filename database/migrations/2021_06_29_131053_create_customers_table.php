<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id', 20)->unique();
            $table->string('name', 80);
            $table->string('email', 80);
            $table->string('phone', 64);
            $table->text('address');
            $table->unsignedBigInteger('pop_id');
            $table->tinyInteger('status');
            $table->timestamps();
            $table->foreign('pop_id')->references('id')->on('pops');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
