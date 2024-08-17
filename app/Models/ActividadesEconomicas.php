<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesEconomicas extends Model
{
    use HasFactory;

    protected $table = 'actividades_economicas';
    protected $primaryKey = 'Id_actividad_economica';

    protected $fillable = [
        'nombre',
    ];

    public function actividadesEconomicas()
    {
        return $this->hasMany(ActividadEconomica::class, 'Id_actividad_economica');
    }
}