<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('avatar')->nullable()->comment('user picture');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('sex', 100)->nullable();
            $table->string('personal_status')->nullable();
            $table->string('location')->nullable();
            $table->date('birthday')->nullable();
            $table->string('status')->default('invalid')->comment('user status: active, inactive, invalid, disable');
            $table->string('type')->default('streamer')->comment('user type: streamer, creator, member, admin');
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('platform', ['website', 'android', 'ios']);
            $table->string('role_id')->nullable();
            $table->string('password');
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
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
