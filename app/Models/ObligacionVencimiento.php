<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObligacionVencimiento extends Model
{
    use HasFactory;

    protected $table = 'obligacion_vencimiento';
    protected $primaryKey = 'ID_obligacion_vencimiento';

    protected $fillable = [
        'nombre',
    ];

    public function obligaciones()
    {
        return $this->hasMany(Obligacion::class, 'ID_obligacion_vencimiento');
    }
}