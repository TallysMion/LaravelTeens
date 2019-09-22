<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaderTeensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leader_teens', function (Blueprint $table) {
            $table->unsignedBigInteger('leader');
            $table->unsignedBigInteger('teen')->unique();
            $table->timestamps();

            $table->foreign('leader')->references('id')->on('users');
            $table->foreign('teen')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leader_teens');
    }
}
