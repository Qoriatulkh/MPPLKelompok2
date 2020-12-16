<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSoftDeleteToFieldAndType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paralegal_case_fields', function (Blueprint $table) {
            $table->softDeletes();
        });
        Schema::table('paralegal_case_types', function (Blueprint $table) {
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
        Schema::table('paralegal_case_fields', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('paralegal_case_types', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
