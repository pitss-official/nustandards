<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Certifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('certifications', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('name');
            $table->string('code',100);
            $table->unsignedInteger('allowed_time')->default(0);
            $table->string('completion_title',255);
            $table->timestamps();
        });
        DB::table('certifications')->insert(
            array(
                'code'=>'AAEC',
                'name' => 'Automation using Raspberry Pi and Arduino',
                'allowed_time'=>10080,
                'completion_title'=>'Associate Automation Engineer',
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
