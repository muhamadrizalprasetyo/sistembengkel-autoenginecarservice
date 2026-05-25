@extends('layouts.admin')

@section('title', 'Feedback Pelanggan')

@section('content')
    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[10px] uppercase tracking-[0.35em] text-purple-400 font-black mb-1">Admin Panel</p>
                <h1 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                    Feedback <span class="text-purple-400">Pelanggan</span>
                </h1>
                <p class="text-sm text-zinc-500 mt-1">Saran, kritik, dan pertanyaan yang dikirimkan pelanggan.</p>
            </div>
            <div class="flex items-center gap-3">
                @if($stats['unread'] > 0)
                    <span class="inline-flex items-center gap-2 px-4 py-2 bg-purple-600/15 border border-purple-500/30 rounded-xl text-purple-400 text-sm font-black">
                        <i class="fas fa-circle-dot fa-xs animate-pulse"></i>
                        {{ $stats['unread'] }} Belum Dibaca
                    </span>
                @endif
            </div>
        </div>

        {{-- Alert --}}
        @if(session('success'))
            <div class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-500/30 rounded-xl text-green-400 text-sm font-bold">
                <i class="fas fa-circle-check fa-lg flex-shrink-0"></i>
                {{ session('success') }}
            </div>
        @endif

        {{-- Stats Cards --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Total Masuk', 'value' => $stats['total'], 'icon' => 'fa-inbox', 'cls' => 'bg-zinc-500/10 border-zinc-500/20 text-zinc-400'],
                ['label' => 'Belum Dibaca', 'value' => $stats['unread'], 'icon' => 'fa-envelope', 'cls' => 'bg-purple-500/10 border-purple-500/20 text-purple-400'],
                ['label' => 'Saran', 'value' => $stats['saran'], 'icon' => 'fa-lightbulb', 'cls' => 'bg-yellow-500/10 border-yellow-500/20 text-yellow-500'],
                ['label' => 'Pertanyaan', 'value' => $stats['pertanyaan'], 'icon' => 'fa-circle-question', 'cls' => 'bg-blue-500/10 border-blue-500/20 text-blue-400'],
            ] as $card)
            <div class="bg-zinc-900/60 border border-white/6 rounded-2xl p-6 transition-all duration-300 flex items-center justify-between">
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-zinc-500 font-black mb-1.5">{{ $card['label'] }}</p>
                    <p class="text-3xl font-black text-white">{{ $card['value'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center border {{ $card['cls'] }} shadow-lg">
                    <i class="fas {{ $card['icon'] }} text-lg"></i>
                </div>
            </div>
        @endforeach
        </div>

        {{-- Feedbacks List --}}
        <div class="bg-zinc-900/60 border border-white/6 rounded-2xl overflow-hidden">
            <div class="px-6 py-4 border-b border-white/6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <i class="fas fa-comments text-purple-400"></i>
                    <h2 class="text-sm font-black uppercase tracking-wider text-zinc-200">Semua Pesan</h2>
                </div>
                <span class="text-xs text-zinc-600 font-bold">{{ $feedbacks->count() }} pesan</span>
            </div>

            @forelse($feedbacks as $fb)
                @php
                    $typeConfig = [
                        'saran' => ['💡', 'Saran', 'yellow', 'bg-yellow-900/30 border-yellow-500/20 text-yellow-400'],
                        'pertanyaan' => ['❓', 'Pertanyaan', 'blue', 'bg-blue-900/30 border-blue-500/20 text-blue-400'],
                        'kritik' => ['🔥', 'Kritik', 'red', 'bg-orange-900/30 border-orange-500/20 text-orange-400'],
                    ];
                    [$fbEmoji, $fbLabel, $fbColor, $fbBadgeCls] = $typeConfig[$fb->type] ?? ['💬', $fb->type, 'zinc', 'bg-zinc-800 border-zinc-700 text-zinc-400'];
                @endphp
                <div class="px-6 py-5 border-b border-white/4 hover:bg-zinc-800/30 transition-colors group">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex items-start gap-4 flex-1 min-w-0">
                            {{-- Type indicator --}}
                            @php
                                $iconBoxCls = [
                                    'yellow' => 'bg-yellow-500/10 border-yellow-500/20',
                                    'blue' => 'bg-blue-500/10 border-blue-500/20',
                                    'red' => 'bg-orange-500/10 border-orange-500/20',
                                    'zinc' => 'bg-zinc-500/10 border-zinc-500/20',
                                ][$fbColor] ?? 'bg-zinc-500/10 border-zinc-500/20';
                            @endphp
                            <div class="flex-shrink-0 w-10 h-10 rounded-xl border flex items-center justify-center text-lg {{ $iconBoxCls }}">
                                {{ $fbEmoji }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-2">
                                    <span class="font-black text-sm text-white">{{ $fb->name }}</span>
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[9px] font-black uppercase tracking-widest border {{ $fbBadgeCls }}">
                                        {{ $fbLabel }}
                                    </span>
                                    @if($fb->booking_ref)
                                        <span class="text-[10px] text-zinc-600 font-mono font-bold">Ref: {{ $fb->booking_ref }}</span>
                                    @endif
                                </div>
                                <p class="text-sm text-zinc-300 leading-relaxed break-words">{{ $fb->message }}</p>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-[10px] text-zinc-600 font-bold uppercase tracking-widest">
                                        <i class="fas fa-clock fa-xs mr-1"></i>
                                        {{ $fb->created_at->diffForHumans() }}
                                    </span>
                                    <span class="text-[10px] text-zinc-700">·</span>
                                    <span class="text-[10px] text-zinc-600 font-bold">
                                        {{ $fb->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Button --}}
                        <form action="{{ route('admin.feedbacks.destroy', $fb->id) }}" method="POST" class="flex-shrink-0"
                              onsubmit="return confirm('Hapus feedback ini dari {{ addslashes($fb->name) }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="opacity-0 group-hover:opacity-100 w-9 h-9 rounded-xl border border-orange-500/20 text-orange-500/60 hover:text-orange-400 hover:bg-orange-900/20 hover:border-orange-500/40 transition-all flex items-center justify-center text-sm">
                                <i class="fas fa-trash-can fa-xs"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-24 text-center">
                    <i class="fas fa-inbox text-5xl text-zinc-700 block mb-4"></i>
                    <p class="text-zinc-500 font-black uppercase tracking-widest text-sm">Belum ada feedback dari pelanggan.</p>
                </div>
            @endforelse
        </div>

    </div>
@endsection
