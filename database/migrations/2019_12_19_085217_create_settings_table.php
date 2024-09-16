<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('web_subscription')->default(0)->comment('false, true');
            $table->boolean('web_recommendation')->default(1)->comment('false, true');
            $table->boolean('web_channel')->default(0)->comment('false, true');
            $table->boolean('web_all_comment')->default(0)->comment('false, true');
            $table->boolean('web_my_comment_reply')->default(0)->comment('false, true');
            $table->boolean('email_permission')->default(1)->comment('false, true');
            $table->boolean('email_subscription')->default(0)->comment('false, true');
            $table->boolean('email_product')->default(1)->comment('false, true');
            $table->boolean('email_channel')->default(1)->comment('false, true');
            $table->string('language')->default('Indonesia')->nullable();
            $table->unsignedInteger('user_id')->comment('id of user');

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
        Schema::dropIfExists('settings');
    }
}
