<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'rfc_emisor',
        'nombre_emisor',
        'folio',
        'rfc_receptor',
        'nombre_receptor',
        'codigo_postal_receptor',
        'regimen_fiscal',
        'uso_cfdi',
        'serie_fiscal',
        'serie_csd',
        'fecha_emision',
        'tipo_efecto',
        'regimen_fiscal_receptor',
        'exportacion',
        'codigo_producto',
        'cantidad',
        'clave_unidad',
        'precio_unitario',
        'importe',
        'impuesto',
        'retencion_impuesto',
        'total',
        'moneda',
        'metodo_pago',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_emision' => 'datetime',
        'precio_unitario' => 'decimal:2',
        'importe' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'retencion_impuesto' => 'decimal:2',
        'total' => 'decimal:2',
    ];

    /**
     * Relación con el modelo de Usuario (Emisor).
     * Si necesitas conectar la factura con un usuario emisor, puedes definir esta relación.
     */
    public function emisor()
    {
        return $this->belongsTo(User::class, 'rfc_emisor', 'rfc');
    }

    /**
     * Relación con el modelo de Usuario (Receptor).
     * Si decides conectar la factura con un usuario receptor, puedes definir esta relación.
     */
    public function receptor()
    {
        return $this->belongsTo(User::class, 'rfc_receptor', 'rfc');
    }
}
