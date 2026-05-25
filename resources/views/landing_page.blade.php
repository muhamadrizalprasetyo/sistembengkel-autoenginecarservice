<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="theme-color" content="#020617">
    <meta name="description"
        content="Auto Engine - Solusi perawatan mesin kendaraan kelas dunia dengan teknologi terkini dan sparepart premium.">
    <title>Auto Engine | World Class Car Service</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&family=Unbounded:wght@400;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --brand: #ff4d00;
            --brand-glow: rgba(255, 77, 0, 0.4);
            --bg: #020617;
            --surface: #0f172a;
            --border: rgba(255, 255, 255, 0.06);
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: #f8fafc;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        .heading-font {
            font-family: 'Unbounded', sans-serif;
        }

        .glass {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--border);
        }

        .neo-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            transform-origin: center;
        }

        .neo-btn:active {
            transform: scale(0.95);
        }

        .brand-text {
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-gradient {
            background: linear-gradient(135deg, #ff4d00 0%, #ff8700 100%);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) scale(1);
            }

            50% {
                transform: translateY(-20px) scale(1.05);
            }
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        .input-style {
            background: rgba(2, 6, 23, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .input-style:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 4px var(--brand-glow);
            outline: none;
        }

        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg);
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--brand);
        }

        .mask-fade-bottom {
            mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .mobile-p-safe {
                padding-bottom: calc(100px + env(safe-area-inset-bottom));
            }

            .hero-text {
                font-size: 2.75rem !important;
                line-height: 1.1 !important;
            }
        }
    </style>
</head>

<body class="mobile-p-safe">

    <!-- DESKTOP NAVBAR -->
    <header class="fixed top-0 left-0 right-0 z-[100] px-6 py-4 hidden md:block">
        <nav class="max-w-6xl mx-auto glass rounded-2xl px-8 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 overflow-hidden rounded-xl shadow-lg shadow-orange-950/20 bg-slate-800">
                    <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-full h-full object-cover">
                </div>
                <span class="heading-font text-sm font-black uppercase tracking-tighter">Auto<span
                        class="text-orange-500">Engine</span></span>
            </div>

            <div class="flex items-center gap-10 text-[11px] font-extrabold uppercase tracking-widest text-slate-400">
                <a href="#hero" class="hover:text-white transition-colors">Intro</a>
                <a href="#services" class="hover:text-white transition-colors">Services</a>
                <a href="#booking" class="text-white border-b-2 border-orange-500 pb-1">Reservasi</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="https://wa.me/{{ $waNumber }}" class="text-slate-400 hover:text-white transition-colors">
                    <i class="fab fa-whatsapp text-lg"></i>
                </a>
            </div>
        </nav>
    </header>

    <!-- MOBILE BOTTOM NAV -->
    <nav
        class="fixed bottom-6 left-6 right-6 glass rounded-[2.5rem] z-[100] flex justify-around items-center px-2 py-4 md:hidden border-white/10 shadow-2xl">
        <a href="#hero"
            class="flex flex-col items-center gap-1 p-2 text-slate-500 active:text-orange-500 transition-colors">
            <i class="fas fa-home-alt text-xl"></i>
            <span class="text-[8px] font-bold uppercase tracking-tighter">Home</span>
        </a>
        <a href="#services"
            class="flex flex-col items-center gap-1 p-2 text-slate-500 active:text-orange-500 transition-colors">
            <i class="fas fa-screwdriver-wrench text-xl"></i>
            <span class="text-[8px] font-bold uppercase tracking-tighter">Servis</span>
        </a>
        <div class="relative -mt-16">
            <a href="#booking"
                class="w-16 h-16 brand-gradient rounded-full flex items-center justify-center text-white shadow-xl shadow-orange-950/40 border-4 border-slate-950">
                <i class="fas fa-plus text-xl"></i>
            </a>
        </div>
        <a href="#konsultasi"
            class="flex flex-col items-center gap-1 p-2 text-slate-500 active:text-orange-500 transition-colors">
            <i class="fab fa-whatsapp text-2xl"></i>
            <span class="text-[8px] font-bold uppercase tracking-tighter">Chat</span>
        </a>
        <a href="/cek-booking"
            class="flex flex-col items-center gap-1 p-2 text-slate-500 active:text-orange-500 transition-colors">
            <i class="fas fa-search-location text-xl"></i>
            <span class="text-[8px] font-bold uppercase tracking-tighter">Track</span>
        </a>
    </nav>

    <main>
        <!-- HERO SECTION -->
        <section id="hero" class="relative min-h-[85vh] flex flex-col justify-center px-6 pt-12 overflow-hidden">
            <!-- Decorative Orbs -->
            <div
                class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] bg-orange-600/10 rounded-full blur-[120px] animate-float">
            </div>
            <div class="absolute bottom-[-5%] left-[-5%] w-[400px] h-[400px] bg-indigo-600/5 rounded-full blur-[100px] animate-float"
                style="animation-delay: -4s"></div>

            <div
                class="max-w-6xl mx-auto w-full relative z-10 flex flex-col items-center md:items-start text-center md:text-left">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 bg-white/5 border border-white/10 rounded-full mb-6">
                    <span class="w-2 h-2 bg-orange-500 rounded-full animate-pulse"></span>
                    <span class="text-[9px] font-black tracking-[0.2em] uppercase text-slate-400">Next Gen Automotive
                        Laboratory</span>
                </div>

                <h1
                    class="heading-font hero-text text-5xl md:text-8xl font-black mb-6 md:mb-8 leading-[0.95] tracking-tighter">
                    TREAT YOUR <br>
                    <span class="text-orange-500 italic">CAR</span> WITH
                    <span class="brand-text">PRIDE.</span>
                </h1>

                <p class="max-w-xl text-slate-400 text-sm md:text-lg mb-8 md:mb-10 leading-relaxed font-light">
                    Kombinasi antara teknologi diagnosa mutakhir dan teknisi ahli untuk memastikan kendaraan
                    Anda melampaui batas ekspektasi.
                </p>

                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="#booking"
                        class="neo-btn brand-gradient px-8 py-4 rounded-xl font-black uppercase text-[10px] tracking-widest shadow-lg shadow-orange-950/40 text-center text-white">
                        Secure Your Slot
                    </a>
                    <a href="#services"
                        class="neo-btn glass px-8 py-4 rounded-xl font-black uppercase text-[10px] tracking-widest text-center">
                        Explore Services
                    </a>
                </div>

                <div
                    class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-20 opacity-50 border-t border-white/5 pt-8">
                    <div>
                        <span class="block text-xl md:text-2xl font-black heading-font">500+</span>
                        <span
                            class="text-[8px] md:text-[9px] uppercase tracking-widest font-black line-clamp-1">Satisfied
                            Customers</span>
                    </div>
                    <div>
                        <span class="block text-xl md:text-2xl font-black heading-font">{{ $sparepartCount }}</span>
                        <span class="text-[8px] md:text-[9px] uppercase tracking-widest font-black line-clamp-1">Premium
                            Parts</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- SERVICES SECTION -->
        <section id="services" class="py-16 md:py-24 px-6 bg-[#020617]">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
                    <div>
                        <p class="text-orange-500 text-[9px] md:text-[10px] font-black tracking-[.3em] uppercase mb-4">
                            Official Menu</p>
                        <h2 class="heading-font text-3xl md:text-6xl font-black uppercase leading-none">LABORATORY <br>
                            <span class="brand-text">SERVICES.</span></h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
                    @foreach($services as $s)
                        <div
                            class="glass p-6 rounded-3xl group hover:border-orange-500/30 transition-all duration-500 relative overflow-hidden h-full">
                            <div class="relative z-10">
                                <div
                                    class="w-12 h-12 rounded-2xl bg-orange-500/10 flex items-center justify-center text-orange-500 mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all">
                                    <i class="fas {{ $s['icon'] }} text-xl"></i>
                                </div>
                                <h3 class="heading-font text-lg font-black text-white mb-3">{{ $s['name'] }}</h3>
                                <p class="text-xs text-slate-400 leading-relaxed mb-6 font-light">{{ $s['description'] }}
                                </p>

                                <div class="flex justify-between items-center mt-auto pt-5 border-t border-white/5">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Starting
                                        Rate</span>
                                    <span class="font-mono text-sm font-black text-orange-500">Rp{{ $s['price'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BOOKING SECTION (IMMEDIATE FORM) -->
        <section id="booking" class="py-16 md:py-24 px-6 relative border-y border-white/5 bg-slate-950/50">
            <div class="max-w-6xl mx-auto grid lg:grid-cols-12 gap-10 md:gap-16 items-start">

                <div class="lg:col-span-4 md:sticky md:top-32">
                    <div class="w-12 h-1 bg-orange-500 mb-4 md:mb-6"></div>
                    <h2 class="heading-font text-3xl md:text-4xl font-black mb-4 md:mb-6 leading-tight">ISI RENCANA <br>
                        <span class="text-slate-500 uppercase">Reservasi.</span></h2>
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 md:mb-10 lg:pr-10">
                        Kami mengalokasikan teknisi spesialis untuk menangani kendaraan Anda secara eksklusif dan
                        presisi tinggi.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-4 md:space-y-6">
                        <div class="flex gap-4 items-center">
                            <div
                                class="w-10 h-10 brand-gradient rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-bolt"></i></div>
                            <div>
                                <p class="text-[10px] uppercase font-black tracking-widest text-white">Proses Cepat</p>
                                <p class="text-[10px] text-slate-500">Konfirmasi via WhatsApp otomatis.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 items-center">
                            <div
                                class="w-10 h-10 brand-gradient rounded-lg flex items-center justify-center text-white">
                                <i class="fas fa-shield-check"></i></div>
                            <div>
                                <p class="text-[10px] uppercase font-black tracking-widest text-white">Garansi Servis
                                </p>
                                <p class="text-[10px] text-slate-500">Jaminan kualitas pengerjaan premium.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    @if($errors->any())
                        <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-[10px]">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/landing/store-booking" method="POST"
                        class="glass rounded-[2rem] md:rounded-[2.5rem] p-6 md:p-12 space-y-6 md:space-y-8">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Owner
                                    Identity</label>
                                <input type="text" name="customer_name" required placeholder="Ex: Tony Stark"
                                    value="{{ old('customer_name') }}"
                                    class="w-full input-style p-4 mt-1 placeholder:text-slate-700 text-white">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Contact
                                    Number</label>
                                <input type="tel" name="phone" required placeholder="0812..." value="{{ old('phone') }}"
                                    class="w-full input-style p-4 mt-1 placeholder:text-slate-700 text-white">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="md:col-span-2 space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Machine
                                    Model</label>
                                <input type="text" name="car_type" required placeholder="Ex: Porsche 911 GT3"
                                    value="{{ old('car_type') }}"
                                    class="w-full input-style p-4 mt-1 placeholder:text-slate-700 text-white">
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">License
                                    Plate</label>
                                <input type="text" name="car_plate" placeholder="B 1234 ABC"
                                    value="{{ old('car_plate') }}"
                                    class="w-full input-style p-4 mt-1 uppercase placeholder:text-slate-700 text-white">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Service
                                    Package</label>
                                <select name="service_type" required
                                    class="w-full input-style p-4 mt-1 appearance-none bg-slate-900 text-white focus:bg-slate-900">
                                    <option value="" disabled selected>Select Procedure</option>
                                    @foreach(['General Tune Up', 'Engine Overhaul', 'AC Performance', 'Brake System', 'Transmission Service', 'Oil & Fluid Change'] as $s)
                                        <option value="{{ $s }}" {{ old('service_type') == $s ? 'selected' : '' }}>{{ $s }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label
                                    class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Operational
                                    Date</label>
                                <input type="date" name="booking_date" required
                                    value="{{ old('booking_date', date('Y-m-d')) }}"
                                    class="w-full input-style p-4 mt-1 text-white" style="color-scheme: dark">
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label
                                class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-slate-500 pl-1">Specific
                                Requirements (Optional)</label>
                            <textarea name="notes" rows="3" placeholder="Any specific issues or requests?"
                                class="w-full input-style p-4 mt-1 placeholder:text-slate-700 text-white">{{ old('notes') }}</textarea>
                        </div>

                        <button type="submit"
                            class="w-full brand-gradient py-5 rounded-2xl font-black uppercase text-xs tracking-widest neo-btn shadow-xl shadow-orange-900/20 text-white">
                            Confirm Appointment
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- KONSULTASI SECTION -->
        <section id="konsultasi" class="py-16 md:py-24 px-6 bg-slate-950">
            <div
                class="max-w-4xl mx-auto glass rounded-[2rem] md:rounded-[3rem] p-8 md:p-20 text-center relative overflow-hidden group">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-orange-600/5 to-indigo-600/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                </div>
                <div class="relative z-10 flex flex-col items-center">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-emerald-500 shadow-xl shadow-emerald-950/20 rounded-xl md:rounded-2xl flex items-center justify-center mb-6 md:mb-10 rotate-12 group-hover:rotate-0 transition-transform">
                        <i class="fab fa-whatsapp text-2xl md:text-3xl text-white"></i>
                    </div>
                    <h2
                        class="heading-font text-2xl md:text-5xl font-black mb-4 md:mb-6 uppercase leading-tight text-white">
                        DIRECT LINE <br> <span class="text-emerald-500">TO STAFF.</span></h2>
                    <p
                        class="text-slate-400 text-xs md:text-base max-w-lg mx-auto mb-8 md:mb-12 font-light leading-relaxed">
                        Butuh bantuan atau diagnosa awal? Hubungi tim teknis kami langsung melalui chat privat.
                    </p>
                    <a href="https://wa.me/{{ $waNumber }}?text=Hello+Auto+Engine+Staff!"
                        class="w-full md:w-auto inline-block bg-slate-100 text-slate-950 px-10 py-4 rounded-xl font-black uppercase text-[10px] tracking-[.25em] neo-btn">
                        Open Secure Chat
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-12 px-6 border-t border-white/5 bg-slate-950">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 glass rounded-lg flex items-center justify-center font-black text-[10px]">AE</div>
                <span class="text-[9px] md:text-[10px] font-black uppercase tracking-widest text-zinc-600">AutoEngine
                    &copy; {{ date('Y') }}</span>
            </div>
            <div class="flex gap-6 text-[9px] font-black uppercase tracking-widest text-zinc-600">
                <a href="#hero" class="hover:text-white transition-colors">Core</a>
                <a href="#services" class="hover:text-white transition-colors">Services</a>
                <a href="https://wa.me/{{ $waNumber }}" class="hover:text-white transition-colors">Support</a>
            </div>
        </div>
    </footer>

    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offset = window.innerWidth < 768 ? 20 : 100;
                    const bodyRect = document.body.getBoundingClientRect().top;
                    const elementRect = target.getBoundingClientRect().top;
                    const elementPosition = elementRect - bodyRect;
                    const offsetPosition = elementPosition - offset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>

</html>