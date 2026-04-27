@extends('layouts.app')

@section('content')
<main>
<!-- Hero Section -->
<section class="relative h-[921px] flex items-center overflow-hidden bg-surface-container-low">
<div class="container mx-auto px-12 z-10 grid grid-cols-1 md:grid-cols-12 gap-12 items-center">
<div class="md:col-span-6">
<span class="font-label text-xs uppercase tracking-[0.3em] text-tertiary mb-6 block">Boutique de Selección</span>
<h1 class="font-headline text-primary text-6xl md:text-8xl leading-none mb-8 -ml-1">
                        Curaduría <br/><span class="italic">con Alma.</span>
</h1>
<p class="font-body text-lg text-on-surface-variant max-w-md leading-relaxed">
                        En La Última Botella no solo vendemos vino; recorremos las bodegas más exclusivas del mundo para encontrar esas piezas únicas que merecen un lugar en tu colección.
                    </p>
</div>
<div class="md:col-span-6 relative">
<div class="aspect-[3/4] w-full bg-surface-container-highest overflow-hidden rounded-lg shadow-[0_20px_40px_-15px_rgba(27,29,14,0.06)] transform rotate-2">
<img class="w-full h-full object-cover" data-alt="Cinematic close-up of a vintage wine bottle in a dusty candlelit stone cellar with soft amber backlighting and moody atmosphere" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA6lysfBeryigaP3EPQfLvg-Xxg_Hy50JofrdJVweT9lT05jrAYJ5yRUzMetBSvJh8RoZXsLLx2zyvgFfE-ItMUdfwvvUU_eRtHR0OvmibjNBzf14zmEaoFKtjqdtkTwtLuIsNAUDxwrIIGWr7nJZiae4oIPaX5L8nrR3IVkv44tv68iBGR8kIv_H-ZNh8mp0TAB1GMSaHvTqGi5KVfREGnhKTLhq8qorWJ_REpASgubzqjP98HbuwzjJbfVqFpfbrDuZE9rxpDIGLp"/>
</div>
<div class="absolute -bottom-12 -left-12 aspect-square w-64 bg-primary overflow-hidden rounded-lg shadow-[0_20px_40px_-15px_rgba(27,29,14,0.06)] transform -rotate-3 border-[12px] border-surface">
<img class="w-full h-full object-cover opacity-90" data-alt="Overhead view of sun-drenched vineyards during harvest season with rolling hills and warm golden morning light" src="https://lh3.googleusercontent.com/aida-public/AB6AXuA5tAWfmciXKBkJ_P_eEeW_dJ0lOkVbgG-VggXTjpU36EH4FjtsI-gcnvWWI0Q1B1z1oZ1sBgtU3FQMPae8-kfb58-wLWnP03YxuWFYBcG-_GeoMCQZ74q-sHhAUEUlKreWOjNGRldBvKLLaNuyOyToGGDIEJ6qJ8vFPXFYQOpfnjLBHDXMGS8dQzkiW-CnrM5gHSh66uMN3vBXuqFD3Tvf8Yg7mWGZis6P7GnaWfFFveBG3wSrqigEdCoL1RsU8Xg9F6OF_dW_9FoF"/>
</div>
</div>
</div>
</section>
<!-- The Philosophy -->
<section class="py-32 bg-surface">
<div class="container mx-auto px-12">
<div class="max-w-4xl mx-auto text-center">
<h2 class="font-headline text-4xl text-primary mb-12 italic">«No somos solo una tienda; somos el puente entre la bodega y tu copa.»</h2>
<div class="grid grid-cols-1 md:grid-cols-3 gap-16 text-left mt-24">
<div>
<h3 class="font-headline text-xl text-primary mb-4">El Origen</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed">Cada etiqueta en nuestro catálogo ha sido seleccionada tras un riguroso proceso de cata, asegurando autenticidad y excelencia desde su tierra natal.</p>
</div>
<div>
<h3 class="font-headline text-xl text-primary mb-4">La Excelencia</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed">Buscamos vinos que cuenten una historia. Desde pequeños productores independientes hasta las casas más prestigiosas del viejo mundo.</p>
</div>
<div>
<h3 class="font-headline text-xl text-primary mb-4">El Vínculo</h3>
<p class="font-body text-sm text-on-surface-variant leading-relaxed">Nuestra misión es educar y conectar. Facilitamos el acceso a botellas que de otro modo serían imposibles de encontrar en mercados convencionales.</p>
</div>
</div>
</div>
</div>
</section>
<!-- Large Editorial Break -->
<section class="h-[614px] relative overflow-hidden">
<img class="w-full h-full object-cover" data-alt="Panoramic view of a grand stone winery architecture at dusk with warm glowing windows and silhouettes of cypress trees" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDSS9Sdznr_JJw2ixxvreypojY_DkH5T4vY0E7LtaCYr4mwJl3yc3sbCisne9GP4o6Nx4ODmXp04Arg2nLChC77I2fNmXn26BHrOxLYs6K_WMwVcx29-Fchzvq6u7q9AAWXtsvEVpJFjwI2zx-lyow6VjP09NHSOO0snbErzRGITnOKOkvb1xhOse2S41xyE1kQI01YBxVfy7JirjNelHTYvFGxTUF0HTteM7PZl2h0obXUFezahs3z7SYDwum0k487425aJQDesmG4"/>
<div class="absolute inset-0 bg-primary/20 backdrop-brightness-75 flex items-center justify-center">
<div class="text-center">
<h2 class="font-headline text-white text-5xl md:text-7xl italic px-4">Corazón Tradicional, Paladar Moderno.</h2>
</div>
</div>
</section>
<!-- Our Process / The Cellar Today -->
<section class="py-32 bg-surface">
<div class="container mx-auto px-12 grid grid-cols-1 md:grid-cols-2 gap-24 items-center">
<div class="order-2 md:order-1">
<div class="relative">
<div class="aspect-[4/5] bg-surface-container-low rounded-lg overflow-hidden shadow-[0_20px_40px_-15px_rgba(27,29,14,0.06)]">
<img class="w-full h-full object-cover" data-alt="Rows of oak wine barrels in a dim cellar with dramatic lighting highlighting the wood grain and metal hoops" src="https://lh3.googleusercontent.com/aida-public/AB6AXuC3r2h7XKPkrrSxHPKSoTGcWQwenUGmS2bug8H8hDelLMf1PVjYb6EXcARFsdl8i-1bLMoaXBBYUqBdhDSR43P7uSZUBDcjBgs8HfJD4MCRNVUyl1XBSqtMddGXu1GqZR-Trcp8cBheZX3kuFa71rozqQ3TtJSl04avpxPudrUbDl-0gtq5OvGCboIgf-o15qm-KaFBacrlNwslhfvdBNz-LUusgRkapyv_xykgu1SQB_PCWrO-NFTUhrkqW0sQQ6hFAiRI5_ICMz4Y"/>
</div>
<div class="absolute -top-10 -right-10 bg-tertiary-fixed text-on-tertiary-fixed p-8 rounded-lg shadow-[0_20px_40px_-15px_rgba(27,29,14,0.06)]">
<p class="font-headline text-2xl italic">"Selección artesanal, <br/>corazón volcado."</p>
</div>
</div>
</div>
<div class="order-1 md:order-2">
                <span class="font-label text-xs uppercase tracking-widest text-secondary mb-6 block">Nuestra Misión</span>
                <h2 class="font-headline text-5xl text-primary mb-8 leading-tight">Seleccionando lo <br/>Inalcanzable.</h2>
                <p class="font-body text-lg text-on-surface-variant mb-12 leading-relaxed">
                    La Última Botella no es solo un catálogo, es una curaduría personal. Seleccionamos tirajes limitados y joyas ocultas de bodegas familiares, asegurando que cada botella que llega a tus manos sea una pieza de colección.
                </p>
                <div class="space-y-6">
                    <div class="flex items-center space-x-4 border-b border-outline-variant/20 pb-4">
                        <span class="material-symbols-outlined text-tertiary">workspace_premium</span>
                        <span class="font-body font-medium">Autenticidad Garantizada</span>
                    </div>
                    <div class="flex items-center space-x-4 border-b border-outline-variant/20 pb-4">
                        <span class="material-symbols-outlined text-tertiary">inventory_2</span>
                        <span class="font-body font-medium">Almacenamiento en Cava Privada</span>
                    </div>
                    <div class="flex items-center space-x-4 border-b border-outline-variant/20 pb-4">
                        <span class="material-symbols-outlined text-tertiary">local_shipping</span>
                        <span class="font-body font-medium">Logística de Guante Blanco</span>
                    </div>
                </div>
                    <a href="{{ url('/catalogo') }}" class="mt-12 inline-block px-10 py-5 bg-[#2a0002] text-white font-label text-xs uppercase tracking-[0.2em] rounded-md hover:bg-[#3d0003] transition-all active:scale-95 shadow-lg">
                        Ver Productos
                    </a>
</div>
</div>
</section>
</main>
@endsection
