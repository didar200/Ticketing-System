<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmtpConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smtp_configurations', function (Blueprint $table) {
            $table->id();
            $table->string('host', 64);
            $table->string('port', 5);
            $table->string('encryption', 5)->nullable();
            $table->string('username', 64);
            $table->string('password', 64);
            $table->string('name', 64);
            $table->string('address', 64);
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
        Schema::dropIfExists('smtp_configurations');
    }
}
