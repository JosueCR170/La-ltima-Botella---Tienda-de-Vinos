@extends('layouts.app')

@section('content')
<main class="flex min-h-screen px-6 md:px-12 pt-12 pb-24 gap-16">

<!-- Barra lateral de filtros -->
<aside class="w-72 flex-shrink-0 space-y-10 pt-4">
    <header>
        <h2 class="font-headline text-2xl text-primary font-bold">Filtrar Colección</h2>
        <p class="text-xs font-label uppercase tracking-widest text-secondary mt-2 opacity-70">Refinando la bodega</p>
    </header>

    <form method="GET" action="{{ url('/catalogo') }}" id="formFiltros">
        <!-- Búsqueda por nombre -->
        <section class="space-y-4 mb-10">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">search</span>
                Buscar Vino
            </h3>
            <div class="relative">
                <input type="text" name="buscar" value="{{ request('buscar') }}" 
                       placeholder="Nombre del vino..."
                       class="w-full bg-surface-container text-sm font-body text-on-surface border border-outline-variant/30 rounded-md px-4 py-3 focus:outline-none focus:border-primary transition-all pr-10">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-primary/40 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </button>
            </div>
        </section>

        <!-- Categoría -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">category</span>
                Categoría
            </h3>
            <div class="flex flex-col space-y-2">
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="categoria" value="" form="formFiltros"
                           class="accent-primary" {{ !request('categoria') ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">Todas</span>
                </label>
                @foreach($categorias as $cat)
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="categoria" value="{{ $cat->id_categoria }}" form="formFiltros"
                           class="accent-primary" {{ request('categoria') == $cat->id_categoria ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">{{ $cat->nombre }}</span>
                </label>
                @endforeach
            </div>
        </section>

        <!-- País de origen -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">public</span>
                País de Origen
            </h3>
            <div class="flex flex-col space-y-2 max-h-48 overflow-y-auto pr-2">
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="pais" value="" form="formFiltros"
                           class="accent-primary" {{ !request('pais') ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">Todos</span>
                </label>
                @foreach($paises as $pais)
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="pais" value="{{ $pais }}" form="formFiltros"
                           class="accent-primary" {{ request('pais') === $pais ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">{{ $pais }}</span>
                </label>
                @endforeach
            </div>
        </section>

        <!-- Bodega / Marca -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">storefront</span>
                Bodega
            </h3>
            <div class="flex flex-col space-y-2 max-h-48 overflow-y-auto pr-2">
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="marca" value="" form="formFiltros"
                           class="accent-primary" {{ !request('marca') ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">Todas</span>
                </label>
                @foreach($marcas as $marca)
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="marca" value="{{ $marca->id_marca }}" form="formFiltros"
                           class="accent-primary" {{ request('marca') == $marca->id_marca ? 'checked' : '' }}
                           onchange="document.getElementById('formFiltros').submit()">
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">{{ $marca->nombre }}</span>
                </label>
                @endforeach
            </div>
        </section>

        <!-- Cepa / Variedad -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">wine_bar</span>
                Cepa / Variedad
            </h3>
            <div class="flex flex-wrap gap-2">
                @foreach($variedades as $variedad)
                <button type="submit" name="variedad" value="{{ $variedad->id_variedad }}" form="formFiltros"
                    class="px-3 py-1 text-[10px] font-label rounded-full uppercase tracking-widest cursor-pointer transition-colors
                    {{ request('variedad') == $variedad->id_variedad
                        ? 'bg-tertiary text-white shadow-md'
                        : 'bg-surface-container-high text-on-surface hover:bg-surface-container-highest' }}">
                    {{ $variedad->nombre }}
                </button>
                @endforeach
            </div>
        </section>

        <!-- Ofertas -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">sell</span>
                Ofertas
            </h3>
            <label class="flex items-center space-x-3 cursor-pointer group">
                <input type="checkbox" name="solo_descuentos" value="1" form="formFiltros"
                       class="accent-primary rounded" {{ request('solo_descuentos') ? 'checked' : '' }}
                       onchange="document.getElementById('formFiltros').submit()">
                <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary font-bold text-red-600 italic">Solo con Descuento</span>
            </label>
        </section>

        <!-- Ordenar -->
        <section class="space-y-4 mb-8">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2 flex items-center">
                <span class="material-symbols-outlined text-sm mr-2 text-tertiary">sort</span>
                Ordenar por
            </h3>
            <select name="orden" form="formFiltros" onchange="document.getElementById('formFiltros').submit()"
                    class="w-full bg-surface-container text-sm font-body text-on-surface border border-outline-variant/30 rounded-md px-3 py-2 focus:outline-none focus:border-tertiary">
                <option value="newest" {{ request('orden', 'newest') === 'newest' ? 'selected' : '' }}>Más recientes</option>
                <option value="precio_asc" {{ request('orden') === 'precio_asc' ? 'selected' : '' }}>Precio: Menor a Mayor</option>
                <option value="precio_desc" {{ request('orden') === 'precio_desc' ? 'selected' : '' }}>Precio: Mayor a Menor</option>
                <option value="nombre" {{ request('orden') === 'nombre' ? 'selected' : '' }}>Nombre A-Z</option>
            </select>
        </section>

        <!-- Limpiar filtros -->
        @if(request()->hasAny(['categoria', 'marca', 'variedad', 'pais', 'orden', 'solo_descuentos', 'buscar']))
        <a href="{{ url('/catalogo') }}" class="inline-flex items-center gap-2 text-xs font-label uppercase tracking-widest text-secondary hover:text-primary transition-colors">
            <span class="material-symbols-outlined text-sm">close</span> Limpiar filtros
        </a>
        @endif
    </form>
</aside>

<!-- Grilla de productos -->
<section class="flex-grow">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h1 class="font-headline text-4xl text-primary font-bold tracking-tight">Nuestra Colección</h1>
            <p class="text-on-surface/60 mt-2 font-headline italic">
                Mostrando {{ $productos->firstItem() }} - {{ $productos->lastItem() }} de {{ $productos->total() }} vinos curados.
            </p>
        </div>
    </div>

    <!-- Grilla -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-y-16 gap-x-8">
        @forelse($productos as $producto)
        <article class="flex flex-col space-y-4 group">
            <div class="relative">
                <a href="{{ route('producto.show', $producto->id_producto) }}" class="block">
                    <div class="aspect-[3/4] bg-surface-container-low overflow-hidden rounded-lg relative p-6 flex items-center justify-center">
                        @if($producto->imagen_url)
                            <img alt="{{ $producto->nombre }}"
                                 class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700"
                                 src="{{ $producto->imagen_url }}"/>
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-7xl text-outline-variant/30">wine_bar</span>
                            </div>
                        @endif

                        @if($producto->descuento > 0)
                        <div class="absolute top-4 right-4 bg-red-600 text-white text-[10px] px-2 py-1 font-label uppercase tracking-widest rounded-full shadow-lg">
                            -{{ $producto->descuento }}%
                        </div>
                        @endif

                        @if($producto->cantidad <= 0)
                        <div class="absolute inset-0 flex items-center justify-center bg-black/20 backdrop-blur-[2px]">
                            <span class="bg-white/90 text-primary px-4 py-2 rounded-full font-label text-[10px] uppercase tracking-[0.2em] font-bold shadow-xl border border-primary/10">Agotado</span>
                        </div>
                        @endif
                    </div>
                </a>
                
                <!-- Botón rápido agregar carrito -->
                @if($producto->cantidad > 0)
                <button onclick="agregarAlCarrito({{ $producto->id_producto }})" 
                        class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-md p-3 rounded-full shadow-lg text-primary hover:bg-primary hover:text-white transition-all duration-300 transform translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100">
                    <span class="material-symbols-outlined">add_shopping_cart</span>
                </button>
                @endif
            </div>

            <div class="space-y-1 mt-4">
                <a href="{{ route('producto.show', $producto->id_producto) }}" class="group">
                    <h3 class="font-headline text-xl text-primary group-hover:text-tertiary transition-colors">{{ $producto->nombre }}</h3>
                </a>
                <div class="flex justify-between items-center text-xs text-on-surface/50 font-label uppercase tracking-wider">
                    <span>
                        {{ $producto->marca->nombre ?? '' }}
                        {{ $producto->pais ? '· ' . $producto->pais : '' }}
                        {{ $producto->anio_cosecha ? ', ' . $producto->anio_cosecha : '' }}
                    </span>
                    <div class="flex flex-col items-end">
                        @if($producto->descuento > 0)
                            <span class="text-[10px] line-through opacity-50">${{ number_format($producto->precio, 2) }}</span>
                            <span class="text-red-600 font-bold">${{ number_format($producto->precio * (1 - $producto->descuento/100), 2) }}</span>
                        @else
                            <span class="text-tertiary font-bold">${{ number_format($producto->precio, 2) }}</span>
                        @endif
                    </div>
                </div>
                @if($producto->variedades->isNotEmpty())
                <p class="text-[10px] text-on-surface/40 font-label uppercase tracking-widest">
                    {{ $producto->variedades->pluck('nombre')->join(' / ') }}
                </p>
                @endif
            </div>
        </article>
        @empty
        <div class="col-span-3 py-24 text-center">
            <span class="material-symbols-outlined text-6xl text-outline-variant/30 block mb-4">wine_bar</span>
            <p class="font-headline text-2xl text-primary/60 italic">No se encontraron vinos con los filtros seleccionados.</p>
            <a href="{{ url('/catalogo') }}" class="mt-6 inline-block text-secondary font-label text-sm uppercase tracking-widest hover:text-primary transition-colors">
                Ver todos los vinos
            </a>
        </div>
        @endforelse
    </div>

    <!-- Paginación -->
    @if($productos->hasPages())
<div class="pagination-container">
    <div class="pagination-info">
        Mostrando <strong>{{ $productos->firstItem() ?? 0 }}</strong> a <strong>{{ $productos->lastItem() ?? 0 }}</strong> de <strong>{{ $productos->total() }}</strong> vinos curados
    </div>
    <div class="pagination-controls">
        {{-- Botón Anterior --}}
        @if($productos->onFirstPage())
            <span class="page-disabled page-icon">
                <span class="material-symbols-outlined">chevron_left</span>
            </span>
        @else
            <a href="{{ $productos->previousPageUrl() }}" class="page-link page-icon">
                <span class="material-symbols-outlined">chevron_left</span>
            </a>
        @endif

        {{-- Números de página --}}
        @foreach($productos->getUrlRange(max(1, $productos->currentPage() - 2), min($productos->lastPage(), $productos->currentPage() + 2)) as $page => $url)
            @if($page == $productos->currentPage())
                <span class="page-current">{{ $page }}</span>
            @else
                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Botón Siguiente --}}
        @if($productos->hasMorePages())
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
@endif
</section>

</section>

</main>
@endsection
