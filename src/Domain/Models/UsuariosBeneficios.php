<?php
namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;

class UsuariosBeneficios extends Model{
    protected $table = 'usuario_beneficios';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'usuario_id',
        'beneficio_id',
        'fecha_asignacion',
    ];
}