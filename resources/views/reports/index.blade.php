@extends('layouts.admin')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="mb-8">
        <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-500">Intelijen Keuangan</p>
        <h1 class="text-3xl font-black uppercase tracking-tight text-white">Layar Analitik <span class="text-red-600">Keuangan</span></h1>
    </header>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Pendapatan Kotor</p>
            <p class="font-mono text-2xl font-black text-red-500">Rp{{ number_format($gross_revenue, 0, ',', '.') }}</p>
        </article>
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Estimasi Profit Bersih</p>
            <p class="font-mono text-2xl font-black text-white">Rp{{ number_format($estimated_net, 0, ',', '.') }}</p>
        </article>
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Total Transaksi</p>
            <p class="font-mono text-2xl font-black text-white">{{ number_format($total_transactions) }}</p>
        </article>
    </section>

    <section class="bg-zinc-900 border border-white/5 rounded-3xl p-6">
        <h2 class="text-[11px] uppercase tracking-[0.22em] font-black text-red-500 mb-4">Item Paling Laku</h2>
        <div class="overflow-auto">
            <table class="w-full min-w-[640px]">
                <thead>
                    <tr class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 border-b border-white/5">
                        <th class="text-left pb-3">Item / Jasa</th>
                        <th class="text-right pb-3">Qty Terjual</th>
                        <th class="text-right pb-3">Pendapatan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($top_items as $item)
                        <tr>
                            <td class="py-3 text-xs font-black uppercase tracking-wide text-zinc-100">{{ $item->item_name }}</td>
                            <td class="py-3 text-right font-mono text-white">{{ number_format((int) $item->total_qty) }}</td>
                            <td class="py-3 text-right font-mono text-red-500">Rp{{ number_format((int) $item->total_revenue, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-4 text-xs uppercase tracking-widest text-zinc-500">Belum ada data performa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
