@extends('layouts.admin')

@section('content')
<div class="flex flex-col space-y-8">
    <header class="flex items-center justify-between">
        <div class="flex flex-col">
            <h1 class="font-headline text-3xl font-bold text-primary tracking-tight">Inventario de Cava</h1>
            <p class="font-body text-on-surface-variant text-sm mt-1">Gestiona la selección editorial de licores finos y vinos de cosecha.</p>
        </div>
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.productos.create') }}" class="bg-primary text-on-primary py-2.5 px-6 rounded-md font-body text-sm font-bold hover:bg-primary-container transition-colors shadow-sm flex items-center space-x-2">
                <span class="material-symbols-outlined text-lg">add</span>
                <span>Nuevo Producto</span>
            </a>
        </div>
    </header>

    <div class="bg-surface-container-low rounded-xl overflow-hidden border border-outline-variant/10">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-high/50 border-b border-outline-variant/5">
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold">Producto</th>
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold">Categoría / Marca</th>
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold">Stock</th>
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold">Precio</th>
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold">Estado</th>
                        <th class="px-6 py-5 font-label text-[0.7rem] uppercase tracking-[0.15em] text-on-surface/60 font-bold text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/5">
                    @forelse($productos as $producto)
                    <tr class="hover:bg-surface-container-highest/30 transition-colors">
                        <td class="px-6 py-5">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-white rounded-md overflow-hidden flex-shrink-0 flex items-center justify-center p-1 border border-outline-variant/10">
                                    @if($producto->imagen_url)
                                        <img class="w-full h-full object-contain" src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                                    @else
                                        <span class="material-symbols-outlined text-on-surface-variant/30">wine_bar</span>
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline font-bold text-primary text-base">{{ $producto->nombre }}</span>
                                    <span class="font-label text-[0.65rem] text-on-surface-variant">
                                        {{ $producto->pais ?? 'N/A' }} • {{ $producto->contenido_ml ? $producto->contenido_ml . 'ml' : 'N/A' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex flex-col">
                                <span class="font-body text-sm text-on-surface font-medium">{{ $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría' }}</span>
                                <span class="font-label text-[0.65rem] text-on-surface-variant">{{ $producto->marca ? $producto->marca->nombre : 'Sin Marca' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-5">
                            @if($producto->cantidad <= 10)
                                <span class="font-body text-sm text-error font-semibold">{{ $producto->cantidad }} Unidades</span>
                            @else
                                <span class="font-body text-sm text-on-surface font-semibold">{{ $producto->cantidad }} Unidades</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 font-body text-sm text-primary font-bold">₡{{ number_format($producto->precio, 2) }}</td>
                        <td class="px-6 py-5">
                            @if($producto->estado)
                                <span class="px-3 py-1 bg-tertiary-fixed text-on-tertiary-fixed text-[0.65rem] font-bold uppercase tracking-widest rounded-full">Activo</span>
                            @else
                                <span class="px-3 py-1 bg-error-container text-on-error-container text-[0.65rem] font-bold uppercase tracking-widest rounded-full">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end space-x-2">
                                <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="p-2 text-on-surface-variant hover:text-primary transition-colors">
                                    <span class="material-symbols-outlined text-lg">edit</span>
                                </a>
                                <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-on-surface-variant hover:text-error transition-colors" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center font-body text-on-surface-variant/60">
                            No se encontraron productos en la colección.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div class="mt-8 flex items-center justify-between">
        <span class="font-label text-xs text-on-surface-variant">
            Mostrando <span class="font-bold">{{ $productos->firstItem() ?? 0 }}</span> a <span class="font-bold">{{ $productos->lastItem() ?? 0 }}</span> de <span class="font-bold">{{ $productos->total() }}</span> productos
        </span>
        <div class="flex space-x-2">
            @if ($productos->onFirstPage())
                <span class="p-2 rounded-md border border-outline-variant/15 text-on-surface-variant/30 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </span>
            @else
                <a href="{{ $productos->previousPageUrl() }}" class="p-2 rounded-md border border-outline-variant/15 hover:bg-surface-container-low transition-colors text-on-surface-variant">
                    <span class="material-symbols-outlined text-lg">chevron_left</span>
                </a>
            @endif

            @foreach ($productos->getUrlRange(max(1, $productos->currentPage() - 2), min($productos->lastPage(), $productos->currentPage() + 2)) as $page => $url)
                @if ($page == $productos->currentPage())
                    <span class="px-4 py-2 rounded-md bg-surface-container-highest font-bold text-xs text-primary">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="px-4 py-2 rounded-md font-bold text-xs text-on-surface-variant hover:bg-surface-container-low transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            @if ($productos->hasMorePages())
                <a href="{{ $productos->nextPageUrl() }}" class="p-2 rounded-md border border-outline-variant/15 hover:bg-surface-container-low transition-colors text-on-surface-variant">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </a>
            @else
                <span class="p-2 rounded-md border border-outline-variant/15 text-on-surface-variant/30 cursor-not-allowed">
                    <span class="material-symbols-outlined text-lg">chevron_right</span>
                </span>
            @endif
        </div>
    </div>
</div>
@endsection
