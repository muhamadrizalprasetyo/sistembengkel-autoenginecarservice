<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Engine — Cek Status Servis</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background: #09090b;
        }

        .glass {
            background: rgba(15, 15, 17, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.07);
        }

        .orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            pointer-events: none;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col items-center justify-center px-4 py-12 relative overflow-hidden text-zinc-200">

    <div class="orb w-80 h-80 bg-orange-600/15 top-0 left-1/4"></div>
    <div class="orb w-64 h-64 bg-purple-600/10 bottom-0 right-1/4"></div>

    <div class="relative z-10 w-full max-w-lg">
        <div class="text-center mb-8">
            <a href="/landing" class="inline-flex items-center gap-3 mb-4">
                <div
                    class="w-10 h-10 bg-gradient-to-br from-orange-500 to-orange-700 rounded-xl flex items-center justify-center font-black">
                    AE</div>
                <span class="text-lg font-black uppercase tracking-tight">Auto<span
                        class="text-orange-500">Engine</span></span>
            </a>
            <h1 class="text-2xl font-black uppercase tracking-tight text-white">Cek Status <span
                    class="text-orange-500">Servis</span></h1>
            <p class="text-zinc-500 text-sm mt-1">Masukkan nomor booking untuk cek status kendaraan Anda.</p>
        </div>

        <div class="glass rounded-3xl p-8">
            <form method="GET" action="{{ route('booking.tracker') }}" class="flex gap-2 mb-6">
                <input type="number" name="kode" value="{{ request('kode') }}" placeholder="Nomor Booking (contoh: 42)"
                    class="flex-1 bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500">
                <button type="submit"
                    class="px-5 py-3 bg-orange-500 hover:bg-orange-600 rounded-xl text-sm font-black text-white transition-colors whitespace-nowrap">
                    <i class="fas fa-search"></i> Cek
                </button>
            </form>

            @if(request()->filled('kode'))
                @if($booking)
                    @php
                        $statusConfig = [
                            'pending' => ['color' => 'yellow', 'icon' => 'fa-hourglass-half', 'label' => 'Menunggu Konfirmasi', 'desc' => 'Booking Anda sedang menunggu konfirmasi dari bengkel.'],
                            'diterima' => ['color' => 'blue', 'icon' => 'fa-screwdriver-wrench', 'label' => 'Sedang Dikerjakan', 'desc' => 'Kendaraan Anda sedang dalam proses servis oleh mekanik kami.'],
                            'selesai' => ['color' => 'green', 'icon' => 'fa-circle-check', 'label' => 'Selesai — Bisa Diambil', 'desc' => 'Kendaraan Anda siap diambil. Terima kasih telah mempercayai kami!'],
                        ];
                        $s = strtolower($booking->status);
                        $cfg = $statusConfig[$s] ?? ['color' => 'zinc', 'icon' => 'fa-circle', 'label' => $booking->status, 'desc' => ''];
                        $colorMap = [
                            'yellow' => 'bg-yellow-900/20 border-yellow-500/30 text-yellow-400',
                            'blue' => 'bg-blue-900/20 border-blue-500/30 text-blue-400',
                            'green' => 'bg-green-900/20 border-green-500/30 text-green-400',
                            'zinc' => 'bg-zinc-900 border-zinc-700 text-zinc-400',
                        ];
                    @endphp
                    <div class="space-y-4">
                        <div class="p-4 rounded-2xl border {{ $colorMap[$cfg['color']] }} text-center">
                            <i class="fas {{ $cfg['icon'] }} text-3xl mb-2 block"></i>
                            <p class="font-black text-lg uppercase">{{ $cfg['label'] }}</p>
                            <p class="text-sm opacity-75 mt-1">{{ $cfg['desc'] }}</p>
                        </div>

                        <div class="bg-black/30 rounded-2xl p-4 space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-zinc-500 font-bold">Booking #</span>
                                <span class="font-black text-zinc-100">{{ $booking->id }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 font-bold">Nama</span>
                                <span class="font-black text-zinc-100">{{ $booking->customer_name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 font-bold">Kendaraan</span>
                                <span
                                    class="font-black text-zinc-100">{{ $booking->car_type }}{{ $booking->car_plate ? ' (' . $booking->car_plate . ')' : '' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 font-bold">Layanan</span>
                                <span class="font-black text-zinc-100">{{ $booking->service_type }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-zinc-500 font-bold">Jadwal</span>
                                <span
                                    class="font-black text-zinc-100">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class="fas fa-search text-3xl text-zinc-700 block mb-3"></i>
                        <p class="text-zinc-500 font-bold">Booking dengan nomor <span
                                class="text-orange-400">{{ request('kode') }}</span> tidak ditemukan.</p>
                        <p class="text-zinc-600 text-sm mt-1">Pastikan nomor booking Anda benar.</p>
                    </div>
                @endif
            @else
                <div class="text-center py-6">
                    <i class="fas fa-receipt text-4xl text-zinc-800 block mb-3"></i>
                    <p class="text-zinc-600 text-sm">Nomor booking dapat dilihat di halaman konfirmasi setelah mendaftar.
                    </p>
                </div>
            @endif
        </div>

        <div class="mt-6 flex justify-center gap-4 text-sm">
            <a href="/landing" class="text-zinc-600 hover:text-orange-400 transition-colors font-bold">← Beranda</a>
            <a href="/landing#booking" class="text-zinc-600 hover:text-orange-400 transition-colors font-bold">Buat
                Booking</a>
        </div>
    </div>
</body>

</html>
