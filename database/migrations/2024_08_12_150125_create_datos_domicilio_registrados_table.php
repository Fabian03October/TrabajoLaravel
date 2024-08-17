<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosDomicilioRegistradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_domicilio_registrados', function (Blueprint $table) {
            $table->id();  // Primary Key
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Foreign Key referenciando la tabla users
            
            $table->string('codigo_postal'); // Reemplazar espacio con guion bajo
            $table->string('nombre_vialidad');
            $table->string('numero_interior')->nullable();
            $table->string('nombre_localidad');
            $table->string('nombre_entidad_federativa');
            $table->string('tipo_vialidad');
            $table->string('numero_exterior');
            $table->string('nombre_colonia');
            $table->string('nombre_municipio');
            $table->string('entre_calle')->nullable();
            $table->string('y_calle')->nullable();
            $table->timestamps();  // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('datos_domicilio_registrados');
    }
}
