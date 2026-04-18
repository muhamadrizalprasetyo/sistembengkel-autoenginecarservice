<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTO ENGINE | Bengkel &amp; Sparepart Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&family=Space+Grotesk:wght@300;500;700&display=swap');

        :root {
            --drift-red: #e60000;
            --drift-dark: #050505;
        }

        body { 
            font-family: 'Space Grotesk', sans-serif; 
            background-color: var(--drift-dark); 
            color: #fff; 
            overflow-x: hidden; 
        }

        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-zinc-950 text-white min-h-screen">

    <!-- Sidebar Premium Dark/Red -->
    <aside class="fixed top-0 left-0 h-full w-[250px] bg-black border-r-2 border-zinc-800 z-50 flex flex-col shadow-2xl">
        <div class="flex items-center px-6 py-8 border-b border-zinc-800 mb-6">
            <div class="bg-red-600 p-2 rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-car-burst text-white text-2xl"></i>
            </div>
            <span class="font-drift text-xl tracking-widest italic">AUTO ENGINE</span>
        </div>
        @php
            $currentRoute = request()->path();
        @endphp
        <nav class="flex-1">
            <ul class="space-y-2 px-2">
                <li>
                    <a href="/" 
                        class="flex items-center gap-3 px-4 py-3 rounded-md
                               text-[10px] font-black uppercase tracking-[0.14em]
                               transition
                               {{ $currentRoute === '/' ? 'bg-red-600 text-white' : 'hover:bg-zinc-900 text-zinc-300' }}">
                        <i class="fas fa-th-large {{ $currentRoute === '/' ? 'text-white' : 'text-red-600' }}"></i>
                        BERANDA
                    </a>
                </li>
                <li>
                    <a href="/kasir"
                       class="flex items-center gap-3 px-4 py-3 rounded-md
                              text-[10px] font-black uppercase tracking-[0.14em]
                              transition
                              {{ Str::startsWith($currentRoute, 'kasir') ? 'bg-red-600 text-white' : 'hover:bg-zinc-900 text-zinc-300' }}">
                        <i class="fas fa-cash-register {{ Str::startsWith($currentRoute, 'kasir') ? 'text-white' : 'text-red-600' }}"></i>
                        KASIR
                    </a>
                </li>
                <li>
                    <a href="/items"
                       class="flex items-center gap-3 px-4 py-3 rounded-md
                              text-[10px] font-black uppercase tracking-[0.14em]
                              transition
                              {{ Str::startsWith($currentRoute, 'items') ? 'bg-red-600 text-white' : 'hover:bg-zinc-900 text-zinc-300' }}">
                        <i class="fas fa-boxes {{ Str::startsWith($currentRoute, 'items') ? 'text-white' : 'text-red-600' }}"></i>
                        STOK
                    </a>
                </li>
                <!-- Lainnya Dropdown -->
                <li x-data="{open: false}" class="relative">
                    <button 
                        @click="open=!open" 
                        class="flex items-center w-full gap-3 px-4 py-3 rounded-md
                               text-[10px] font-black uppercase tracking-[0.14em]
                               transition
                               hover:bg-zinc-900 text-zinc-300 justify-between">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-ellipsis-h text-red-600"></i>
                            LAINNYA
                        </span>
                        <i class="fas fa-chevron-down text-zinc-500 text-[10px] transition-transform" :class="{ 'rotate-180': open }"></i>
                    </button>
                    <ul x-show="open" @click.outside="open=false" x-transition
                        class="absolute left-0 mt-1 w-full bg-zinc-950 border border-zinc-800 rounded-md shadow-xl z-20">
                        <li>
                            <a href="/reports" class="flex items-center gap-3 px-4 py-3 rounded-md text-[10px] font-black uppercase tracking-[0.12em] transition hover:bg-zinc-900 hover:text-red-500 text-zinc-300">
                                <i class="fas fa-chart-line text-red-600"></i>
                                Laporan Keuangan
                            </a>
                        </li>
                        <li>
                            <a href="/customers" class="flex items-center gap-3 px-4 py-3 rounded-md text-[10px] font-black uppercase tracking-[0.12em] transition hover:bg-zinc-900 hover:text-red-500 text-zinc-300">
                                <i class="fas fa-users text-red-600"></i>
                                Data Pelanggan
                            </a>
                        </li>
                        <li>
                            <a href="/riwayat-struk" class="flex items-center gap-3 px-4 py-3 rounded-md text-[10px] font-black uppercase tracking-[0.12em] transition hover:bg-zinc-900 hover:text-red-500 text-zinc-300">
                                <i class="fas fa-receipt text-red-600"></i>
                                Riwayat &amp; Struk
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div class="mt-auto px-6 py-6 border-t border-zinc-800 text-zinc-600 text-[10px] text-center tracking-widest">
            &copy; {{ date('Y') }} AUTO ENGINE
        </div>
    </aside>

    <!-- Content Overlay (for future mobile/sidebar) -->
    <div class="ml-[250px] min-h-screen bg-zinc-950">
        <!-- Content goes here -->
    </div>

    <script src="https://unpkg.com/alpinejs@3.13.0/dist/cdn.min.js"></script>
</body>
</html>