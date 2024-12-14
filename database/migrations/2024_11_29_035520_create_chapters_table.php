<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->string('chapter_name');
            $table->timestamps();
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->foreignId('teacher_id')->nullable()->constrained('teachers');
            $table->foreignId('subject_id')->nullable()->constrained('subjects');
        });
    }


    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
