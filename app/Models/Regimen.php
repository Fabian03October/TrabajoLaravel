<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimen extends Model
{
    use HasFactory;

    protected $table = 'regimen'; // Tabla 'regimen'

    protected $fillable = [
        'user_id',
        'ID_regimen',
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

    public function regimenGeneral()
    {
        return $this->belongsTo(Regimenes::class, 'ID_regimen', 'IdRegimenes');
    }
}
