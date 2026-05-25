@extends('layouts.admin')

@section('title', 'Riwayat Transaksi')

@section('content')
    <div class="max-w-5xl mx-auto pb-10">
        <header class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-500 font-black">History</p>
                <h2 class="text-3xl font-black tracking-tighter italic uppercase text-white">Riwayat <span
                        class="text-orange-600">Transaksi</span></h2>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-zinc-900 border border-zinc-800 px-5 py-3 rounded-2xl text-right">
                    <p class="text-[9px] font-black text-zinc-600 uppercase">Total Omzet</p>
                    <p class="text-lg font-black text-green-500 font-mono">
                        Rp{{ number_format($transactions->sum('total_price'), 0, ',', '.') }}</p>
                </div>
            </div>
        </header>

        {{-- Low Stock Alert --}}
        @if($lowStockItems->count() > 0)
            <div class="mb-6 p-4 bg-orange-900/10 border border-orange-500/20 rounded-2xl flex items-start gap-3">
                <i class="fas fa-triangle-exclamation text-orange-500 mt-0.5 flex-shrink-0"></i>
                <div>
                    <p class="text-xs font-black text-orange-400 uppercase tracking-wide">⚠ Stok Kritis</p>
                    <p class="text-xs text-zinc-500 mt-1">{{ $lowStockItems->pluck('name')->implode(', ') }}</p>
                </div>
            </div>
        @endif

        <div class="space-y-3">
            @forelse($transactions as $t)
                <div
                    class="bg-zinc-900 p-5 md:p-6 rounded-3xl border border-zinc-800 hover:border-orange-600/30 transition-all group">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-black border border-zinc-800 rounded-2xl overflow-hidden flex items-center justify-center flex-shrink-0 group-hover:border-orange-600 transition-all">
                                @if($t->car_image)
                                    <img src="{{ asset('storage/' . $t->car_image) }}" class="w-full h-full object-cover">
                                @else
                                    <span
                                        class="text-lg font-black text-orange-600 italic">{{ substr($t->customer_name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h4 class="text-sm font-black text-white uppercase">{{ $t->customer_name }}</h4>
                                    @if($t->invoice_number)
                                        <span
                                            class="text-[9px] font-mono bg-zinc-800 text-zinc-400 px-2 py-0.5 rounded-md">{{ $t->invoice_number }}</span>
                                    @endif
                                </div>
                                <div
                                    class="flex items-center gap-3 mt-1 text-[9px] font-bold text-zinc-600 uppercase tracking-widest flex-wrap">
                                    <span><i class="fas fa-phone mr-1"></i>{{ $t->customer_phone ?? '-' }}</span>
                                    <span>•</span>
                                    <span><i class="far fa-clock mr-1"></i>{{ $t->created_at->diffForHumans() }}</span>
                                    @if($t->details_count > 0)
                                        <span>•</span>
                                        <span><i class="fas fa-list mr-1"></i>{{ $t->details_count }} item</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div
                            class="flex items-center justify-between md:justify-end gap-4 border-t border-zinc-800 md:border-none pt-3 md:pt-0">
                            <div class="text-left md:text-right">
                                <p class="text-[9px] font-black text-zinc-600 uppercase">Total</p>
                                <p class="text-lg font-black text-white font-mono">
                                    Rp{{ number_format($t->total_price, 0, ',', '.') }}</p>
                            </div>
                            <a href="{{ route('transaksi.cetak', $t->id) }}" target="_blank"
                                class="w-10 h-10 bg-orange-600 hover:bg-orange-700 text-white rounded-xl flex items-center justify-center shadow-lg shadow-orange-900/40 transition-all hover:scale-105">
                                <i class="fas fa-print text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-20 opacity-30 italic text-zinc-500">Belum ada transaksi...</div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($transactions->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $transactions->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>
@endsection
