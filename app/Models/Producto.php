<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'cantidad',
        'id_categoria',
        'id_marca',
        'pais',
        'region',
        'precio',
        'contenido_ml',
        'anio_cosecha',
        'alcohol_porcentaje',
        'imagen_url',
        'descuento',
        'estado'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca');
    }

    public function variedades()
    {
        return $this->belongsToMany(Variedad::class, 'producto_variedad', 'id_producto', 'id_variedad')
                    ->withPivot('porcentaje');
    }

    public function carritos()
    {
        return $this->belongsToMany(Carrito::class, 'carrito_producto', 'id_producto', 'id_carrito')
                    ->withPivot('cantidad', 'precio_unitario');
    }
}
