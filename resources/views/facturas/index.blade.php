@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Lista de Facturas</span>
                        <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-sm">Crear Factura</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>RFC Emisor</th>
                                <th>RFC Receptor</th>
                                <th>Nombre Receptor</th>
                                <th>Fecha Emisión</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facturas as $factura)
                                <tr>
                                    <td>{{ $factura->id }}</td>
                                    <td>{{ $factura->rfc_emisor }}</td>
                                    <td>{{ $factura->rfc_receptor }}</td>
                                    <td>{{ $factura->nombre_receptor }}</td>
                                    <td>{{ $factura->fecha_emision }}</td>
                                    <td>${{ number_format($factura->total, 2) }}</td>
                                    <td>
                                        <a href="{{ route('facturas.pdf', $factura->id) }}" class="btn btn-success">Descargar PDF</a>
                                        <a href="{{ route('facturas.xml', $factura->id) }}" class="btn btn-info">Generar XML</a>
                                        <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta factura?');">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection