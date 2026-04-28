@extends('layouts.app')

@section('content')
<main class="flex min-h-screen px-12 pt-12 pb-24 gap-16">
    <!-- Filter Sidebar -->
    <aside class="w-64 flex-shrink-0 space-y-12">
        <header>
            <h2 class="font-headline text-2xl text-primary font-bold">Curate Your View</h2>
            <p class="text-xs font-label uppercase tracking-widest text-secondary mt-2 opacity-70">Filtering the cellar</p>
        </header>
        <!-- Variety Filter -->
        <section class="space-y-4">
            <h3 class="font-headline text-lg italic border-b border-outline-variant/15 pb-2">Grape Variety</h3>
            <div class="flex flex-col space-y-2">
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <div class="w-4 h-4 border border-outline-variant group-hover:border-tertiary rounded-sm transition-colors"></div>
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">Cabernet Sauvignon</span>
                </label>
                <label class="flex items-center space-x-3 cursor-pointer group">
                    <div class="w-4 h-4 border border-outline-variant group-hover:border-tertiary rounded-sm transition-colors"></div>
                    <span class="text-sm font-medium text-on-surface/80 group-hover:text-primary">Merlot</span>
                </label>
            </div>
        </section>
    </aside>

    <!-- Product Grid -->
    <section class="flex-grow">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h1 class="font-headline text-4xl text-primary font-bold tracking-tight">The Cellar Collection</h1>
                <p class="text-on-surface/60 mt-2 font-headline italic">127 curated expressions from the 2018-2022 vintages.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-y-16 gap-x-8">
            <!-- Fetching from DB in the future, for now static example from your mockup -->
            <article class="flex flex-col space-y-4 group">
                <div class="aspect-[3/4] bg-surface-container-low overflow-hidden rounded-lg relative p-6 flex items-center justify-center">
                    <img alt="Red Wine" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzX7Qe2Aq9X8x8qqn-yc17CP5gc0sBn1pNV58Zxy_pVZjM0q5RGzghMyk-dWHKPrk-3H3fxRLh0408RzUq1yq9Qnbd_Bf5fN2uzPQTVGeaf7jN8ru2_1y2ODbjbDCQQbTGXjC2jeonHrpOr0k17TQ06amC0rIhKv0cGoTVGbgl-K_nF9ZCjnvi_b3jJSvscbRM0i-ETdtsgBHx86C8zXKMae-BrMVTxQ1bqia0OXWhAkQpjSq_uR0vsW1xTZsmzY1_9vrYvD2EW_e0"/>
                </div>
                <div class="space-y-1">
                    <h3 class="font-headline text-xl text-primary">Meridian Ridge Syrah</h3>
                    <div class="flex justify-between items-center text-xs text-on-surface/50 font-label uppercase tracking-wider">
                        <span>Sonoma Valley, 2020</span>
                        <span class="text-tertiary font-bold">$185.00</span>
                    </div>
                </div>
            </article>

            <article class="flex flex-col space-y-4 group">
                <div class="aspect-[3/4] bg-surface-container-low overflow-hidden rounded-lg relative p-6 flex items-center justify-center">
                    <img alt="White Wine" class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCTQgjd7vBKXO2yZ-CTMU_-_SK49sWhkL-7miB8n8MqDtrzWPTPkjJ00PbsEHK3sK5n17UKXTmKpFSI_b1vkIc6YCSe-Il_Zz7KpeNimuwOiGqVlUuBdJz-vpY5IhGgV6iqdeOCBx8WUCGZ1-hk5RIi71KYEsnxl4q9WAXEXYhZMTngl63779LP3_Jk36Q1JiJwtZdAuPnnuz9f5ucBH0O9AwF9IGE_gDR4ev6fGMiCqsSVGJhwM9_ve4DYEUvHt4UFOmo0-pCXq2vn"/>
                </div>
                <div class="space-y-1">
                    <h3 class="font-headline text-xl text-primary">Vidal Blanc 'L'Éclat'</h3>
                    <div class="flex justify-between items-center text-xs text-on-surface/50 font-label uppercase tracking-wider">
                        <span>Loire Valley, 2021</span>
                        <span class="text-tertiary font-bold">$85.00</span>
                    </div>
                </div>
            </article>
        </div>
    </section>
</main>
@endsection
