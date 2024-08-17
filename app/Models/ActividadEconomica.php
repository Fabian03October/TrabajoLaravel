<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadEconomica extends Model
{
    use HasFactory;

    protected $table = 'actividad_economica';

    protected $fillable = [
        'user_id',
        'Id_actividad_economica',
        'porcentaje',
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

    public function actividadEconomicaGeneral()
    {
        return $this->belongsTo(ActividadesEconomicas::class, 'Id_actividad_economica');
    }
}