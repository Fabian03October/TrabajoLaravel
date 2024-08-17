<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadEconomicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_economica', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Columna 'user_id'
            $table->unsignedBigInteger('Id_actividad_economica'); // Columna 'Id_actividad_economica'
            $table->decimal('porcentaje', 5, 2); // Columna 'porcentaje'
            $table->date('fecha_inicio'); // Columna 'fecha_inicio'
            $table->date('fecha_fin')->nullable(); // Columna 'fecha_fin' opcional
            $table->timestamps();

            // Definir la llave foránea
            $table->foreign('Id_actividad_economica')->references('id')->on('actividades_economicas')->onDelete('cascade');

            // Llave foránea para 'user_id'
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actividad_economica');
    }
}
