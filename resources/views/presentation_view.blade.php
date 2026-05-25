<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#020202">
    <meta name="robots" content="noindex">
    <title>Auto Engine | Presentasi Kelompok 5</title>
    
    {{-- Preconnect Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    {{-- Tailwind & AOS & Icons --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css" media="print" onload="this.media='all'">
    
    {{-- Fonts: Space Grotesk + Anton --}}
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;900&family=Anton&display=swap" rel="stylesheet">
    
    <style>
        /* ===[ VARIABLES & RESET ]=== */
        :root {
            --orange: #ff5e00;
            --purple: #bf00ff;
            --bg: #050505;
            --glass: rgba(10,10,12,0.78);
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--bg);
            color: #e5e7eb;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }
        .anton { font-family: 'Anton', sans-serif; letter-spacing: 0.02em; }

        /* ===[ EFFECTS ]=== */
        .neon-o { color: var(--orange); text-shadow: 0 0 15px rgba(255,94,0,.8); }
        .neon-p { color: var(--purple); text-shadow: 0 0 15px rgba(191,0,255,.8); }
        .bg-glass {
            background: var(--glass);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.05);
        }

        /* Buttons & Interactions (Hardware Accelerated) */
        .lift {
            transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            will-change: transform;
        }
        @media (hover: hover) { .lift:hover { transform: translateY(-6px); } }
        .lift:active { transform: scale(0.96); }

        .btn-primary {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; padding: 0 1.5rem;
            background: var(--orange); color: #fff;
            font-weight: 900; text-transform: uppercase; letter-spacing: 0.1em; font-size: 0.875rem;
            border-radius: 0.75rem; border: 1px solid rgba(255,94,0,0.6);
            box-shadow: 0 0 20px rgba(255,94,0,0.4);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            text-decoration: none; -webkit-tap-highlight-color: transparent;
        }
        .btn-primary:active { transform: scale(0.95); }

        .btn-ghost {
            display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;
            min-height: 52px; padding: 0 1.5rem;
            background: transparent; color: #fff; border: 1.5px solid rgba(255,255,255,0.2);
            font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; font-size: 0.875rem;
            border-radius: 0.75rem;
            transition: transform 0.2s ease, background 0.2s ease;
            text-decoration: none; -webkit-tap-highlight-color: transparent;
        }
        .btn-ghost:active { transform: scale(0.95); }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 4px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: var(--orange); border-radius: 4px; }

        /* ===[ MARQUEE ANIMATION ]=== */
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-100% / 2)); }
        }
        .marquee {
            display: flex;
            width: fit-content;
            animation: scroll 30s linear infinite;
        }
        /* Mobile: freeze marquee to save battery but allow swipe tracking */
        @media (max-width: 768px) {
            .marquee { animation-duration: 40s; }
        }
        .mask-edges {
            -webkit-mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
            mask-image: linear-gradient(90deg, transparent, #000 10%, #000 90%, transparent);
        }

        .orb-float { animation: orb-float 6s ease-in-out infinite; will-change: transform; }
        @keyframes orb-float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="selection:bg-orange-500 selection:text-white">

    <!-- Mobile Top Bar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-glass border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-5 min-h-[64px] flex justify-between items-center">
            <h1 class="text-xl font-black tracking-tighter uppercase italic text-white flex gap-2 items-center">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-orange-500 to-orange-700 flex items-center justify-center text-xs not-italic shadow-lg shadow-orange-900/40">AE</div>
                Auto<span class="neon-o">Engine</span>
            </h1>
            <div class="hidden md:flex space-x-6 text-xs font-black uppercase tracking-widest text-zinc-400">
                <a href="#hero" class="hover:text-white transition">Intro</a>
                <a href="#team" class="hover:text-white transition">Tim</a>
                <a href="#tech" class="hover:text-white transition">Tech Stack</a>
                <a href="/landing" class="text-orange-500 hover:text-white transition">Live Web →</a>
            </div>
            <!-- Mobile Menu Btn -->
            <a href="/landing" class="md:hidden flex items-center justify-center min-h-[44px] px-4 rounded-lg bg-orange-600 text-[10px] font-black uppercase text-white tracking-widest shadow-lg shadow-orange-900/40">
                Live Web
            </a>
        </div>
    </nav>

    <!-- ===[ HERO SECTION ]=== -->
    <section id="hero" class="relative min-h-[100svh] flex flex-col justify-center pt-24 pb-12 overflow-hidden">
        {{-- Background blur & image --}}
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-zinc-950 to-black z-0 pointer-events-none"></div>
        <div class="absolute inset-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1611016186353-9f44db2b07e5?auto=format&fit=crop&q=80')] bg-cover bg-center mix-blend-screen z-0 pointer-events-none"></div>
        
        <div class="relative z-10 px-5 max-w-7xl mx-auto w-full" data-aos="fade-up" data-aos-duration="800">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
                
                <!-- Left Side: Title -->
                <div class="text-center md:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 border border-white/10 rounded-full mb-6 glass text-[10px] tracking-[0.2em] text-orange-400 font-black uppercase">
                        <i class="fa-solid fa-folder-tree"></i> Tugas Presentasi Arsitektur Informasi
                    </div>
                    
                    <h2 class="anton text-6xl md:text-8xl lg:text-9xl mb-2 text-white uppercase leading-[0.9]">
                        SISTEM <span class="block neon-p">BENGKEL</span>
                    </h2>
                    <h3 class="text-lg md:text-3xl text-zinc-400 tracking-[0.2em] font-black uppercase italic mb-6">
                        AUTO ENGINE <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-500 to-yellow-400 drop-shadow-md">CAR SERVICE</span>
                    </h3>
                    
                    <p class="text-sm md:text-base text-zinc-400 mb-8 max-w-md mx-auto md:mx-0 leading-relaxed">
                        Platform digital operasional untuk mempermudah reservasi pelanggan, manajemen inventaris, dan kasir dengan UI/UX kelas atas.
                    </p>

                    <!-- Mobile-friendly full-width buttons -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="/landing" class="btn-primary w-full sm:w-auto">
                            <i class="fas fa-desktop"></i> Buka Aplikasi
                        </a>
                        <a href="#team" class="btn-ghost w-full sm:w-auto hover:bg-white/5">
                            <i class="fas fa-users-viewfinder"></i> Tim Pengembang
                        </a>
                    </div>
                </div>

                <!-- Right Side: Academic Badge -->
                <div class="w-full max-w-sm mx-auto lg:my-0 mt-6 lg:justify-self-end">
                    <div class="bg-glass border border-white/10 p-8 md:p-10 rounded-3xl relative overflow-hidden shadow-2xl lift">
                        <div class="orb-float absolute -right-12 -top-12 w-48 h-48 bg-orange-500/20 rounded-full blur-[60px]"></div>
                        <div class="orb-float absolute -left-12 -bottom-12 w-48 h-48 bg-purple-500/20 rounded-full blur-[60px]" style="animation-delay:-3s"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <div class="w-24 h-24 mb-6 bg-gradient-to-br from-zinc-800 to-zinc-950 p-[2px] rounded-full shadow-[0_0_30px_rgba(255,255,255,0.03)] border-2 border-white/10">
                                <div class="w-full h-full rounded-full flex items-center justify-center bg-black">
                                    <i class="fas fa-graduation-cap text-4xl text-zinc-200 drop-shadow-[0_0_10px_rgba(255,255,255,0.3)]"></i>
                                </div>
                            </div>

                            <div class="space-y-5 w-full">
                                <div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-orange-500 mb-1">Mata Kuliah</p>
                                    <p class="text-xl md:text-2xl font-black uppercase italic text-white leading-tight">Arsitektur<br>Informasi</p>
                                </div>
                                <div class="w-10 h-px bg-white/10 mx-auto"></div>
                                <div class="grid grid-cols-2 gap-3 text-left">
                                    <div class="bg-white/5 p-3 rounded-xl border border-white/5" style="border-left:3px solid var(--purple)">
                                        <p class="text-[8px] font-black uppercase tracking-widest text-purple-400 mb-0.5">Pengembang</p>
                                        <p class="text-xs font-bold text-white uppercase italic">Kelompok 5</p>
                                    </div>
                                    <div class="bg-white/5 p-3 rounded-xl border border-white/5" style="border-left:3px solid #52525b">
                                        <p class="text-[8px] font-black uppercase tracking-widest text-zinc-400 mb-0.5">Studi</p>
                                        <p class="text-xs font-bold text-white uppercase italic">Teknologi Info</p>
                                    </div>
                                </div>
                                <div class="pt-5 border-t border-white/5 mt-4">
                                    <p class="text-[9px] font-black uppercase tracking-[0.2em] text-zinc-500 mb-1">Dosen Pengampu</p>
                                    <p class="text-xs text-white font-mono font-bold tracking-widest neon-o uppercase text-center break-words">Cipto Basuki, S.Kom., M.Kom.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===[ TEAM SECTION ]=== -->
    <section id="team" class="py-20 md:py-32 relative bg-zinc-950 border-t border-white/5">
        <div class="max-w-6xl mx-auto px-5">
            <div data-aos="fade-up" class="mb-12 md:mb-20">
                <h3 class="text-3xl md:text-5xl font-black uppercase italic mb-3 flex items-center gap-3">
                    <span class="w-2 h-10 bg-purple-600 block"></span>
                    Kelompok <span class="neon-p">5</span>
                </h3>
                <p class="text-sm text-zinc-400 font-bold uppercase tracking-widest">Kolaborasi Pengembangan UI/UX & Backend</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-6">
                <!-- Data Tim (Loop) -->
                @php
                    $team = [
                        ['name'=>'Muhamad Rizal', 'npm'=>'2024806091', 'role'=>'Graphic Designer / UIUX', 'color'=>'orange', 'initials'=>'MR'],
                        ['name'=>'Tasya Monica', 'npm'=>'2024806034', 'role'=>'Project Manager', 'color'=>'purple', 'initials'=>'TM'],
                        ['name'=>'Siti Annsisa J', 'npm'=>'2024806051', 'role'=>'Data Analyst', 'color'=>'blue', 'initials'=>'SA'],
                        ['name'=>'Muhamad Alif', 'npm'=>'2024806012', 'role'=>'Copy Writer', 'color'=>'indigo', 'initials'=>'MA'],
                        ['name'=>'Muhamad Nabil', 'npm'=>'2024806077', 'role'=>'Social Media Spec.', 'color'=>'sky', 'initials'=>'MN'],
                        ['name'=>'Yunan & Fajar', 'npm'=>'2024806023 | 2024806044', 'role'=>'Content Planner', 'color'=>'emerald', 'initials'=>'CP'],
                    ];
                @endphp

                @foreach($team as $m)
                <div class="bg-glass p-6 md:p-8 rounded-2xl hover:border-{{ $m['color'] }}-500/50 transition-colors duration-300 group lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <div class="absolute -right-8 -top-8 w-24 h-24 bg-{{ $m['color'] }}-500/10 rounded-full blur-2xl group-hover:bg-{{ $m['color'] }}-500/20 transition-all"></div>
                    <div class="relative z-10 flex md:flex-col items-center md:text-center gap-4 md:gap-0">
                        <div class="w-16 h-16 md:w-20 md:h-20 md:mb-5 bg-gradient-to-br from-zinc-800 to-black border border-white/5 rounded-2xl md:rounded-full flex items-center justify-center text-xl md:text-2xl font-black text-zinc-300 shadow-inner group-hover:border-{{ $m['color'] }}-500/40 group-hover:text-{{ $m['color'] }}-400 transition-colors shrink-0">
                            {{ $m['initials'] }}
                        </div>
                        <div class="text-left md:text-center w-full">
                            <span class="inline-block text-[9px] bg-{{ $m['color'] }}-500/10 text-{{ $m['color'] }}-400 px-2 py-0.5 rounded font-black uppercase tracking-widest border border-{{ $m['color'] }}-500/20 md:mb-3">
                                {{ $m['role'] }}
                            </span>
                            <h4 class="text-base md:text-xl font-black mt-1 md:mt-0 mb-1 text-white uppercase italic leading-tight">{{ $m['name'] }}</h4>
                            <p class="text-[10px] md:text-sm text-zinc-500 font-mono tracking-widest font-bold">NPM <span class="text-zinc-300">{{ $m['npm'] }}</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===[ TECH STACK (INTERACTIVE MARQUEE) ]=== -->
    <section id="tech" class="py-20 relative bg-black overflow-hidden border-t border-b border-white/5">
        <div class="max-w-7xl mx-auto px-5 mb-10 md:mb-16 text-center">
            <h3 class="text-3xl md:text-5xl font-black uppercase italic" data-aos="fade-in">
                <span class="neon-o">Tech Stack</span> Platform
            </h3>
        </div>

        {{-- Infinite Marquee (CSS only) --}}
        <div class="mask-edges w-full pb-8 overflow-hidden select-none" dir="ltr">
            @php
                $techs = [
                    ['icon'=>'devicon-laravel-plain', 'name'=>'Laravel 10', 'color'=>'text-orange-500', 'border'=>'border-orange-500/20'],
                    ['icon'=>'devicon-php-plain', 'name'=>'PHP 8.1', 'color'=>'text-indigo-400', 'border'=>'border-indigo-400/20'],
                    ['icon'=>'devicon-mysql-plain', 'name'=>'MySQL', 'color'=>'text-sky-500', 'border'=>'border-sky-500/20'],
                    ['icon'=>'devicon-html5-plain', 'name'=>'HTML5', 'color'=>'text-orange-500', 'border'=>'border-orange-500/20'],
                    ['icon'=>'devicon-tailwindcss-plain', 'name'=>'Tailwind', 'color'=>'text-cyan-400', 'border'=>'border-cyan-400/20'],
                    ['icon'=>'devicon-alpinejs-plain', 'name'=>'Alpine.js', 'color'=>'text-teal-400', 'border'=>'border-teal-400/20'],
                    ['icon'=>'devicon-github-original', 'name'=>'GitHub', 'color'=>'text-white', 'border'=>'border-white/20'],
                ];
            @endphp
            <div class="marquee gap-4 px-4 w-max hover:[animation-play-state:paused]">
                {{-- Duplicate list twice for seamless scroll loop --}}
                @foreach([1,2,3] as $loopVar)
                    @foreach($techs as $t)
                    <div class="flex flex-col items-center justify-center p-6 w-32 md:w-44 rounded-2xl bg-zinc-900 border {{ $t['border'] }} shrink-0 transition-transform hover:scale-105">
                        <i class="{{ $t['icon'] }} text-5xl md:text-6xl {{ $t['color'] }} mb-3 drop-shadow-md"></i>
                        <p class="text-[10px] md:text-xs font-black text-white uppercase tracking-widest">{{ $t['name'] }}</p>
                    </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    <!-- ===[ FOOTER ]=== -->
    <footer class="py-10 bg-zinc-950 text-center">
        <h2 class="text-2xl font-black uppercase italic mb-2 text-white/20">Auto<span class="text-orange-500/40">Engine</span></h2>
        <p class="text-[10px] font-bold text-zinc-600 uppercase tracking-widest mb-6">&copy; {{ date('Y') }} Kelompok 5 / Arsitektur Informasi</p>
        
        <p class="text-[9px] font-black text-orange-500/80 uppercase tracking-[0.2em] neon-o">
            <i class="fa-solid fa-paintbrush mr-1"></i> UI & DESIGN BY MUHAMAD RIZAL
        </p>
    </footer>

    <!-- Scripts (Deferred for performance) -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer onload="AOS.init({once:true, offset:0, duration:600});"></script>
</body>
</html>
