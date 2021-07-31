<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerMailHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_mail_histories', function (Blueprint $table) {
            $table->id();
            $table->string('subject', 255);
            $table->text('body');
            $table->string('attachment', 255)->nullable();
            $table->string('pop', 255);
            $table->string('customer', 255);
            $table->string('category', 32);
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
        Schema::dropIfExists('customer_mail_histories');
    }
}
