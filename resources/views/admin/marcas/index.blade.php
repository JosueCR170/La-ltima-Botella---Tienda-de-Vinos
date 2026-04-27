@extends('layouts.admin')


@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Casas y Bodegas</h1>
            <p>Gestiona los productores y casas vinícolas que dan vida a la colección.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.marcas.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nueva Bodega</span>
            </a>
        </div>
    </header>

    <!-- Barra de Filtros -->
    <form action="{{ route('admin.marcas.index') }}" method="GET" class="filter-bar">
        <div class="filter-group">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input type="text" name="search" class="filter-input" placeholder="Buscar por nombre o descripción..." value="{{ request('search') }}">
        </div>

        <div class="filter-group">
            <input list="paises-list" name="pais" class="premium-datalist-input" placeholder="Buscar por país..." value="{{ request('pais') }}">
            <datalist id="paises-list">
                @foreach($paises as $code => $nombre)
                    <option value="{{ $nombre }}"></option>
                @endforeach
            </datalist>
        </div>

        <button type="submit" class="btn-filter">Filtrar</button>
        
        @if(request()->anyFilled(['search', 'pais']))
            <a href="{{ route('admin.marcas.index') }}" class="btn-reset">Limpiar Filtros</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.marcas.index', array_merge(request()->query(), ['sort' => 'nombre', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Bodega y Origen
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'nombre' ? 'active' : '' }}">
                                {{ request('sort') == 'nombre' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>Presencia Digital</th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($marcas as $marca)
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-name-info">
                                <span class="product-name">{{ $marca->nombre }}</span>
                                <span class="product-meta">
                                    {{ $marca->pais ?? 'N/A' }} • {{ Str::limit($marca->descripcion, 50) }}
                                </span>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($marca->sitio_web)
                            <a href="{{ $marca->sitio_web }}" target="_blank" class="action-btn" style="padding: 0; color: var(--primary);">
                                <span class="material-symbols-outlined">language</span>
                                <span style="font-size: 0.8rem; margin-left: 4px;">Visitar Sitio</span>
                            </a>
                        @else
                            <span style="opacity: 0.3;">N/A</span>
                        @endif
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.marcas.edit', $marca->id_marca) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            
                            <a href="#modal-delete-{{ $marca->id_marca }}" class="action-btn delete" title="Eliminar">
                                <span class="material-symbols-outlined">delete</span>
                            </a>

                            <!-- Modal Delete -->
                            <div id="modal-delete-{{ $marca->id_marca }}" class="modal-overlay">
                                <a href="#" class="modal-close-area"></a>
                                <div class="modal-content">
                                    <div class="modal-header-icon"><span class="material-symbols-outlined">warning</span></div>
                                    <h2>¿Eliminar Bodega?</h2>
                                    <p>Estás a punto de eliminar <strong>{{ $marca->nombre }}</strong>.</p>
                                    <div class="modal-warning">
                                        <span class="material-symbols-outlined">info</span>
                                        <span>Todos los productos asociados a esta casa quedarán sin marca asignada.</span>
                                    </div>
                                    <div class="modal-actions">
                                        <a href="#" class="btn-modal-cancel">Cancelar</a>
                                        <form action="{{ route('admin.marcas.destroy', $marca->id_marca) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-modal-confirm">Eliminar Permanentemente</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align: center; padding: 3rem;">No se encontraron bodegas.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        <div class="pagination-info">
            Mostrando <strong>{{ $marcas->firstItem() ?? 0 }}</strong> a <strong>{{ $marcas->lastItem() ?? 0 }}</strong> de <strong>{{ $marcas->total() }}</strong> bodegas
        </div>
        <div class="pagination-controls">
            @if ($marcas->onFirstPage())
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $marcas->previousPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            @foreach ($marcas->getUrlRange(max(1, $marcas->currentPage() - 2), min($marcas->lastPage(), $marcas->currentPage() + 2)) as $page => $url)
                @if ($page == $marcas->currentPage())
                    <span class="page-current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach

            @if ($marcas->hasMorePages())
                <a href="{{ $marcas->nextPageUrl() }}" class="page-link page-icon">
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
