@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Usuario</h1>

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="CURP">CURP:</label>
            <input type="text" class="form-control" id="CURP" name="CURP" value="{{ old('CURP') }}" required>
            @error('CURP')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="primer_apellido">Primer Apellido:</label>
            <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="{{ old('primer_apellido') }}" required>
            @error('primer_apellido')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="segundo_apellido">Segundo Apellido:</label>
            <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="{{ old('segundo_apellido') }}">
        </div>

        <div class="form-group">
            <label for="fecha_inicio_operaciones">Fecha de Inicio de Operaciones:</label>
            <input type="date" class="form-control" id="fecha_inicio_operaciones" name="fecha_inicio_operaciones" value="{{ old('fecha_inicio_operaciones') }}">
        </div>

        <div class="form-group">
            <label for="estatus_padron">Estatus en el Padrón:</label>
            <input type="text" class="form-control" id="estatus_padron" name="estatus_padron" value="{{ old('estatus_padron') }}">
        </div>

        <div class="form-group">
            <label for="fecha_ultimo_cambio_estado">Fecha del Último Cambio de Estado:</label>
            <input type="date" class="form-control" id="fecha_ultimo_cambio_estado" name="fecha_ultimo_cambio_estado" value="{{ old('fecha_ultimo_cambio_estado') }}">
        </div>

        <div class="form-group">
            <label for="nombre_comercial">Nombre Comercial:</label>
            <input type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" value="{{ old('nombre_comercial') }}">
        </div>

        <!-- Parte del formulario para el domicilio -->
<h2>Domicilio Registrado</h2>

<div class="form-group">
    <label for="codigo_postal">Código Postal:</label>
    <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal') }}">
</div>

<div class="form-group">
    <label for="nombre_vialidad">Nombre de la Vialidad:</label>
    <input type="text" class="form-control" id="nombre_vialidad" name="nombre_vialidad" value="{{ old('nombre_vialidad') }}">
</div>

<div class="form-group">
    <label for="num_interior">Número Interior:</label>
    <input type="text" name="numero_interior" value="{{ old('numero_interior') }}">
</div>

<div class="form-group">
    <label for="nombre_localidad">Nombre de la Localidad:</label>
    <input type="text" class="form-control" id="nombre_localidad" name="nombre_localidad" value="{{ old('nombre_localidad') }}">
</div>

<div class="form-group">
    <label for="nombre_entidad_federativa">Nombre de la Entidad Federativa:</label>
    <input type="text" class="form-control" id="nombre_entidad_federativa" name="nombre_entidad_federativa" value="{{ old('nombre_entidad_federativa') }}">
</div>

<div class="form-group">
    <label for="tipo_vialidad">Tipo de Vialidad:</label>
    <input type="text" class="form-control" id="tipo_vialidad" name="tipo_vialidad" value="{{ old('tipo_vialidad') }}">
</div>

<div class="form-group">
    <label for="numero_exterior">Número Exterior:</label>
    <input type="text" class="form-control" id="numero_exterior" name="numero_exterior" value="{{ old('numero_exterior') }}">
</div>

<div class="form-group">
    <label for="nombre_colonia">Nombre de la Colonia:</label>
    <input type="text" class="form-control" id="nombre_colonia" name="nombre_colonia" value="{{ old('nombre_colonia') }}">
</div>

<div class="form-group">
    <label for="nombre_municipio">Nombre del Municipio:</label>
    <input type="text" class="form-control" id="nombre_municipio" name="nombre_municipio" value="{{ old('nombre_municipio') }}">
</div>

<div class="form-group">
    <label for="entre_calle">Entre Calle:</label>
    <input type="text" class="form-control" id="entre_calle" name="entre_calle" value="{{ old('entre_calle') }}">
</div>

<div class="form-group">
    <label for="y_calle">Y Calle:</label>
    <input type="text" class="form-control" id="y_calle" name="y_calle" value="{{ old('y_calle') }}">
</div>


        <h2>Actividad Económica</h2>

        <div class="col-md-5">
    <div class="form-group">
        <label style="color: black; font-weight: bold;" for="actividades_id">Actividad Económica: <span class="required text-danger">*</span></label>
        <select id="actividades_id" name="actividades_id" class="form-control custom-select" required>
            <option disabled selected>Selecciona una actividad económica</option>
            @foreach(\App\Models\ActividadesEconomicas::get() as $actividad)
                <option value="{{ $actividad->Id_actividad_economica }}">{{ $actividad->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>



        <div class="form-group">
            <label for="porcentaje">Porcentaje:</label>
            <input type="number" class="form-control" id="porcentaje" name="porcentaje" value="{{ old('porcentaje') }}" min="0" max="100">
        </div>

        <div class="form-group">
            <label for="fecha_inicio_actividad">Fecha de Inicio de Actividad:</label>
            <input type="date" class="form-control" id="fecha_inicio_actividad" name="fecha_inicio_actividad" value="{{ old('fecha_inicio_actividad') }}">
        </div>

        <div class="form-group">
            <label for="fecha_fin_actividad">Fecha de Fin de Actividad:</label>
            <input type="date" class="form-control" id="fecha_fin_actividad" name="fecha_fin_actividad" value="{{ old('fecha_fin_actividad') }}">
        </div>

        <h2>Régimen</h2>

        <div class="col-md-5">
    <div class="form-group">
        <label style="color: black; font-weight: bold;" for="regimen_id">Régimen: <span class="required text-danger">*</span></label>
        <select id="regimen_id" name="regimen_id" class="form-control custom-select" required>
            <option disabled selected>Selecciona un régimen</option>
            @foreach(\App\Models\Regimenes::get() as $regimen)
                <option value="{{ $regimen->IdRegimenes }}">{{ $regimen->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>


        <div class="form-group">
            <label for="fecha_inicio_regimen">Fecha de Inicio de Régimen:</label>
            <input type="date" class="form-control" id="fecha_inicio_regimen" name="fecha_inicio_regimen" value="{{ old('fecha_inicio_regimen') }}">
        </div>

        <div class="form-group">
            <label for="fecha_fin_regimen">Fecha de Fin de Régimen:</label>
            <input type="date" class="form-control" id="fecha_fin_regimen" name="fecha_fin_regimen" value="{{ old('fecha_fin_regimen') }}">
        </div>

        <h2>Obligaciones</h2>

        <div class="col-md-5">
    <div class="form-group">
        <label style="color: black; font-weight: bold;" for="descripcion_obligacion_id">Descripción de la Obligación: <span class="required text-danger">*</span></label>
        <select id="descripcion_obligacion_id" name="descripcion_obligacion_id" class="form-control custom-select" required>
            <option disabled selected>Selecciona una descripción</option>
            @foreach(\App\Models\DescripcionObligacion::get() as $descripcion)
                <option value="{{ $descripcion->ID_descripcion_obligacion }}" @if(old('descripcion_obligacion_id') == $descripcion->ID_descripcion_obligacion) selected @endif>{{ $descripcion->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-md-5">
    <div class="form-group">
        <label style="color: black; font-weight: bold;" for="obligacion_vencimiento_id">Vencimiento de la Obligación: <span class="required text-danger">*</span></label>
        <select id="obligacion_vencimiento_id" name="obligacion_vencimiento_id" class="form-control custom-select" required>
            <option disabled selected>Selecciona un vencimiento</option>
            @foreach(\App\Models\ObligacionVencimiento::get() as $vencimiento)
                <option value="{{ $vencimiento->ID_obligacion_vencimiento }}" @if(old('obligacion_vencimiento_id') == $vencimiento->ID_obligacion_vencimiento) selected @endif>{{ $vencimiento->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>


        <div class="form-group">
            <label for="fecha_inicio_obligacion">Fecha de Inicio de Obligación:</label>
            <input type="date" class="form-control" id="fecha_inicio_obligacion" name="fecha_inicio_obligacion" value="{{ old('fecha_inicio_obligacion') }}">
        </div>

        <div class="form-group">
            <label for="fecha_fin_obligacion">Fecha de Fin de Obligación:</label>
            <input type="date" class="form-control" id="fecha_fin_obligacion" name="fecha_fin_obligacion" value="{{ old('fecha_fin_obligacion') }}">
        </div>


        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
@endsection