<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#09090b">
    <title>Booking Berhasil! | Auto Engine</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #09090b;
            color: #e4e4e7;
            -webkit-font-smoothing: antialiased;
        }

        .neon-glow {
            text-shadow: 0 0 20px rgba(249, 115, 22, 0.4);
        }

        .glass {
            background: rgba(24, 24, 27, 0.4);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-up {
            animation: fadeUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .check-anim {
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.5);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Industrial Grid Pattern */
        .bg-grid {
            background-image: linear-gradient(rgba(255, 255, 255, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 40px 40px;
        }
    </style>
</head>

<body class="min-h-screen bg-grid flex flex-col items-center">

    {{-- Header / Logo --}}
    <header class="w-full max-w-5xl px-6 py-8 flex justify-between items-center z-50">
        <a href="/" class="flex items-center gap-3">
            <div class="w-10 h-10 overflow-hidden rounded-xl bg-zinc-800 shadow-lg shadow-orange-900/40">
                <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
            </div>
            <div class="hidden sm:block">
                <p class="text-[9px] uppercase tracking-[0.3em] text-zinc-500 font-bold leading-none mb-0.5">Auto Engine
                </p>
                <p class="text-xs uppercase tracking-widest text-white font-black">Success Page</p>
            </div>
        </a>
        <a href="/"
            class="text-[10px] font-black uppercase tracking-widest text-zinc-500 hover:text-white transition-colors">
            <i class="fas fa-chevron-left mr-2"></i> Kembali
        </a>
    </header>

    <main class="flex-1 w-full max-w-2xl px-6 py-12 flex flex-col items-center">

        {{-- Success Icon --}}
        <div class="check-anim mb-10">
            <div
                class="w-24 h-24 rounded-full bg-emerald-500/10 border border-emerald-500/30 flex items-center justify-center relative">
                <div class="absolute inset-0 rounded-full bg-emerald-500/20 blur-xl animate-pulse"></div>
                <i class="fas fa-check text-4xl text-emerald-500 relative z-10"></i>
            </div>
        </div>

        {{-- Main Message --}}
        <div class="text-center mb-12 animate-fade-up" style="animation-delay: 0.1s">
            <p class="text-[10px] uppercase tracking-[0.4em] font-black text-emerald-500 mb-4">Reservasi Telah Diterima
            </p>
            <h1 class="text-5xl md:text-6xl font-black uppercase tracking-tighter text-white leading-none mb-6">
                Booking <span class="text-orange-600 neon-glow">Berhasil!</span>
            </h1>
            <p class="text-zinc-500 text-sm md:text-base max-w-md mx-auto leading-relaxed">
                Terima kasih telah mempercayakan kendaraan Anda kepada kami. Tim kami akan menghubungi Anda segera
                melalui WhatsApp.
            </p>
        </div>

        {{-- Ticket Details --}}
        <div class="w-full glass rounded-[2.5rem] p-8 md:p-10 mb-8 animate-fade-up relative overflow-hidden"
            style="animation-delay: 0.2s">
            {{-- Decorative corners --}}
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fas fa-microchip text-6xl text-orange-500"></i>
            </div>

            <div class="flex items-center justify-between mb-8 pb-6 border-b border-white/5">
                <div>
                    <p class="text-[9px] uppercase tracking-widest text-zinc-500 font-black">ID Reservasi</p>
                    <p class="text-lg font-mono font-black text-white">#{{ $booking->id }}</p>
                </div>
                <div class="text-right">
                    <p class="text-[9px] uppercase tracking-widest text-zinc-500 font-black">Status</p>
                    <span class="inline-flex items-center gap-2 text-[10px] font-black uppercase text-orange-400">
                        <span class="w-1.5 h-1.5 rounded-full bg-orange-500 animate-ping"></span>
                        Menunggu Konfirmasi
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <label class="text-[9px] uppercase tracking-widest text-zinc-500 font-black block mb-1">Nama
                        Customer</label>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->customer_name }}</p>
                </div>
                <div>
                    <label class="text-[9px] uppercase tracking-widest text-zinc-500 font-black block mb-1">Tipe
                        Kendaraan</label>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->car_type }}
                        ({{ $booking->car_plate ?? '-' }})</p>
                </div>
                <div>
                    <label
                        class="text-[9px] uppercase tracking-widest text-zinc-500 font-black block mb-1">Layanan</label>
                    <p class="text-sm font-bold text-white uppercase">{{ $booking->service_type }}</p>
                </div>
                <div>
                    <label class="text-[9px] uppercase tracking-widest text-zinc-500 font-black block mb-1">Rencana
                        Kedatangan</label>
                    <p class="text-sm font-bold text-white uppercase">
                        {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="w-full grid grid-cols-1 sm:grid-cols-2 gap-4 animate-fade-up" style="animation-delay: 0.3s">
            <a href="https://wa.me/6281234567890?text=Halo+Auto+Engine!+Saya+ingin+konfirmasi+booking+#{{ $booking->id }}"
                class="bg-orange-600 hover:bg-orange-500 text-white py-4 rounded-2xl flex items-center justify-center gap-3 text-xs font-black uppercase tracking-widest transition-all shadow-lg shadow-orange-900/20 group">
                <i class="fab fa-whatsapp text-lg group-hover:scale-110 transition-transform"></i>
                Konfirmasi via WhatsApp
            </a>
            <a href="/"
                class="bg-zinc-900 border border-white/10 hover:border-white/20 text-white py-4 rounded-2xl flex items-center justify-center gap-3 text-xs font-black uppercase tracking-widest transition-all">
                <i class="fas fa-house text-sm"></i>
                Kembali ke Beranda
            </a>
        </div>

        {{-- Feedback Section --}}
        <div class="w-full mt-20 p-8 glass rounded-[2.5rem] animate-fade-up" style="animation-delay: 0.4s">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-orange-500/10 flex items-center justify-center text-orange-500">
                    <i class="fas fa-comment-dots text-xl"></i>
                </div>
                <div>
                    <h3 class="text-sm font-black uppercase tracking-widest text-white">Saran & Kritik</h3>
                    <p class="text-[10px] text-zinc-500 uppercase font-medium">Bantu kami meningkatkan layanan untuk
                        Anda.</p>
                </div>
            </div>

            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="booking_ref" value="#{{ $booking->id }}">
                <input type="hidden" name="name" value="{{ $booking->customer_name }}">
                <input type="hidden" name="type" value="saran">

                <textarea name="message" rows="3" required
                    class="w-full bg-black/40 border border-white/10 rounded-2xl p-4 text-sm text-white focus:outline-none focus:border-orange-500/50 transition-all placeholder:text-zinc-700"
                    placeholder="Tuliskan pengalaman Anda menggunakan sistem booking kami..."></textarea>

                <button type="submit"
                    class="w-full text-[10px] font-black uppercase tracking-[0.2em] text-zinc-500 hover:text-orange-500 transition-colors py-2">
                    Kirim Masukan <i class="fas fa-paper-plane ml-2"></i>
                </button>
            </form>
        </div>

    </main>

    <footer class="py-10 text-center opacity-30">
        <p class="text-[9px] font-bold uppercase tracking-[0.4em] text-zinc-500">&copy; {{ date('Y') }} Auto Engine
            Management · Mission Success</p>
    </footer>

</body>

</html>