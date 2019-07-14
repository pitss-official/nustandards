<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fathers_name')->nullable();
            $table->string('college_id')->nullable();
            $table->string('college_name')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'email' => 'icare.pdubey@gmail.com',
                'password'=>'$2y$10$sdiR2riZ.kI7jNjTrhvoa.nIRUFGj7Hjn60UVgfrupm5L9PiQcqfq',
                'name'=>'Pawan Kumar',
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
        Schema::dropIfExists('users');
    }
}
