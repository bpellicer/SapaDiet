<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentPropisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliment_propis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categories');
            $table->foreignId('user_id')->constrained('users');
            $table->string('nom',190);
            $table->double('kilocalories');
            $table->double('hidrats');
            $table->double('proteines');
            $table->double('greixos');
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
        Schema::dropIfExists('aliment_propis');
    }
}
