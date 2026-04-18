@extends('layouts.admin')

@section('title', 'Kelola Reservasi')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-[10px] uppercase tracking-[0.35em] text-orange-500 font-black mb-1">Admin Panel</p>
            <h1 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                Kelola <span class="text-orange-500">Reservasi</span>
            </h1>
            <p class="text-sm text-zinc-500 mt-1">Konfirmasi dan update status booking pelanggan.</p>
        </div>
        <a href="/landing#booking" target="_blank"
           class="inline-flex items-center gap-2 px-5 py-2.5 border border-orange-500/30 rounded-xl text-orange-400 text-sm font-black hover:bg-orange-500/10 transition-colors whitespace-nowrap">
            <i class="fas fa-plus"></i> Form Booking Publik
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-500/30 rounded-xl text-green-400 text-sm font-bold">
        <i class="fas fa-circle-check fa-lg flex-shrink-0"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Stats Cards --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php
            $statCards = [
                ['label'=>'Total Reservasi', 'value'=>$stats['total'],   'icon'=>'fa-calendar-check', 'color'=>'zinc',   'glow'=>''],
                ['label'=>'Menunggu',         'value'=>$stats['pending'],'icon'=>'fa-hourglass-half', 'color'=>'yellow',  'glow'=>'card-glow-orange'],
                ['label'=>'Dikerjakan',       'value'=>$stats['diterima'],'icon'=>'fa-screwdriver-wrench','color'=>'blue','glow'=>'card-glow-purple'],
                ['label'=>'Selesai',          'value'=>$stats['selesai'],'icon'=>'fa-circle-check',   'color'=>'green',   'glow'=>'card-glow-green'],
            ];
        @endphp
        @foreach($statCards as $card)
        <div class="bg-zinc-900/60 border border-white/6 rounded-2xl p-5 transition-all duration-300 {{ $card['glow'] }}">
            <div class="flex items-start justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-{{ $card['color'] }}-500/10 border border-{{ $card['color'] }}-500/20 flex items-center justify-center">
                    <i class="fas {{ $card['icon'] }} text-{{ $card['color'] }}-400 text-sm"></i>
                </div>
            </div>
            <p class="text-3xl font-black text-white mb-1">{{ $card['value'] }}</p>
            <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 font-black">{{ $card['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Bookings Table --}}
    <div class="bg-zinc-900/60 border border-white/6 rounded-2xl overflow-hidden">
        {{-- Table Header --}}
        <div class="px-6 py-4 border-b border-white/6 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <i class="fas fa-list text-orange-500"></i>
                <h2 class="text-sm font-black uppercase tracking-wider text-zinc-200">Daftar Reservasi</h2>
            </div>
            <span class="text-xs text-zinc-600 font-bold">{{ $bookings->count() }} total entri</span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-white/5">
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Pelanggan</th>
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Kendaraan & Layanan</th>
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500 hidden md:table-cell">Telepon</th>
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500 hidden lg:table-cell">Tanggal</th>
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Status</th>
                        <th class="px-6 py-3.5 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/4">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-zinc-800/30 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500/30 to-orange-700/20 border border-orange-500/20 flex items-center justify-center text-xs font-black text-orange-400 flex-shrink-0">
                                    {{ strtoupper(substr($booking->customer_name, 0, 2)) }}
                                </div>
                                <span class="font-bold text-sm text-zinc-100">{{ $booking->customer_name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-zinc-200">{{ $booking->car_type }}</p>
                            <p class="text-xs text-zinc-500 mt-0.5">{{ $booking->service_type }}</p>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <span class="text-sm text-zinc-400 font-mono">{{ $booking->phone }}</span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <span class="text-sm text-zinc-400">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $statusMap = [
                                    'pending'  => ['bg-yellow-900/40 text-yellow-400 border-yellow-500/30', 'fa-hourglass-half', 'Menunggu'],
                                    'diterima' => ['bg-blue-900/40 text-blue-400 border-blue-500/30',     'fa-screwdriver-wrench', 'Dikerjakan'],
                                    'selesai'  => ['bg-green-900/40 text-green-400 border-green-500/30',  'fa-circle-check', 'Selesai'],
                                ];
                                $s = strtolower($booking->status);
                                [$cls, $ico, $lbl] = $statusMap[$s] ?? ['bg-zinc-800 text-zinc-400 border-zinc-700', 'fa-circle', $booking->status];
                            @endphp
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-[10px] font-black uppercase border {{ $cls }}">
                                <i class="fas {{ $ico }} fa-xs"></i> {{ $lbl }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if(strtolower($booking->status) === 'pending')
                                <form action="{{ url('/admin/bookings/'.$booking->id.'/accept') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-blue-600/20 hover:bg-blue-600/40 border border-blue-500/30 text-blue-400 text-[10px] font-black uppercase rounded-lg transition-all hover:shadow-[0_0_10px_rgba(59,130,246,0.3)]">
                                        <i class="fas fa-check mr-1"></i>Terima
                                    </button>
                                </form>
                                @endif
                                @if(strtolower($booking->status) !== 'selesai')
                                <form action="{{ url('/admin/bookings/'.$booking->id.'/complete') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit"
                                        class="px-3 py-1.5 bg-green-600/20 hover:bg-green-600/40 border border-green-500/30 text-green-400 text-[10px] font-black uppercase rounded-lg transition-all hover:shadow-[0_0_10px_rgba(34,197,94,0.3)]">
                                        <i class="fas fa-flag-checkered mr-1"></i>Selesai
                                    </button>
                                </form>
                                @endif
                                @if(strtolower($booking->status) === 'selesai')
                                <span class="px-3 py-1.5 text-[10px] font-black uppercase text-zinc-600">— Selesai —</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-20 text-center">
                            <i class="fas fa-calendar-xmark text-4xl text-zinc-700 block mb-4"></i>
                            <p class="text-zinc-500 font-black uppercase tracking-widest text-sm">Belum ada data reservasi masuk.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
