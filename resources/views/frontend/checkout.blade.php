@extends('layouts.app')

@section('content')
<main class="max-w-4xl mx-auto px-6 py-24">
    <div class="bg-white shadow-2xl rounded-lg overflow-hidden border border-outline-variant/20">
        <!-- Header de la Factura -->
        <div class="bg-[#2a0002] p-12 text-white flex justify-between items-start">
            <div>
                <h1 class="font-headline text-4xl italic font-bold">Factura de Compra</h1>
                <p class="font-label text-xs uppercase tracking-[0.3em] mt-2 opacity-70">La Última Botella — Selección Privada</p>
            </div>
            <div class="text-right">
                <p class="font-label text-xs uppercase tracking-widest opacity-60">Fecha</p>
                <p class="font-body text-lg">{{ date('d / m / Y') }}</p>
            </div>
        </div>

        <!-- Cuerpo de la Factura -->
        <div class="p-12">
            <div class="mb-12 flex justify-between">
                <div>
                    <h3 class="font-label text-xs uppercase tracking-widest text-on-surface-variant mb-4">Emitido por</h3>
                    <p class="font-headline text-xl font-bold text-primary">La Última Botella S.A.</p>
                    <p class="text-sm text-on-surface/60 font-body">Valle de los Viñedos, Bóveda 01<br>Costa Rica</p>
                </div>
                <div class="text-right">
                    <h3 class="font-label text-xs uppercase tracking-widest text-on-surface-variant mb-4">Detalle de Cliente</h3>
                    <p class="font-headline text-xl font-bold text-primary">Invitado Distinguido</p>
                    <p class="text-sm text-on-surface/60 font-body">Compra en Línea</p>
                </div>
            </div>

            <!-- Tabla de Productos -->
            <table class="w-full mb-12">
                <thead>
                    <tr class="border-b-2 border-primary/10 text-left">
                        <th class="py-4 font-label text-xs uppercase tracking-widest text-on-surface-variant">Vino Seleccionado</th>
                        <th class="py-4 font-label text-xs uppercase tracking-widest text-on-surface-variant text-center">Cant.</th>
                        <th class="py-4 font-label text-xs uppercase tracking-widest text-on-surface-variant text-right">Precio Unit.</th>
                        <th class="py-4 font-label text-xs uppercase tracking-widest text-on-surface-variant text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline-variant/10">
                    @foreach($carrito as $id => $item)
                    <tr>
                        <td class="py-6">
                            <p class="font-headline font-bold text-primary text-lg">{{ $item['nombre'] }}</p>
                            <p class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant">Reserva Especial</p>
                        </td>
                        <td class="py-6 text-center font-body">{{ $item['cantidad'] }}</td>
                        <td class="py-6 text-right font-body">${{ number_format($item['precio'], 2) }}</td>
                        <td class="py-6 text-right font-headline font-bold text-primary">${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totales -->
            <div class="flex justify-end">
                <div class="w-72 space-y-4">
                    <div class="flex justify-between text-sm font-label uppercase tracking-widest opacity-60">
                        <span>Subtotal</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-sm font-label uppercase tracking-widest opacity-60">
                        <span>Impuestos (IVA)</span>
                        <span>Incluidos</span>
                    </div>
                    <div class="flex justify-between text-sm font-label uppercase tracking-widest opacity-60 border-b border-outline-variant/20 pb-4">
                        <span>Envío</span>
                        <span class="text-tertiary italic">Bonificado</span>
                    </div>
                    <div class="flex justify-between items-end pt-4">
                        <span class="font-label text-xs uppercase tracking-widest font-bold">Total a Pagar</span>
                        <span class="font-headline text-4xl font-bold italic text-primary">${{ number_format($total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="bg-surface-container-low p-12 flex flex-col items-center gap-6 border-t border-outline-variant/20">
            <form action="{{ route('checkout.pay') }}" method="POST" class="w-full max-w-md">
                @csrf
                <button type="submit" class="w-full bg-[#2a0002] text-white py-5 rounded-md font-label font-bold uppercase tracking-[0.3em] hover:bg-[#3d0003] active:scale-95 transition-all shadow-2xl flex items-center justify-center gap-4">
                    <span class="material-symbols-outlined">payments</span>
                    Confirmar y Pagar Factura
                </button>
            </form>
            <a href="{{ route('carrito.index') }}" class="font-label text-xs uppercase tracking-widest text-secondary hover:text-primary transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined text-sm">arrow_back</span> Regresar al Carrito
            </a>
        </div>
    </div>

    <p class="text-center mt-12 font-label text-[10px] uppercase tracking-widest opacity-40">
        Al confirmar, se descontarán los productos de nuestro inventario.<br>
        Gracias por confiar en la curaduría de La Última Botella.
    </p>
</main>
@endsection
