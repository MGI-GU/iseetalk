<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('source')->nullable()->comment('url/link uploaded audio resource');
            $table->string('thumbnail')->nullable()->comment('cover audio image');
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('duration')->nullable()->comment('play time audio in second');
            $table->string('visibility', 100)->default(0)->comment('public / private');
            $table->string('contain', 100)->nullable()->comment('presentation, etc');
            $table->string('status', 100)->default(0)->comment('draft, pending, approve, revision, block');
            $table->smallInteger('allow_comment')->nullable()->comment('allow, review, none');
            $table->string('sort_comment', 100)->nullable()->comment('trend, new');
            $table->boolean('allow_age')->default(0)->comment('false, true');
            $table->boolean('allow_notice')->default(0)->comment('false, true');
            $table->boolean('allow_rating')->default(0)->comment('false, true');
            $table->char('language', 50)->default('none')->comment('none, id, en');
            $table->unsignedInteger('category_id')->nullable()->comment('part of the channel');
            $table->unsignedInteger('channel_id')->comment('part of the channel');
            $table->unsignedInteger('user_id')->comment('owner of audio');
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
        Schema::dropIfExists('audios');
    }
}
