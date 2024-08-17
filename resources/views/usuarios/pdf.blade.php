<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Situación Fiscal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #000;
            position: relative;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            width: 100px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
        }
        .sub-header {
            text-align: center;
            margin-top: 5px;
            margin-bottom: 30px;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
        }
        .content-table {
            width: 80%;
            border-collapse: collapse;
            margin-bottom: 30px;
            margin-left: auto;
            margin-right: auto;
        }
        .content-table th, .content-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 60px;
            color: rgba(200, 200, 200, 0.3);
            z-index: -1;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="watermark">DOCUMENTO NO OFICIAL</div>
    <div class="container">
        <div class="header">
            <img src="logo.png" alt="Logo">
            <h1>SERVICIO DE ADMINISTRACIÓN TRIBUTARIA</h1>
        </div>
        <div class="sub-header">
            <h2>Constancia de Situación Fiscal</h2>
            <p>Fecha de emisión: {{ now()->format('d M Y') }}</p>
        </div>
        
        <div class="section-title">Datos del Contribuyente</div>
        <table class="content-table">
            <tr>
                <th>RFC:</th>
                <td>{{ $usuario->RFC }}</td>
            </tr>
            <tr>
                <th>Nombre:</th>
                <td>{{ $usuario->name }}</td>
            </tr>
            <tr>
                <th>Situación Fiscal:</th>
                <td>Activo</td>
            </tr>
            <tr>
                <th>Regimen Fiscal:</th>
                <td>{{ $usuario->REGIMEN }}</td>
            </tr>
        </table>
        
        <div class="section-title">Domicilio Fiscal</div>
        <table class="content-table">
            <tr>
                <th>Calle:</th>
                <td>{{ $usuario->address }}</td>
            </tr>
            <tr>
                <th>Número Exterior:</th>
                <td>{{ $usuario->numero_exterior ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Colonia:</th>
                <td>{{ $usuario->colonia ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Municipio/Delegación:</th>
                <td>{{ $usuario->municipio ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td>{{ $usuario->estado ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Código Postal:</th>
                <td>{{ $usuario->codigo_postal ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>País:</th>
                <td>México</td>
            </tr>
        </table>
        
        <div class="section-title">Medios de Contacto</div>
        <table class="content-table">
            <tr>
                <th>Teléfono:</th>
                <td>{{ $usuario->phone }}</td>
            </tr>
            <tr>
                <th>Correo Electrónico:</th>
                <td>{{ $usuario->email }}</td>
            </tr>
        </table>
        
        <div class="section-title">Datos Adicionales</div>
        <table class="content-table">
            <tr>
                <th>Fecha de Inscripción:</th>
                <td>{{ $usuario->fecha_inscripcion ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Fecha de Última Actualización:</th>
                <td>{{ now()->format('d/m/Y') }}</td>
            </tr>
        </table>

        <div class="footer">
            <small>IdcGeneraConstancia.jsf</small>
        </div>
    </div>
</body>
</html>