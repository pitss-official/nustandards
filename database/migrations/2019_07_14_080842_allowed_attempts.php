<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllowedAttempts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('allowed_attempts', function (Blueprint $table) {
           $table->unsignedBigInteger('id')->autoIncrement();
           $table->unsignedBigInteger('user_id');
           $table->unsignedBigInteger('certification_id');
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('certification_id')->references('id')->on('certifications');
           $table->timestamp('end_time')->nullable();
           $table->timestamps();
           $table->boolean('is_active')->default(true);
        });
        DB::table('allowed_attempts')->insert(
            array(
                'user_id'=>1,
                'certification_id'=>1
            )
        );
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
