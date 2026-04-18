@extends('layouts.admin')

@section('title', 'Kasir')

@section('content')
<div x-data="posSystem()" class="max-w-7xl mx-auto pb-20">
    <header class="mb-8 flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
        <div>
            <p class="text-[10px] uppercase tracking-[0.3em] text-zinc-500 font-black">Pusat Kasir</p>
            <h2 class="text-3xl font-black uppercase tracking-tight">Kasir <span class="text-red-600">Eksekutif</span></h2>
        </div>
    </header>

    <form action="/transaksi/simpan" method="POST" enctype="multipart/form-data" @submit="handleSubmit">
        @csrf
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-5">
            <section class="xl:col-span-7 bg-zinc-900 border border-white/5 rounded-3xl p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-5">
                    <input type="text" name="customer_name" required placeholder="NAMA CUSTOMER" class="md:col-span-2 w-full bg-black/40 border border-white/5 py-4 px-5 rounded-2xl font-black text-xs uppercase text-white outline-none focus:border-red-600">
                    <input type="text" name="customer_phone" placeholder="NO WHATSAPP" class="w-full bg-black/40 border border-white/5 py-4 px-5 rounded-2xl font-black text-xs uppercase text-white outline-none focus:border-red-600">
                </div>

                <label class="mb-5 flex items-center justify-center border border-dashed border-white/10 rounded-2xl bg-black/20 h-16 cursor-pointer group">
                    <i class="fas fa-camera text-zinc-600 mr-2"></i>
                    <span class="text-[10px] font-black uppercase tracking-widest text-zinc-500">Foto Unit</span>
                    <input type="file" name="car_image" class="hidden" accept="image/*" capture="environment">
                </label>

                <div class="mb-4">
                    <input type="text" x-model="search" placeholder="Cari Sparepart / Jasa..." class="w-full bg-black/40 border border-white/5 py-4 px-5 rounded-2xl font-black text-xs uppercase text-white outline-none focus:border-red-600">
                </div>

                <div class="space-y-2 max-h-[540px] overflow-auto pr-1">
                    @foreach($items as $item)
                        <button
                            type="button"
                            x-show="matchesSearch('{{ strtoupper($item->name) }}')"
                            @click="addStockItem({ id: {{ $item->id }}, name: '{{ strtoupper($item->name) }}', price: {{ (int) $item->price }}, stock: {{ (int) $item->stock }}, category: '{{ $item->category }}' })"
                            class="w-full bg-black/30 border border-white/5 rounded-2xl px-4 py-3 text-left hover:border-red-600 transition-all">
                            <div class="flex justify-between items-center gap-3">
                                <div>
                                    <p class="text-xs font-black uppercase tracking-wide text-zinc-100">{{ $item->name }}</p>
                                    <p class="text-[10px] uppercase tracking-wider text-zinc-500">{{ strtoupper($item->category) }} | Stok {{ (int) $item->stock }}</p>
                                </div>
                                <p class="font-mono text-sm text-red-500">Rp{{ number_format((int) $item->price, 0, ',', '.') }}</p>
                            </div>
                        </button>
                    @endforeach
                </div>
            </section>

            <section class="xl:col-span-5 bg-zinc-900 border border-white/5 rounded-3xl p-6">
                <h3 class="text-[11px] uppercase tracking-[0.24em] font-black text-red-500 mb-4">Keranjang Belanja</h3>
                <div class="space-y-3 max-h-[560px] overflow-auto pr-1">
                    <template x-for="(row, index) in rows" :key="row.uuid">
                        <div class="bg-black/40 border border-white/5 rounded-2xl p-4">
                            <div class="flex justify-between items-start gap-2 mb-2">
                                <p class="text-xs font-black uppercase tracking-wide text-zinc-100" x-text="row.name"></p>
                                <button type="button" @click="removeRow(index)" class="text-zinc-500 hover:text-red-500"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="grid grid-cols-3 gap-2 items-center">
                                <input type="number" min="1" x-model.number="row.qty" @input="normalizeQty(row)" class="col-span-1 bg-zinc-950 border border-white/10 rounded-xl px-3 py-2 text-white text-xs font-black text-center">
                                <input type="text" :value="'Rp' + Number(row.price).toLocaleString('id-ID')" readonly class="col-span-2 bg-zinc-950 border border-white/10 rounded-xl px-3 py-2 text-red-500 text-xs font-mono">
                            </div>

                            <input type="hidden" name="item_id[]" :value="row.type === 'manual' ? 'manual' : row.id">
                            <input type="hidden" name="qty[]" :value="row.qty">
                            <template x-if="row.type === 'manual'">
                                <div class="mt-2 grid grid-cols-2 gap-2">
                                    <input type="text" name="manual_name[]" x-model="row.name" placeholder="NAMA JASA" class="bg-zinc-950 border border-white/10 rounded-xl px-3 py-2 text-xs text-white uppercase">
                                    <input type="number" name="manual_price[]" x-model.number="row.price" placeholder="HARGA JASA" class="bg-zinc-950 border border-white/10 rounded-xl px-3 py-2 text-xs text-white font-mono">
                                </div>
                            </template>
                        </div>
                    </template>
                </div>

                <button type="button" @click="addManualService()" class="mt-4 w-full bg-black/50 border border-red-600/40 text-red-500 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600/10">
                    Tambah Jasa Manual
                </button>

                <div class="mt-5 bg-black/50 border border-white/5 rounded-2xl p-4 flex justify-between items-center">
                    <span class="text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Total Bayar</span>
                    <span class="font-mono text-2xl font-black text-white" x-text="'Rp' + total().toLocaleString('id-ID')"></span>
                </div>

                <button type="submit" class="mt-5 w-full bg-red-600 hover:bg-red-700 py-6 rounded-3xl font-black uppercase tracking-[0.12em] text-sm text-white shadow-2xl shadow-red-900/50">
                    PROSES TRANSAKSI & CETAK STRUK
                </button>
            </section>
        </div>
    </form>
</div>
@endsection

@section('extra_js')
<script>
    function posSystem() {
        return {
            search: '',
            rows: [],
            matchesSearch(name) {
                return name.includes(this.search.toUpperCase());
            },
            addStockItem(item) {
                const existing = this.rows.find((r) => r.type === 'stock' && r.id === item.id);
                if (existing) {
                    existing.qty += 1;
                    return;
                }
                this.rows.push({
                    uuid: crypto.randomUUID(),
                    type: 'stock',
                    id: item.id,
                    name: item.name,
                    price: Number(item.price),
                    qty: 1,
                });
            },
            addManualService() {
                this.rows.push({
                    uuid: crypto.randomUUID(),
                    type: 'manual',
                    id: null,
                    name: 'JASA MANUAL',
                    price: 0,
                    qty: 1,
                });
            },
            removeRow(index) {
                this.rows.splice(index, 1);
            },
            normalizeQty(row) {
                if (!row.qty || row.qty < 1) {
                    row.qty = 1;
                }
            },
            total() {
                return this.rows.reduce((sum, row) => sum + (Number(row.price) * Number(row.qty)), 0);
            },
            handleSubmit(event) {
                if (this.rows.length === 0) {
                    event.preventDefault();
                    alert('Keranjang masih kosong.');
                }
            }
        };
    }
</script>
@endsection