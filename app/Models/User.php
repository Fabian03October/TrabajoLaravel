<?php

namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected$fillable = [
        'name',
        'email',
        'password',
        'CURP',
        'RFC',
        'primer_apellido',
        'segundo_apellido',
        'fecha_inicio_operaciones',
        'estatus_padron',
        'fecha_ultimo_cambio_estado',
        'nombre_comercial',
    ];
    


    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'fecha_inicio_operaciones' => 'date',
        'fecha_ultimo_cambio_estado' => 'date',
    ];
    
 // Relación con Domicilio (one-to-one)
 public function domicilioRegistrado()
    {
        return$this->hasOne(DomicilioRegistrado::class, 'user_id');
    }

    // Relación con ActividadEconomica (one-to-many)
    public function actividadesEconomicas()
    {
        return$this->hasMany(ActividadEconomica::class, 'user_id');
    }

    // Relación con Regimen (one-to-many)
    public function regimenes()
    {
        return$this->hasMany(Regimen::class, 'user_id');
    }

    // Relación con Obligacion (one-to-many)
    public function obligaciones()
    {
        return$this->hasMany(Obligacion::class, 'user_id');
    }
}