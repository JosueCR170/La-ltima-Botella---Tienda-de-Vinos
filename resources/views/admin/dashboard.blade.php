@extends('layouts.admin')

@section('content')
    <div class="header">
        <h1>Dashboard Principal</h1>
        <p>Bienvenido al panel de administración de La Última Botella.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
        <div style="background: var(--surface-container-lowest); padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--tertiary);">wine_bar</span>
            <h3>Productos</h3>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-primary btn-sm mt-2">Gestionar</a>
        </div>
        
        <div style="background: var(--surface-container-lowest); padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--tertiary);">category</span>
            <h3>Categorías</h3>
            <a href="{{ route('admin.categorias.index') }}" class="btn btn-primary btn-sm mt-2">Gestionar</a>
        </div>

        <div style="background: var(--surface-container-lowest); padding: 1.5rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center;">
            <span class="material-symbols-outlined" style="font-size: 3rem; color: var(--tertiary);">sell</span>
            <h3>Marcas</h3>
            <a href="{{ route('admin.marcas.index') }}" class="btn btn-primary btn-sm mt-2">Gestionar</a>
        </div>
    </div>
@endsection
