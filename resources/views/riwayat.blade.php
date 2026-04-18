@extends('layouts.admin')

@section('title', 'Laporan Transaksi')

@section('content')
    <header class="mb-10 flex justify-between items-start">
        <div>
            <h2 class="text-3xl font-black tracking-tighter italic uppercase text-white">Laporan <span class="text-red-600">Keuangan</span></h2>
            <p class="text-zinc-500 text-[10px] font-black uppercase tracking-[0.2em] mt-1">Rekap semua transaksi Bengkel Auto Engine</p>
        </div>
        <div class="hidden md:flex bg-zinc-900 border border-zinc-800 p-4 rounded-3xl items-center space-x-4">
            <div class="text-right">
                <p class="text-[9px] font-black text-zinc-600 uppercase">Total Omzet</p>
                <p class="text-xl font-black text-green-500 font-mono">Rp{{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</p>
            </div>
            <div class="w-10 h-10 bg-green-500/10 text-green-500 rounded-2xl flex items-center justify-center">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </header>

    <div class="space-y-4">
    @forelse($transactions as $t)
    <div class="bg-zinc-900 p-6 md:p-8 rounded-[2.5rem] border border-zinc-800 hover:border-red-600/50 transition-all group shadow-xl">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            
            <div class="flex items-center space-x-5">
                <div class="w-16 h-16 bg-black border border-zinc-800 rounded-2xl overflow-hidden flex items-center justify-center shadow-inner group-hover:border-red-600 transition-all">
                    @if($t->car_image)
                        <img src="{{ asset('storage/' . $t->car_image) }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-xl font-black text-red-600 italic">
                            {{ substr($t->customer_name, 0, 1) }}
                        </span>
                    @endif
                </div>

                <div>
                    <h4 class="text-lg font-black text-white uppercase tracking-tighter">{{ $t->customer_name }}</h4>
                    <div class="flex items-center space-x-3 mt-1 text-[10px] font-bold text-zinc-500 uppercase tracking-widest">
                        <span><i class="fas fa-id-card mr-1 text-red-600"></i> {{ $t->customer_phone ?? 'Tanpa Plat' }}</span>
                        <span class="text-zinc-800">•</span>
                        <span><i class="far fa-clock mr-1"></i> {{ $t->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between md:justify-end md:space-x-10 border-t border-zinc-800 md:border-none pt-4 md:pt-0">
                <div class="text-left md:text-right">
                    <p class="text-[9px] font-black text-zinc-600 uppercase tracking-widest">Total Bayar</p>
                    <p class="text-xl font-black text-white font-mono tracking-tighter italic">
                        Rp{{ number_format($t->total_price, 0, ',', '.') }}
                    </p>
                </div>
                
                <a href="/transaksi/cetak/{{ $t->id }}" target="_blank" 
                   class="w-12 h-12 bg-red-600 hover:bg-red-700 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/40 transition-all active:scale-95">
                    <i class="fas fa-print"></i>
                </a>
            </div>
        </div>
    </div>
    @empty
        <div class="text-center py-20 opacity-20 italic">Belum ada laporan...</div>
    @endforelse
</div>
@endsection