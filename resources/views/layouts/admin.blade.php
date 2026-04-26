<!DOCTYPE html>
<html lang="es" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | The Editorial Cellar</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400;1,700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface-variant": "#e4e4cc",
                        "primary": "#2a0002",
                        "secondary-container": "#fed7d0",
                        "outline-variant": "#dac1bf",
                        "inverse-surface": "#303221",
                        "outline": "#877270",
                        "surface-container-highest": "#e4e4cc",
                        "surface-tint": "#954742",
                        "error-container": "#ffdad6",
                        "primary-container": "#4a0e0e",
                        "on-primary-container": "#cc726d",
                        "error": "#ba1a1a",
                        "on-background": "#1b1d0e",
                        "surface-dim": "#dbdcc3",
                        "on-primary": "#ffffff",
                        "on-error": "#ffffff",
                        "on-surface": "#1b1d0e",
                        "background": "#fbfbe2",
                        "on-tertiary": "#ffffff",
                        "surface-container": "#efefd7",
                        "tertiary-fixed": "#ffe088",
                        "surface-container-low": "#f5f5dc",
                        "on-surface-variant": "#544341",
                        "primary-fixed-dim": "#ffb3ad",
                        "primary-fixed": "#ffdad7",
                        "surface-bright": "#fbfbe2",
                        "secondary-fixed": "#ffdad4",
                        "on-secondary-container": "#795c57",
                        "surface": "#fbfbe2",
                        "surface-container-lowest": "#ffffff",
                        "tertiary": "#735c00",
                        "secondary": "#745853",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#eaead1",
                        "on-secondary": "#ffffff"
                    },
                    fontFamily: {
                        headline: ["Noto Serif"],
                        body: ["Manrope"],
                        label: ["Manrope"]
                    }
                }
            }
        }
    </script>
    
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #dac1bf26; border-radius: 10px; }
        body { font-family: 'Manrope', sans-serif; background-color: #fbfbe2; }
    </style>
</head>
<body class="text-on-surface antialiased overflow-hidden">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 h-full flex flex-col p-6 space-y-8 bg-[#f5f5dc] w-64 border-r border-[#dac1bf]/15 z-40">
            <div class="flex flex-col space-y-2">
                <span class="font-headline text-xl font-bold text-primary">The Editorial Cellar</span>
                <div class="flex items-center space-x-3 mt-4 px-2 py-3 bg-surface-container-highest rounded-lg">
                    <div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center text-on-primary">
                        <span class="material-symbols-outlined">person</span>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-headline text-sm font-bold text-primary">Admin</span>
                        <span class="font-body text-[10px] uppercase tracking-wider text-on-surface/60">Dashboard</span>
                    </div>
                </div>
            </div>

            <nav class="flex-1 flex flex-col space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-surface-variant text-primary font-bold' : 'text-on-surface/60 hover:bg-surface-variant/50' }} rounded-lg px-4 py-3 flex items-center space-x-3 transition-all duration-200">
                    <span class="material-symbols-outlined text-xl">dashboard</span>
                    <span class="font-body text-sm font-medium">Dashboard</span>
                </a>
                <a href="{{ route('admin.productos.index') }}" class="{{ request()->routeIs('admin.productos.*') ? 'bg-surface-variant text-primary font-bold' : 'text-on-surface/60 hover:bg-surface-variant/50' }} rounded-lg px-4 py-3 flex items-center space-x-3 transition-all duration-200">
                    <span class="material-symbols-outlined text-xl">wine_bar</span>
                    <span class="font-body text-sm font-medium">Productos</span>
                </a>
                <a href="{{ route('admin.categorias.index') }}" class="{{ request()->routeIs('admin.categorias.*') ? 'bg-surface-variant text-primary font-bold' : 'text-on-surface/60 hover:bg-surface-variant/50' }} rounded-lg px-4 py-3 flex items-center space-x-3 transition-all duration-200">
                    <span class="material-symbols-outlined text-xl">category</span>
                    <span class="font-body text-sm font-medium">Categorías</span>
                </a>
                <a href="{{ route('admin.marcas.index') }}" class="{{ request()->routeIs('admin.marcas.*') ? 'bg-surface-variant text-primary font-bold' : 'text-on-surface/60 hover:bg-surface-variant/50' }} rounded-lg px-4 py-3 flex items-center space-x-3 transition-all duration-200">
                    <span class="material-symbols-outlined text-xl">sell</span>
                    <span class="font-body text-sm font-medium">Marcas</span>
                </a>
                <a href="{{ route('admin.variedades.index') }}" class="{{ request()->routeIs('admin.variedades.*') ? 'bg-surface-variant text-primary font-bold' : 'text-on-surface/60 hover:bg-surface-variant/50' }} rounded-lg px-4 py-3 flex items-center space-x-3 transition-all duration-200">
                    <span class="material-symbols-outlined text-xl">grass</span>
                    <span class="font-body text-sm font-medium">Variedades</span>
                </a>
            </nav>

            <a href="{{ url('/') }}" class="mt-auto bg-primary text-on-primary py-3 px-4 rounded-md font-body text-[0.75rem] uppercase tracking-widest font-bold hover:bg-primary-container transition-colors text-center shadow-sm">
                Volver a la Tienda
            </a>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 bg-surface overflow-y-auto custom-scrollbar">
            @if(session('success'))
                <div class="mx-10 mt-6 p-4 bg-primary-fixed text-primary rounded-lg font-body text-sm shadow-sm border border-outline-variant/10">
                    {{ session('success') }}
                </div>
            @endif

            <div class="px-10 py-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
