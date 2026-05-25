<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AUTO ENGINE — Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Space Grotesk', sans-serif; background: #09090b; }

        .orb {
            position: absolute; border-radius: 50%;
            filter: blur(90px); pointer-events: none; will-change: transform;
        }

        .glass {
            background: rgba(15,15,17,0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.07);
        }

        .input-field {
            width: 100%;
            background: rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 14px 16px 14px 46px;
            color: #fff;
            font-size: 14px;
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 500;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .input-field:focus {
            border-color: #f97316;
            box-shadow: 0 0 0 1px #f97316, 0 0 16px rgba(249,115,22,0.2);
        }
        .input-field::placeholder { color: #52525b; }

        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ea580c, #f97316);
            border: none;
            border-radius: 14px;
            color: #fff;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 14px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            cursor: pointer;
            box-shadow: 0 0 30px rgba(249,115,22,0.35);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-login:hover { transform: translateY(-2px); box-shadow: 0 0 40px rgba(249,115,22,0.5); }
        .btn-login:active { transform: scale(0.98); }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .float-icon { animation: float 4s ease-in-out infinite; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">

    <!-- Background Orbs -->
    <div class="orb w-96 h-96 bg-orange-600/20 top-0 left-1/4 opacity-50"></div>
    <div class="orb w-64 h-64 bg-orange-700/15 bottom-0 right-1/4 opacity-40"></div>
    <div class="orb w-48 h-48 bg-orange-400/10 top-1/2 right-0 opacity-30"></div>

    <!-- Grid pattern overlay -->
    <div class="absolute inset-0" style="background-image: linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px); background-size: 40px 40px;"></div>

    <div class="relative z-10 w-full max-w-md px-4">
        <!-- Logo -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-24 h-24 mb-5 overflow-hidden rounded-2xl shadow-2xl shadow-orange-900/60">
                <img src="{{ asset('logo.jpg') }}" alt="Auto Engine Logo" class="w-full h-full object-cover">
            </div>
            <p class="text-[10px] uppercase tracking-[0.4em] text-zinc-500 font-black mb-1">Sistem Manajemen</p>
            <h1 class="text-2xl font-black uppercase tracking-tight text-white">Auto<span class="text-orange-500">Engine</span></h1>
        </div>

        <!-- Card -->
        <div class="glass rounded-3xl p-8">
            <p class="text-[10px] uppercase tracking-[0.3em] font-black text-zinc-500 mb-1">Selamat Datang</p>
            <h2 class="text-xl font-black text-white mb-6">Masuk ke Panel Admin</h2>

            @if($errors->any())
            <div class="mb-5 flex items-center gap-3 p-4 bg-orange-900/20 border border-orange-500/30 rounded-xl">
                <i class="fas fa-circle-exclamation text-orange-400 flex-shrink-0"></i>
                <p class="text-orange-300 text-sm font-bold">{{ $errors->first() }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-5 flex items-center gap-3 p-4 bg-orange-900/20 border border-orange-500/30 rounded-xl">
                <i class="fas fa-circle-exclamation text-orange-400 flex-shrink-0"></i>
                <p class="text-orange-300 text-sm font-bold">{{ session('error') }}</p>
            </div>
            @endif

            <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500 mb-2">
                        <i class="fas fa-envelope mr-1"></i> Email
                    </label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-zinc-600 text-sm pointer-events-none"></i>
                        <input type="email" name="email" required autocomplete="email"
                            value="{{ old('email') }}"
                            placeholder="admin@autoengine.id"
                            class="input-field">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-[10px] uppercase tracking-[0.2em] font-black text-zinc-500 mb-2">
                        <i class="fas fa-lock mr-1"></i> Password
                    </label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-zinc-600 text-sm pointer-events-none"></i>
                        <input type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="input-field" id="passwordField">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-zinc-600 hover:text-zinc-300 transition-colors">
                            <i class="fas fa-eye" id="eyeIcon"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember -->
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember"
                        class="w-4 h-4 rounded bg-zinc-800 border-zinc-600 accent-orange-500">
                    <label for="remember" class="text-xs text-zinc-500 font-bold cursor-pointer">Ingat Saya</label>
                </div>

                <button type="submit" class="btn-login mt-2">
                    <i class="fas fa-right-to-bracket mr-2"></i> Masuk Sekarang
                </button>
            </form>

            <!-- Hint Akun -->
            <div class="mt-6 pt-5 border-t border-white/5 text-center">
                <p class="text-[9px] uppercase tracking-[0.25em] font-black text-zinc-600">Secure Access Portal Only</p>
            </div>
        </div>

        <p class="text-center text-[9px] text-zinc-700 font-bold uppercase tracking-widest mt-6">
            &copy; {{ date('Y') }} Auto Engine Car Service
        </p>
    </div>

    <script>
        function togglePassword() {
            const f = document.getElementById('passwordField');
            const i = document.getElementById('eyeIcon');
            if (f.type === 'password') {
                f.type = 'text';
                i.className = 'fas fa-eye-slash';
            } else {
                f.type = 'password';
                i.className = 'fas fa-eye';
            }
        }

        function fillLogin(email, pass) {
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = pass;
        }
    </script>
</body>
</html>
