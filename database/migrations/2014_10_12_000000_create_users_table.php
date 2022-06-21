<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->string('email')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('fullname');
            $table->string('observations')->nullable();
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('user_roles')->onDelete('cascade');

        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
}
