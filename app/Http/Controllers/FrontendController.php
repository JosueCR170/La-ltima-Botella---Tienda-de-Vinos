<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Variedad;

class FrontendController extends Controller
{
    public function index()
    {
        // Últimos 6 productos para la portada
        $productosDestacados = Producto::with(['categoria', 'marca'])
            ->where('estado', true)
            ->latest()
            ->take(6)
            ->get();

        // Productos con descuento
        $productosDescuento = Producto::with(['categoria', 'marca'])
            ->where('estado', true)
            ->where('descuento', '>', 0)
            ->take(3)
            ->get();

        return view('frontend.home', compact('productosDestacados', 'productosDescuento'));
    }

    public function catalogo(Request $request)
    {
        $query = Producto::with(['categoria', 'marca', 'variedades'])
            ->where('estado', true);

        // Filtros
        if ($request->filled('buscar')) {
            $query->where('nombre', 'LIKE', '%' . $request->buscar . '%');
        }
        if ($request->filled('categoria')) {
            $query->where('id_categoria', $request->categoria);
        }
        if ($request->filled('marca')) {
            $query->where('id_marca', $request->marca);
        }
        if ($request->filled('variedad')) {
            $query->whereHas('variedades', function ($q) use ($request) {
                $q->where('variedades.id_variedad', $request->variedad);
            });
        }
        if ($request->filled('pais')) {
            $query->where('pais', $request->pais);
        }
        if ($request->has('solo_descuentos')) {
            $query->where('descuento', '>', 0);
        }
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }

        // Ordenamiento
        $orden = $request->get('orden', 'newest');
        match ($orden) {
            'precio_asc'  => $query->orderBy('precio', 'asc'),
            'precio_desc' => $query->orderBy('precio', 'desc'),
            'nombre'      => $query->orderBy('nombre', 'asc'),
            default       => $query->latest(),
        };

        $productos  = $query->paginate(12)->withQueryString();
        $categorias = Categoria::all();
        $marcas     = Marca::all();
        $variedades = Variedad::all();
        $paises     = Producto::where('estado', true)
                        ->whereNotNull('pais')
                        ->distinct()
                        ->orderBy('pais')
                        ->pluck('pais');

        return view('frontend.catalogo', compact('productos', 'categorias', 'marcas', 'variedades', 'paises'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'marca', 'variedades'])->findOrFail($id);

        // Productos relacionados (misma categoría, excluyendo el actual)
        $relacionados = Producto::with(['categoria', 'marca'])
            ->where('id_categoria', $producto->id_categoria)
            ->where('id_producto', '!=', $id)
            ->where('estado', true)
            ->take(3)
            ->get();

        return view('frontend.producto', compact('producto', 'relacionados'));
    }

    public function agregarCarrito(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        
        if($producto->cantidad <= 0) {
            return response()->json(['success' => false, 'mensaje' => 'Lo sentimos, este producto está agotado.'], 400);
        }

        $carrito = session()->get('carrito', []);

        if(isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                "id_producto" => $producto->id_producto,
                "nombre" => $producto->nombre,
                "cantidad" => 1,
                "precio" => $producto->precio * (1 - $producto->descuento/100),
                "imagen" => $producto->imagen_url
            ];
        }

        session()->put('carrito', $carrito);
        return response()->json(['success' => true, 'mensaje' => 'Producto agregado al carrito', 'count' => count($carrito)]);
    }

    public function carrito()
    {
        $carrito = session()->get('carrito', []);
        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }
        return view('frontend.carrito', compact('carrito', 'total'));
    }

    public function eliminarCarrito($id)
    {
        $carrito = session()->get('carrito', []);
        if(isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }
        return redirect()->back()->with('success', 'Producto eliminado');
    }

    public function actualizarCarrito(Request $request, $id)
    {
        $carrito = session()->get('carrito', []);
        $producto = Producto::find($id);

        if(isset($carrito[$id]) && $producto) {
            if($request->accion == 'incrementar') {
                if($carrito[$id]['cantidad'] < $producto->cantidad) {
                    $carrito[$id]['cantidad']++;
                } else {
                    return redirect()->back()->with('error', 'No hay más unidades disponibles de este producto.');
                }
            } elseif($request->accion == 'decrementar' && $carrito[$id]['cantidad'] > 1) {
                $carrito[$id]['cantidad']--;
            }
            session()->put('carrito', $carrito);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        if(count($carrito) == 0) return redirect()->route('carrito.index');

        $total = 0;
        foreach($carrito as $item) {
            $total += $item['precio'] * $item['cantidad'];
        }

        return view('frontend.checkout', compact('carrito', 'total'));
    }

    public function procesarPago()
    {
        $carrito = session()->get('carrito', []);
        if(count($carrito) == 0) return redirect()->route('home');

        foreach($carrito as $id => $item) {
            $producto = Producto::find($id);
            if($producto) {
                $producto->cantidad -= $item['cantidad'];
                if($producto->cantidad < 0) $producto->cantidad = 0;
                $producto->save();
            }
        }

        session()->forget('carrito');
        return redirect()->route('home')->with('success', '¡Gracias por su compra! El pedido ha sido procesado correctamente.');
    }
}
