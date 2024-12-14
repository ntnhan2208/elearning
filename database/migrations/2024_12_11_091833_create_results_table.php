<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
            $table->float('score');
            $table->timestamps();
        });

        Schema::table('results', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->foreignId('student_id')->nullable()->constrained('students');
            $table->foreignId('test_id')->nullable()->constrained('tests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}
