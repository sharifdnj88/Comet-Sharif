<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('role_id') ->default(3);
            $table->string('name');
            $table->string('email') -> unique();
            $table->string('mobile') -> unique();
            $table->string('password');            
            $table->string('first_name') ->nullable();            
            $table->string('last_name') ->nullable();            
            $table->string('dob') -> nullable();
            $table->text('address') -> nullable();
            $table->string('city') -> nullable();
            $table->string('zip_code') -> nullable();
            $table->string('country') -> nullable();
            $table->string('photo') -> default('avatar.png');
            $table->string('access_token') -> nullable();
            $table->boolean('status') -> default(true);
            $table->boolean('trash') -> default(false);
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
        Schema::dropIfExists('admins');
    }
};
