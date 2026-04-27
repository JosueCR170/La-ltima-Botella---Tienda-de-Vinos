@extends('layouts.admin')

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Variedades de Uva</h1>
            <p>Gestiona las cepas y variedades que definen el carácter de cada botella.</p>
        </div>
        <div class="header-actions">
            <a href="{{ route('admin.variedades.create') }}" class="btn-create">
                <span class="material-symbols-outlined">add</span>
                <span>Nueva Variedad</span>
            </a>
        </div>
    </header>

    <!-- Barra de Filtros -->
    <form action="{{ route('admin.variedades.index') }}" method="GET" class="filter-bar">
        <div class="filter-group" style="flex: 1;">
            <span class="material-symbols-outlined filter-icon">search</span>
            <input type="text" name="search" class="filter-input" placeholder="Buscar por nombre o tipo..." value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn-filter">Filtrar</button>
        @if(request('search'))
            <a href="{{ route('admin.variedades.index') }}" class="btn-reset">Limpiar</a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>
                        <a href="{{ route('admin.variedades.index', array_merge(request()->query(), ['sort' => 'nombre', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Variedad
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'nombre' ? 'active' : '' }}">
                                {{ request('sort') == 'nombre' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('admin.variedades.index', array_merge(request()->query(), ['sort' => 'tipo', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc'])) }}" class="sort-link">
                            Tipo
                            <span class="material-symbols-outlined sort-icon {{ request('sort') == 'tipo' ? 'active' : '' }}">
                                {{ request('sort') == 'tipo' ? (request('direction') == 'asc' ? 'arrow_upward' : 'arrow_downward') : 'unfold_more' }}
                            </span>
                        </a>
                    </th>
                    <th class="actions-cell">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($variedades as $variedad)
                <tr>
                    <td>
                        <div class="product-cell">
                            <div class="product-name-info">
                                <span class="product-name">{{ $variedad->nombre }}</span>
                                <span class="product-meta">{{ Str::limit($variedad->descripcion, 50) }}</span>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge {{ $variedad->tipo == 'Tinta' ? 'badge-tinta' : ($variedad->tipo == 'Blanca' ? 'badge-blanca' : ($variedad->tipo == 'Aromatica' ? 'badge-aromatica' : 'badge-neutral')) }}">
                            {{ $variedad->tipo }}
                        </span>
                    </td>
                    <td class="actions-cell">
                        <div class="actions-wrapper">
                            <a href="{{ route('admin.variedades.edit', $variedad->id_variedad) }}" class="action-btn" title="Editar">
                                <span class="material-symbols-outlined">edit</span>
                            </a>
                            
                            <a href="#modal-delete-{{ $variedad->id_variedad }}" class="action-btn delete" title="Eliminar">
                                <span class="material-symbols-outlined">delete</span>
                            </a>

                            <!-- Modal Delete -->
                            <div id="modal-delete-{{ $variedad->id_variedad }}" class="modal-overlay">
                                <a href="#" class="modal-close-area"></a>
                                <div class="modal-content">
                                    <div class="modal-header-icon"><span class="material-symbols-outlined">warning</span></div>
                                    <h2>¿Eliminar Variedad?</h2>
                                    <p>Estás a punto de eliminar <strong>{{ $variedad->nombre }}</strong>.</p>
                                    <div class="modal-warning">
                                        <span class="material-symbols-outlined">info</span>
                                        <span>Esta acción desvinculará esta variedad de todos los productos que la contienen.</span>
                                    </div>
                                    <div class="modal-actions">
                                        <a href="#" class="btn-modal-cancel">Cancelar</a>
                                        <form action="{{ route('admin.variedades.destroy', $variedad->id_variedad) }}" method="POST">
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
                <tr><td colspan="3" style="text-align: center; padding: 3rem;">No se encontraron variedades.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="pagination-container">
        <div class="pagination-info">
            Mostrando <strong>{{ $variedades->firstItem() ?? 0 }}</strong> a <strong>{{ $variedades->lastItem() ?? 0 }}</strong> de <strong>{{ $variedades->total() }}</strong> variedades
        </div>
        <div class="pagination-controls">
            @if ($variedades->onFirstPage())
                <span class="page-disabled page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </span>
            @else
                <a href="{{ $variedades->previousPageUrl() }}" class="page-link page-icon">
                    <span class="material-symbols-outlined">chevron_left</span>
                </a>
            @endif

            @foreach ($variedades->getUrlRange(max(1, $variedades->currentPage() - 2), min($variedades->lastPage(), $variedades->currentPage() + 2)) as $page => $url)
                @if ($page == $variedades->currentPage())
                    <span class="page-current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                @endif
            @endforeach

            @if ($variedades->hasMorePages())
                <a href="{{ $variedades->nextPageUrl() }}" class="page-link page-icon">
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
