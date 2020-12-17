<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToParalegalCases extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paralegal_cases', function (Blueprint $table) {
            $table->string('name');
            $table->date('date');
            $table->unsignedInteger('created_by');

            // Foreign keys
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paralegal_cases', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn(['name', 'date', 'created_by']);
        });
    }
}
