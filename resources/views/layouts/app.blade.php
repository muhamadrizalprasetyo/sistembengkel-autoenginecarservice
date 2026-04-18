<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>AUTO ENGINE - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { -webkit-tap-highlight-color: transparent; scroll-behavior: smooth; }
        [x-cloak] { display: none !important; }
        .badge-bounce { animation: badgeBounce 1.5s ease-in-out infinite; }
        @keyframes badgeBounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.15); }
        }
    </style>
    @yield('extra_css')
</head>
<body class="bg-zinc-950 text-white font-sans pb-28 lg:pb-0">

    @php
        // Global notification counts for sidebar badges
        $pendingBookingsCount = \App\Models\Booking::where('status', 'pending')->count();
        $unreadFeedbackCount  = \App\Models\Feedback::where('is_read', false)->count();
    @endphp

    <div class="flex h-screen overflow-hidden">
        <aside class="w-72 bg-black border-r border-white/5 p-8 hidden lg:block">
            <div class="flex items-center justify-between mb-12">
                <div class="flex items-center space-x-3">
                    <div class="w-11 h-11 bg-red-600 rounded-2xl flex items-center justify-center font-black text-lg shadow-lg shadow-red-900/50">AE</div>
                    <div>
                        <h1 class="text-xs uppercase tracking-[0.3em] text-zinc-500 font-black">AUTO ENGINE</h1>
                        <p class="text-sm uppercase tracking-[0.15em] text-white font-black">SISTEM EKSEKUTIF</p>
                    </div>
                </div>
            </div>

            <nav class="space-y-2" x-data="{ openMore: false }">
                @php
                    $mainNavs = [
                        ['url' => '/', 'icon' => 'fa-th-large', 'label' => 'BERANDA', 'active' => Request::is('/')],
                        ['url' => '/kasir', 'icon' => 'fa-cash-register', 'label' => 'KASIR', 'active' => Request::is('kasir*')],
                        ['url' => '/items', 'icon' => 'fa-boxes', 'label' => 'STOK', 'active' => Request::is('items*')],
                    ];
                @endphp

                @foreach($mainNavs as $nav)
                <a href="{{ $nav['url'] }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border transition-all duration-200 {{ $nav['active'] ? 'bg-red-600 text-white border-red-500 shadow-lg shadow-red-900/40' : 'text-zinc-400 border-transparent hover:border-white/5 hover:bg-zinc-900' }}">
                    <i class="fas {{ $nav['icon'] }} {{ $nav['active'] ? 'text-white' : 'text-red-600' }}"></i>
                    <span>{{ $nav['label'] }}</span>
                </a>
                @endforeach

                <!-- Bookings with badge -->
                <a href="/admin/bookings" class="flex items-center justify-between px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border transition-all duration-200 {{ Request::is('admin/bookings*') ? 'bg-red-600 text-white border-red-500 shadow-lg shadow-red-900/40' : 'text-zinc-400 border-transparent hover:border-white/5 hover:bg-zinc-900' }}">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-calendar-check {{ Request::is('admin/bookings*') ? 'text-white' : 'text-red-600' }}"></i>
                        RESERVASI
                    </span>
                    @if($pendingBookingsCount > 0)
                    <span class="badge-bounce inline-flex items-center justify-center w-5 h-5 rounded-full bg-orange-500 text-white text-[9px] font-black shadow-[0_0_10px_rgba(255,94,0,0.5)]">
                        {{ $pendingBookingsCount > 9 ? '9+' : $pendingBookingsCount }}
                    </span>
                    @endif
                </a>

                <!-- Feedback with badge -->
                <a href="/admin/feedbacks" class="flex items-center justify-between px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border transition-all duration-200 {{ Request::is('admin/feedbacks*') ? 'bg-red-600 text-white border-red-500 shadow-lg shadow-red-900/40' : 'text-zinc-400 border-transparent hover:border-white/5 hover:bg-zinc-900' }}">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-comment-dots {{ Request::is('admin/feedbacks*') ? 'text-white' : 'text-red-600' }}"></i>
                        FEEDBACK
                    </span>
                    @if($unreadFeedbackCount > 0)
                    <span class="badge-bounce inline-flex items-center justify-center w-5 h-5 rounded-full bg-purple-500 text-white text-[9px] font-black shadow-[0_0_10px_rgba(191,0,255,0.5)]">
                        {{ $unreadFeedbackCount > 9 ? '9+' : $unreadFeedbackCount }}
                    </span>
                    @endif
                </a>

                <!-- Landing Page Link -->
                <a href="/landing" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border transition-all duration-200 text-zinc-400 border-transparent hover:border-white/5 hover:bg-zinc-900">
                    <i class="fas fa-globe text-orange-500"></i>
                    <span>LANDING PAGE</span>
                </a>

                <div class="relative">
                    <button @click="openMore = !openMore" class="w-full flex items-center justify-between space-x-3 px-4 py-3 rounded-xl border border-transparent text-[10px] font-black uppercase tracking-[0.2em] text-zinc-400 hover:text-zinc-200 hover:border-white/5 hover:bg-zinc-900 transition-all duration-200">
                        <span class="flex items-center gap-3">
                            <i class="fas fa-ellipsis-h text-red-600"></i>
                            <span>LAINNYA</span>
                        </span>
                        <i class="fas fa-chevron-down text-zinc-500 text-[10px] transition-transform" :class="{ 'rotate-180': openMore }"></i>
                    </button>

                    <div x-cloak x-show="openMore" @click.outside="openMore = false" x-transition class="mt-2 rounded-xl border border-white/5 bg-zinc-950 overflow-hidden">
                        @php
                            $moreMenus = [
                                ['icon' => 'fa-chart-line', 'label' => 'Laporan Keuangan', 'url' => '/reports', 'active' => Request::is('reports*')],
                                ['icon' => 'fa-users', 'label' => 'Data Pelanggan', 'url' => '/customers', 'active' => Request::is('customers*')],
                                ['icon' => 'fa-receipt', 'label' => 'Riwayat & Struk', 'url' => '/riwayat-struk', 'active' => Request::is('riwayat-struk*')],
                            ];
                        @endphp
                        @foreach($moreMenus as $menu)
                        <a href="{{ $menu['url'] }}" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.16em] transition-all duration-200 {{ $menu['active'] ? 'bg-red-600 text-white' : 'text-zinc-400 hover:bg-zinc-900 hover:text-red-500' }}">
                            <i class="fas {{ $menu['icon'] }} {{ $menu['active'] ? 'text-white' : 'text-red-600' }}"></i>
                            <span>{{ $menu['label'] }}</span>
                        </a>
                        @endforeach
                    </div>
                </div>
            </nav>
        </aside>

        <div class="flex-1 overflow-y-auto p-5 md:p-10 custom-scrollbar">
            @yield('content')
        </div>
    </div>

    <!-- Mobile Bottom Nav -->
    <div class="lg:hidden fixed bottom-6 left-6 right-6 bg-black/90 backdrop-blur-xl border border-white/5 px-4 py-4 rounded-[2.5rem] flex justify-between items-center z-50 shadow-2xl" x-data="{ openMoreMobile: false }">
        <a href="/" class="flex flex-col items-center {{ Request::is('/') ? 'text-red-600' : 'text-zinc-500 hover:text-white' }}">
            <i class="fas fa-th-large text-xl transition-transform active:scale-90"></i>
            <span class="text-[10px] font-black uppercase mt-1 tracking-wider">Beranda</span>
        </a>
        <a href="/kasir" class="flex flex-col items-center {{ Request::is('kasir*') ? 'text-red-600' : 'text-zinc-500 hover:text-white' }}">
            <i class="fas fa-cash-register text-xl transition-transform active:scale-90"></i>
            <span class="text-[10px] font-black uppercase mt-1 tracking-wider">Kasir</span>
        </a>
        <a href="/admin/bookings" class="flex flex-col items-center relative {{ Request::is('admin/bookings*') ? 'text-red-600' : 'text-zinc-500 hover:text-white' }}">
            <i class="fas fa-calendar-check text-xl transition-transform active:scale-90"></i>
            @if($pendingBookingsCount > 0)
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-orange-500 rounded-full text-[8px] font-black text-white flex items-center justify-center">{{ $pendingBookingsCount > 9 ? '9+' : $pendingBookingsCount }}</span>
            @endif
            <span class="text-[10px] font-black uppercase mt-1 tracking-wider">Booking</span>
        </a>
        <a href="/admin/feedbacks" class="flex flex-col items-center relative {{ Request::is('admin/feedbacks*') ? 'text-red-600' : 'text-zinc-500 hover:text-white' }}">
            <i class="fas fa-comment-dots text-xl transition-transform active:scale-90"></i>
            @if($unreadFeedbackCount > 0)
            <span class="absolute -top-1 -right-1 w-4 h-4 bg-purple-500 rounded-full text-[8px] font-black text-white flex items-center justify-center">{{ $unreadFeedbackCount > 9 ? '9+' : $unreadFeedbackCount }}</span>
            @endif
            <span class="text-[10px] font-black uppercase mt-1 tracking-wider">Feedback</span>
        </a>
        <div class="relative">
            <button @click="openMoreMobile = !openMoreMobile" class="flex flex-col items-center text-zinc-500 hover:text-white">
                <i class="fas fa-ellipsis-h text-xl transition-transform active:scale-90"></i>
                <span class="text-[10px] font-black uppercase mt-1 tracking-wider">Lainnya</span>
            </button>
            <div x-cloak x-show="openMoreMobile" @click.outside="openMoreMobile = false" x-transition class="absolute bottom-14 right-0 w-56 rounded-xl border border-white/5 bg-zinc-950 overflow-hidden shadow-2xl">
                <a href="/items" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.12em] {{ Request::is('items*') ? 'bg-red-600 text-white' : 'text-zinc-300 hover:bg-zinc-900 hover:text-red-500' }}">
                    <i class="fas fa-boxes text-red-600"></i> Stok
                </a>
                <a href="/reports" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.12em] {{ Request::is('reports*') ? 'bg-red-600 text-white' : 'text-zinc-300 hover:bg-zinc-900 hover:text-red-500' }}">
                    <i class="fas fa-chart-line text-red-600"></i> Laporan Keuangan
                </a>
                <a href="/customers" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.12em] {{ Request::is('customers*') ? 'bg-red-600 text-white' : 'text-zinc-300 hover:bg-zinc-900 hover:text-red-500' }}">
                    <i class="fas fa-users text-red-600"></i> Data Pelanggan
                </a>
                <a href="/riwayat-struk" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.12em] {{ Request::is('riwayat-struk*') ? 'bg-red-600 text-white' : 'text-zinc-300 hover:bg-zinc-900 hover:text-red-500' }}">
                    <i class="fas fa-receipt text-red-600"></i> Riwayat & Struk
                </a>
                <a href="/landing" class="flex items-center gap-3 px-4 py-3 text-[10px] font-black uppercase tracking-[0.12em] text-zinc-300 hover:bg-zinc-900 hover:text-orange-400">
                    <i class="fas fa-globe text-orange-500"></i> Landing Page
                </a>
            </div>
        </div>
    </div>

    @yield('extra_js')
</body>
</html>