<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>AUTO ENGINE &mdash; @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdab/zgiXH+jfAVLELqO4E9P9MHStHXkANfm6MOT1uY3CLZX8xXBxkpEL+OC7BTYdJnQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Space Grotesk', sans-serif; background-color: #09090b; }
        [x-cloak] { display: none !important; }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #18181b; }
        ::-webkit-scrollbar-thumb { background: #3f3f46; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #f97316; }

        /* Sidebar active state */
        .nav-active {
            background: linear-gradient(90deg, rgba(249,115,22,0.15) 0%, rgba(249,115,22,0) 100%);
            border-left: 2px solid #f97316;
            color: #f97316 !important;
        }
        .nav-active i { color: #f97316 !important; }

        /* Neon glow badge */
        .badge-orange { animation: pulseOrange 2s ease-in-out infinite; }
        .badge-purple { animation: pulsePurple 2s ease-in-out infinite; }
        @keyframes pulseOrange {
            0%, 100% { box-shadow: 0 0 0 0 rgba(249,115,22,0.5); }
            50% { box-shadow: 0 0 0 5px rgba(249,115,22,0); }
        }
        @keyframes pulsePurple {
            0%, 100% { box-shadow: 0 0 0 0 rgba(168,85,247,0.5); }
            50% { box-shadow: 0 0 0 5px rgba(168,85,247,0); }
        }

        /* Card hover glow */
        .card-glow-orange:hover { box-shadow: 0 0 25px rgba(249,115,22,0.15); border-color: rgba(249,115,22,0.3) !important; }
        .card-glow-red:hover { box-shadow: 0 0 25px rgba(239,68,68,0.15); border-color: rgba(239,68,68,0.3) !important; }
        .card-glow-purple:hover { box-shadow: 0 0 25px rgba(168,85,247,0.15); border-color: rgba(168,85,247,0.3) !important; }
        .card-glow-green:hover { box-shadow: 0 0 25px rgba(34,197,94,0.15); border-color: rgba(34,197,94,0.3) !important; }
    </style>
    @yield('extra_css')
</head>
<body class="bg-zinc-950 text-gray-100 antialiased overflow-x-hidden">

    @php
        $pendingBookingsCount = \App\Models\Booking::where('status', 'pending')->count();
        $unreadFeedbackCount  = \App\Models\Feedback::where('is_read', false)->count();
        $currentPath = request()->path();

        $navLinks = [
            ['path' => '/',               'icon' => 'fa-gauge-high',        'label' => 'DASHBOARD',    'match' => fn($p) => $p === '/'],
            ['path' => '/kasir',          'icon' => 'fa-cash-register',     'label' => 'KASIR',        'match' => fn($p) => str_starts_with($p, 'kasir')],
            ['path' => '/items',          'icon' => 'fa-boxes-stacked',     'label' => 'STOK',         'match' => fn($p) => str_starts_with($p, 'items')],
            ['path' => '/admin/bookings', 'icon' => 'fa-calendar-check',   'label' => 'RESERVASI',    'match' => fn($p) => str_starts_with($p, 'admin/bookings'), 'badge' => $pendingBookingsCount, 'badge_color' => 'orange'],
            ['path' => '/admin/feedbacks','icon' => 'fa-comment-dots',      'label' => 'FEEDBACK',     'match' => fn($p) => str_starts_with($p, 'admin/feedbacks'), 'badge' => $unreadFeedbackCount, 'badge_color' => 'purple'],
        ];
        $moreLinks = [
            ['path' => '/reports',        'icon' => 'fa-chart-line',        'label' => 'Laporan Keuangan', 'match' => fn($p) => str_starts_with($p, 'reports')],
            ['path' => '/customers',      'icon' => 'fa-users',             'label' => 'Data Pelanggan',   'match' => fn($p) => str_starts_with($p, 'customers')],
            ['path' => '/riwayat-struk',  'icon' => 'fa-file-invoice',      'label' => 'Riwayat & Struk',  'match' => fn($p) => str_starts_with($p, 'riwayat-struk')],
        ];
    @endphp

    @php
        $openMoreDefault = false;
        foreach($moreLinks as $ml) {
            if($ml['match']($currentPath)) { $openMoreDefault = true; break; }
        }
    @endphp

    <div class="flex h-screen overflow-hidden">

        {{-- ===[ DESKTOP SIDEBAR ]=== --}}
        <aside class="w-[260px] flex-shrink-0 bg-zinc-900/60 backdrop-blur-md border-r border-white/8 hidden lg:flex flex-col">
            {{-- Logo --}}
            <div class="px-6 py-7 border-b border-white/5">
                <a href="/" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-700 rounded-xl flex items-center justify-center font-black text-base shadow-lg shadow-orange-900/40 flex-shrink-0">AE</div>
                    <div>
                        <p class="text-[9px] uppercase tracking-[0.35em] text-zinc-500 font-black leading-none mb-0.5">Auto Engine</p>
                        <p class="text-xs uppercase tracking-[0.18em] text-white font-black">Sistem Eksekutif</p>
                    </div>
                </a>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-5 space-y-1 overflow-y-auto" x-data="{ openMore: {{ $openMoreDefault ? 'true' : 'false' }} }">
                @foreach($navLinks as $nav)
                @php $isActive = $nav['match']($currentPath); @endphp
                <a href="{{ $nav['path'] }}"
                   class="group flex items-center justify-between px-3 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-[0.18em] transition-all duration-200 {{ $isActive ? 'nav-active' : 'text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/60 border-l-2 border-transparent' }}">
                    <span class="flex items-center gap-3">
                        <i class="fas {{ $nav['icon'] }} w-4 text-center {{ $isActive ? 'text-orange-500' : 'text-zinc-500 group-hover:text-zinc-300' }}"></i>
                        {{ $nav['label'] }}
                    </span>
                    @if(isset($nav['badge']) && $nav['badge'] > 0)
                    <span class="badge-{{ $nav['badge_color'] }} inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 rounded-full text-[9px] font-black {{ $nav['badge_color'] === 'orange' ? 'bg-orange-500 text-white' : 'bg-purple-600 text-white' }}">
                        {{ $nav['badge'] > 9 ? '9+' : $nav['badge'] }}
                    </span>
                    @endif
                </a>
                @endforeach

                {{-- More Dropdown --}}
                <div>
                    <button @click="openMore = !openMore"
                        class="group w-full flex items-center justify-between px-3 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-[0.18em] transition-all duration-200 text-zinc-400 hover:text-zinc-100 hover:bg-zinc-800/60 border-l-2 border-transparent">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-ellipsis-h w-4 text-center text-zinc-500 group-hover:text-zinc-300"></i>
                            LAINNYA
                        </span>
                        <i class="fas fa-chevron-down text-zinc-600 text-[9px] transition-transform duration-200" :class="{'rotate-180': openMore}"></i>
                    </button>
                    <div x-show="openMore" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="mt-1 ml-3 pl-3 border-l border-white/8 space-y-0.5">
                        @foreach($moreLinks as $menu)
                        @php $isActive = $menu['match']($currentPath); @endphp
                        <a href="{{ $menu['path'] }}"
                           class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-[11px] font-bold uppercase tracking-[0.14em] transition-all duration-200 {{ $isActive ? 'text-orange-400 bg-orange-500/10' : 'text-zinc-500 hover:text-zinc-100 hover:bg-zinc-800/50' }}">
                            <i class="fas {{ $menu['icon'] }} w-4 text-center {{ $isActive ? 'text-orange-400' : 'text-zinc-600' }}"></i>
                            {{ $menu['label'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Divider --}}
                <div class="pt-2 border-t border-white/5 mt-2">
                    <a href="/landing"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-[0.18em] transition-all duration-200 text-zinc-500 hover:text-orange-400 hover:bg-orange-500/5 border-l-2 border-transparent">
                        <i class="fas fa-globe w-4 text-center text-zinc-600 group-hover:text-orange-500"></i>
                        LANDING PAGE
                    </a>
                    <a href="/presentasi"
                       class="group flex items-center gap-3 px-3 py-2.5 rounded-xl text-[11px] font-black uppercase tracking-[0.18em] transition-all duration-200 text-zinc-500 hover:text-purple-400 hover:bg-purple-500/5 border-l-2 border-transparent">
                        <i class="fas fa-presentation-screen w-4 text-center text-zinc-600 group-hover:text-purple-400"></i>
                        PRESENTASI
                    </a>
                </div>
            </nav>

            {{-- Footer --}}
            <div class="px-5 py-4 border-t border-white/5">
                <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-600 font-black">&copy; {{ date('Y') }} Auto Engine</p>
            </div>
        </aside>

        {{-- ===[ MAIN CONTENT ]=== --}}
        <div class="flex-1 flex flex-col min-h-0 overflow-hidden">
            {{-- Top Bar --}}
            <header class="h-14 flex-shrink-0 flex items-center justify-between px-6 border-b border-white/5 bg-zinc-900/40 backdrop-blur-md">
                <div class="flex items-center gap-3">
                    {{-- Mobile logo --}}
                    <div class="lg:hidden w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-700 rounded-lg flex items-center justify-center font-black text-sm">AE</div>
                    <div>
                        <p class="text-xs font-black text-zinc-400 uppercase tracking-wider hidden sm:block">@yield('title', 'Dashboard')</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    {{-- Notification bells (desktop) --}}
                    <a href="/admin/bookings" class="relative hidden sm:flex items-center justify-center w-9 h-9 rounded-xl bg-zinc-800/60 hover:bg-zinc-700/60 border border-white/5 transition-colors">
                        <i class="fas fa-calendar-check text-sm text-zinc-400"></i>
                        @if($pendingBookingsCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 rounded-full text-[8px] font-black text-white flex items-center justify-center">{{ $pendingBookingsCount > 9 ? '9+' : $pendingBookingsCount }}</span>
                        @endif
                    </a>
                    <a href="/admin/feedbacks" class="relative hidden sm:flex items-center justify-center w-9 h-9 rounded-xl bg-zinc-800/60 hover:bg-zinc-700/60 border border-white/5 transition-colors">
                        <i class="fas fa-comment-dots text-sm text-zinc-400"></i>
                        @if($unreadFeedbackCount > 0)
                        <span class="absolute -top-1 -right-1 w-4 h-4 bg-purple-600 rounded-full text-[8px] font-black text-white flex items-center justify-center">{{ $unreadFeedbackCount > 9 ? '9+' : $unreadFeedbackCount }}</span>
                        @endif
                    </a>
                    {{-- Time --}}
                    <div class="hidden md:block text-right">
                        <p class="text-[9px] uppercase tracking-widest text-zinc-600 font-black">{{ now()->locale('id')->translatedFormat('l') }}</p>
                        <p class="font-mono text-xs text-zinc-400">{{ now()->format('d M Y') }}</p>
                    </div>
                </div>
            </header>

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto p-5 md:p-8 pb-28 lg:pb-8">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- ===[ MOBILE BOTTOM NAV ]=== --}}
    <div class="lg:hidden fixed bottom-0 left-0 right-0 z-50 bg-zinc-900/95 backdrop-blur-xl border-t border-white/8 px-2 py-3 safe-area-pb" x-data="{ openMobileMore: false }">
        <div class="flex items-center justify-around">
            {{-- Main nav items (4 most important) --}}
            @php $mobilePrimary = [
                ['path'=>'/','icon'=>'fa-gauge-high','label'=>'Dashboard','match'=>fn($p)=>$p==='/'],
                ['path'=>'/kasir','icon'=>'fa-cash-register','label'=>'Kasir','match'=>fn($p)=>str_starts_with($p,'kasir')],
                ['path'=>'/admin/bookings','icon'=>'fa-calendar-check','label'=>'Booking','match'=>fn($p)=>str_starts_with($p,'admin/bookings'),'badge'=>$pendingBookingsCount,'badge_color'=>'orange'],
                ['path'=>'/admin/feedbacks','icon'=>'fa-comment-dots','label'=>'Feedback','match'=>fn($p)=>str_starts_with($p,'admin/feedbacks'),'badge'=>$unreadFeedbackCount,'badge_color'=>'purple'],
            ]; @endphp

            @foreach($mobilePrimary as $mob)
            @php $isActive = $mob['match']($currentPath); @endphp
            <a href="{{ $mob['path'] }}" class="relative flex flex-col items-center gap-1 px-2 {{ $isActive ? 'text-orange-500' : 'text-zinc-500' }}">
                <i class="fas {{ $mob['icon'] }} text-lg"></i>
                @if(isset($mob['badge']) && $mob['badge'] > 0)
                <span class="absolute -top-0.5 right-0 w-4 h-4 {{ $mob['badge_color'] === 'orange' ? 'bg-orange-500' : 'bg-purple-600' }} rounded-full text-[8px] font-black text-white flex items-center justify-center">{{ $mob['badge'] > 9 ? '9+' : $mob['badge'] }}</span>
                @endif
                <span class="text-[9px] font-black uppercase tracking-wide">{{ $mob['label'] }}</span>
            </a>
            @endforeach

            {{-- More button --}}
            <div class="relative">
                <button @click="openMobileMore = !openMobileMore" class="flex flex-col items-center gap-1 px-2 text-zinc-500 hover:text-white">
                    <i class="fas fa-grid-2 text-lg"></i>
                    <span class="text-[9px] font-black uppercase tracking-wide">Lainnya</span>
                </button>
                <div x-show="openMobileMore" @click.outside="openMobileMore=false" x-cloak x-transition
                     class="absolute bottom-14 right-0 w-52 bg-zinc-900 border border-white/10 rounded-2xl overflow-hidden shadow-2xl">
                    @foreach(array_merge([['path'=>'/items','icon'=>'fa-boxes-stacked','label'=>'Stok'],['path'=>'/reports','icon'=>'fa-chart-line','label'=>'Laporan'],['path'=>'/customers','icon'=>'fa-users','label'=>'Pelanggan'],['path'=>'/riwayat-struk','icon'=>'fa-file-invoice','label'=>'Riwayat Struk'],['path'=>'/landing','icon'=>'fa-globe','label'=>'Landing Page']], []) as $m)
                    <a href="{{ $m['path'] }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-zinc-300 hover:bg-zinc-800 hover:text-orange-400 transition-colors">
                        <i class="fas {{ $m['icon'] }} w-4 text-zinc-500"></i> {{ $m['label'] }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @yield('extra_js')
</body>
</html>
