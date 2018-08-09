<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('originalId');
            $table->string('name');
            $table->string('area')->default('null');
            $table->string('url')->default('null');
            $table->integer('salaryTo')->default(null);
            $table->integer('salaryFrom')->default(null);
            $table->string('currency')->default('null');
            $table->string('logo')->default('null');
            $table->string('employer')->default('null');
            $table->string('experience');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vacancies');
    }
}
