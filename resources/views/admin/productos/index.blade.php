@extends('layouts.admin')

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Inventario de Cava</h1>
            <p>Gestiona la selección editorial de licores finos y vinos de cosecha.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.productos.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nuevo Producto</span>
            </a>
        </div>
    </header>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Categoría / Marca</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-img-wrapper">
                                @if($producto->imagen_url)
                                    <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}">
                                @else
                                    <span class="material-symbols-outlined" style="opacity: 0.3;">wine_bar</span>
                                @endif
                            </div>
                            <div class="product-name-info">
                                <span class="product-name">{{ $producto->nombre }}</span>
                                <span class="product-meta">
                                    {{ $producto->pais ?? 'N/A' }} • {{ $producto->contenido_ml ? $producto->contenido_ml . 'ml' : 'N/A' }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="category-cell">
                            <span class="category-name">{{ $producto->categoria ? $producto->categoria->nombre : 'Sin Categoría' }}</span>
                            <span class="brand-name-sm">{{ $producto->marca ? $producto->marca->nombre : 'Sin Marca' }}</span>
                        </div>
                    </td>
                    <td>
                        @if($producto->cantidad <= 10)
                            <span class="stock-count stock-low">{{ $producto->cantidad }} Unidades</span>
                        @else
                            <span class="stock-count stock-normal">{{ $producto->cantidad }} Unidades</span>
                        @endif
                    </td>
                    <td>
                        <span class="price-text">₡{{ number_format($producto->precio, 2) }}</span>
                    </td>
                    <td>
                        @if($producto->estado)
                            <span class="badge badge-success">Activo</span>
                        @else
                            <span class="badge badge-error">Inactivo</span>
                        @endif
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.productos.edit', $producto->id_producto) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            <form action="{{ route('admin.productos.destroy', $producto->id_producto) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este producto?')">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 3rem; color: rgba(27, 29, 14, 0.4);">
                        No se encontraron productos en la colección.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        <div class="pagination-info">
            Mostrando <strong>{{ $productos->firstItem() ?? 0 }}</strong> a <strong>{{ $productos->lastItem() ?? 0 }}</strong> de <strong>{{ $productos->total() }}</strong> productos
        </div>
        <div class="pagination-controls">
            @if ($productos->onFirstPage())
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $productos->previousPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            @foreach ($productos->getUrlRange(max(1, $productos->currentPage() - 2), min($productos->lastPage(), $productos->currentPage() + 2)) as $page => $url)
                @if ($page == $productos->currentPage())
                    <span class="page-current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach

            @if ($productos->hasMorePages())
                <a href="{{ $productos->nextPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_right</span>
                </a>
            @else
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_right</span>
                </span>
            @endif
        </div>
    </div>
</div>
@endsection
