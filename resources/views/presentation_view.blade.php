<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auto Engine | Presentasi Kelompok 5</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Devicon for Tech Stack -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/devicon.min.css">
    
    <style>
        body {
            background-color: #050505;
            color: #e5e7eb;
            scroll-behavior: smooth;
        }
        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .neon-orange { color: #ff5e00; text-shadow: 0 0 15px rgba(255, 94, 0, 0.8), 0 0 30px rgba(255, 94, 0, 0.4); }
        .neon-purple { color: #bf00ff; text-shadow: 0 0 15px rgba(191, 0, 255, 0.8), 0 0 30px rgba(191, 0, 255, 0.4); }
        .border-neon-orange { border-color: #ff5e00; box-shadow: 0 0 15px rgba(255, 94, 0, 0.6); }
        .bg-glass { background: rgba(10, 10, 12, 0.7); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.05); }
        .hover-lift { transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .hover-lift:hover { transform: translateY(-8px); }
        
        .glow-icon { filter: drop-shadow(0 0 15px rgba(255, 94, 0, 0.3)); transition: all 0.3s ease; }
        .glow-icon:hover { filter: drop-shadow(0 0 25px rgba(255, 94, 0, 0.7)); transform: scale(1.1); }
        .glow-icon.text-red-500 { filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.3)); }
        .glow-icon.text-red-500:hover { filter: drop-shadow(0 0 25px rgba(239, 68, 68, 0.7)); }
        .glow-icon.text-cyan-400 { filter: drop-shadow(0 0 15px rgba(34, 211, 238, 0.3)); }
        .glow-icon.text-cyan-400:hover { filter: drop-shadow(0 0 25px rgba(34, 211, 238, 0.7)); }
        .glow-icon.text-blue-500 { filter: drop-shadow(0 0 15px rgba(59, 130, 246, 0.3)); }
        .glow-icon.text-blue-500:hover { filter: drop-shadow(0 0 25px rgba(59, 130, 246, 0.7)); }
        .glow-icon.text-indigo-400 { filter: drop-shadow(0 0 15px rgba(129, 140, 248, 0.3)); }
        .glow-icon.text-indigo-400:hover { filter: drop-shadow(0 0 25px rgba(129, 140, 248, 0.7)); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #000; }
        ::-webkit-scrollbar-thumb { background: #ff5e00; border-radius: 4px; }

        /* Marquee Animation */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .animate-marquee {
            display: flex;
            width: max-content;
            animation: marquee 30s linear infinite;
        }
        .marquee-container {
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden selection:bg-orange-500 selection:text-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-glass border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-black tracking-tighter uppercase italic text-white">Auto<span class="neon-orange">Engine</span></h1>
            <div class="hidden md:flex space-x-8 text-sm font-bold uppercase tracking-wider">
                <a href="#hero" class="hover:text-orange-500 transition">Beranda</a>
                <a href="#team" class="hover:text-purple-500 transition">Tim</a>
                <a href="#tech" class="hover:text-purple-500 transition">Tech Stack</a>
                <a href="/landing" class="hover:text-orange-500 transition border-l border-gray-700 pl-8">Live Web</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-950 to-black z-0"></div>
        <div class="absolute inset-0 opacity-30 bg-[url('https://images.unsplash.com/photo-1611016186353-9f44db2b07e5?auto=format&fit=crop&q=80')] bg-cover bg-center mix-blend-screen z-0 opacity-20"></div>
        
        <div class="relative z-10 px-6 max-w-7xl mx-auto" data-aos="zoom-out-up" data-aos-duration="1200">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center text-left">
                <!-- Left Side: Title & Description -->
                <div>
                    <div class="inline-block px-4 py-1 border border-white/20 rounded-full mb-6 bg-white/5 backdrop-blur-sm text-sm tracking-widest text-orange-400 font-bold uppercase">
                        <i class="fa-solid fa-folder-tree mr-2"></i>Tugas Presentasi Arsitektur Informasi
                    </div>
                    <div class="mb-8 font-black uppercase italic leading-none tracking-tighter">
                        <h2 class="text-6xl md:text-8xl mb-4">SISTEM <span class="neon-purple">BENGKEL</h2>
                        <h3 class="text-2xl md:text-4xl text-gray-400 tracking-widest opacity-100">
                            AUTO ENGINE <span class="neon-orange text-gradient bg-gradient-to-r from-orange-600 to-yellow-500">CAR SERVICE</span>
                        </h3>
                    </div>
                    <p class="text-lg md:text-xl text-gray-400 mb-8 font-light leading-relaxed max-w-2xl">
                        Platform digital terpusat yang dibangun oleh Kelompok 5 untuk mempermudah pendaftaran, manajemen inventaris, dan kasir dengan UI/UX modern.
                    </p>
                    
                    <p class="text-xs md:text-sm text-gray-500 mb-10 tracking-widest uppercase font-black neon-orange">
                        UI & DESIGN EXCLUSIVELY BY MUHAMAD RIZAL
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/landing" class="px-10 py-4 bg-orange-600 border border-orange-500 text-white font-black uppercase tracking-widest rounded shadow-[0_0_20px_rgba(255,94,0,0.4)] hover:bg-orange-500 transition-all duration-300 transform hover:scale-105 text-center">
                            <i class="fa-solid fa-desktop mr-2"></i> Buka Aplikasi
                        </a>
                        <a href="#team" class="px-10 py-4 bg-transparent border-2 border-white/20 text-white font-bold uppercase tracking-widest rounded hover:bg-white/10 transition-all duration-300 text-center">
                            <i class="fa-solid fa-users-viewfinder mr-2"></i> Lihat Tim Pengembang
                        </a>
                    </div>
                </div>

                <!-- Right Side: Logo & Academic Info (Enhanced Card) -->
                <div class="lg:justify-self-end w-full max-w-lg">
                    <div class="bg-glass border border-white/10 p-12 rounded-[40px] relative overflow-hidden group shadow-2xl">
                        <!-- Decorative background elements -->
                        <div class="absolute -right-20 -top-20 w-80 h-80 bg-orange-500/10 rounded-full blur-[100px] group-hover:bg-orange-500/20 transition-all duration-700"></div>
                        <div class="absolute -left-20 -bottom-20 w-60 h-60 bg-purple-500/10 rounded-full blur-[80px] group-hover:bg-purple-500/20 transition-all duration-700"></div>
                        
                        <div class="relative z-10 flex flex-col items-center text-center">
                            <!-- Logo Kampus Larger & More Stylized -->
                            <div class="relative mb-12 transform group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-white/5 blur-2xl rounded-full transform scale-150"></div>
                                <div class="w-44 h-44 bg-gradient-to-br from-white/20 to-transparent p-1 rounded-full border-2 border-white/20 flex items-center justify-center shadow-[0_0_50px_rgba(255,255,255,0.05)] relative z-10">
                                    <div class="w-full h-full rounded-full border border-white/5 flex items-center justify-center bg-[#080808]">
                                        <i class="fa-solid fa-graduation-cap text-7xl text-gray-200"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6 w-full">
                                <div>
                                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-orange-500 block mb-3 opacity-80">MATA KULIAH</span>
                                    <h3 class="text-3xl font-black uppercase italic text-white tracking-tight leading-none">Arsitektur Informasi</h3>
                                </div>

                                <div class="w-16 h-[1px] bg-gradient-to-r from-transparent via-white/20 to-transparent mx-auto"></div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-purple-400 block mb-1">PENGEMBANG</span>
                                        <h3 class="text-sm font-bold text-white uppercase italic">Kelompok 5</h3>
                                    </div>
                                    <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-left">
                                        <span class="text-[9px] font-black uppercase tracking-widest text-gray-400 block mb-1">PRODI</span>
                                        <h3 class="text-sm font-bold text-gray-300 uppercase italic">Teknologi Informasi</h3>
                                    </div>
                                </div>

                                <div class="mt-8 pt-8 border-t border-white/10">
                                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400 block mb-3 opacity-80">DOSEN PENGAMPU</span>
                                    <p class="text-base text-white font-mono tracking-widest neon-orange font-bold uppercase">Cipto Basuki, S.Kom., M.Kom.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="team" class="py-32 relative z-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]">
        <div class="max-w-7xl mx-auto px-6">
            <div data-aos="fade-up">
                <h3 class="text-4xl md:text-5xl font-black uppercase italic mb-4 text-center border-l-4 border-purple-500 pl-4 py-2 bg-gradient-to-r from-gray-900/80 to-transparent inline-block">Kelompok <span class="neon-purple">5</span></h3>
                <p class="text-center text-gray-400 mb-16 max-w-2xl mx-auto">Dosen Pengampu: Sucipto Basuki S.Kom, M.Kom</p>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Graphic Designer (Muhamad Rizal) -->
                <div class="bg-glass p-8 rounded-2xl hover:border-orange-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="0">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-orange-500/10 rounded-full blur-2xl group-hover:bg-orange-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-orange-600 to-orange-900 rounded-full flex items-center justify-center text-2xl font-black text-white shadow-[0_0_15px_rgba(255,94,0,0.5)] border border-orange-500/50">
                            MR
                        </div>
                        <span class="text-xs bg-orange-900/50 text-orange-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-orange-500/20">Graphic Designer</span>
                        <h4 class="text-2xl font-bold mt-5 mb-1 text-white uppercase italic">Muhamad Rizal</h4>
                        <p class="text-sm text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: <span class="text-gray-300">2024806091</span></p>
                    </div>
                </div>

                <!-- Project Manager -->
                <div class="bg-glass p-8 rounded-2xl hover:border-purple-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-full flex items-center justify-center text-2xl font-black text-white">
                            TM
                        </div>
                        <span class="text-xs bg-purple-900/40 text-purple-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-purple-500/20">Project Manager</span>
                        <h4 class="text-2xl font-bold mt-5 mb-1 text-white uppercase italic">Tasya Monica</h4>
                        <p class="text-sm text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: <span class="text-gray-300">2024806034</span></p>
                    </div>
                </div>

                <!-- Data Analyst -->
                <div class="bg-glass p-8 rounded-2xl hover:border-purple-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-full flex items-center justify-center text-2xl font-black text-white">
                            SA
                        </div>
                        <span class="text-xs bg-purple-900/40 text-purple-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-purple-500/20">Data Analyst</span>
                        <h4 class="text-2xl font-bold mt-5 mb-1 text-white uppercase italic text-xl">Siti Annsisa Juliyanti</h4>
                        <p class="text-sm text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: <span class="text-gray-300">2024806051</span></p>
                    </div>
                </div>

                <!-- Copy Writer -->
                <div class="bg-glass p-8 rounded-2xl hover:border-purple-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="100">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-full flex items-center justify-center text-2xl font-black text-white">
                            MA
                        </div>
                        <span class="text-xs bg-purple-900/40 text-purple-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-purple-500/20">Copy Writer</span>
                        <h4 class="text-2xl font-bold mt-5 mb-1 text-white uppercase italic">Muhamad Alif</h4>
                        <p class="text-sm text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: <span class="text-gray-300">2024806012</span></p>
                    </div>
                </div>

                <!-- Social Media Specialist -->
                <div class="bg-glass p-8 rounded-2xl hover:border-purple-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-full flex items-center justify-center text-2xl font-black text-white">
                            MN
                        </div>
                        <span class="text-xs bg-purple-900/40 text-purple-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-purple-500/20">Social Media Spec.</span>
                        <h4 class="text-2xl font-bold mt-5 mb-1 text-white uppercase italic">Muhamad Nabil</h4>
                        <p class="text-sm text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: <span class="text-gray-300">2024806077</span></p>
                    </div>
                </div>

                <!-- Content Planner -->
                <div class="bg-glass p-8 rounded-2xl hover:border-purple-500 transition-colors duration-300 group hover-lift relative overflow-hidden" data-aos="fade-up" data-aos-delay="300">
                    <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-500/10 rounded-full blur-2xl group-hover:bg-purple-500/20 transition-all"></div>
                    <div class="relative z-10 text-center">
                        <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-800 to-gray-900 border border-gray-700 rounded-full flex items-center justify-center text-2xl font-black text-white">
                            CP
                        </div>
                        <span class="text-xs bg-purple-900/40 text-purple-300 px-3 py-1 rounded-full font-bold uppercase tracking-widest border border-purple-500/20">Content Planner</span>
                        <h4 class="text-xl font-bold mt-5 mb-1 text-white uppercase italic">Yunan S. &<br>Fajar Ramadhan</h4>
                        <p class="text-[11px] text-gray-500 mt-1 font-mono tracking-widest font-bold">NPM: 2024806023 | 2024806044</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Tech Stack Section (Interactive Infinite Marquee) -->
    <section id="tech" class="py-32 relative z-10 bg-gradient-to-b from-black to-gray-950 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <div data-aos="fade-up">
                <h3 class="text-4xl md:text-5xl font-black uppercase italic mb-4"><span class="neon-orange">Tech Stack</span> Platform</h3>
                <p class="text-gray-400">Infrastruktur dan teknologi modern yang menggerakkan sistem Auto Engine.</p>
            </div>
        </div>

        <div class="marquee-container relative w-full overflow-hidden py-10">
            <div class="animate-marquee flex items-center gap-8">
                <!-- Tech Items Set 1 -->
                <div class="flex items-center gap-8 px-4">
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-red-500/20 group">
                        <i class="devicon-laravel-plain text-6xl text-red-500 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Laravel</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-indigo-400/20 group">
                        <i class="devicon-php-plain text-6xl text-indigo-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">PHP 8.1</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-sky-600/20 group">
                        <i class="devicon-mysql-plain text-6xl text-sky-600 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">MySQL</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-orange-500/20 group">
                        <i class="devicon-html5-plain text-6xl text-orange-500 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">HTML5</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-cyan-400/20 group">
                        <i class="devicon-tailwindcss-plain text-6xl text-cyan-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Tailwind CSS</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-yellow-400/20 group">
                        <i class="devicon-javascript-plain text-6xl text-yellow-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">JavaScript</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-white/20 group">
                        <i class="devicon-github-original text-6xl text-white mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">GitHub</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-gray-400/20 group">
                        <i class="devicon-vercel-original text-6xl text-white mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Vercel</p>
                    </div>
                </div>
                
                <!-- Tech Items Set 2 (Duplicate for Seamless Loop) -->
                <div class="flex items-center gap-8 px-4">
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-red-500/20 group">
                        <i class="devicon-laravel-plain text-6xl text-red-500 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Laravel</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-indigo-400/20 group">
                        <i class="devicon-php-plain text-6xl text-indigo-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">PHP 8.1</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-sky-600/20 group">
                        <i class="devicon-mysql-plain text-6xl text-sky-600 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">MySQL</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-orange-500/20 group">
                        <i class="devicon-html5-plain text-6xl text-orange-500 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">HTML5</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-cyan-400/20 group">
                        <i class="devicon-tailwindcss-plain text-6xl text-cyan-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Tailwind CSS</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-yellow-400/20 group">
                        <i class="devicon-javascript-plain text-6xl text-yellow-400 mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">JavaScript</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-white/20 group">
                        <i class="devicon-github-original text-6xl text-white mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">GitHub</p>
                    </div>
                    <div class="flex flex-col items-center justify-center p-8 w-48 rounded-3xl bg-glass border border-gray-400/20 group">
                        <i class="devicon-vercel-original text-6xl text-white mb-4 group-hover:scale-110 transition-transform"></i>
                        <p class="text-[10px] font-black text-white uppercase tracking-widest">Vercel</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-[#020202] border-t border-white/5 text-center relative overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>
        <div class="relative z-10 flex flex-col items-center justify-center">
            <h2 class="text-3xl font-black uppercase italic mb-4 text-white/20">Auto<span class="text-orange-500">Engine</span></h2>
            <p class="text-sm font-bold text-gray-600 uppercase tracking-widest mb-2">&copy; 2026 Kelompok 5 - Arsitektur Informasi. Hak Cipta Dilindungi.</p>
            
            <div class="mt-8 pt-6 border-t border-white/10 mx-auto w-full max-w-lg">
                <p class="text-xs md:text-sm font-black text-orange-500/80 uppercase tracking-widest neon-orange">
                    <i class="fa-solid fa-paintbrush mr-2"></i> UI & DESIGN EXCLUSIVELY BY MUHAMAD RIZAL
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            once: true,
            offset: 50,
            duration: 800,
            easing: 'ease-out-cubic'
        });
    </script>
</body>
</html>
