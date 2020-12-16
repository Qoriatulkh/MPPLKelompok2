<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('region_name');
            $table->string('region_code');
            $table->string('province_name');
            $table->string('province_code');
            $table->string('city_name');
            $table->string('city_code');
            $table->string('district_name');
            $table->string('district_code');
            $table->string('village_name');
            $table->string('village_code');
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
        Schema::dropIfExists('areas');
    }
}
