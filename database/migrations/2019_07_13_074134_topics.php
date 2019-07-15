<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Topics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('topics', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->text('list');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedInteger('allowed_time')->default(0);
            //todo: integrity check that allowed time is lesser than the certification time
        });
        DB::table('topics')->insert(
            array(
                'list'=>'Introduction, Timers, PWM, Analog and Digital Input and Output',
                'course_id'=>1,
                'allowed_time'=>15
            )
        );DB::table('topics')->insert(
            array(
                'list'=>'Introduction, Analog and Digital Input and Output, BCM and Pin modes',
                'course_id'=>2,
                'allowed_time'=>15
            )
        );DB::table('topics')->insert(
            array(
                'list'=>'JSON, Manifest Development, Service Workers',
                'course_id'=>3,
                'allowed_time'=>15
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
