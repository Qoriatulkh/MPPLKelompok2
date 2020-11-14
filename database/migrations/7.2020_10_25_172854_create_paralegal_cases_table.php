<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParalegalCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paralegalCase', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('paralegal_id')->unsigned();
            $table->foreign('paralegal_id')->references('id')->on('paralegals')->onDelete('CASCADE');
            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('paralegalCaseTypes')->onDelete('CASCADE');
            $table->integer('field_id')->unsigned();
            $table->foreign('field_id')->references('id')->on('paralegalCaseField')->onDelete('CASCADE');
            $table->string('desc');
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
        Schema::dropIfExists('paralegalCase');
    }
}
