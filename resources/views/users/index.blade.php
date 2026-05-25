@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')
    <div class="max-w-5xl mx-auto space-y-6">

        <header class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <p class="text-[10px] uppercase tracking-[0.35em] text-orange-500 font-black mb-1">Super Admin Only</p>
                <h1 class="text-2xl md:text-3xl font-black uppercase tracking-tight text-white">
                    Manajemen <span class="text-orange-500">User</span>
                </h1>
                <p class="text-sm text-zinc-500 mt-1">Kelola akses pengguna sistem.</p>
            </div>
        </header>

        @if(session('success'))
            <div
                class="flex items-center gap-3 p-4 bg-green-900/20 border border-green-500/30 rounded-xl text-green-400 text-sm font-bold">
                <i class="fas fa-circle-check fa-lg flex-shrink-0"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div
                class="flex items-center gap-3 p-4 bg-orange-900/20 border border-orange-500/30 rounded-xl text-orange-400 text-sm font-bold">
                <i class="fas fa-circle-exclamation fa-lg flex-shrink-0"></i> {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 xl:grid-cols-12 gap-6">

            {{-- Tambah User Form --}}
            <div class="xl:col-span-4">
                <div class="bg-zinc-900/60 border border-white/6 rounded-2xl p-6">
                    <h2 class="text-[10px] uppercase tracking-[0.25em] font-black text-orange-500 mb-5">+ Tambah User Baru</h2>
                    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label
                                class="block text-[9px] uppercase tracking-widest font-black text-zinc-500 mb-1">Nama</label>
                            <input type="text" name="name" required value="{{ old('name') }}" placeholder="Nama Lengkap"
                                class="w-full bg-black/40 border border-white/8 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label
                                class="block text-[9px] uppercase tracking-widest font-black text-zinc-500 mb-1">Email</label>
                            <input type="email" name="email" required value="{{ old('email') }}"
                                placeholder="email@contoh.com"
                                class="w-full bg-black/40 border border-white/8 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label
                                class="block text-[9px] uppercase tracking-widest font-black text-zinc-500 mb-1">Role</label>
                            <select name="role"
                                class="w-full bg-black/40 border border-white/8 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500 cursor-pointer">
                                <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin
                                </option>
                            </select>
                        </div>
                        <div>
                            <label
                                class="block text-[9px] uppercase tracking-widest font-black text-zinc-500 mb-1">Password</label>
                            <input type="password" name="password" required placeholder="Min. 6 karakter"
                                class="w-full bg-black/40 border border-white/8 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500">
                        </div>
                        <div>
                            <label
                                class="block text-[9px] uppercase tracking-widest font-black text-zinc-500 mb-1">Konfirmasi
                                Password</label>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi password"
                                class="w-full bg-black/40 border border-white/8 rounded-xl px-4 py-3 text-white text-sm outline-none focus:border-orange-500">
                        </div>
                        @if($errors->any())
                            <div class="text-orange-400 text-xs font-bold space-y-1">
                                @foreach($errors->all() as $e)<p>• {{ $e }}</p>@endforeach
                            </div>
                        @endif
                        <button type="submit"
                            class="w-full bg-orange-600 hover:bg-orange-700 rounded-xl py-3 text-sm font-black uppercase tracking-widest text-white transition-colors">
                            Tambah User
                        </button>
                    </form>
                </div>
            </div>

            {{-- Daftar User --}}
            <div class="xl:col-span-8">
                <div class="bg-zinc-900/60 border border-white/6 rounded-2xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-white/6 flex items-center gap-3">
                        <i class="fas fa-users text-orange-500"></i>
                        <h2 class="text-sm font-black uppercase tracking-wider text-zinc-200">Daftar Pengguna Sistem</h2>
                        <span class="ml-auto text-xs text-zinc-600">{{ $users->count() }} user</span>
                    </div>
                    <div class="divide-y divide-white/4">
                        @foreach($users as $user)
                            <div class="px-6 py-4 flex items-center gap-4 hover:bg-zinc-800/20 transition-colors">
                                {{-- Avatar --}}
                                <div
                                    class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-black flex-shrink-0
                                    {{ $user->role === 'superadmin' ? 'bg-orange-900/40 text-orange-400 border border-orange-500/20' : ($user->role === 'admin' ? 'bg-orange-900/40 text-orange-400 border border-orange-500/20' : 'bg-blue-900/40 text-blue-400 border border-blue-500/20') }}">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                {{-- Info --}}
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="text-sm font-black text-zinc-100">{{ $user->name }}</p>
                                        @if($user->id === auth()->id())
                                            <span
                                                class="text-[8px] px-2 py-0.5 bg-zinc-700 text-zinc-400 rounded-full font-black uppercase">Anda</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-zinc-500 font-mono">{{ $user->email }}</p>
                                </div>
                                {{-- Role Badge --}}
                                <span
                                    class="flex-shrink-0 inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border
                                    {{ $user->role === 'superadmin' ? 'bg-orange-900/30 text-orange-400 border-orange-500/20' : ($user->role === 'admin' ? 'bg-orange-900/30 text-orange-400 border-orange-500/20' : 'bg-blue-900/30 text-blue-400 border-blue-500/20') }}">
                                    <i
                                        class="fas {{ $user->role === 'superadmin' ? 'fa-crown' : ($user->role === 'admin' ? 'fa-shield' : 'fa-cash-register') }} fa-xs"></i>
                                    {{ ucfirst($user->role) }}
                                </span>
                                {{-- Actions --}}
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST"
                                        onsubmit="return confirm('Hapus user {{ $user->name }}? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="p-2 rounded-lg text-zinc-600 hover:text-orange-400 hover:bg-orange-900/20 transition-all">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @else
                                    <div class="w-8"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Role Guide --}}
                <div class="mt-4 bg-zinc-900/40 border border-white/5 rounded-2xl p-5">
                    <p class="text-[10px] uppercase tracking-[0.25em] font-black text-zinc-500 mb-3">Panduan Role</p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs text-zinc-500">
                        <div class="flex items-start gap-2">
                            <i class="fas fa-crown text-orange-400 mt-0.5"></i>
                            <div>
                                <p class="font-black text-orange-400">Super Admin</p>
                                <p>Akses penuh: termasuk settings, user mgmt, semua laporan</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-shield text-orange-400 mt-0.5"></i>
                            <div>
                                <p class="font-black text-orange-400">Admin</p>
                                <p>Kelola booking, stok, feedback, laporan. Tidak bisa atur user/settings</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <i class="fas fa-cash-register text-blue-400 mt-0.5"></i>
                            <div>
                                <p class="font-black text-blue-400">Kasir</p>
                                <p>Hanya bisa akses kasir & lihat riwayat transaksi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
