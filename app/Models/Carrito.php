<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_carrito';

    protected $fillable = [
        'id_usuario',
        'estado'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'carrito_producto', 'id_carrito', 'id_producto')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
