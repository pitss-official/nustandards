<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Courses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('courses', function (Blueprint $table)
        {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name',255);
            $table->string('code',100);
            $table->unsignedInteger('alloc_size')->default(0);
            $table->unsignedBigInteger('certification_id');
            $table->foreign('certification_id')->references('id')->on('certifications');
            $table->timestamps();
        });
        DB::table('courses')->insert(
            array(
                'code'=>'ARDUINO-B1',
                'name' => 'Arduino Basics to Intermediate',
                'certification_id'=>1
            )
        );DB::table('courses')->insert(
            array(
                'code'=>'RASP-B1',
                'name' => 'Raspberry Basics to Intermediate',
                'certification_id'=>1
            )
        );DB::table('courses')->insert(
            array(
                'code'=>'APPS-PWA',
                'name' => 'Progressive Web Apps and Manifests',
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
