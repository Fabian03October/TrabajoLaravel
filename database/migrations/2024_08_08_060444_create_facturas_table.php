<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->string('rfc_emisor')->nullable(); // Se obtendrá de la tabla de usuarios
            $table->string('nombre_emisor')->nullable(); // Se obtendrá de la tabla de usuarios
            $table->string('folio')->nullable(); // Se generará automáticamente y de forma aleatoria
            $table->string('rfc_receptor');
            $table->string('nombre_receptor');
            $table->string('codigo_postal_receptor')->nullable(); // Se generará automáticamente
            $table->string('regimen_fiscal');
            $table->string('uso_cfdi');
            $table->string('serie_fiscal')->nullable(); // Se generará con una letra aleatoria
            $table->string('serie_csd');
            $table->dateTime('fecha_emision')->nullable(); // Se generará automáticamente
            $table->string('tipo_efecto');
            $table->string('regimen_fiscal_receptor');
            $table->string('exportacion');
            $table->string('codigo_producto');
            $table->integer('cantidad');
            $table->string('clave_unidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('importe', 10, 2);
            $table->decimal('impuesto', 10, 2);
            $table->decimal('retencion_impuesto', 10, 2);
            $table->decimal('total', 10, 2);
            $table->string('moneda');
            $table->string('metodo_pago');
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
        Schema::dropIfExists('facturas');
    }
}