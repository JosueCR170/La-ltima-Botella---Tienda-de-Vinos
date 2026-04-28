@extends('layouts.app')

@section('content')
<main class="max-w-screen-xl mx-auto px-6 md:px-12 py-24 min-h-[70vh]">
    <header class="mb-16 border-b border-outline-variant/20 pb-8">
        <h1 class="font-headline text-5xl text-primary font-bold italic tracking-tight">Tu Bodega Personal</h1>
        <p class="text-on-surface/60 mt-4 font-body text-lg italic">Vinos seleccionados listos para ser descorchados.</p>
    </header>

    @if(count($carrito) > 0)
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
        <!-- Listado de Productos -->
        <div class="lg:col-span-8 space-y-8">
            @foreach($carrito as $id => $item)
            <article class="flex items-center gap-8 bg-surface-container-low p-6 rounded-lg shadow-sm border border-outline-variant/10">
                <div class="w-24 h-32 bg-surface-container rounded overflow-hidden flex-shrink-0">
                    @if($item['imagen'])
                        <img src="{{ $item['imagen'] }}" alt="{{ $item['nombre'] }}" class="w-full h-full object-contain p-2">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-outline-variant/30">wine_bar</span>
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <h3 class="font-headline text-xl text-primary font-bold">{{ $item['nombre'] }}</h3>
                    <p class="text-tertiary font-label text-sm uppercase tracking-widest mt-1">${{ number_format($item['precio'], 2) }} por unidad</p>
                    
                    <div class="flex items-center gap-6 mt-4">
                    <div class="flex items-center gap-6 mt-4">
                        <div class="flex items-center border border-outline-variant/30 rounded-md bg-white overflow-hidden">
                            <form action="{{ route('carrito.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="accion" value="decrementar">
                                <button type="submit" class="px-3 py-1 text-primary hover:bg-surface-container transition-colors border-r border-outline-variant/30 {{ $item['cantidad'] <= 1 ? 'opacity-30 pointer-events-none' : '' }}">-</button>
                            </form>
                            
                            <span class="px-4 py-1 font-bold text-sm min-w-[3rem] text-center">{{ $item['cantidad'] }}</span>
                            
                            <form action="{{ route('carrito.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                <input type="hidden" name="accion" value="incrementar">
                                <button type="submit" class="px-3 py-1 text-primary hover:bg-surface-container transition-colors border-l border-outline-variant/30">+</button>
                            </form>
                        </div>
                        <form action="{{ route('carrito.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs font-label uppercase tracking-widest text-secondary hover:text-red-600 transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-sm">delete</span> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="font-headline text-xl text-primary font-bold">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</p>
                </div>
            </article>
            @endforeach
            
            <div class="pt-8">
                <a href="{{ url('/catalogo') }}" class="inline-flex items-center gap-2 text-sm font-label uppercase tracking-widest text-secondary hover:text-primary transition-all">
                    <span class="material-symbols-outlined text-sm">arrow_back</span> Seguir comprando
                </a>
            </div>
        </div>
 
        <!-- Resumen -->
        <div class="lg:col-span-4">
            <div class="bg-primary p-8 rounded-lg text-white shadow-xl sticky top-32">
                <h3 class="font-headline text-2xl mb-8 border-b border-white/10 pb-4 italic">Resumen de Compra</h3>
                
                <div class="space-y-4 mb-8">
                    <div class="flex justify-between text-sm font-label uppercase tracking-widest opacity-80">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-label uppercase tracking-widest opacity-80">
                        <span>Envío</span>
                        <span class="italic">Gratis</span>
                    </div>
                </div>
                
                <div class="border-t border-white/20 pt-6 mb-10 flex justify-between items-end">
                    <span class="font-label text-xs uppercase tracking-widest opacity-60">Total Estimado</span>
                    <span class="font-headline text-4xl font-bold italic text-[#e4e4cc]">${{ number_format($total, 2) }}</span>
                </div>
                
                <a href="{{ route('checkout.index') }}" class="w-full bg-[#e4e4cc] text-[#2a0002] py-4 rounded-md font-label font-bold uppercase tracking-[0.2em] hover:bg-white transition-all active:scale-95 shadow-lg block text-center">
                    Finalizar Pedido
                </a>
                
                <p class="text-[10px] text-center mt-6 font-label uppercase tracking-widest opacity-40 leading-loose">
                    Precios incluyen impuestos locales.<br>Garantía de calidad de La Última Botella.
                </p>
            </div>
        </div>
    </div>
    @else
    <div class="py-32 text-center bg-surface-container-low rounded-xl border border-dashed border-outline-variant/30">
        <span class="material-symbols-outlined text-8xl text-outline-variant/20 block mb-6">shopping_basket</span>
        <h2 class="font-headline text-3xl text-primary/60 italic">Tu bodega está vacía.</h2>
        <p class="text-on-surface/40 mt-4 mb-10">Es el momento perfecto para descubrir nuevas historias embotelladas.</p>
        <a href="{{ url('/catalogo') }}" class="bg-primary text-white px-10 py-4 rounded-md font-label uppercase tracking-widest text-xs hover:bg-primary-container transition-all shadow-lg inline-block">
            Explorar Catálogo
        </a>
    </div>
    @endif
</main>
@endsection
