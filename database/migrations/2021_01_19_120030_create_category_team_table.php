<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_team', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('team_id');
            $table->unsignedInteger('category_id');
            $table->string('status', 100)->default('active')->comment('active, suspend');
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
        Schema::dropIfExists('category_team');
    }
}
