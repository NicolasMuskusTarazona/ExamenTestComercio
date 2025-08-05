<?php
namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficiosEstrategias extends Model{
    protected $table = 'beneficios_estrategias';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'tipo',
        'descripcion',
        'porcentaje_descuento',
        'monto_descuento',
        'precio_combo',
        'producto_aplica_id',
        'producto_extra_id',
        'estado'
    ];
}