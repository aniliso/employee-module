<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeEmployeeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee__employee_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->text('description');
            $table->text('biography');
            $table->text('skills');
            $table->string('position');

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            $table->integer('employee_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['employee_id', 'locale']);
            $table->foreign('employee_id')->references('id')->on('employee__employees')->onDelete('cascade');
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
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('employee__employee_translations');
    }
}
