<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersApatsAlimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_apats_aliments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_apat_id');
            $table->unsignedBigInteger('aliment_id');
            $table->foreign('user_apat_id')->references('id')->on('users_apats')->onDelete('cascade');
            $table->foreign('aliment_id')->references('id')->on('aliments')->onDelete('cascade');
            $table->double("mesura_quantitat");
            $table->date("data");
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
        Schema::dropIfExists('users_apats_aliments');
    }
}
