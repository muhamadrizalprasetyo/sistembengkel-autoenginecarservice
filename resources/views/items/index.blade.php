@extends('layouts.admin')

@section('title', 'Manajemen Stok')

@section('content')
<div x-data="{ 
    openModal: false, 
    bulkMode: false,
    selectedItems: [],
    item: { id: '', name: '', price: '', stock: '', category: '' } 
}" class="max-w-[1400px] mx-auto pb-24 px-4 md:px-8">

    <header class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-2 h-8 bg-red-600 rounded-full"></div>
                <h2 class="text-3xl font-black tracking-tighter text-white uppercase">Kontrol <span class="text-red-600">Inventaris</span></h2>
            </div>
            <p class="text-[10px] font-bold text-zinc-600 uppercase tracking-[0.35em] ml-5">Auto Engine | Pusat Stok Eksekutif</p>
        </div>
        <button
            @click="bulkMode = !bulkMode; selectedItems = []"
            :class="bulkMode ? 'bg-red-600 text-white shadow-lg shadow-red-600/20' : 'bg-zinc-900 text-zinc-400 border-white/5'"
            class="px-6 py-4 rounded-2xl border border-white/5 font-black uppercase text-[10px] tracking-widest transition-all active:scale-95 flex items-center justify-center gap-2 min-w-[180px]"
        >
            <i class="fas" :class="bulkMode ? 'fa-times' : 'fa-layer-group'"></i>
            <span x-text="bulkMode ? 'Batal Pilih' : 'Aksi Massal'"></span>
        </button>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Register Form --}}
        <div class="lg:col-span-4">
            <div class="bg-zinc-900/80 backdrop-blur-xl p-8 rounded-[2.5rem] border border-white/5 shadow-2xl relative overflow-hidden group">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-red-600/5 rounded-full blur-3xl"></div>
                
                <h3 class="text-[11px] font-black uppercase tracking-[0.2em] mb-10 text-red-600 italic flex items-center gap-3">
                    <i class="fas fa-plus-circle"></i> Registrasi Barang Baru
                </h3>
                
                <form action="/items/simpan" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Nama Barang / Jasa</label>
                        <input type="text" name="name" required placeholder="NAMA BARANG / JASA" class="w-full bg-black/40 border border-white/5 py-5 px-6 rounded-2xl font-bold text-sm text-white uppercase outline-none focus:border-red-600 transition-all placeholder:text-zinc-700 focus:ring-4 focus:ring-red-600/10">
                    </div>

                    <div class="space-y-2">
                        <label class="text-[9px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Kategori</label>
                        <select name="category" required class="w-full bg-black/40 border border-white/5 py-5 px-6 rounded-2xl font-bold text-sm uppercase text-zinc-400 outline-none focus:border-red-600 cursor-pointer">
                            <option value="sparepart">Sparepart (Inventaris)</option>
                            <option value="service">Jasa (Layanan)</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Harga Jual</label>
                            <input type="number" name="price" required placeholder="0" class="w-full bg-black/40 border border-white/5 py-5 px-6 rounded-2xl font-bold text-sm text-white outline-none focus:border-red-600 transition-all font-mono">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[9px] font-black text-zinc-500 uppercase ml-2 tracking-widest">Stok Awal</label>
                            <input type="number" name="stock" placeholder="0" class="w-full bg-black/40 border border-white/5 py-5 px-6 rounded-2xl font-bold text-sm text-white outline-none focus:border-red-600 transition-all font-mono">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 py-6 rounded-3xl font-black uppercase text-xs mt-4 text-white transition-all active:scale-95 shadow-2xl shadow-red-600/30 italic flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i> Simpan ke Database
                    </button>
                </form>
            </div>
            <div class="mt-8 bg-zinc-900 border border-white/5 p-6 rounded-[2rem] flex items-center justify-between">
                <div>
                    <p class="text-[9px] font-black text-zinc-600 uppercase tracking-widest">Peringatan Stok</p>
                    <p class="text-xl font-black text-red-600 italic mt-1">{{ $critical_stock_items ?? 0 }} <span class="text-[10px] not-italic text-zinc-500 uppercase ml-1">Kritis</span></p>
                </div>
                <i class="fas fa-exclamation-triangle text-2xl text-red-600/20"></i>
            </div>
        </div>

        {{-- Table --}}
        <div class="lg:col-span-8">
            <form action="/items/bulk-delete" method="POST">
                @csrf
                {{-- Bulk Action Bar --}}
                <div 
                    x-show="bulkMode"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mb-6 flex justify-between items-center px-8 py-5 bg-red-600/10 border border-red-600/20 rounded-[2rem] backdrop-blur-md"
                >
                    <div class="flex items-center gap-4">
                        <input type="checkbox" id="selectAll" class="w-6 h-6 rounded-lg border-zinc-800 bg-black/60 text-red-600 focus:ring-red-600 cursor-pointer accent-red-600">
                        <label for="selectAll" class="text-xs font-black uppercase text-red-600 italic tracking-widest cursor-pointer">Pilih Semua Data</label>
                    </div>
                    <button type="submit" 
                        x-show="selectedItems.length > 0"
                        onclick="return confirm('Hapus data terpilih?')" 
                        class="bg-red-600 text-white px-8 py-3 rounded-2xl text-xs font-black uppercase italic shadow-2xl shadow-red-600/40 active:scale-95 transition-all">
                        Hapus Massal (<span x-text="selectedItems.length"></span>)
                    </button>
                </div>
                <div class="bg-zinc-900/40 rounded-[3rem] border border-white/5 overflow-hidden shadow-2xl backdrop-blur-sm">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="text-[10px] uppercase tracking-[0.3em] text-zinc-600 bg-black/40">
                                <th x-show="bulkMode" class="p-7 text-center w-14">#</th>
                                <th class="p-7 text-left font-black">Identitas Item</th>
                                <th class="p-7 text-left font-black">Harga Jual</th>
                                <th class="p-7 text-center font-black">Stock</th>
                                <th class="p-7 text-right font-black">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            @foreach($items as $item)
                                <tr class="hover:bg-white/[0.03] transition-colors duration-300 ease-out group">
                                    <td 
                                        x-show="bulkMode" 
                                        class="p-7 text-center bg-red-600/5 align-middle"
                                    >
                                        <input
                                            type="checkbox"
                                            name="ids[]"
                                            value="{{ $item->id }}"
                                            x-model="selectedItems"
                                            class="item-checkbox w-6 h-6 rounded-lg border-zinc-800 bg-black/60 text-red-600 focus:ring-red-600 cursor-pointer accent-red-600"
                                        >
                                    </td>
                                    <td class="p-7 align-middle">
                                        <p class="text-white font-black text-sm uppercase tracking-tight group-hover:text-red-500 transition-colors leading-none mb-2">{{ $item->name }}</p>
                                        <span class="text-[9px] font-black uppercase px-3 py-1 rounded-lg tracking-tighter {{ $item->category == 'sparepart' ? 'bg-blue-600/10 text-blue-400 border border-blue-600/20' : 'bg-purple-600/10 text-purple-400 border border-purple-600/20' }}">
                                            {{ strtoupper($item->category) }}
                                        </span>
                                    </td>
                                    <td class="p-7 align-middle">
                                        <span class="font-mono tabular-nums text-base font-black text-green-500">Rp{{ number_format((int)$item->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="p-7 text-center align-middle">
                                        <span class="text-[15px] font-black {{ $item->stock <= 3 ? 'text-red-500 animate-pulse' : 'text-zinc-300' }}">{{ (int)$item->stock }}</span>
                                    </td>
                                    <td class="p-7 text-right align-middle">
                                        <div class="flex justify-end gap-3">
                                            <button type="button"
                                                @click="openModal = true; item = { id: '{{ $item->id }}', name: '{{ $item->name }}', price: '{{ $item->price }}', stock: '{{ $item->stock }}' }"
                                                class="w-11 h-11 flex items-center justify-center rounded-2xl bg-zinc-800 text-zinc-500 hover:bg-white hover:text-black transition-all shadow-xl shadow-black/40"
                                            >
                                                <i class="fas fa-sliders-h text-xs"></i>
                                            </button>
                                            <a href="/items/hapus/{{ $item->id }}"
                                                onclick="return confirm('Hapus item dari sistem?')"
                                                class="w-11 h-11 flex items-center justify-center rounded-2xl bg-red-900/10 text-red-900/50 hover:bg-red-600 hover:text-white transition-all"
                                            >
                                                <i class="fas fa-trash-alt text-xs"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @if($items->count() === 0)
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-zinc-500 text-xs font-bold uppercase">Belum ada data inventaris.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div x-show="openModal" class="fixed inset-0 z-[99] flex items-center justify-center p-4 bg-black/95 backdrop-blur-2xl" x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
        <div @click.away="openModal = false" class="bg-zinc-900 border border-white/10 p-12 rounded-[3rem] w-full max-w-lg shadow-2xl relative overflow-hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-3"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">
            <div class="absolute top-0 left-0 w-full h-[3px] bg-gradient-to-r from-red-600 via-red-400 to-transparent"></div>
            <h3 class="text-[11px] font-black uppercase tracking-[0.3em] mb-10 text-red-600 italic">Penyesuaian Data</h3> 
            <form :action="'/items/update/' + item.id" method="POST" class="space-y-8">
                @csrf
                <div class="space-y-3">
                    <label class="text-[10px] font-black text-zinc-600 uppercase ml-2 tracking-widest">Nama Item</label>
                    <input type="text" name="name" x-model="item.name" class="w-full bg-black/60 border border-white/10 py-6 px-8 rounded-3xl font-black text-lg text-white uppercase outline-none focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition-all shadow-inner">
                </div>
                <div class="grid grid-cols-2 gap-6">
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-zinc-600 uppercase ml-2 tracking-widest">Harga Jual</label>
                        <input type="number" name="price" x-model="item.price" class="w-full bg-black/60 border border-white/10 py-6 px-8 rounded-3xl font-black text-lg text-white outline-none focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition-all shadow-inner font-mono">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] font-black text-zinc-600 uppercase ml-2 tracking-widest">Stok</label>
                        <input type="number" name="stock" x-model="item.stock" class="w-full bg-black/60 border border-white/10 py-6 px-8 rounded-3xl font-black text-lg text-white outline-none focus:border-red-600 focus:ring-4 focus:ring-red-600/10 transition-all shadow-inner font-mono">
                    </div>
                </div>
                <div class="pt-6 flex flex-col gap-4">
                    <button type="submit" class="w-full bg-red-600 py-7 rounded-[2rem] font-black uppercase text-xs text-white italic shadow-2xl shadow-red-600/30 hover:bg-red-700 transition-all active:scale-95">
                        Simpan Perubahan
                    </button>
                    <button type="button" @click="openModal = false" class="text-zinc-600 text-[10px] font-black uppercase tracking-[0.4em] hover:text-white transition-all">
                        Batalkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('selectAll');
        if (selectAll) {
            selectAll.addEventListener('change', function() {
                const root = document.querySelector('[x-data]');
                const alpineData = root && root._x_dataStack ? root._x_dataStack[0] : null;
                if (!alpineData) return;
                const checkboxes = document.querySelectorAll('.item-checkbox');
                if (this.checked) {
                    const allIds = Array.from(checkboxes).map(el => el.value);
                    alpineData.selectedItems = allIds;
                } else {
                    alpineData.selectedItems = [];
                }
            });
        }
    });
</script>
<style>
    [x-cloak] { display: none !important; }
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #27272a; border-radius: 20px; border: 2px solid transparent; background-clip: content-box; }
    ::-webkit-scrollbar-thumb:hover { background: #ef4444; }
</style>
@endsection