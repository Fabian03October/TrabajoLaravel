<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Ingreso</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @page {
            size: landscape;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            position: relative;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 80px;
            color: rgba(0, 0, 0, 0.1);
            white-space: nowrap;
            z-index: 9999;
            pointer-events: none;
        }
        .container {
            margin-top: 20px;
            max-width: 1000px;
            position: relative;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .card {
            border: 1px solid #ddd;
            padding: 15px;
            background: white;
        }
        .row {
            margin-bottom: 10px;
        }
        .col-md-6 {
            margin-bottom: 10px;
        }
        .col-md-12 {
            margin-bottom: 10px;
        }
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .table th, .table td {
            text-align: left;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd !important;
        }
    </style>
</head>
<body>
    <div class="watermark">DOCUMENTO NO OFICIAL</div>
    <div class="container">
        <div class="header">
            <h2>Comprobante de Ingreso</h2>
            <p>Folio Fiscal: {{ $factura->folio }}</p>
        </div>
        <div class="card">
            <div class="section-title">Datos del Emisor</div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Nombre emisor:</strong> {{ $factura->nombre_emisor }}
                </div>
                <div class="col-md-6">
                    <strong>RFC emisor:</strong> {{ $factura->rfc_emisor }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Fecha de emisión:</strong> {{ $factura->fecha_emision }}
                </div>
                <div class="col-md-6">
                    <strong>Régimen fiscal:</strong> {{ $factura->regimen_fiscal }}
                </div>
            </div>

            <div class="section-title">Datos del Receptor</div>
            <div class="row">
                <div class="col-md-6">
                    <strong>RFC receptor:</strong> {{ $factura->rfc_receptor }}
                </div>
                <div class="col-md-6">
                    <strong>Nombre receptor:</strong> {{ $factura->nombre_receptor }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Código postal receptor:</strong> {{ $factura->codigo_postal_receptor }}
                </div>
                <div class="col-md-6">
                    <strong>Régimen fiscal receptor:</strong> {{ $factura->regimen_fiscal_receptor }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Uso CFDI:</strong> {{ $factura->uso_cfdi }}
                </div>
                <div class="col-md-6">
                    <strong>Efecto de comprobante:</strong> {{ $factura->tipo_efecto }}
                </div>
            </div>

            <div class="section-title">Conceptos</div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Clave del producto y/o servicio</th>
                        <th>No. identificación</th>
                        <th>Cantidad</th>
                        <th>Clave de unidad</th>
                        <th>Unidad</th>
                        <th>Valor unitario</th>
                        <th>Importe</th>
                        <th>Descuento</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $factura->codigo_producto }}</td>
                        <td>{{ $factura->cantidad }}</td>
                        <td>{{ $factura->clave_unidad }}</td>
                        <td>Unidad de servicio</td>
                        <td>{{ $factura->precio_unitario }}</td>
                        <td>{{ $factura->importe }}</td>
                        <td>No aplica</td>
                    </tr>
                </tbody>
            </table>

            <div class="section-title">Impuestos</div>
            <div class="row">
                <div class="col-md-6">
                    <strong>IVA Traslado:</strong> {{ $factura->impuesto }}
                </div>
                <div class="col-md-6">
                    <strong>ISR Retención:</strong> {{ $factura->retencion_impuesto }}
                </div>
            </div>

            <div class="section-title">Totales</div>
            <div class="row">
                <div class="col-md-6">
                    <strong>Subtotal:</strong> ${{ $factura->importe }}
                </div>
                <div class="col-md-6">
                    <strong>Total:</strong> ${{ $factura->total }}
                </div>
            </div>
        </div>
        <div class="footer">
            <small>Este documento es una representación impresa de un CFDI</small>
        </div>
    </div>
</body>
</html>
