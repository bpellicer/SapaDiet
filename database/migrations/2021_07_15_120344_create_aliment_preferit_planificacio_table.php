<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlimentPreferitPlanificacioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliment_preferit_planificacio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planificacio_id');
            $table->unsignedBigInteger('aliment_preferit_id');
            $table->foreign('planificacio_id')->references('id')->on('planificacions')->onDelete('cascade');
            $table->foreign('aliment_preferit_id')->references('id')->on('aliments_preferits')->onDelete('cascade');
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
        Schema::dropIfExists('aliment_preferit_planificacio');
    }
}
