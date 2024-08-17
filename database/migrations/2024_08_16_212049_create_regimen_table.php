<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regimen', function (Blueprint $table) {
            $table->id('ID_regimen'); // Clave primaria
            $table->unsignedBigInteger('user_id'); // Columna 'user_id'
            $table->unsignedBigInteger('IdRegimenes'); // Columna 'IdRegimenes'
            $table->date('fecha_inicio_regimen')->nullable(); // Columna 'fecha_inicio_regimen' opcional
            $table->date('fecha_fin_regimen')->nullable(); // Columna 'fecha_fin_regimen' opcional
            $table->timestamps();

            // Definir la clave foránea que referencia a la tabla `users`
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Definir la clave foránea que referencia a la tabla `regimenes`
            $table->foreign('IdRegimenes')->references('IdRegimenes')->on('regimenes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regimen');
    }
}
