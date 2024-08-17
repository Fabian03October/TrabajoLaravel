@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Factura</div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('facturas.store') }}" method="POST">
                        @csrf

                        <!-- RFC Emisor (Rellenado automáticamente) -->
                        <div class="form-group">
                            <label for="rfc">RFC Emisor</label>
                            <input type="text" name="rfc" id="rfc" class="form-control" value="{{ Auth::user()->rfc }}" readonly>
                        </div>

                        <!-- Nombre Emisor (Rellenado automáticamente) -->
                        <div class="form-group">
                            <label for="nombre_emisor">Nombre Emisor</label>
                            <input type="text" name="nombre_emisor" id="nombre_emisor" class="form-control" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <!-- RFC Receptor -->
                        <div class="form-group">
                            <label for="rfc_receptor">RFC Receptor</label>
                            <input type="text" name="rfc_receptor" id="rfc_receptor" class="form-control" value="{{ old('rfc_receptor') }}" required>
                        </div>

                        <!-- Nombre Receptor -->
                        <div class="form-group">
                            <label for="nombre_receptor">Nombre Receptor</label>
                            <input type="text" name="nombre_receptor" id="nombre_receptor" class="form-control" value="{{ old('nombre_receptor') }}" required>
                        </div>

                        <!-- Régimen Fiscal -->
                        <div class="form-group">
                            <label for="regimen_fiscal">Régimen Fiscal</label>
                            <input type="text" name="regimen_fiscal" id="regimen_fiscal" class="form-control" value="{{ old('regimen_fiscal') }}" required>
                        </div>

                        <!-- Uso de CFDI -->
                        <div class="form-group">
                            <label for="uso_cfdi">Uso de CFDI</label>
                            <input type="text" name="uso_cfdi" id="uso_cfdi" class="form-control" value="{{ old('uso_cfdi') }}" required>
                        </div>

                        <!-- Serie CSD -->
                        <div class="form-group">
                            <label for="serie_csd">Serie CSD</label>
                            <input type="text" name="serie_csd" id="serie_csd" class="form-control" value="{{ old('serie_csd') }}" required>
                        </div>

                        <!-- Tipo de Efecto -->
                        <div class="form-group">
                            <label for="tipo_efecto">Tipo de Efecto</label>
                            <input type="text" name="tipo_efecto" id="tipo_efecto" class="form-control" value="{{ old('tipo_efecto') }}" required>
                        </div>

                        <!-- Régimen Fiscal Receptor -->
                        <div class="form-group">
                            <label for="regimen_fiscal_receptor">Régimen Fiscal Receptor</label>
                            <input type="text" name="regimen_fiscal_receptor" id="regimen_fiscal_receptor" class="form-control" value="{{ old('regimen_fiscal_receptor') }}" required>
                        </div>

                        <!-- Exportación -->
                        <div class="form-group">
                            <label for="exportacion">Exportación</label>
                            <input type="text" name="exportacion" id="exportacion" class="form-control" value="{{ old('exportacion') }}" required>
                        </div>

                        <!-- Código de Producto -->
                        <div class="form-group">
                            <label for="codigo_producto">Código de Producto</label>
                            <input type="text" name="codigo_producto" id="codigo_producto" class="form-control" value="{{ old('codigo_producto') }}" required>
                        </div>

                        <!-- Cantidad -->
                        <div class="form-group">
                            <label for="cantidad">Cantidad</label>
                            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad') }}" required>
                        </div>

                        <!-- Clave Unidad -->
                        <div class="form-group">
                            <label for="clave_unidad">Clave Unidad</label>
                            <input type="text" name="clave_unidad" id="clave_unidad" class="form-control" value="{{ old('clave_unidad') }}" required>
                        </div>

                        <!-- Precio Unitario -->
                        <div class="form-group">
                            <label for="precio_unitario">Precio Unitario</label>
                            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control" value="{{ old('precio_unitario') }}" required>
                        </div>

                        <!-- Importe -->
                        <div class="form-group">
                            <label for="importe">Importe</label>
                            <input type="number" step="0.01" name="importe" id="importe" class="form-control" value="{{ old('importe') }}" required>
                        </div>

                        <!-- Impuesto -->
                        <div class="form-group">
                            <label for="impuesto">Impuesto</label>
                            <input type="number" step="0.01" name="impuesto" id="impuesto" class="form-control" value="{{ old('impuesto') }}" required>
                        </div>

                        <!-- Retención de Impuesto -->
                        <div class="form-group">
                            <label for="retencion_impuesto">Retención de Impuesto</label>
                            <input type="number" step="0.01" name="retencion_impuesto" id="retencion_impuesto" class="form-control" value="{{ old('retencion_impuesto') }}" required>
                        </div>

                        <!-- Total -->
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ old('total') }}" required>
                        </div>

                        <!-- Moneda -->
                        <div class="form-group">
                            <label for="moneda">Moneda</label>
                            <input type="text" name="moneda" id="moneda" class="form-control" value="{{ old('moneda') }}" required>
                        </div>

                        <!-- Método de Pago -->
                        <div class="form-group">
                            <label for="metodo_pago">Método de Pago</label>
                            <input type="text" name="metodo_pago" id="metodo_pago" class="form-control" value="{{ old('metodo_pago') }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Crear Factura</button>
                        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
