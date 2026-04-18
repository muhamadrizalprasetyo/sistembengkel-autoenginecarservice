@extends('layouts.admin')

@section('title', 'Riwayat & Struk')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="mb-8">
        <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-500">Arsip Transaksi</p>
        <h1 class="text-3xl font-black uppercase tracking-tight text-white">Riwayat &amp; <span class="text-red-600">Struk</span></h1>
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-zinc-600 mt-2">Daftar lengkap transaksi dengan cetak struk termal</p>
    </header>

    <section class="bg-zinc-900 border border-white/5 rounded-3xl p-6 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[960px]">
                <thead>
                    <tr class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 border-b border-white/5">
                        <th class="text-left pb-3">Tanggal</th>
                        <th class="text-left pb-3">Item Yang Dibeli</th>
                        <th class="text-right pb-3">Total Harga</th>
                        <th class="text-right pb-3">Tunai</th>
                        <th class="text-right pb-3">Kembalian</th>
                        <th class="text-right pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($transactions as $row)
                        <tr class="hover:bg-white/[0.02]">
                            <td class="py-4 font-mono text-xs text-zinc-300">{{ $row['tanggal'] }}</td>
                            <td class="py-4 text-xs font-black uppercase tracking-wide text-zinc-100 max-w-md">{{ $row['items'] }}</td>
                            <td class="py-4 text-right font-mono text-red-500 font-black">Rp{{ number_format($row['total_harga'], 0, ',', '.') }}</td>
                            <td class="py-4 text-right font-mono text-white">Rp{{ number_format($row['tunai'], 0, ',', '.') }}</td>
                            <td class="py-4 text-right font-mono text-zinc-400">Rp{{ number_format($row['kembalian'], 0, ',', '.') }}</td>
                            <td class="py-4 text-right">
                                <a href="/transaksi/cetak/{{ $row['id'] }}" target="_blank" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.14em] shadow-lg shadow-red-900/40 transition-all">
                                    <i class="fas fa-print"></i>
                                    Cetak Struk
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs uppercase tracking-widest text-zinc-500">Belum ada riwayat transaksi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
