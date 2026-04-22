<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_marca';

    protected $fillable = [
        'nombre',
        'descripcion',
        'pais',
        'sitio_web'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_marca');
    }
}
