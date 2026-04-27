<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Última Botella — Tienda de Vinos</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Temporal: Tailwind CDN tal como en tu boceto para mantener la estructura compleja del catalogo intacta -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                "surface-variant": "#e4e4cc",
                "primary": "#2a0002",
                "surface-container-highest": "#e4e4cc",
                "tertiary": "#735c00",
                "on-surface": "#1b1d0e",
                "background": "#fbfbe2",
                "surface-container-low": "#f5f5dc",
                "outline-variant": "#dac1bf"
            },
            "fontFamily": {
                "headline": ["Noto Serif"],
                "body": ["Manrope"],
                "label": ["Manrope"]
            }
          }
        }
      }
    </script>
</head>
<body class="bg-background text-on-surface font-body selection:bg-tertiary-fixed">
    <!-- Barra de Navegación -->
    <nav class="flex justify-between items-center px-12 py-6 w-full sticky top-0 z-50 bg-[#d5d5b5]/90 backdrop-blur-3xl transition-all shadow-sm">
        <!-- Marca -->
        <div class="w-1/3 flex justify-start">
            <a href="{{ url('/') }}" class="font-['Noto_Serif'] text-2xl font-bold italic text-[#2a0002]">La Última Botella</a>
        </div>
        <!-- Enlac.es centrados -->
        <div class="w-1/3 hidden md:flex justify-center space-x-8 font-['Noto_Serif'] text-lg tracking-tight">
            @php
                $rutaActual = request()->path();
            @endphp
            <a class="{{ $rutaActual === '/' ? 'text-[#2a0002] border-b-2 border-[#735c00] pb-1' : 'text-[#1b1d0e]/70 hover:text-[#2a0002] transition-colors duration-300' }}"
               href="{{ url('/') }}">Inicio</a>
            <a class="{{ str_starts_with($rutaActual, 'catalogo') ? 'text-[#2a0002] border-b-2 border-[#735c00] pb-1' : 'text-[#1b1d0e]/70 hover:text-[#2a0002] transition-colors duration-300' }}"
               href="{{ url('/catalogo') }}">Catálogo</a>
            <a class="{{ str_starts_with($rutaActual, 'about') ? 'text-[#2a0002] border-b-2 border-[#735c00] pb-1' : 'text-[#1b1d0e]/70 hover:text-[#2a0002] transition-colors duration-300' }}"
               href="{{ url('/about') }}">Historia</a>
        </div>
        <!-- Íconos a la derecha -->
        <div class="w-1/3 flex justify-end items-center space-x-6">
            <a href="{{ route('carrito.index') }}" class="relative group" title="Carrito">
                <span class="material-symbols-outlined text-[#2a0002] hover:opacity-80 active:scale-95 transition-all" data-icon="shopping_cart">shopping_cart</span>
                @php $cartCount = count(session('carrito', [])); @endphp
                @if($cartCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-[10px] w-4 h-4 flex items-center justify-center rounded-full font-bold shadow-sm group-hover:scale-110 transition-transform">
                    {{ $cartCount }}
                </span>
                @endif
            </a>
            <a href="{{ route('admin.dashboard') }}" title="Panel de Administración" class="material-symbols-outlined text-[#2a0002] hover:opacity-80 active:scale-95 transition-all" data-icon="settings">settings</a>
            <button class="material-symbols-outlined text-[#2a0002] hover:opacity-80 active:scale-95 transition-all" title="Mi cuenta" data-icon="person">person</button>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="w-full py-20 px-12 bg-[#e4e4cc] border-t border-[#dac1bf]/30">
        <div class="max-w-4xl mx-auto flex flex-col items-center text-center gap-10">
            <!-- Brand -->
            <div class="space-y-4">
                <div class="font-['Noto_Serif'] text-3xl italic text-[#2a0002]">La Última Botella</div>
                <p class="font-body text-sm text-[#1b1d0e]/60 max-w-sm mx-auto">
                    Curaduría exclusiva de vinos del viejo y nuevo mundo. Seleccionamos historias, descorchamos momentos.
                </p>
            </div>
            
            <!-- Social Media -->
            <div class="flex items-center space-x-8">
                <a href="#" class="text-[#2a0002]/70 hover:text-[#2a0002] transition-colors" title="Instagram">
                    <i class="fa-brands fa-instagram text-xl"></i>
                </a>
                <a href="#" class="text-[#2a0002]/70 hover:text-[#2a0002] transition-colors" title="Facebook">
                    <i class="fa-brands fa-facebook text-xl"></i>
                </a>
                <a href="#" class="text-[#2a0002]/70 hover:text-[#2a0002] transition-colors" title="Twitter">
                    <i class="fa-brands fa-x-twitter text-xl"></i>
                </a>
            </div>

            <!-- Divider -->
            <div class="w-16 h-px bg-[#2a0002]/10"></div>

            <!-- Copyright -->
            <div class="font-['Manrope'] text-[10px] uppercase tracking-[0.2em] text-[#1b1d0e]/50">
                © {{ date('Y') }} La Última Botella. Todos los derechos reservados.<br>
                <span class="mt-2 block opacity-70 italic text-stone-500">Diseñado y Desarrollado por Daniel y Josué</span>
            </div>
        </div>
    </footer>
</body>
</html>
