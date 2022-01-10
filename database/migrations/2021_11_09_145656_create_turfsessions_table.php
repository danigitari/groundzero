<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTurfsessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turfsessions', function (Blueprint $table) {
            $table->id()->unique();;
            $table->string('name');
            $table->bigInteger('phoneNumber');
            $table->string("email");
            $table->string("date");
            $table->time("start");
            $table->time("end");
            $table->integer('user_id');
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
        Schema::dropIfExists('turfsessions');
    }
}
