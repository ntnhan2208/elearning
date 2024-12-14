<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_test', function (Blueprint $table) {
            $table->id();
        });

        Schema::table('review_test', function (Blueprint $table) {
            $table->foreignId('review_id')->nullable()->constrained('reviews');
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
        Schema::dropIfExists('review_test');
    }
}
