<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Editorial Cellar</title>
    
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
    <!-- TopNavBar -->
    <nav class="flex justify-between items-center px-12 py-6 w-full sticky top-0 z-50 bg-[#e4e4cc]/70 backdrop-blur-3xl transition-all">
        <div class="flex items-center space-x-12">
            <span class="font-['Noto_Serif'] text-2xl font-bold italic text-[#2a0002]">The Editorial Cellar</span>
            <div class="hidden md:flex space-x-8 font-['Noto_Serif'] text-lg tracking-tight">
                <a class="text-[#2a0002] border-b-2 border-[#735c00] pb-1" href="{{ url('/') }}">The Cellar</a>
                <a class="text-[#1b1d0e]/70 hover:text-[#2a0002] transition-colors duration-300" href="{{ route('admin.dashboard') }}">Admin Panel</a>
            </div>
        </div>
        <div class="flex items-center space-x-6">
            <button class="material-symbols-outlined text-[#2a0002] hover:opacity-80 active:scale-95 transition-all" data-icon="shopping_bag">shopping_bag</button>
            <button class="material-symbols-outlined text-[#2a0002] hover:opacity-80 active:scale-95 transition-all" data-icon="person">person</button>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="w-full py-20 px-12 flex flex-col items-center space-y-8 bg-[#fbfbe2] border-t border-[#dac1bf]/15">
        <div class="font-['Noto_Serif'] text-lg italic text-[#2a0002]">The Editorial Cellar</div>
        <div class="font-['Manrope'] text-[0.75rem] uppercase tracking-widest text-[#1b1d0e]/50">
            © 2024 The Editorial Cellar. Crafted for the Patient Palate.
        </div>
    </footer>
</body>
</html>
