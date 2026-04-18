<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#09090b">
    <meta name="description" content="Auto Engine Car Service - Bengkel terpercaya: booking online, cek stok sparepart, konsultasi gratis via WhatsApp.">
    <title>AUTO ENGINE | Bengkel & Sparepart Terpercaya</title>

    {{-- Preconnect untuk performa font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font: hanya 2 weight yang dibutuhkan --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&family=Anton&display=swap" rel="stylesheet">

    {{-- FontAwesome: subset solid icons saja --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>

    <style>
        /* ===[ CSS VARIABLES & RESET ]=== */
        :root {
            --orange: #ff5e00;
            --purple: #bf00ff;
            --bg: #09090b;
            --glass: rgba(10,10,12,0.78);
            --border: rgba(255,255,255,0.07);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--bg);
            color: #e4e4e7;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* ===[ UTILITY CLASSES ]=== */
        .anton { font-family: 'Anton', sans-serif; letter-spacing: -0.02em; }

        /* Neon text */
        .neon-o { color: var(--orange); text-shadow: 0 0 18px rgba(255,94,0,.7), 0 0 35px rgba(255,94,0,.3); }
        .neon-p { color: var(--purple); text-shadow: 0 0 18px rgba(191,0,255,.7), 0 0 35px rgba(191,0,255,.3); }

        /* Glassmorphism */
        .glass {
            background: var(--glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--border);
        }

        /* ===[ HARDWARE-ACCELERATED ANIMATIONS ]=== */
        /* Use only transform + opacity — never width/margin/height */
        .lift {
            transition: transform 0.28s cubic-bezier(.2,.8,.2,1), box-shadow 0.28s ease;
            will-change: transform;
        }
        .lift:active { transform: scale(0.97); }
        @media (hover: hover) {
            .lift:hover { transform: translateY(-6px); }
        }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; padding: 0 1.75rem;
            background: var(--orange); border: 1px solid rgba(255,94,0,.6);
            color: #fff; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.875rem;
            border-radius: 0.875rem;
            box-shadow: 0 0 20px rgba(255,94,0,.3);
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
            will-change: transform;
            text-decoration: none;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-primary:active { transform: scale(0.96); }
        @media (hover: hover) {
            .btn-primary:hover { background: #ff7520; box-shadow: 0 0 35px rgba(255,94,0,.5); transform: translateY(-2px); }
        }

        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; padding: 0 1.75rem;
            background: transparent; border: 1.5px solid rgba(255,255,255,.15);
            color: #fff; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.875rem;
            border-radius: 0.875rem;
            transition: transform 0.2s ease, background 0.2s ease, border-color 0.2s ease;
            will-change: transform;
            text-decoration: none;
            cursor: pointer;
            -webkit-tap-highlight-color: transparent;
        }
        .btn-ghost:active { transform: scale(0.96); }
        @media (hover: hover) {
            .btn-ghost:hover { background: rgba(255,255,255,.06); border-color: rgba(255,255,255,.3); transform: translateY(-2px); }
        }

        /* ===[ FORM INPUTS — 16px prevents iOS zoom ]=== */
        .form-input {
            width: 100%;
            min-height: 52px;
            padding: 0 1rem;
            font-size: 16px; /* Critical: prevents iOS auto-zoom */
            font-family: inherit;
            background: rgba(0,0,0,.5);
            border: 1px solid #3f3f46;
            border-radius: 0.75rem;
            color: #fff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            -webkit-appearance: none;
            appearance: none;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 1px var(--orange), 0 0 12px rgba(255,94,0,.2);
        }
        .form-input.purple:focus {
            border-color: var(--purple);
            box-shadow: 0 0 0 1px var(--purple), 0 0 12px rgba(191,0,255,.2);
        }
        textarea.form-input { min-height: 120px; padding: 0.875rem 1rem; resize: vertical; }
        select.form-input { cursor: pointer; }

        /* ===[ SCROLLBAR ]=== */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 4px; }

        /* ===[ BADGE PULSE ]=== */
        @keyframes pulse-ring {
            0%, 100% { box-shadow: 0 0 0 0 rgba(255,94,0,.5); }
            50% { box-shadow: 0 0 0 6px rgba(255,94,0,0); }
        }
        .pulse-ring { animation: pulse-ring 2s ease-in-out infinite; }

        /* ===[ STOCK STATUS ANIMATION — Low Stock ]=== */
        @keyframes stock-warn {
            0%, 100% { border-color: rgba(239,68,68,.25); }
            50% { border-color: rgba(239,68,68,.7); box-shadow: 0 0 16px rgba(239,68,68,.25); }
        }
        .stock-low { animation: stock-warn 1.8s ease-in-out infinite; }

        /* ===[ HERO ORBS — GPU composited ]=== */
        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(80px);
            will-change: transform, opacity;
            pointer-events: none;
        }

        /* ===[ BOTTOM NAV SAFE AREA ]=== */
        .bottom-nav-pad { padding-bottom: calc(72px + env(safe-area-inset-bottom, 0px)); }

        /* ===[ MOBILE BOTTOM NAVIGATION ]=== */
        .bottom-nav {
            position: fixed; bottom: 0; left: 0; right: 0; z-index: 50;
            background: rgba(9,9,11,.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid var(--border);
            padding: 10px 0 calc(10px + env(safe-area-inset-bottom, 0px));
            display: flex; justify-content: space-around; align-items: center;
        }
        .bottom-nav a {
            display: flex; flex-direction: column; align-items: center; gap: 4px;
            min-width: 48px; min-height: 48px; justify-content: center;
            color: #71717a; font-size: 9px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em;
            text-decoration: none; transition: color 0.2s ease;
            -webkit-tap-highlight-color: transparent;
        }
        .bottom-nav a.active, .bottom-nav a:active { color: var(--orange); }
        .bottom-nav i { font-size: 1.2rem; }

        /* ===[ DESKTOP NAVBAR — hidden on mobile ]=== */
        .desktop-nav { display: none; }
        @media (min-width: 768px) {
            .desktop-nav { display: flex; }
            .bottom-nav { display: none; }
            .bottom-nav-pad { padding-bottom: 0; }
        }
    </style>
</head>
<body class="bottom-nav-pad">

    {{-- ===[ DESKTOP NAVBAR — hidden on mobile ]=== --}}
    <header class="desktop-nav fixed top-0 left-0 right-0 z-50 glass border-b border-white/5">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center w-full">
            <a href="/landing" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-orange-500 to-orange-700 rounded-xl flex items-center justify-center font-black text-sm shadow-lg shadow-orange-900/40">AE</div>
                <span class="text-lg font-black tracking-tighter uppercase italic text-white">Auto<span class="neon-o">Engine</span></span>
            </a>
            <nav class="flex items-center gap-6 text-xs font-black uppercase tracking-widest">
                <a href="#stok" class="text-zinc-400 hover:text-white transition-colors">Suku Cadang</a>
                <a href="#konsultasi" class="text-zinc-400 hover:text-white transition-colors">Konsultasi</a>
                <a href="#booking" class="text-zinc-400 hover:text-white transition-colors">Reservasi</a>
                <a href="/presentasi" class="btn-primary !min-h-[38px] !py-0 !text-xs">
                    <i class="fas fa-presentation-screen"></i> Presentasi
                </a>
            </nav>
        </div>
    </header>

    {{-- ===[ MOBILE BOTTOM NAV ]=== --}}
    <nav class="bottom-nav md:hidden" aria-label="Navigasi utama">
        <a href="#hero" class="active"><i class="fas fa-house"></i>Beranda</a>
        <a href="#stok"><i class="fas fa-boxes-stacked"></i>Stok</a>
        <a href="#konsultasi"><i class="fab fa-whatsapp"></i>Konsultasi</a>
        <a href="#booking"><i class="fas fa-calendar-check"></i>Booking</a>
        <a href="/presentasi"><i class="fas fa-tv"></i>Slide</a>
    </nav>

    <main>
        {{-- ===[ HERO ]=== --}}
        <section id="hero" class="relative min-h-[100svh] flex items-center justify-center pt-20 md:pt-28 pb-6 overflow-hidden">
            {{-- Background orbs — GPU composited --}}
            <div class="orb w-72 h-72 md:w-96 md:h-96 bg-orange-600/20 top-1/4 left-1/4 opacity-60"></div>
            <div class="orb w-52 h-52 bg-purple-600/15 bottom-1/4 right-1/4 opacity-50"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 via-zinc-950 to-zinc-950 z-0"></div>

            <div class="relative z-10 w-full max-w-5xl mx-auto px-5 text-center">
                {{-- Status pill --}}
                <div class="inline-flex items-center gap-2 px-4 py-2 glass rounded-full mb-6 md:mb-8 cursor-default">
                    <span class="w-2 h-2 rounded-full bg-orange-500 pulse-ring flex-shrink-0"></span>
                    <span class="text-xs font-black uppercase tracking-widest text-orange-400">Aktif Melayani Sekarang</span>
                </div>

                {{-- Headline — Mobile: 4xl, Desktop: 9xl  --}}
                <h1 class="anton text-5xl sm:text-7xl md:text-9xl leading-none uppercase mb-4 md:mb-6">
                    <span class="block text-white">KINERJA</span>
                    <span class="block neon-p">MAKSIMAL</span>
                    <span class="block text-3xl sm:text-5xl md:text-7xl text-white mt-2">KETEPATAN</span>
                    <span class="block text-3xl sm:text-5xl md:text-7xl text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-yellow-400 to-orange-600">AGRESIF</span>
                </h1>

                <p class="text-base md:text-xl text-zinc-400 max-w-2xl mx-auto mb-8 md:mb-12 leading-relaxed">
                    Perawatan mesin dengan teknologi terkini. Kami pastikan kendaraan Anda selalu dalam performa terbaik — dari jalanan kota hingga lintasan pacu.
                </p>

                {{-- CTA Buttons — full width on mobile --}}
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="#booking" class="btn-primary w-full sm:w-auto">
                        <i class="fas fa-flag-checkered"></i> Reservasi Segera
                    </a>
                    <a href="#stok" class="btn-ghost w-full sm:w-auto">
                        <i class="fas fa-boxes-stacked"></i> Cek Stok
                    </a>
                </div>

                {{-- Stats bar --}}
                <div class="mt-12 md:mt-16 grid grid-cols-3 gap-4 max-w-sm md:max-w-xl mx-auto">
                    <div class="text-center">
                        <p class="text-2xl md:text-3xl font-black text-orange-400">500+</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-600 mt-1 font-bold">Ditangani</p>
                    </div>
                    <div class="text-center border-x border-white/8">
                        <p class="text-2xl md:text-3xl font-black text-purple-400">{{ $allSpareparts->count() }}</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-600 mt-1 font-bold">Sparepart</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl md:text-3xl font-black text-orange-400">24/7</p>
                        <p class="text-[10px] uppercase tracking-widest text-zinc-600 mt-1 font-bold">Konsultasi</p>
                    </div>
                </div>
            </div>

            {{-- Scroll indicator --}}
            <div class="hidden md:block absolute bottom-6 left-1/2 -translate-x-1/2 text-center opacity-40 animate-bounce">
                <span class="text-[10px] uppercase tracking-widest text-zinc-500 font-bold block mb-1">Scroll</span>
                <i class="fas fa-chevron-down text-orange-500 text-xs"></i>
            </div>
        </section>

        {{-- ===[ LIVE STOCK ]=== --}}
        <section id="stok" class="py-16 md:py-28 bg-zinc-950 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-5">
                {{-- Section header + search --}}
                <div class="mb-8 md:mb-12">
                    <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-[.3em] text-orange-500 mb-2">Live Inventory</p>
                            <h2 class="text-3xl md:text-5xl font-black uppercase italic leading-tight">
                                Suku Cadang <span class="neon-p">Premium</span>
                            </h2>
                            <p class="text-zinc-500 text-sm mt-2">Stok real-time langsung dari database bengkel.</p>
                        </div>
                        {{-- Search --}}
                        <form method="GET" action="/landing#stok" class="flex gap-2 w-full md:w-80">
                            <div class="relative flex-1">
                                <i class="fas fa-magnifying-glass absolute left-3.5 top-1/2 -translate-y-1/2 text-zinc-500 text-sm pointer-events-none"></i>
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari sparepart..."
                                    autocomplete="off"
                                    class="form-input pl-10">
                            </div>
                            <button type="submit" class="btn-primary !px-4 !min-h-[52px]" aria-label="Cari">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                            <a href="/landing#stok" class="btn-ghost !px-3 !min-h-[52px]" aria-label="Hapus pencarian">
                                <i class="fas fa-xmark"></i>
                            </a>
                            @endif
                        </form>
                    </div>

                    @if(request('search'))
                    <p class="mt-3 text-sm text-zinc-500">
                        Hasil untuk: <span class="text-orange-400 font-bold">"{{ request('search') }}"</span> — {{ $spareparts->count() }} item
                    </p>
                    @endif
                </div>

                {{-- Grid: 1 col mobile → 2 col sm → 4 col lg --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
                    @forelse($spareparts as $index => $item)
                    <article class="glass rounded-2xl p-5 lift {{ $item->stock !== null && $item->stock <= 3 ? 'stock-low' : 'hover:border-orange-500/40' }} active:scale-95 transition-transform">
                        {{-- Stock icon visual --}}
                        <div class="h-28 mb-4 rounded-xl bg-gradient-to-br from-zinc-900 to-black border border-zinc-800 flex items-center justify-center overflow-hidden">
                            @php
                                $icons = ['oli'=>'fa-oil-can','mesin'=>'fa-engine','ban'=>'fa-circle','rem'=>'fa-circle-stop','lampu'=>'fa-lightbulb','aki'=>'fa-car-battery','filter'=>'fa-filter','busi'=>'fa-bolt'];
                                $iconKey = collect(array_keys($icons))->first(fn($k) => str_contains(strtolower($item->name), $k));
                                $icon = $iconKey ? $icons[$iconKey] : 'fa-gear';
                            @endphp
                            <i class="fas {{ $icon }} text-4xl text-zinc-700"></i>
                        </div>
                        {{-- Category badge --}}
                        <span class="inline-block text-[9px] bg-purple-900/40 text-purple-300 px-2 py-0.5 rounded-md font-black uppercase tracking-widest border border-purple-500/20 mb-2">
                            {{ $item->category }}
                        </span>
                        <h3 class="text-sm font-bold text-white leading-snug mb-3">{{ $item->name }}</h3>
                        <div class="flex items-end justify-between mt-auto">
                            <div>
                                <p class="text-[9px] text-zinc-600 font-black uppercase mb-0.5">Harga</p>
                                <p class="text-sm font-black text-orange-400">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-[9px] text-zinc-600 font-black uppercase mb-0.5">Stok</p>
                                <p class="text-sm font-black {{ $item->stock <= 3 ? 'text-red-400' : ($item->stock <= 10 ? 'text-yellow-400' : 'text-green-400') }}">
                                    {{ $item->stock ?? '∞' }}
                                </p>
                            </div>
                        </div>
                        @if($item->stock !== null && $item->stock <= 3)
                        <p class="mt-2 text-[9px] font-black uppercase tracking-widest text-red-400 flex items-center gap-1">
                            <i class="fas fa-triangle-exclamation fa-xs"></i> Stok Hampir Habis
                        </p>
                        @endif
                    </article>
                    @empty
                    <div class="col-span-full text-center py-16">
                        <i class="fas fa-ghost text-4xl text-zinc-700 block mb-3"></i>
                        <p class="text-zinc-500 font-bold uppercase tracking-widest text-sm">
                            @if(request('search')) Tidak ada hasil untuk "{{ request('search') }}"
                            @else Belum ada stok tersedia.
                            @endif
                        </p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- ===[ KONSULTASI ]=== --}}
        <section id="konsultasi" class="py-16 md:py-28 bg-gradient-to-b from-zinc-950 to-black">
            <div class="max-w-2xl mx-auto px-5">
                <article class="glass rounded-3xl p-8 md:p-12 text-center relative overflow-hidden">
                    <div class="orb w-48 h-48 bg-green-500/8 -right-12 -top-12 opacity-100"></div>

                    <div class="relative z-10">
                        <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 rounded-2xl bg-green-500/10 border border-green-500/20 mb-5 mx-auto">
                            <i class="fab fa-whatsapp text-3xl md:text-4xl text-green-400"></i>
                        </div>
                        <p class="text-[10px] font-black uppercase tracking-[.3em] text-green-400 mb-2">Gratis</p>
                        <h2 class="text-3xl md:text-5xl font-black uppercase italic text-white mb-3">
                            Tanya Langsung <span style="color:#25D366;text-shadow:0 0 18px rgba(37,211,102,.5)">Mekanik</span>
                        </h2>
                        <p class="text-zinc-400 text-sm md:text-base leading-relaxed mb-8">
                            Punya pertanyaan soal kendaraan Anda? Hubungi langsung via WhatsApp — cepat, responsif, gratis.
                        </p>

                        <a href="https://wa.me/6281234567890?text=Halo%20Auto%20Engine!%20Saya%20ingin%20konsultasi." target="_blank" rel="noopener"
                            class="w-full block text-center min-h-[52px] leading-[52px] rounded-xl font-black uppercase tracking-widest text-sm text-white mb-4"
                            style="background:#25D366;box-shadow:0 0 20px rgba(37,211,102,.25)">
                            <i class="fab fa-whatsapp mr-2"></i> Chat WhatsApp
                        </a>
                        <a href="#booking" class="btn-ghost w-full">
                            <i class="fas fa-calendar-check"></i> Atau Buat Janji
                        </a>

                        {{-- Quick chips --}}
                        <div class="mt-6 flex flex-wrap gap-2 justify-center">
                            @foreach(['Ganti Oli','Tune Up','Cek Rem','Servis AC','Kaki-Kaki'] as $q)
                            <a href="https://wa.me/6281234567890?text=Saya+mau+tanya+soal+{{ urlencode($q) }}" target="_blank" rel="noopener"
                                class="px-3 py-1.5 min-h-[36px] flex items-center glass rounded-full text-xs font-bold text-zinc-400 hover:text-green-400 transition-colors">
                                {{ $q }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                </article>
            </div>
        </section>

        {{-- ===[ BOOKING FORM ]=== --}}
        <section id="booking" class="py-16 md:py-28 bg-black border-t border-white/5">
            <div class="max-w-2xl mx-auto px-5">
                <header class="text-center mb-8 md:mb-12">
                    <p class="text-[10px] font-black uppercase tracking-[.3em] text-orange-500 mb-2">Online Booking</p>
                    <h2 class="text-3xl md:text-5xl font-black uppercase italic">
                        <span class="neon-o">Reservasi</span> Servis
                    </h2>
                    <p class="text-zinc-500 text-sm mt-3">Amankan slot servis Anda. Konfirmasi via WhatsApp.</p>
                </header>

                @if($errors->any())
                <div class="mb-5 p-4 bg-red-900/20 border border-red-500/30 rounded-xl text-red-300 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ url('/landing/store-booking') }}" method="POST" novalidate>
                    @csrf
                    {{-- Rainbow top line --}}
                    <div class="h-[2px] rounded-t-xl bg-gradient-to-r from-orange-500 via-purple-500 to-orange-500 mb-0"></div>

                    <div class="glass rounded-b-2xl p-5 md:p-8 space-y-5">
                        {{-- Row 1: Nama + Telepon --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                                    <i class="fas fa-user mr-1"></i> Nama Pelanggan
                                </label>
                                <input type="text" name="customer_name" required
                                    value="{{ old('customer_name') }}"
                                    placeholder="Han Lue"
                                    autocomplete="name"
                                    class="form-input">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                                    <i class="fas fa-phone mr-1"></i> Nomor Telepon
                                </label>
                                <input type="tel" name="phone" required
                                    value="{{ old('phone') }}"
                                    placeholder="0812xxxx"
                                    autocomplete="tel"
                                    inputmode="tel"
                                    class="form-input">
                            </div>
                        </div>

                        {{-- Row 2: Mobil + Tanggal --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                                    <i class="fas fa-car mr-1"></i> Merek & Tipe Mobil
                                </label>
                                <input type="text" name="car_type" required
                                    value="{{ old('car_type') }}"
                                    placeholder="Toyota Avanza 2021"
                                    class="form-input purple">
                            </div>
                            <div>
                                <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                                    <i class="fas fa-calendar-day mr-1"></i> Jadwal Servis
                                </label>
                                <input type="date" name="booking_date" required
                                    value="{{ old('booking_date') }}"
                                    class="form-input purple"
                                    style="color-scheme:dark">
                            </div>
                        </div>

                        {{-- Jenis Layanan --}}
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                                <i class="fas fa-wrench mr-1"></i> Jenis Layanan
                            </label>
                            <div class="relative">
                                <select name="service_type" required class="form-input pr-10">
                                    <option value="" disabled {{ !old('service_type') ? 'selected' : '' }}>-- Pilih Paket Layanan --</option>
                                    @foreach([
                                        'Servis Rutin Berkala'    => '🔧 Servis Rutin Berkala',
                                        'Ganti Oli Mesin'         => '🛢️ Ganti Oli Mesin',
                                        'Tune Up Performa'        => '⚡ Tune Up Performa',
                                        'Pengecekan Kaki-kaki'    => '🚗 Pengecekan Kaki-kaki',
                                        'Upgrade ECU & Remap'     => '💻 Upgrade ECU & Remap',
                                        'Ganti Ban & Balancing'   => '🏎️ Ganti Ban & Balancing',
                                        'Servis AC Mobil'         => '❄️ Servis AC Mobil',
                                    ] as $val => $label)
                                    <option value="{{ $val }}" {{ old('service_type') == $val ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                                <i class="fas fa-chevron-down absolute right-3.5 top-1/2 -translate-y-1/2 text-zinc-500 text-xs pointer-events-none"></i>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="submitBtn" class="btn-primary w-full text-base">
                            <i class="fas fa-flag-checkered"></i> Kirim Reservasi
                        </button>
                        <p class="text-center text-[10px] text-zinc-700 font-bold uppercase tracking-widest">
                            <i class="fas fa-lock mr-1"></i> Data Anda aman & hanya untuk keperluan servis
                        </p>
                    </div>
                </form>
            </div>
        </section>
    </main>

    {{-- ===[ FOOTER ]=== --}}
    <footer class="py-10 md:py-14 bg-black border-t border-white/5 text-center">
        <h2 class="text-2xl font-black uppercase italic text-white/20 mb-2">Auto<span class="text-orange-500/60">Engine</span></h2>
        <p class="text-[10px] font-bold text-zinc-700 uppercase tracking-widest">&copy; {{ date('Y') }} Auto Engine Car Service · Kelompok 5</p>
        <div class="mt-4 flex justify-center gap-5 text-xs font-bold text-zinc-600">
            <a href="/landing" class="hover:text-zinc-400 transition-colors">Beranda</a>
            <a href="#stok" class="hover:text-zinc-400 transition-colors">Stok</a>
            <a href="/presentasi" class="hover:text-orange-400 transition-colors">Presentasi</a>
            <a href="/" class="hover:text-red-400 transition-colors">Admin</a>
        </div>
    </footer>

    {{-- ===[ SCRIPTS — deferred, non-blocking ]=== --}}
    <script defer>
        // Submit loading state — native JS, no library needed
        document.addEventListener('DOMContentLoaded', function () {
            var form = document.querySelector('form[action*="store-booking"]');
            if (form) {
                form.addEventListener('submit', function () {
                    var btn = document.getElementById('submitBtn');
                    if (btn) {
                        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
                        btn.disabled = true;
                        btn.style.opacity = '0.7';
                    }
                });
            }

            // Active bottom nav link based on scroll
            var sections = ['hero','stok','konsultasi','booking'];
            var navLinks = document.querySelectorAll('.bottom-nav a');
            var obs = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        navLinks.forEach(function(a) { a.classList.remove('active'); });
                        var active = document.querySelector('.bottom-nav a[href="#' + entry.target.id + '"]');
                        if (active) active.classList.add('active');
                    }
                });
            }, { threshold: 0.4 });
            sections.forEach(function(id) {
                var el = document.getElementById(id);
                if (el) obs.observe(el);
            });
        });
    </script>
</body>
</html>
