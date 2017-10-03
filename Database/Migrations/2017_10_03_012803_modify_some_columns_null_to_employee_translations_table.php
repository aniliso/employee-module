<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifySomeColumnsNullToEmployeeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employee__employee_translations', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('biography')->nullable()->change();
            $table->text('skills')->nullable()->change();
            $table->string('position')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee__employee_translations', function (Blueprint $table) {
            $table->text('description')->nullable(false)->change();
            $table->text('biography')->nullable(false)->change();
            $table->text('skills')->nullable(false)->change();
            $table->string('position')->nullable(false)->change();
        });
    }
}
