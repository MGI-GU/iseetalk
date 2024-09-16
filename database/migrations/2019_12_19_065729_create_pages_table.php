<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('sub_content')->comment('little desctiption of page, seo description, subject content / notice');
            $table->text('content');
            $table->unsignedInteger('author_id')->comment('id of user writer');
            $table->string('type', 100)->nullable->comment('type: footer, page');
            $table->string('status', 100)->default(0)->comment('status: publish, unpublish');
            $table->string('slug')->comment('page url handle');
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
        Schema::dropIfExists('pages');
    }
}
