<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObligacionVencimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obligacion_vencimiento', function (Blueprint $table) {
            $table->id('ID_obligacion_vencimiento'); // Clave primaria personalizada
            $table->string('nombre'); // Columna 'nombre' para el modelo
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
        Schema::dropIfExists('obligacion_vencimiento');
    }
}
