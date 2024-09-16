<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type')->comment('model name: audio/category/channel');
            $table->unsignedInteger('model_id')->comment('id of model');
            $table->enum('status', ['draft', 'new', 'approve', 'suspend'])->comment('status of item');
            $table->string('notes')->nullable()->comment('notes from auditor');
            $table->unsignedInteger('admin_id')->nullable()->comment('this admin id');
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
        Schema::dropIfExists('audits');
    }
}
