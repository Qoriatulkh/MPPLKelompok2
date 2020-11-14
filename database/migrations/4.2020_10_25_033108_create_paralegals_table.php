<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParalegalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paralegals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('CASCADE')->nullable();
            $table->string('number');
            $table->string('name');
            $table->string('address');
            $table->enum('sex',['Male','Female']);
            $table->boolean('isApproved');
            $table->string('phoneNumber');
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
        Schema::dropIfExists('paralegals');
    }
}
