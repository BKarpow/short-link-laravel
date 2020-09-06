<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShortLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('short_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('short_id');
            $table->string('ip');
            $table->string('user_agent');
            $table->foreign('short_id')->references('id')->on('shorts')->onDelete('cascade');
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
        Schema::dropIfExists('short_logs');
    }
}
