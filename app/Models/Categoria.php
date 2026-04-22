<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre',
        'nombre_padre',
        'descripcion',
        'nivel'
    ];

    public function padre()
    {
        return $this->belongsTo(Categoria::class, 'nombre_padre');
    }

    public function hijas()
    {
        return $this->hasMany(Categoria::class, 'nombre_padre');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }
}
