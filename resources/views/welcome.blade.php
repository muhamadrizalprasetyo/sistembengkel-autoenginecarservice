@extends('layouts.admin')

@section('title', 'Pusat Kendali')

@section('content')
    <div class="max-w-7xl mx-auto px-2 md:px-4 pt-4 pb-10">
        <header class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-8">
            <div>
                <p class="text-[10px] uppercase tracking-[0.35em] font-black text-zinc-500">Pusat Kendali</p>
                <h1 class="text-3xl md:text-4xl font-black uppercase tracking-tight text-white">Auto Engine <span
                        class="text-orange-600">Sistem Eksekutif</span></h1>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('kasir') }}"
                    class="flex items-center gap-2 bg-orange-600 hover:bg-orange-500 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">
                    <i class="fas fa-plus"></i> Transaksi Baru
                </a>
                <a href="{{ route('admin.bookings.index') }}"
                    class="flex items-center gap-2 bg-zinc-800 hover:bg-zinc-700 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all border border-white/5">
                    <i class="fas fa-calendar-alt"></i> Cek Reservasi
                </a>
            </div>
        </header>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            {{-- Pendapatan --}}
            <article
                class="bg-zinc-900 border border-white/5 rounded-3xl p-5 hover:border-orange-500/20 transition-all relative overflow-hidden group">
                <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2 flex items-center gap-2">
                    <i class="fas fa-coins text-orange-500"></i> Pendapatan
                </p>
                <div class="flex items-baseline gap-2">
                    <p class="font-mono text-2xl font-black text-orange-500">{{ $formatted_monthly_revenue }}</p>
                    @if($revenue_growth != 0)
                        <span class="text-[9px] font-black {{ $revenue_growth > 0 ? 'text-emerald-500' : 'text-rose-500' }}">
                            <i class="fas fa-caret-{{ $revenue_growth > 0 ? 'up' : 'down' }}"></i> {{ abs($revenue_growth) }}%
                        </span>
                    @endif
                </div>
            </article>

            {{-- Pengeluaran --}}
            <article
                class="bg-zinc-900 border border-white/5 rounded-3xl p-5 hover:border-rose-500/20 transition-all relative overflow-hidden group">
                <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2 flex items-center gap-2">
                    <i class="fas fa-arrow-up-from-bracket text-rose-500"></i> Pengeluaran
                </p>
                <p class="font-mono text-2xl font-black text-rose-500">{{ $formatted_monthly_expense }}</p>
            </article>

            {{-- Laba Bersih --}}
            <article
                class="bg-zinc-900 border border-white/5 rounded-3xl p-5 hover:border-emerald-500/20 transition-all relative overflow-hidden group">
                <p class="text-[10px] uppercase tracking-[0.24em] font-black text-zinc-500 mb-2 flex items-center gap-2">
                    <i class="fas fa-vault text-emerald-500"></i> Laba Bersih
                </p>
                <p class="font-mono text-2xl font-black text-emerald-500">{{ $formatted_net_profit }}</p>
            </article>

            {{-- Pending Bookings --}}
            <a href="{{ route('admin.bookings.index') }}"
                class="bg-orange-600 border border-orange-500 rounded-3xl p-5 hover:bg-orange-500 transition-all block group shadow-lg shadow-orange-900/20">
                <p
                    class="text-[10px] uppercase tracking-[0.24em] font-black text-white/80 mb-2 flex items-center justify-between">
                    <span><i class="fas fa-hourglass-half mr-2"></i>Antrean Booking</span>
                    <i class="fas fa-arrow-right text-[8px] opacity-50 group-hover:opacity-100 transition-all"></i>
                </p>
                <p class="font-mono text-2xl font-black text-white">{{ number_format($pending_bookings) }}</p>
            </a>
        </section>

        <section class="grid grid-cols-1 xl:grid-cols-12 gap-5">
            <div class="xl:col-span-8 space-y-5">
                {{-- Chart 1: Revenue Wave --}}
                <article class="bg-zinc-900 border border-white/5 rounded-3xl p-6 relative">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-[11px] uppercase tracking-[0.25em] font-black text-orange-500">Gelombang
                                Pendapatan</h2>
                            <p class="text-[9px] text-zinc-500 uppercase mt-1">Analisis 7 Hari Terakhir</p>
                        </div>
                        <div class="bg-white/5 px-3 py-1 rounded-full">
                            <p class="text-[9px] font-black text-zinc-400 uppercase tracking-widest">Live Scan</p>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="revenueWaveChart"></canvas>
                    </div>
                </article>

                {{-- Chart 2: Top Selling (Velocity) --}}
                <article class="bg-zinc-900 border border-white/5 rounded-3xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h2 class="text-[11px] uppercase tracking-[0.25em] font-black text-orange-500">Top 7 Moving
                                Parts</h2>
                            <p class="text-[9px] text-zinc-500 uppercase mt-1">Berdasarkan Volume Penjualan</p>
                        </div>
                        <i class="fas fa-bolt text-orange-500/50"></i>
                    </div>
                    <div class="h-64">
                        <canvas id="stockVelocityChart"></canvas>
                    </div>
                </article>
            </div>

            <aside class="xl:col-span-4 space-y-5">
                {{-- Operational Alerts --}}
                <div class="bg-zinc-900 border border-white/5 rounded-3xl p-6 h-full min-h-[400px]">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-[11px] uppercase tracking-[0.25em] font-black text-orange-500">System Alerts</h3>
                        <span
                            class="px-2 py-0.5 bg-orange-500/10 text-orange-500 text-[8px] font-black rounded uppercase">Priority
                            High</span>
                    </div>
                    <div class="space-y-4">
                        @forelse($operational_alerts as $alert)
                            <div
                                class="flex items-center justify-between p-3 bg-white/5 rounded-2xl border border-white/5 hover:border-orange-500/20 transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center justify-center text-orange-500 w-5">
                                        <i class="fas fa-triangle-exclamation text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-[10px] font-black uppercase tracking-wide text-zinc-200 line-clamp-1">
                                            {{ $alert['name'] }}
                                        </p>
                                        <p class="text-[8px] text-zinc-500 uppercase">Segera Restock</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="font-mono text-sm text-orange-500 font-black animate-pulse">{{ $alert['stock'] }}
                                    </p>
                                    <p class="text-[7px] text-zinc-600 uppercase">Sisa</p>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center">
                                <i class="fas fa-check-circle text-emerald-500/20 text-4xl mb-3"></i>
                                <p class="text-[10px] text-zinc-500 uppercase tracking-widest">Semua sistem aman.</p>
                            </div>
                        @endforelse
                    </div>

                    @if($unread_feedbacks > 0)
                        <a href="{{ route('admin.feedbacks.index') }}"
                            class="mt-6 flex items-center justify-between p-4 bg-purple-500/10 border border-purple-500/20 rounded-2xl hover:bg-purple-500/20 transition-all group">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-comment-dots text-purple-400"></i>
                                <span
                                    class="text-[10px] font-black text-purple-300 uppercase underline decoration-purple-500/30">Ada
                                    {{ $unread_feedbacks }} Feedback Baru</span>
                            </div>
                            <i
                                class="fas fa-chevron-right text-[10px] text-purple-500 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    @endif
                </div>
            </aside>
        </section>
    </div>
@endsection

@section('extra_js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart Configs
            Chart.defaults.color = '#52525b';
            Chart.defaults.font.family = 'Plus Jakarta Sans';

            const revenueEl = document.getElementById('revenueWaveChart');
            if (revenueEl) {
                const revenueCtx = revenueEl.getContext('2d');
                const revenueGradient = revenueCtx.createLinearGradient(0, 0, 0, 260);
                revenueGradient.addColorStop(0, 'rgba(249, 115, 22, 0.2)');
                revenueGradient.addColorStop(1, 'rgba(249, 115, 22, 0)');

                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: @json($revenue_wave_labels),
                        datasets: [{
                            label: 'Revenue',
                            data: @json($revenue_wave_data),
                            borderColor: '#f97316',
                            backgroundColor: revenueGradient,
                            borderWidth: 3,
                            tension: 0.4,
                            fill: true,
                            pointRadius: 4,
                            pointBackgroundColor: '#09090b',
                            pointBorderColor: '#f97316',
                            pointBorderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false } },
                            y: {
                                grid: { color: 'rgba(255,255,255,0.03)' },
                                ticks: {
                                    callback: (v) => 'Rp' + (v >= 1000000 ? (v / 1000000).toFixed(1) + 'M' : (v / 1000).toFixed(0) + 'K')
                                }
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
                            label: 'Qty Terjual',
                            data: @json($stock_velocity_data),
                            backgroundColor: 'rgba(249, 115, 22, 0.8)',
                            borderRadius: 8,
                            barThickness: 25,
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            x: { grid: { display: false } },
                            y: { grid: { color: 'rgba(255,255,255,0.03)' } }
                        }
                    }
                });
            }
        });
    </script>
@endsection