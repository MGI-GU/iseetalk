<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('project_id')->nullable();
            $table->string('model')->comment('model name: audio/channel');
            $table->unsignedInteger('model_id')->comment('id of model');
            $table->string('source', 200)->nullable();
            $table->string('status', 200)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_projects');
    }
}
