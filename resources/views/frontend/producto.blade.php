@extends('layouts.app')

@section('content')
<main class="max-w-screen-2xl mx-auto px-6 md:px-12 pt-12 pb-24">

    <!-- Migas de pan -->
    <nav class="mb-8 text-xs font-label uppercase tracking-widest text-on-surface/50">
        <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Inicio</a>
        <span class="mx-2">/</span>
        <a href="{{ url('/catalogo') }}" class="hover:text-primary transition-colors">Catálogo</a>
        <span class="mx-2">/</span>
        <span class="text-primary">{{ $producto->nombre }}</span>
    </nav>

    <!-- Asymmetric Product Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">

        <!-- Left: Image -->
        <div class="lg:col-span-5 relative">
            <div class="bg-surface-container-low rounded-lg p-12 lg:sticky lg:top-32 shadow-[0_20px_40px_-10px_rgba(27,29,14,0.06)] aspect-[3/4] flex items-center justify-center">
                @if($producto->imagen_url)
                    <img alt="{{ $producto->nombre }}"
                         class="max-w-full max-h-full object-contain transform hover:scale-105 transition-transform duration-700"
                         src="{{ $producto->imagen_url }}"/>
                @else
                    <div class="flex items-center justify-center">
                        <span class="material-symbols-outlined text-9xl text-outline-variant/30">wine_bar</span>
                    </div>
                @endif

                <!-- Botón Editar (Debajo de la imagen) -->
                <div class="mt-8 pt-8 border-t border-outline-variant/20">
                    <a href="{{ route('admin.productos.index', ['search' => $producto->nombre]) }}" 
                       class="w-full bg-white text-[#2a0002] border border-[#2a0002] px-6 py-3 rounded-md font-label text-xs font-bold uppercase tracking-widest hover:bg-[#2a0002] hover:text-white transition-all duration-300 flex items-center justify-center space-x-3">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        <span>Editar Producto en Admin</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Right: Content -->
        <div class="lg:col-span-7 flex flex-col space-y-12">

            <!-- Header -->
            <section class="space-y-4">
                <div class="flex items-center flex-wrap gap-3">
                    @if($producto->categoria)
                    <span class="bg-tertiary text-on-tertiary px-4 py-1 rounded-full font-label text-[0.75rem] uppercase tracking-widest">
                        {{ $producto->categoria->nombre }}
                    </span>
                    @endif
                    @if($producto->pais)
                    <span class="text-on-surface-variant font-label text-[0.75rem] uppercase tracking-widest">
                        {{ $producto->pais }}{{ $producto->region ? ', ' . $producto->region : '' }}
                    </span>
                    @endif
                </div>
                <h1 class="font-headline text-5xl md:text-6xl font-bold text-primary tracking-tighter leading-tight italic">
                    {{ $producto->nombre }}
                </h1>
                @if($producto->marca)
                <p class="font-headline text-2xl text-secondary italic opacity-80">{{ $producto->marca->nombre }}</p>
                @endif
                @if($producto->variedades->isNotEmpty())
                <p class="font-label text-sm text-tertiary uppercase tracking-widest">
                    {{ $producto->variedades->pluck('nombre')->join(' / ') }}
                </p>
                @endif
            </section>

            <!-- Technical Specs -->
            <section class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                @if($producto->anio_cosecha)
                <div class="bg-surface-container p-6 rounded-lg flex flex-col justify-center items-center">
                    <span class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Año de Cosecha</span>
                    <span class="font-headline text-xl font-bold text-primary">{{ $producto->anio_cosecha }}</span>
                </div>
                @endif
                @if($producto->alcohol_porcentaje)
                <div class="bg-surface-container p-6 rounded-lg flex flex-col justify-center items-center">
                    <span class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Alcohol</span>
                    <span class="font-headline text-xl font-bold text-primary">{{ $producto->alcohol_porcentaje }}%</span>
                </div>
                @endif
                @if($producto->contenido_ml)
                <div class="bg-surface-container p-6 rounded-lg flex flex-col justify-center items-center">
                    <span class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Contenido</span>
                    <span class="font-headline text-xl font-bold text-primary">{{ $producto->contenido_ml }}ml</span>
                </div>
                @endif
                <div class="bg-surface-container p-6 rounded-lg flex flex-col justify-center items-center">
                    <span class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Existencias</span>
                    <span class="font-headline text-xl font-bold text-primary">{{ $producto->cantidad }}</span>
                </div>
            </section>

            <!-- Pricing & CTA -->
            <section class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-8 bg-surface-container-highest rounded-xl border border-outline-variant/10">
                <div class="mb-6 sm:mb-0">
                    <span class="font-label text-[0.75rem] uppercase text-on-surface-variant">Precio de Venta</span>
                    @if($producto->descuento > 0)
                        <p class="text-lg font-body line-through text-on-surface/40">${{ number_format($producto->precio, 2) }}</p>
                        <p class="text-4xl font-headline font-bold text-primary">
                            ${{ number_format($producto->precio * (1 - $producto->descuento / 100), 2) }}
                            <span class="text-base text-tertiary font-label ml-2">-{{ $producto->descuento }}%</span>
                        </p>
                    @else
                        <p class="text-4xl font-headline font-bold text-primary">${{ number_format($producto->precio, 2) }}</p>
                    @endif
                </div>
                <button onclick="agregarAlCarrito({{ $producto->id_producto }})" 
                        class="w-full sm:w-auto bg-[#2a0002] text-white px-8 py-4 rounded-md font-label text-sm font-bold uppercase tracking-widest hover:bg-[#3d0003] active:scale-95 transition-all duration-300 flex items-center justify-center space-x-3 shadow-lg">
                    <span class="material-symbols-outlined">add_shopping_cart</span>
                    <span>Agregar al Carrito</span>
                </button>
            </section>

            <!-- Description -->
            @if($producto->descripcion)
            <section class="space-y-4">
                <h3 class="font-headline text-2xl font-bold text-primary italic">Descripción del Vino</h3>
                <p class="font-body text-on-surface-variant leading-relaxed text-lg">{{ $producto->descripcion }}</p>
            </section>
            @endif

            <!-- Details Block -->
            <section class="relative p-12 bg-surface-container-low rounded-lg overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <span class="material-symbols-outlined text-9xl">wine_bar</span>
                </div>
                <div class="relative z-10">
                    <h3 class="font-headline text-2xl font-bold text-primary mb-6">Datos Técnicos</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @if($producto->pais)
                        <div class="flex items-start gap-3 border-b border-outline-variant/20 pb-3">
                            <span class="material-symbols-outlined text-tertiary text-sm mt-0.5">public</span>
                            <div>
                                <dt class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">País</dt>
                                <dd class="font-body font-medium text-on-surface">{{ $producto->pais }}</dd>
                            </div>
                        </div>
                        @endif
                        @if($producto->region)
                        <div class="flex items-start gap-3 border-b border-outline-variant/20 pb-3">
                            <span class="material-symbols-outlined text-tertiary text-sm mt-0.5">location_on</span>
                            <div>
                                <dt class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Región</dt>
                                <dd class="font-body font-medium text-on-surface">{{ $producto->region }}</dd>
                            </div>
                        </div>
                        @endif
                        @if($producto->marca)
                        <div class="flex items-start gap-3 border-b border-outline-variant/20 pb-3">
                            <span class="material-symbols-outlined text-tertiary text-sm mt-0.5">storefront</span>
                            <div>
                                <dt class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Bodega</dt>
                                <dd class="font-body font-medium text-on-surface">{{ $producto->marca->nombre }}</dd>
                            </div>
                        </div>
                        @endif
                        @if($producto->categoria)
                        <div class="flex items-start gap-3 border-b border-outline-variant/20 pb-3">
                            <span class="material-symbols-outlined text-tertiary text-sm mt-0.5">category</span>
                            <div>
                                <dt class="font-label text-[0.65rem] uppercase tracking-widest text-on-surface-variant">Categoría</dt>
                                <dd class="font-body font-medium text-on-surface">{{ $producto->categoria->nombre }}</dd>
                            </div>
                        </div>
                        @endif
                    </dl>
                </div>
            </section>

        </div>
    </div>
</main>

<!-- Related Products -->
@if($relacionados->isNotEmpty())
<section class="bg-surface-container-low py-24 px-6 md:px-12">
    <div class="max-w-screen-2xl mx-auto">
        <h2 class="font-headline text-4xl text-primary font-bold mb-12 italic">Vinos del Mismo Estilo</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @foreach($relacionados as $rel)
            <a href="{{ route('producto.show', $rel->id_producto) }}" class="group cursor-pointer block">
                <div class="aspect-[3/4] bg-surface rounded-lg mb-6 overflow-hidden flex items-center justify-center p-8 transition-transform duration-500 group-hover:-translate-y-2">
                    @if($rel->imagen_url)
                        <img alt="{{ $rel->nombre }}" class="h-full object-contain" src="{{ $rel->imagen_url }}"/>
                    @else
                        <span class="material-symbols-outlined text-7xl text-outline-variant/30">wine_bar</span>
                    @endif
                </div>
                <h4 class="font-headline text-xl font-bold text-primary group-hover:text-tertiary transition-colors">{{ $rel->nombre }}</h4>
                <p class="font-body text-on-surface-variant text-sm">
                    {{ $rel->marca->nombre ?? '' }}{{ $rel->pais ? ' | ' . $rel->pais : '' }}
                </p>
                <p class="font-label text-tertiary mt-2 font-bold">${{ number_format($rel->precio, 2) }}</p>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
    function agregarAlCarrito(id) {
        fetch(`/carrito/agregar/${id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert(data.mensaje);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al agregar el producto');
        });
    }
</script>
@endsection
