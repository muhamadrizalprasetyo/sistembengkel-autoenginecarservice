@extends('layouts.admin')

@section('title', 'Manajemen Pengeluaran')

@section('content')
    <div class="space-y-6">
        {{-- Header Content --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-black tracking-tight text-white uppercase">Management Pengeluaran</h1>
                <p class="text-zinc-500 text-sm font-medium">Catat dan pantau semua pengeluaran operasional bengkel.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="bg-zinc-900/50 border border-white/5 px-4 py-2 rounded-2xl">
                    <p class="text-[10px] text-zinc-500 uppercase font-black tracking-widest">Total Pengeluaran</p>
                    <p class="text-lg font-black text-orange-500">Rp {{ number_format($totalAmount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Form Input (Left) --}}
            <div class="lg:col-span-1">
                <div class="bg-zinc-900/60 backdrop-blur-xl border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
                    <div class="p-6 border-b border-white/5 bg-gradient-to-r from-orange-500/10 to-transparent">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Catat Pengeluaran Baru</h3>
                    </div>
                    <form action="{{ route('expenses.store') }}" method="POST" class="p-6 space-y-4">
                        @csrf
                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">Tanggal</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" required
                                class="w-full bg-zinc-950 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500/50 transition-all text-white">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">Kategori</label>
                            <select name="category" required
                                class="w-full bg-zinc-950 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500/50 transition-all text-white">
                                <option value="Listrik">Listrik & Air</option>
                                <option value="Gaji">Gaji Karyawan</option>
                                <option value="Sewa">Sewa Tempat</option>
                                <option value="Stok">Pembelian Stok/Sparepart</option>
                                <option value="Alat">Pembelian Alat Bengkel</option>
                                <option value="Promosi">Iklan & Promosi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">Nominal
                                (Rp)</label>
                            <input type="number" name="amount" placeholder="0" required
                                class="w-full bg-zinc-950 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500/50 transition-all text-white font-mono">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">Metode
                                Pembayaran</label>
                            <select name="payment_method"
                                class="w-full bg-zinc-950 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500/50 transition-all text-white">
                                <option value="Tunai">Tunai</option>
                                <option value="Transfer">Transfer Bank</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black uppercase tracking-widest text-zinc-500 mb-2">Keterangan</label>
                            <textarea name="description" rows="3" placeholder="Contoh: Bayar tagihan listrik bulan Mei"
                                class="w-full bg-zinc-950 border border-white/10 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500/50 transition-all text-white"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black uppercase tracking-widest text-[11px] py-4 rounded-xl transition-all shadow-lg shadow-orange-900/40">
                            Simpan Pengeluaran
                        </button>
                    </form>
                </div>
            </div>

            {{-- Table List (Right) --}}
            <div class="lg:col-span-2">
                <div class="bg-zinc-900/60 backdrop-blur-xl border border-white/5 rounded-3xl overflow-hidden shadow-2xl">
                    <div class="p-6 border-b border-white/5 flex items-center justify-between">
                        <h3 class="text-sm font-black uppercase tracking-widest text-white">Riwayat Pengeluaran</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-white/5">
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                                        Tanggal</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                                        Kategori</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                                        Nominal</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                                        Metode</th>
                                    <th class="px-6 py-4 text-[10px] font-black uppercase tracking-widest text-zinc-400">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($expenses as $ex)
                                    <tr class="hover:bg-white/[0.02] transition-colors group">
                                        <td class="px-6 py-4">
                                            <p class="text-xs font-bold text-white">
                                                {{ \Carbon\Carbon::parse($ex->date)->format('d M Y') }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest bg-zinc-800 text-zinc-400 border border-white/5">
                                                {{ $ex->category }}
                                            </span>
                                            <p class="text-[10px] text-zinc-500 mt-1 truncate max-w-[150px]">
                                                {{ $ex->description }}</p>
                                        </td>
                                        <td class="px-6 py-4 font-mono text-sm font-bold text-white">
                                            Rp {{ number_format($ex->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <p class="text-[10px] font-black text-zinc-400 tracking-widest uppercase">
                                                {{ $ex->payment_method }}</p>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('expenses.destroy', $ex->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-8 h-8 rounded-lg bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all">
                                                    <i class="fas fa-trash-can text-xs"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-20 text-center">
                                            <i class="fas fa-receipt text-4xl text-zinc-800 mb-4 block"></i>
                                            <p class="text-zinc-500 text-xs font-black uppercase tracking-widest text-center">
                                                Belum ada catatan pengeluaran.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($expenses->hasPages())
                        <div class="px-6 py-4 border-t border-white/5">
                            {{ $expenses->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection