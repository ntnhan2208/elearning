<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number', 10)->nullable();
            $table->integer('account_id');
            $table->string('gender');
            $table->timestamps();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->foreignId('admin_id')->nullable()->constrained('admins');
            $table->foreignId('class_id')->nullable()->constrained('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
