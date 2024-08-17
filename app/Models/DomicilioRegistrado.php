<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomicilioRegistrado extends Model
{
    use HasFactory;

    protected $table = 'datos_domicilio_registrados';

    protected $fillable = [
        'user_id', 'codigo_postal', 'nombre_vialidad', 'numero_interior', 
        'nombre_localidad', 'nombre_entidad_federativa', 'tipo_vialidad', 
        'numero_exterior', 'nombre_colonia', 'nombre_municipio', 
        'entre_calle', 'y_calle'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
