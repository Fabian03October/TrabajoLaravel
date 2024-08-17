<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obligacion extends Model
{
    use HasFactory;

    protected $table = 'obligaciones';

    protected $fillable = [
        'user_id',
        'ID_descripcion_obligacion',
        'ID_obligacion_vencimiento',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function descripcionObligacion()
    {
        return $this->belongsTo(DescripcionObligacion::class, 'ID_descripcion_obligacion');
    }

    public function obligacionVencimiento()
    {
        return $this->belongsTo(ObligacionVencimiento::class, 'ID_obligacion_vencimiento');
    }
}