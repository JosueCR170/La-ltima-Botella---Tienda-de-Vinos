@extends('layouts.admin')

@section('content')
<div class="index-view">
    <header class="index-header">
        <div class="header-info">
            <h1>Cava Principal</h1>
            <p>Bienvenido al centro de control y gestión de la colección de La Última Botella.</p>
        </div>
    </header>

    <div class="dashboard-grid">
        <a href="{{ route('admin.productos.index') }}" class="dashboard-card">
            <div class="dashboard-icon">
                <span class="material-symbols-outlined">wine_bar</span>
            </div>
            <h3>Catálogo de Vinos</h3>
            <p>Administra el inventario de botellas, precios, cosechas y existencias en la cava.</p>
            <div class="btn-manage">Explorar Catálogo</div>
        </a>
        
        <a href="{{ route('admin.categorias.index') }}" class="dashboard-card">
            <div class="dashboard-icon">
                <span class="material-symbols-outlined">category</span>
            </div>
            <h3>Clasificación</h3>
            <p>Organiza la colección estructurando jerarquías, clasificaciones y tipos de vino.</p>
            <div class="btn-manage">Gestionar Categorías</div>
        </a>

        <a href="{{ route('admin.marcas.index') }}" class="dashboard-card">
            <div class="dashboard-icon">
                <span class="material-symbols-outlined">storefront</span>
            </div>
            <h3>Casas y Bodegas</h3>
            <p>Supervisa los viñedos, marcas y el origen geográfico de cada vino de la tienda.</p>
            <div class="btn-manage">Ver Bodegas</div>
        </a>

        <a href="{{ route('admin.variedades.index') }}" class="dashboard-card">
            <div class="dashboard-icon">
                <span class="material-symbols-outlined">psychiatry</span>
            </div>
            <h3>Variedades de Uva</h3>
            <p>Define las cepas, perfiles aromáticos y características de nuestra selección.</p>
            <div class="btn-manage">Descubrir Cepas</div>
        </a>
    </div>
</div>
@endsection
