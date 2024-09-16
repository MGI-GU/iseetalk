<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('audio_id')->comment('id of audio');
            $table->date('listened_at')->nullable()->comment('last time of listening');
            $table->unsignedInteger('played_number')->comment('count played audio per user');
            $table->tinyInteger('listen_later')->default(0)->comment('listen latter condition : true / false');
            $table->tinyInteger('liked')->default(0)->comment('liked condition : true / false');
            $table->unsignedInteger('user_id')->comment('id of user');
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
        Schema::dropIfExists('user_activity');
    }
}
