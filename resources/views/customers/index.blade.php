@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('content')
<div class="max-w-7xl mx-auto">
    <header class="mb-8">
        <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-500">Konsol CRM</p>
        <h1 class="text-3xl font-black uppercase tracking-tight text-white">Data <span class="text-red-600">Pelanggan</span></h1>
    </header>

    <section class="bg-zinc-900 border border-white/5 rounded-3xl p-6">
        <div class="overflow-auto">
            <table class="w-full min-w-[760px]">
                <thead>
                    <tr class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 border-b border-white/5">
                        <th class="text-left pb-3">Plat Nomor</th>
                        <th class="text-left pb-3">Nama Pemilik</th>
                        <th class="text-left pb-3">No. WA</th>
                        <th class="text-right pb-3">Jumlah Kunjungan</th>
                        <th class="text-right pb-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($customers as $customer)
                        <tr>
                            <td class="py-3 font-mono text-zinc-300">{{ $customer['plate_number'] }}</td>
                            <td class="py-3 text-xs font-black uppercase tracking-wide text-zinc-100">{{ $customer['customer_name'] }}</td>
                            <td class="py-3 font-mono text-zinc-300">{{ $customer['customer_phone'] }}</td>
                            <td class="py-3 text-right font-mono text-white">{{ number_format($customer['visit_count']) }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ $customer['wa_link'] }}?text={{ urlencode('Halo, ini reminder servis/ganti oli dari Auto Engine.') }}" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600/20 border border-emerald-400/40 text-emerald-300 hover:bg-emerald-500/30 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-[0.14em] transition-all">
                                    <i class="fab fa-whatsapp"></i>
                                    KIRIM WA
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-4 text-xs uppercase tracking-widest text-zinc-500">Belum ada data pelanggan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
