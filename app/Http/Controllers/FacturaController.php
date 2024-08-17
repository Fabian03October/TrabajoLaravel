<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class FacturaController extends Controller
{
    public function index()
    {
        $facturas = Factura::all();
        return view('facturas.index', compact('facturas'));
    }

    

public function generateXML($id)
{
    // Buscar la factura por ID
    $factura = Factura::findOrFail($id);

    // Crear un nuevo documento XML
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><factura></factura>');

    // Añadir elementos al XML
    $xml->addChild('id', $factura->id);
    $xml->addChild('rfc_emisor', $factura->rfc_emisor);
    $xml->addChild('nombre_emisor', $factura->nombre_emisor);
    $xml->addChild('rfc_receptor', $factura->rfc_receptor);
    $xml->addChild('nombre_receptor', $factura->nombre_receptor);
    $xml->addChild('fecha_emision', $factura->fecha_emision);
    $xml->addChild('total', $factura->total);

    // Puedes añadir más campos según la estructura de tu factura

    // Convertir el XML a string
    $xmlString = $xml->asXML();

    // Crear una respuesta con el contenido XML
    $response = new Response($xmlString);
    $response->header('Content-Type', 'text/xml');

    // Opcional: si quieres que se descargue como archivo
    $response->header('Content-Disposition', 'attachment; filename="factura_' . $factura->id . '.xml"');

    return $response;
}
    
 
    public function pdf($id)
{
    $factura = Factura::findOrFail($id); // Busca la factura por su ID
    $pdf = Pdf::loadView('facturas.pdf', compact('factura')); // Pasa la factura específica a la vista
    return $pdf->stream();
}




    public function create()
    {
        return view('facturas.create');
    }

    public function store(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'rfc_receptor' => 'required|string|max:255',
        'nombre_receptor' => 'required|string|max:255',
        'regimen_fiscal' => 'required|string|max:255',
        'uso_cfdi' => 'required|string|max:255',
        'serie_csd' => 'required|string|max:255',
        'tipo_efecto' => 'required|string|max:255',
        'regimen_fiscal_receptor' => 'required|string|max:255',
        'exportacion' => 'required|string|max:255',
        'codigo_producto' => 'required|string|max:255',
        'cantidad' => 'required|integer',
        'clave_unidad' => 'required|string|max:255',
        'precio_unitario' => 'required|numeric',
        'importe' => 'required|numeric',
        'impuesto' => 'required|numeric',
        'retencion_impuesto' => 'required|numeric',
        'total' => 'required|numeric',
        'moneda' => 'required|string|max:255',
        'metodo_pago' => 'required|string|max:255',
    ]);

    // Crear una nueva instancia de Factura
    $factura = new Factura($request->all());

    // Asignar automáticamente el RFC y nombre del emisor usando el usuario autenticado
    $factura->rfc_emisor = Auth::user()->rfc;
    $factura->nombre_emisor = Auth::user()->name;

    // Generar automáticamente el folio, serie fiscal, código postal, y fecha de emisión
    $factura->folio = $this->generateFolio();
    $factura->serie_fiscal = $this->generateSerieFiscal();
    $factura->codigo_postal_receptor = $this->generateCodigoPostal();
    $factura->fecha_emision = now();

    // Guardar la factura en la base de datos
    $factura->save();

    // Redirigir a la lista de facturas con un mensaje de éxito
    return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
}


    public function show(Factura $factura)
    {
        return view('facturas.show', compact('factura'));
    }

    public function edit(Factura $factura)
    {
        return view('facturas.edit', compact('factura'));
    }

    public function update(Request $request, Factura $factura)
    {
        $request->validate([
            'rfc_emisor' => 'nullable|string|max:255',
            'nombre_emisor' => 'nullable|string|max:255',
            'rfc_receptor' => 'required|string|max:255',
            'nombre_receptor' => 'required|string|max:255',
            'regimen_fiscal' => 'required|string|max:255',
            'uso_cfdi' => 'required|string|max:255',
            'serie_csd' => 'required|string|max:255',
            'tipo_efecto' => 'required|string|max:255',
            'regimen_fiscal_receptor' => 'required|string|max:255',
            'exportacion' => 'required|string|max:255',
            'codigo_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'clave_unidad' => 'required|string|max:255',
            'precio_unitario' => 'required|numeric',
            'importe' => 'required|numeric',
            'impuesto' => 'required|numeric',
            'retencion_impuesto' => 'required|numeric',
            'total' => 'required|numeric',
            'moneda' => 'required|string|max:255',
            'metodo_pago' => 'required|string|max:255',
        ]);

        $factura->update($request->all());

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    public function destroy(Factura $factura)
    {
        $factura->delete();
        return redirect()->route('facturas.index')->with('success', 'Factura eliminada exitosamente.');
    }

    private function generateFolio()
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
    }

    private function generateSerieFiscal()
    {
        return chr(rand(65, 90)); // Genera una letra aleatoria (A-Z)
    }

    private function generateCodigoPostal()
    {
        return rand(10000, 99999); // Genera un código postal aleatorio
    }
}
