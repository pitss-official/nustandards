<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('questions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->text('question_text');
            $table->text('option_1')->nullable();
            $table->text('option_2')->nullable();
            $table->text('option_3')->nullable();
            $table->text('option_4')->nullable();
            $table->text('option_others')->nullable();
            $table->text('images')->nullable();
            $table->unsignedBigInteger('topic_id');
            $table->unsignedInteger('type')->default(0);
            $table->foreign('topic_id')->references('id')->on('topics');
            $table->unsignedInteger('display_times')->default(1);
            $table->string('correct_answer')->default('');
            $table->unsignedInteger('positive_points');
            $table->unsignedInteger('negative_points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
