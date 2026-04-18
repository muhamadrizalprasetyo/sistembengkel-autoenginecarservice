@extends('layouts.admin')

@section('title', 'Pusat Kendali')

@section('content')
<div class="max-w-7xl mx-auto px-2 md:px-4 pt-4 pb-10">
    <header class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-8">
        <div>
            <p class="text-[10px] uppercase tracking-[0.35em] font-black text-zinc-500">Pusat Kendali</p>
            <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tight text-white">Auto Engine <span class="text-red-600">Sistem Eksekutif</span></h1>
        </div>
        <div class="text-left lg:text-right">
            <p class="text-[10px] uppercase tracking-[0.25em] font-black text-zinc-500">{{ now()->locale('id')->translatedFormat('l') }}</p>
            <p class="font-mono text-sm text-zinc-200">{{ now()->format('d M Y H:i') }}</p>
        </div>
    </header>

    <section class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 mb-8">
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Pendapatan Bulan Ini</p>
            <p class="font-mono text-2xl font-black text-red-500">{{ $formatted_monthly_revenue }}</p>
        </article>
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Total Transaksi</p>
            <p class="font-mono text-2xl font-black text-white">{{ number_format($global_transactions) }}</p>
        </article>
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Inventaris Aktif</p>
            <p class="font-mono text-2xl font-black text-white">{{ number_format($active_inventory) }}</p>
        </article>
        <article class="bg-zinc-900 border border-white/5 rounded-3xl p-5">
            <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2">Peringatan Stok Kritis</p>
            <p class="font-mono text-2xl font-black text-red-500">{{ number_format($critical_stock_alerts) }}</p>
        </article>
    </section>

    <section class="grid grid-cols-1 xl:grid-cols-12 gap-5">
        <div class="xl:col-span-8 space-y-5">
            <article class="bg-zinc-900 border border-white/5 rounded-3xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-[11px] uppercase tracking-[0.25em] font-black text-red-500">Gelombang Pendapatan</h2>
                </div>
                <div class="h-64">
                    <canvas id="revenueWaveChart"></canvas>
                </div>
            </article>
            <article class="bg-zinc-900 border border-white/5 rounded-3xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-[11px] uppercase tracking-[0.25em] font-black text-red-500">Kecepatan Perputaran Stok</h2>
                </div>
                <div class="h-64">
                    <canvas id="stockVelocityChart"></canvas>
                </div>
            </article>
        </div>

        <aside class="xl:col-span-4">
            <div class="bg-zinc-900 border border-white/5 rounded-3xl p-6 h-full">
                <h3 class="text-[11px] uppercase tracking-[0.25em] font-black text-red-500 mb-4">Peringatan Operasional</h3>
                <div class="overflow-auto max-h-[560px]">
                    <table class="w-full">
                        <thead>
                            <tr class="text-zinc-500 text-[10px] uppercase tracking-[0.2em] border-b border-white/5">
                                <th class="text-left pb-3">Item</th>
                                <th class="text-right pb-3">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @forelse($operational_alerts as $alert)
                                <tr>
                                    <td class="py-3 text-xs font-black uppercase tracking-wide text-zinc-200">{{ $alert['name'] }}</td>
                                    <td class="py-3 text-right font-mono text-red-500 font-black animate-pulse">{{ $alert['stock'] }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-4 text-xs text-zinc-500 uppercase tracking-wider">Tidak ada peringatan kritis.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
    </section>
</div>
@endsection

@section('extra_js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const revenueEl = document.getElementById('revenueWaveChart');
    if (revenueEl) {
        const revenueCtx = revenueEl.getContext('2d');
        const revenueGradient = revenueCtx.createLinearGradient(0, 0, 0, 260);
        revenueGradient.addColorStop(0, 'rgba(220, 38, 38, 0.35)');
        revenueGradient.addColorStop(1, 'rgba(220, 38, 38, 0)');

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: @json($revenue_wave_labels),
                datasets: [{
                    label: 'Pendapatan',
                    data: @json($revenue_wave_data),
                    borderColor: '#dc2626',
                    backgroundColor: revenueGradient,
                    borderWidth: 2.5,
                    tension: 0.35,
                    fill: true,
                    pointRadius: 3,
                    pointBackgroundColor: '#dc2626',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#a1a1aa' }, grid: { color: 'rgba(255,255,255,0.03)' } },
                    y: {
                        ticks: {
                            color: '#a1a1aa',
                            callback: (value) => 'Rp' + Number(value).toLocaleString('id-ID'),
                        },
                        grid: { color: 'rgba(255,255,255,0.03)' }
                    }
                }
            }
        });
    }

    const stockEl = document.getElementById('stockVelocityChart');
    if (stockEl) {
        new Chart(stockEl.getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($stock_velocity_labels),
                datasets: [{
                    label: 'Pemakaian',
                    data: @json($stock_velocity_data),
                    backgroundColor: 'rgba(220, 38, 38, 0.75)',
                    borderColor: '#dc2626',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#a1a1aa' }, grid: { color: 'rgba(255,255,255,0.03)' } },
                    y: { ticks: { color: '#a1a1aa' }, grid: { color: 'rgba(255,255,255,0.03)' } }
                }
            }
        });
    }
});
</script>
@endsection