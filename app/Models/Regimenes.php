<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regimenes extends Model
{
    use HasFactory;

    protected $table = 'regimenes'; // Tabla 'regimenes'
    protected $primaryKey = 'IdRegimenes';

    protected $fillable = [
        'nombre',
    ];

    public function regimenes()
    {
        return $this->hasMany(Regimen::class, 'ID_regimen');
    }
}
