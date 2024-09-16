<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('media')->nullable();
            $table->unsignedInteger('user_id')->comment('owner of channel');
            $table->string('status', 100)->default(0)->comment('status: publish, unpublish');
            $table->string('category', 100)->nullable()->comment('category relation to team');
            $table->string('type', 100)->nullable()->comment('type: best, trending, selected');
            $table->string('visibility', 100)->default('public')->comment('public / private');
            $table->unsignedInteger('parent_id')->nullable()->comment('this draft of id');
            $table->unsignedInteger('backup_id')->nullable()->comment('this backup of id');
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
        Schema::dropIfExists('channels');
    }
}
