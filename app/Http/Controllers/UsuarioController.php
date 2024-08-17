<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DatoIdentificacionContribuyente;
use App\Models\DomicilioRegistrado;
use App\Models\ActividadEconomica;
use App\Models\Regimen;
use App\Models\Obligacion;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;


class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function pdf($id)
    {
        $usuario = User::find($id);

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        $data = [
            'usuario' => $usuario,
        ];

        $pdf = Pdf::loadView('usuarios.pdf', $data);
        return $pdf->download('CSF_'.$usuario->name.'.pdf');
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'CURP' => 'required|string|size:18|unique:users,CURP',
        'primer_apellido' => 'required|string|max:45',
        'segundo_apellido' => 'nullable|string|max:45',
        'fecha_inicio_operaciones' => 'nullable|date',
        'estatus_padron' => 'nullable|string|max:45',
        'fecha_ultimo_cambio_estado' => 'nullable|date',
        'nombre_comercial' => 'nullable|string|max:45',
        'codigo_postal' => 'nullable|string|max:10',
        'nombre_vialidad' => 'nullable|string|max:255',
        'numero_interior' => 'nullable|string|max:45',
        'nombre_localidad' => 'nullable|string|max:255',
        'nombre_entidad_federativa' => 'nullable|string|max:255',
        'tipo_vialidad' => 'nullable|string|max:255',
        'numero_exterior' => 'nullable|string|max:45',
        'nombre_colonia' => 'nullable|string|max:255',
        'nombre_municipio' => 'nullable|string|max:255',
        'entre_calle' => 'nullable|string|max:255',
        'y_calle' => 'nullable|string|max:255',
        'Id_actividad_economica' => 'required|exists:actividades_economicas,Id_actividad_economica',
        'porcentaje' => 'nullable|numeric|min:0|max:100',
        'fecha_inicio_actividad' => 'nullable|date',
        'fecha_fin_actividad' => 'nullable|date',
            'ID_regimen' => 'required|exists:regimen,ID_regimen',
            'fecha_inicio_regimen' => 'nullable|date',
            'fecha_fin_regimen' => 'nullable|date',
        
        'ID_descripcion_obligacion' => 'required|exists:descripcion_obligacion,ID_descripcion_obligacion',
        'ID_obligacion_vencimiento' => 'required|exists:obligacion_vencimiento,ID_obligacion_vencimiento',
        'fecha_inicio_operaciones' => 'nullable|date',
        'fecha_fin_obligacion' => 'nullable|date',
        
    ]);

    DB::beginTransaction();

    try {
        $rfc = substr($validated['CURP'], 0, 10) . Str::random(3);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'CURP' => $validated['CURP'],
            'RFC' => $rfc,
            'primer_apellido' => $validated['primer_apellido'],
            'segundo_apellido' => $validated['segundo_apellido'],
            'fecha_inicio_operaciones' => $validated['fecha_inicio_operaciones'],
            'estatus_padron' => $validated['estatus_padron'],
            'fecha_ultimo_cambio_estado' => $validated['fecha_ultimo_cambio_estado'],
            'nombre_comercial' => $validated['nombre_comercial'],
        ]);

        DomicilioRegistrado::create([
            'user_id' => $user->id,
            'codigo_postal' => $validated['codigo_postal'],
            'nombre_vialidad' => $validated['nombre_vialidad'],
            'numero_interior' => $validated['numero_interior'],
            'nombre_localidad' => $validated['nombre_localidad'],
            'nombre_entidad_federativa' => $validated['nombre_entidad_federativa'],
            'tipo_vialidad' => $validated['tipo_vialidad'],
            'numero_exterior' => $validated['numero_exterior'],
            'nombre_colonia' => $validated['nombre_colonia'],
            'nombre_municipio' => $validated['nombre_municipio'],
            'entre_calle' => $validated['entre_calle'],
            'y_calle' => $validated['y_calle'],
        ]);

        ActividadEconomica::create([
            'user_id' => $user->id,
            'Id_actividad_economica' => $validated['Id_actividad_economica'],
            'porcentaje' => $validated['porcentaje'],
            'fecha_inicio' => $validated['fecha_inicio_actividad'],
            'fecha_fin' => $validated['fecha_fin_actividad'],
        ]);

        Regimen::create([
            'user_id' => $user->id,
            'ID_regimen' => $validated['ID_regimen'],
            'fecha_inicio' => $validated['fecha_inicio_regimen'],
            'fecha_fin' => $validated['fecha_fin_regimen'],
        ]);

        Obligacion::create([
            'user_id' => $user->id,
            'ID_descripcion_obligacion' => $validated['ID_descripcion_obligacion'],
            'ID_obligacion_vencimiento' => $validated['ID_obligacion_vencimiento'],
            'fecha_inicio' => $validated['fecha_inicio_operaciones'],
            'fecha_fin' => $validated['fecha_fin_obligacion'],
        ]);

        DB::commit();
    } catch (\Exception$e) {
        DB::rollBack();
        // Puedes usar dd($e->getMessage()) para depurar o log::error para guardar el mensaje en un archivo de logdd($e->getMessage());
    }
}


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
    
        return view('usuarios.editar', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'nullable|min:6|confirmed',
            'CURP' => 'required|string|size:18|unique:users,CURP,'.$id,
            'primer_apellido' => 'required|string|max:45',
            'segundo_apellido' => 'nullable|string|max:45',
            'fecha_inicio_operaciones' => 'required|date',
            'estatus_padron' => 'required|string|max:45',
            'fecha_ultimo_cambio_estado' => 'nullable|date',
            'nombre_comercial' => 'nullable|string|max:45',
            'codigo postal' => 'nullable|string|max:10',
            'nombre_vialidad' => 'nullable|string|max:255',
            'numero_interior' => 'nullable|string|max:45',
            'nombre_localidad' => 'nullable|string|max:255',
            'nombre_entidad_federativa' => 'nullable|string|max:255',
            'tipo_vialidad' => 'nullable|string|max:255',
            'numero_exterior' => 'nullable|string|max:45',
            'nombre_colonia' => 'nullable|string|max:255',
            'nombre_municipio' => 'nullable|string|max:255',
            'entre_calle' => 'nullable|string|max:255',
            'y_calle' => 'nullable|string|max:255',
            'actividad_economica' => 'nullable|string|max:255',
            'porcentaje' => 'nullable|numeric|min:0|max:100',
            'fecha_inicio_actividad' => 'nullable|date',
            'fecha_fin_actividad' => 'nullable|date',
            'regimen' => 'nullable|string|max:255',
            'fecha_inicio_regimen' => 'nullable|date',
            'fecha_fin_regimen' => 'nullable|date',
            'descripcion_obligacion' => 'nullable|string|max:255',
            'obligacion_vencimiento' => 'nullable|string|max:255',
            'fecha_inicio_operaciones' => 'nullable|date',
            'fecha_fin_obligacion' => 'nullable|date',
            'roles' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->CURP = $request->input('CURP');
        $user->PrimerApellido = $request->input('PrimerApellido');
        $user->SegundoApellido = $request->input('SegundoApellido');
        $user->FachadeIDeOp = $request->input('FachadeIDeOp');
        $user->EstatusDelPadron = $request->input('EstatusDelPadron');
        $user->FechaDeEstado = $request->input('FechaDeEstado');
        $user->NombreComercial = $request->input('NombreComercial');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();
        $user->roles()->sync($request->input('roles'));

        // Actualizar datos de identificación del contribuyente
        $identificacion = DatoIdentificacionContribuyente::where('user_id', $id)->first();
        $identificacion->update([
            'CURP' => $request->input('CURP'),
            'nombres' => $request->input('name'),
            'primer_apellido' => $request->input('PrimerApellido'),
            'segundo_apellido' => $request->input('SegundoApellido'),
            'fecha_inicio_operaciones' => $request->input('FachadeIDeOp'),
            'estatus_en_el_padron' => $request->input('EstatusDelPadron'),
            'fecha_ultimo_cambio_estado' => $request->input('FechaDeEstado'),
            'nombre_comercial' => $request->input('NombreComercial'),
        ]);

        // Actualizar datos del domicilio registrado
        $domicilio = DomicilioRegistrado::where('user_id', $id)->first();
        $domicilio->update([
            'codigo_postal' => $request->input('cp'),
            'nombre_vialidad' => $request->input('nombre_vialidad'),
            'numero_interior' => $request->input('num_interior'),
            'nombre_localidad' => $request->input('nombre_localidad'),
            'nombre_entidad_federativa' => $request->input('nombre_entidad_federativa'),
            'tipo_vialidad' => $request->input('tipo_vialidad'),
            'numero_exterior' => $request->input('numero_exterior'),
            'nombre_colonia' => $request->input('nombre_colonia'),
            'nombre_municipio' => $request->input('nombre_municipio'),
            'entre_calle' => $request->input('entre_calle'),
            'y_calle' => $request->input('y_calle'),
        ]);

        // Actualizar actividad económica
        $actividad = ActividadEconomica::where('user_id', $id)->first();
        $actividad->update([
            'actividad_economica' => $request->input('actividad_economica'),
            'porcentaje' => $request->input('porcentaje'),
            'fecha_inicio' => $request->input('fecha_inicio_actividad'),
            'fecha_fin' => $request->input('fecha_fin_actividad'),
        ]);

        // Actualizar régimen
        $regimen = Regimen::where('user_id', $id)->first();
        $regimen->update([
            'regimen' => $request->input('regimen'),
            'fecha_inicio' => $request->input('fecha_inicio_regimen'),
            'fecha_fin' => $request->input('fecha_fin_regimen'),
        ]);

        // Actualizar obligaciones
        $obligacion = Obligacion::where('user_id', $id)->first();
        $obligacion->update([
            'descripcion_obligacion' => $request->input('descripcion_obligacion'),
            'obligacion_vencimiento' => $request->input('obligacion_vencimiento'),
            'fecha_inicio' => $request->input('fecha_inicio_operaciones'),
            'fecha_fin' => $request->input('fecha_fin_obligacion'),
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios.index');
    }
}
