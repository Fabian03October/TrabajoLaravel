<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DescripcionObligacion extends Model
{
    use HasFactory;

    protected $table = 'descripcion_obligacion';
    protected $primaryKey = 'ID_descripcion_obligacion';

    protected $fillable = [
        'nombre',
    ];

    public function obligaciones()
    {
        return $this->hasMany(Obligacion::class, 'ID_descripcion_obligacion');
    }
}