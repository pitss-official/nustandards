<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Results extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('results', function (Blueprint $table) {
            $table->string('certID',100)->unique();
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->integer('marks');
            $table->string('score',5);
            $table->unsignedBigInteger('attempt_id')->unique();
            $table->foreign('attempt_id')->references('id')->on('allowed_attempts');
            $table->text('link')->nullable();
            $table->date('start')->nullable();
            $table->date('end_date')->nullable();
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
