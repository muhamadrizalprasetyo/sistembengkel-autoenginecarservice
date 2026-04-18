<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#050505">
    <title>Booking Berhasil! | Auto Engine</title>
    <meta name="robots" content="noindex">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700&family=Anton&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"></noscript>

    <style>
        :root { --orange: #ff5e00; --purple: #bf00ff; --bg: #050505; }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: var(--bg);
            color: #e4e4e7;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        .anton { font-family: 'Anton', sans-serif; }
        .neon-o { color: var(--orange); text-shadow: 0 0 18px rgba(255,94,0,.7); }
        .glass {
            background: rgba(10,10,12,0.78);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.07);
        }
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 4px; }

        /* ===[ ANIMATIONS — transform/opacity only ]=== */
        @keyframes check-pop {
            0% { transform: scale(0) rotate(-20deg); opacity: 0; }
            70% { transform: scale(1.1) rotate(3deg); }
            100% { transform: scale(1) rotate(0); opacity: 1; }
        }
        @keyframes fade-up {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes orb-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }
        .anim-check { animation: check-pop 0.65s cubic-bezier(.175,.885,.32,1.275) 0.2s both; }
        .anim-up-1 { animation: fade-up 0.5s ease 0.4s both; }
        .anim-up-2 { animation: fade-up 0.5s ease 0.6s both; }
        .anim-up-3 { animation: fade-up 0.5s ease 0.8s both; }
        .orb-float { animation: orb-float 5s ease-in-out infinite; }

        /* Buttons */
        .btn-primary {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; width: 100%; padding: 0 1.5rem;
            background: var(--orange); color: #fff;
            font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.875rem;
            border-radius: 0.875rem;
            box-shadow: 0 0 20px rgba(255,94,0,.25);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            will-change: transform;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
        }
        @media (hover: hover) { .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 0 32px rgba(255,94,0,.4); } }
        .btn-primary:active { transform: scale(0.97); }

        .btn-ghost {
            display: flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; width: 100%; padding: 0 1.5rem;
            background: transparent; color: #fff;
            border: 1.5px solid rgba(255,255,255,.15);
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.875rem;
            border-radius: 0.875rem;
            transition: transform 0.2s ease, background 0.2s ease;
            will-change: transform;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
        }
        @media (hover: hover) { .btn-ghost:hover { background: rgba(255,255,255,.06); transform: translateY(-2px); } }
        .btn-ghost:active { transform: scale(0.97); }

        /* Form inputs — 16px prevents iOS auto-zoom */
        .form-input {
            width: 100%; min-height: 52px; padding: 0 1rem;
            font-size: 16px; font-family: inherit;
            background: rgba(0,0,0,.5); color: #fff;
            border: 1px solid #3f3f46; border-radius: 0.75rem;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            -webkit-appearance: none; appearance: none;
        }
        .form-input:focus {
            outline: none;
            border-color: var(--orange);
            box-shadow: 0 0 0 1px var(--orange), 0 0 12px rgba(255,94,0,.2);
        }
        textarea.form-input { min-height: 110px; padding: 0.875rem 1rem; resize: vertical; }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    {{-- Background orbs --}}
    <div class="fixed inset-0 pointer-events-none overflow-hidden z-0" aria-hidden="true">
        <div class="orb-float absolute top-1/4 left-1/4 w-64 h-64 rounded-full bg-orange-600/10 blur-[80px]"></div>
        <div class="orb-float absolute bottom-1/4 right-1/4 w-48 h-48 rounded-full bg-purple-600/8 blur-[70px]" style="animation-delay:-2s"></div>
    </div>

    {{-- Navbar --}}
    <header class="relative z-50 border-b border-white/5 flex-shrink-0" style="background:rgba(5,5,5,.85);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px)">
        <div class="max-w-4xl mx-auto px-5 py-4 flex justify-between items-center">
            <a href="/landing" class="flex items-center gap-2.5 min-h-[48px]">
                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-500 to-orange-700 flex items-center justify-center font-black text-sm shadow-lg shadow-orange-900/40">AE</div>
                <span class="text-base font-black tracking-tighter uppercase italic">Auto<span class="neon-o">Engine</span></span>
            </a>
            <a href="/landing" class="min-h-[48px] flex items-center gap-2 text-sm text-zinc-400 hover:text-white font-bold uppercase tracking-widest transition-colors">
                <i class="fas fa-arrow-left text-xs"></i>
                <span class="hidden sm:inline">Kembali</span>
            </a>
        </div>
    </header>

    {{-- Main content --}}
    <main class="flex-1 relative z-10 flex flex-col items-center justify-center py-12 px-5">
        <div class="w-full max-w-2xl mx-auto">

            {{-- SUCCESS BADGE --}}
            <div class="text-center mb-8">
                <div class="anim-check inline-flex items-center justify-center w-24 h-24 md:w-32 md:h-32 rounded-full mb-6 mx-auto"
                    style="background:radial-gradient(circle,rgba(34,197,94,.12),rgba(34,197,94,.04));border:2px solid rgba(34,197,94,.4);box-shadow:0 0 40px rgba(34,197,94,.2)">
                    <i class="fas fa-check text-4xl md:text-5xl text-green-400"></i>
                </div>
                <div class="anim-up-1">
                    <p class="text-[10px] font-black uppercase tracking-[.35em] text-green-500 mb-3">Reservasi Diterima</p>
                    <h1 class="anton text-5xl md:text-7xl text-white uppercase leading-none">
                        Booking <span class="neon-o">Berhasil!</span>
                    </h1>
                    <p class="mt-4 text-zinc-400 text-sm md:text-base max-w-md mx-auto leading-relaxed">
                        Tim Auto Engine akan menghubungi Anda dalam 1×24 jam untuk konfirmasi jadwal servis.
                    </p>
                </div>
            </div>

            {{-- BOOKING DETAIL --}}
            @if(isset($booking))
            <div class="anim-up-2 glass rounded-2xl p-5 md:p-7 mb-6">
                <p class="text-[10px] font-black uppercase tracking-[.25em] text-zinc-600 mb-4 flex items-center gap-2">
                    <i class="fas fa-receipt text-orange-500"></i> Detail Reservasi #{{ $booking->id }}
                </p>
                <div class="grid grid-cols-2 gap-x-4 gap-y-3">
                    @foreach([
                        ['Nama',     $booking->customer_name ?? '—'],
                        ['Telepon',  $booking->phone ?? '—'],
                        ['Kendaraan',$booking->car_type ?? '—'],
                        ['Layanan',  $booking->service_type ?? '—'],
                        ['Jadwal',   isset($booking->booking_date) ? \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') : '—'],
                    ] as [$label, $value])
                    <div class="{{ $label === 'Layanan' ? 'col-span-2' : '' }}">
                        <p class="text-[9px] uppercase tracking-widest text-zinc-600 font-black mb-0.5">{{ $label }}</p>
                        <p class="text-sm font-bold text-zinc-100 leading-snug">{{ $value }}</p>
                    </div>
                    @endforeach
                    <div>
                        <p class="text-[9px] uppercase tracking-widest text-zinc-600 font-black mb-0.5">Status</p>
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-yellow-900/30 border border-yellow-500/30 rounded-full text-yellow-400 text-[10px] font-black uppercase">
                            <span class="w-1.5 h-1.5 rounded-full bg-yellow-400 animate-pulse"></span>
                            Menunggu Konfirmasi
                        </span>
                    </div>
                </div>
            </div>
            @endif

            {{-- ACTION BUTTONS --}}
            <div class="anim-up-2 flex flex-col sm:flex-row gap-3 mb-10">
                <a href="https://wa.me/6281234567890?text=Halo+Auto+Engine!+Saya+baru+booking+#{{ $booking->id ?? '' }}.+Mohon+dikonfirmasi."
                   target="_blank" rel="noopener"
                   class="flex-1 flex items-center justify-center gap-2.5 min-h-[52px] rounded-xl font-black uppercase tracking-widest text-sm text-white transition-transform"
                   style="background:#25D366;box-shadow:0 0 18px rgba(37,211,102,.2)">
                    <i class="fab fa-whatsapp text-xl"></i> Konfirmasi via WA
                </a>
                <a href="/landing" class="btn-ghost flex-1 sm:w-auto">
                    <i class="fas fa-house"></i> Kembali ke Beranda
                </a>
            </div>

            {{-- DIVIDER --}}
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-white/8"></div></div>
                <div class="relative flex justify-center">
                    <span class="px-5 text-[10px] font-black uppercase tracking-[0.3em] text-zinc-700" style="background:var(--bg)">Bantu Kami Berkembang</span>
                </div>
            </div>

            {{-- FEEDBACK FORM --}}
            <div class="anim-up-3 glass rounded-2xl overflow-hidden">
                <div class="px-6 py-5 border-b border-white/6" style="background:linear-gradient(90deg,rgba(255,94,0,.08),rgba(191,0,255,.05))">
                    <h2 class="text-base font-black uppercase italic text-white">
                        <i class="fas fa-comment-dots text-orange-400 mr-2"></i> Saran, Kritik atau Pertanyaan
                    </h2>
                    <p class="text-xs text-zinc-500 mt-1">Masukan Anda sangat berharga bagi kami.</p>
                </div>

                @if(session('feedback_success'))
                <div class="mx-5 mt-5 p-4 bg-green-900/20 border border-green-500/30 rounded-xl text-green-300 text-sm flex items-center gap-3">
                    <i class="fas fa-circle-check text-green-400 flex-shrink-0"></i>
                    {{ session('feedback_success') }}
                </div>
                @endif

                <form action="{{ route('feedback.store') }}" method="POST" class="p-5 md:p-7 space-y-5">
                    @csrf
                    @if(isset($booking))
                    <input type="hidden" name="booking_ref" value="#{{ $booking->id }}">
                    @endif

                    {{-- Nama --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                            <i class="fas fa-user mr-1"></i> Nama
                        </label>
                        <input type="text" name="name" required
                            value="{{ isset($booking) ? $booking->customer_name : old('name') }}"
                            placeholder="Nama Anda"
                            autocomplete="name"
                            class="form-input">
                    </div>

                    {{-- Tipe pesan --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-3">
                            <i class="fas fa-tag mr-1"></i> Jenis Pesan
                        </label>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach(['saran'=>['💡','Saran','yellow'],'pertanyaan'=>['❓','Pertanyaan','blue'],'kritik'=>['🔥','Kritik','red']] as $val=>[$emoji,$lbl,$clr])
                            <label class="cursor-pointer">
                                <input type="radio" name="type" value="{{ $val }}" class="sr-only peer"
                                    {{ old('type','saran') == $val ? 'checked' : '' }}>
                                <div class="min-h-[52px] flex flex-col items-center justify-center gap-1 rounded-xl text-xs font-bold text-zinc-500 border border-zinc-800
                                    peer-checked:border-{{ $clr }}-500 peer-checked:text-{{ $clr }}-400 peer-checked:bg-{{ $clr }}-500/8
                                    transition-colors cursor-pointer">
                                    <span class="text-xl">{{ $emoji }}</span>
                                    <span class="text-[10px] font-black uppercase tracking-wide">{{ $lbl }}</span>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">
                            <i class="fas fa-pen-to-square mr-1"></i> Pesan Anda
                        </label>
                        <textarea name="message" required rows="4"
                            placeholder="Tuliskan pesan Anda di sini..."
                            class="form-input">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit" class="btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </main>

    <footer class="relative z-10 flex-shrink-0 py-7 border-t border-white/5 text-center">
        <p class="text-[10px] font-bold text-zinc-700 uppercase tracking-widest">&copy; {{ date('Y') }} Auto Engine Car Service · Kelompok 5</p>
    </footer>

</body>
</html>
