@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
<div class="max-w-4xl mx-auto">
    <header class="mb-8">
        <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-500">Inti Konfigurasi</p>
        <h1 class="text-3xl font-black uppercase tracking-tight text-white">Pengaturan <span class="text-red-600">Sistem</span></h1>
    </header>

    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-400/30 text-emerald-300 text-xs font-black uppercase tracking-wider">
            {{ session('success') }}
        </div>
    @endif

    <section class="bg-zinc-900 border border-white/5 rounded-3xl p-8">
        <form action="/settings" method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Nama Bengkel</label>
                <input type="text" name="workshop_name" value="{{ old('workshop_name', $settings['workshop_name'] ?? '') }}" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 text-white uppercase font-black text-xs outline-none focus:border-red-600">
            </div>

            <div>
                <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Alamat Struk</label>
                <input type="text" name="receipt_address" value="{{ old('receipt_address', $settings['receipt_address'] ?? '') }}" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 text-white font-black text-xs outline-none focus:border-red-600">
            </div>

            <div>
                <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">No. Telepon Bengkel</label>
                <input type="text" name="workshop_phone" value="{{ old('workshop_phone', $settings['workshop_phone'] ?? '') }}" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 text-white font-mono text-xs outline-none focus:border-red-600">
            </div>

            <div>
                <label class="block mb-2 text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500">Footer Struk</label>
                <textarea name="receipt_footer" rows="3" class="w-full bg-black/40 border border-white/10 rounded-2xl px-5 py-4 text-white text-xs outline-none focus:border-red-600">{{ old('receipt_footer', $settings['receipt_footer'] ?? '') }}</textarea>
            </div>

            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 rounded-2xl py-4 text-sm font-black uppercase tracking-[0.14em] text-white">
                Simpan Pengaturan Sistem
            </button>
        </form>
    </section>
</div>
@endsection
