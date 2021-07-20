<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_id')->constrained('categories');
            $table->foreignId('imatge_id')->constrained('imatges');
            $table->string('nom');
            $table->double('kilocalories');
            $table->double('hidrats');
            $table->double('proteines');
            $table->double('grasses');
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
        Schema::dropIfExists('aliments');
    }
}
