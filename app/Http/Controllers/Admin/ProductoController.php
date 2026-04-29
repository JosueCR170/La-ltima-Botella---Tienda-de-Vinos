<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Monarobase\CountryList\CountryList;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::with(['categoria.padre', 'marca']);

        // Búsqueda por nombre o descripción
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('nombre', 'like', $searchTerm)
                  ->orWhere('descripcion', 'like', $searchTerm);
            });
        }

        // Filtro por categoría
        if ($request->has('categoria') && !empty($request->categoria)) {
            $query->where('id_categoria', $request->categoria);
        }

        // Filtro por marca
        if ($request->has('marca') && !empty($request->marca)) {
            $query->where('id_marca', $request->marca);
        }

        // Filtro por país
        if ($request->has('pais') && !empty($request->pais)) {
            $query->where('pais', $request->pais);
        }

        // Ordenamiento
        $sort = $request->get('sort', 'id_producto');
        $direction = $request->get('direction', 'desc');

        if ($sort === 'categoria') {
            $query->join('categorias', 'productos.id_categoria', '=', 'categorias.id_categoria')
                  ->orderBy('categorias.nombre', $direction)
                  ->select('productos.*');
        } elseif ($sort === 'marca') {
            $query->join('marcas', 'productos.id_marca', '=', 'marcas.id_marca')
                  ->orderBy('marcas.nombre', $direction)
                  ->select('productos.*');
        } else {
            // Validar que la columna existe para evitar errores SQL
            $allowedSorts = ['nombre', 'cantidad', 'precio', 'estado', 'id_producto', 'created_at'];
            if (in_array($sort, $allowedSorts)) {
                $query->orderBy($sort, $direction);
            } else {
                $query->orderBy('id_producto', 'desc');
            }
        }

        $productos = $query->paginate(10)->withQueryString();
        
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $countries = new CountryList();
        $paises = $countries->getList('es');

        return view('admin.productos.index', compact('productos', 'categorias', 'marcas', 'paises'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $countries = new CountryList();
        $paises = $countries->getList('es');
        return view('admin.productos.create', compact('categorias', 'marcas', 'paises'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:200',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'alcohol_porcentaje' => 'nullable|numeric|min:0|max:100',
            'contenido_ml' => 'nullable|integer|min:0',
            'anio_cosecha' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'imagen_url' => 'nullable|url|max:500',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 200 caracteres.',
            'id_categoria.required' => 'Debe seleccionar una categoría.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',
            'id_marca.required' => 'Debe seleccionar una marca.',
            'id_marca.exists' => 'La marca seleccionada no existe.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.min' => 'El precio no puede ser negativo.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede superar el 100%.',
            'alcohol_porcentaje.min' => 'El porcentaje de alcohol no puede ser negativo.',
            'alcohol_porcentaje.max' => 'El porcentaje de alcohol no puede superar 100%.',
            'anio_cosecha.min' => 'El año de cosecha no es válido.',
            'anio_cosecha.max' => 'El año de cosecha no puede ser futuro.',
            'imagen_url.url' => 'La URL de imagen debe ser una dirección web válida.',
        ]);

        try {
            $data = $request->all();
            $data['estado'] = $request->has('estado') ? 1 : 0;
            
            Producto::create($data);
            return redirect()->route('admin.productos.index')->with('success', 'Producto creado con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al guardar el producto en la base de datos. Verifique que los datos sean correctos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al crear el producto. Intente nuevamente.']);
        }
    }

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $marcas = Marca::all();
        $countries = new CountryList();
        $paises = $countries->getList('es');
        return view('admin.productos.edit', compact('producto', 'categorias', 'marcas', 'paises'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre' => 'required|max:200',
            'id_categoria' => 'required|exists:categorias,id_categoria',
            'id_marca' => 'required|exists:marcas,id_marca',
            'precio' => 'required|numeric|min:0',
            'cantidad' => 'nullable|integer|min:0',
            'descuento' => 'nullable|numeric|min:0|max:100',
            'alcohol_porcentaje' => 'nullable|numeric|min:0|max:100',
            'contenido_ml' => 'nullable|integer|min:0',
            'anio_cosecha' => 'nullable|integer|min:1900|max:' . (date('Y') + 1),
            'imagen_url' => 'nullable|url|max:500',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder 200 caracteres.',
            'id_categoria.required' => 'Debe seleccionar una categoría.',
            'id_categoria.exists' => 'La categoría seleccionada no existe.',
            'id_marca.required' => 'Debe seleccionar una marca.',
            'id_marca.exists' => 'La marca seleccionada no existe.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe ser un número válido.',
            'precio.min' => 'El precio no puede ser negativo.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad no puede ser negativa.',
            'descuento.min' => 'El descuento no puede ser negativo.',
            'descuento.max' => 'El descuento no puede superar el 100%.',
            'alcohol_porcentaje.min' => 'El porcentaje de alcohol no puede ser negativo.',
            'alcohol_porcentaje.max' => 'El porcentaje de alcohol no puede superar 100%.',
            'anio_cosecha.min' => 'El año de cosecha no es válido.',
            'anio_cosecha.max' => 'El año de cosecha no puede ser futuro.',
            'imagen_url.url' => 'La URL de imagen debe ser una dirección web válida.',
        ]);

        try {
            $data = $request->all();
            $data['estado'] = $request->has('estado') ? 1 : 0;
            
            $producto->update($data);
            return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado con éxito.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->withErrors(['db_error' => 'Error al actualizar el producto en la base de datos.']);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Ocurrió un error inesperado al actualizar el producto.']);
        }
    }

    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
            return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado con éxito.');
        } catch (QueryException $e) {
            return redirect()->route('admin.productos.index')->withErrors(['error' => 'No se puede eliminar el producto porque tiene registros asociados (ej. carritos de compra).']);
        } catch (\Exception $e) {
            return redirect()->route('admin.productos.index')->withErrors(['error' => 'Ocurrió un error inesperado al eliminar el producto.']);
        }
    }
}
