<?php
namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class BeneficioProductos extends Model{
    protected $table = 'beneficio_productos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'beneficio_id',
        'producto_id',
        'tipo_asociacion',
    ];
}