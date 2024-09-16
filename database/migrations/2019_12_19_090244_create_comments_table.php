<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->mediumText('comment');
            $table->unsignedInteger('audio_id')->comment('id of audio commneted');
            $table->unsignedInteger('comment_id')->nullable()->comment('parent of commented');
            $table->unsignedInteger('user_id')->comment('owner of comment');
            $table->string('status', 100)->default('public')->comment('status: public, private, review, spam');
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
        Schema::dropIfExists('comments');
    }
}
