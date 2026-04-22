<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variedad extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_variedad';

    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo'
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_variedad', 'id_variedad', 'id_producto')
                    ->withPivot('porcentaje');
    }
}
