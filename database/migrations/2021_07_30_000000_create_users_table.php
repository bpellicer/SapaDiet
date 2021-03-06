<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('imatge_id')->default(1)->constrained();
            $table->foreignId('planificacio_id')->default(1)->constrained('planificacions');
            $table->string('nom',30);
            $table->string('cognoms',190);
            $table->string('email',190)->unique();
            $table->enum("sexe",["Home","Dona"]);
            $table->integer("edat");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contrasenya',190);
            $table->boolean('primera_vegada')->default(true);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
