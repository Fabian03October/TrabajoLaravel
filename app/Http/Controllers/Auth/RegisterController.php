<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\DatoIdentificacionContribuyente;
use App\Models\DomicilioRegistrado;
use App\Models\ActividadEconomica;
use App\Models\Regimen;
use App\Models\Obligacion;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'CURP' => ['required', 'string', 'size:18', 'unique:users'],
            'primer_apellido' => ['required', 'string', 'max:255'],
            'segundo_apellido' => ['nullable', 'string', 'max:255'],
            'fecha_inicio_operaciones' => ['required', 'date'],
            'estatus_padron' => ['required', 'string', 'max:255'],
            'fecha_ultimo_cambio_estado' => ['required', 'date'],
            'nombre_comercial' => ['nullable', 'string', 'max:255'],
            'codigo_postal' => ['required', 'string', 'max:10'],
            'nombre_vialidad' => ['required', 'string', 'max:255'],
            'num_interior' => ['nullable', 'string', 'max:10'],
            'nombre_localidad' => ['required', 'string', 'max:255'],
            'nombre_entidad_federativa' => ['required', 'string', 'max:255'],
            'tipo_vialidad' => ['required', 'string', 'max:255'],
            'numero_exterior' => ['required', 'string', 'max:10'],
            'nombre_colonia' => ['required', 'string', 'max:255'],
            'nombre_municipio' => ['required', 'string', 'max:255'],
            'entre_calle' => ['nullable', 'string', 'max:255'],
            'y_calle' => ['nullable', 'string', 'max:255'],
            'actividad_economica' => ['required', 'string', 'max:255'],
            'porcentaje' => ['required', 'numeric', 'min:0', 'max:100'],
            'fecha_inicio_actividad' => ['required', 'date'],
            'fecha_fin_actividad' => ['nullable', 'date'],
            'regimen' => ['required', 'string', 'max:255'],
            'fecha_inicio_regimen' => ['required', 'date'],
            'fecha_fin_regimen' => ['nullable', 'date'],
            'descripcion_obligacion' => ['required', 'string', 'max:255'],
            'obligacion_vencimiento' => ['required', 'date'],
            'fecha_inicio_obligacion' => ['required', 'date'],
            'fecha_fin_obligacion' => ['nullable', 'date'],
        ]);
    }

    protected function create(array $data)
    {
        $rfc = substr($data['CURP'], 0, 10) . Str::random(3);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'CURP' => $data['CURP'],
            'RFC' => $rfc,
            'primer_apellido' => $data['primer_apellido'],
            'segundo_apellido' => $data['segundo_apellido'],
            'fecha_inicio_operaciones' => $data['fecha_inicio_operaciones'],
            'estatus_padron' => $data['estatus_padron'],
            'fecha_ultimo_cambio_estado' => $data['fecha_ultimo_cambio_estado'],
            'nombre_comercial' => $data['nombre_comercial'],
        ]);


        DomicilioRegistrado::create([
            'user_id' => $user->id,
            'codigo_postal' => $data['codigo_postal'],
            'nombre_vialidad' => $data['nombre_vialidad'],
            'num_interior' => $data['num_interior'],
            'nombre_localidad' => $data['nombre_localidad'],
            'nombre_entidad_federativa' => $data['nombre_entidad_federativa'],
            'tipo_vialidad' => $data['tipo_vialidad'],
            'numero_exterior' => $data['numero_exterior'],
            'nombre_colonia' => $data['nombre_colonia'],
            'nombre_municipio' => $data['nombre_municipio'],
            'entre_calle' => $data['entre_calle'],
            'y_calle' => $data['y_calle'],
        ]);

        ActividadEconomica::create([
            'user_id' => $user->id,
            'actividad_economica' => $data['actividad_economica'],
            'porcentaje' => $data['porcentaje'],
            'fecha_inicio' => $data['fecha_inicio_actividad'],
            'fecha_fin' => $data['fecha_fin_actividad'],
        ]);

        Regimen::create([
            'user_id' => $user->id,
            'regimen' => $data['regimen'],
            'fecha_inicio' => $data['fecha_inicio_regimen'],
            'fecha_fin' => $data['fecha_fin_regimen'],
        ]);

        Obligacion::create([
            'user_id' => $user->id,
            'descripcion_obligacion' => $data['descripcion_obligacion'],
            'obligacion_vencimiento' => $data['obligacion_vencimiento'],
            'fecha_inicio' => $data['fecha_inicio_obligacion'],
            'fecha_fin' => $data['fecha_fin_obligacion'],
        ]);

        return $user;
    }
}

