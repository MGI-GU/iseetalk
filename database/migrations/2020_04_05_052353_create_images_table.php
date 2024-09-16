<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('attachment_id')->comment('id of source attachment');
            $table->string('title');
            $table->string('source');
            $table->float('time_show');
            $table->float('time_end');
            $table->unsignedInteger('audio_id')->comment('id of audio');
            $table->unsignedInteger('pages')->nullable()->comment('count slide of attachment');;
            $table->string('status', 100)->nullable();
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
        Schema::dropIfExists('images');
    }
}
