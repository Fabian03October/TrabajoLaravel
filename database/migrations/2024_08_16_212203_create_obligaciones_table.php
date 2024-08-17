<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObligacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obligaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Llave foránea a usuarios
            $table->unsignedBigInteger('ID_descripcion_obligacion'); // Llave foránea a descripcion_obligacion
            $table->unsignedBigInteger('ID_obligacion_vencimiento'); // Llave foránea a obligacion_vencimiento
            $table->date('fecha_inicio'); // Campo para fecha de inicio
            $table->date('fecha_fin'); // Campo para fecha de fin
            $table->timestamps();

            // Definir las llaves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ID_descripcion_obligacion')->references('ID_descripcion_obligacion')->on('descripcion_obligacion')->onDelete('cascade');
            $table->foreign('ID_obligacion_vencimiento')->references('ID_obligacion_vencimiento')->on('obligacion_vencimiento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obligaciones');
    }
}
