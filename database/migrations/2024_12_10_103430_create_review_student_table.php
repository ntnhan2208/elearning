<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_student', function (Blueprint $table) {
            $table->id();
            $table->text('answer');
        });

        Schema::table('review_student', function (Blueprint $table) {
            $table->foreignId('review_id')->nullable()->constrained('reviews');
            $table->foreignId('student_id')->nullable()->constrained('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_student');
    }
}
