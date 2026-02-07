<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DPRD Kabupaten Madiun - Sistem Perjalanan Dinas</title>
    <meta name="description" content="Sistem Informasi Perjalanan Dinas DPRD Kabupaten Madiun. Kelola jadwal, pengajuan, dan pelaporan kegiatan perjalanan dinas dengan transparan dan akuntabel.">
    <meta name="keywords" content="DPRD Madiun, Perjalanan Dinas, SPPD, Sistem Informasi, Madiun, Pemerintah Daerah">
    <meta name="author" content="Sekretariat DPRD Kabupaten Madiun">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="DPRD Kabupaten Madiun - Sistem Perjalanan Dinas">
    <meta property="og:description" content="Platform digital pengelolaan perjalanan dinas DPRD Kabupaten Madiun yang efisien, transparan, dan akuntabel.">
    <meta property="og:image" content="{{ asset('images/og-image.jpg') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url('/') }}">
    <meta property="twitter:title" content="DPRD Kabupaten Madiun - Sistem Perjalanan Dinas">
    <meta property="twitter:description" content="Platform digital pengelolaan perjalanan dinas DPRD Kabupaten Madiun yang efisien, transparan, dan akuntabel.">
    <meta property="twitter:image" content="{{ asset('images/og-image.jpg') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-sans text-slate-800 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-blue-100 via-indigo-50 to-white min-h-screen relative selection:bg-indigo-500 selection:text-white overflow-x-hidden">

    <!-- Background Decoration -->
    <div class="fixed inset-0 z-0 pointer-events-none">
        <div class="absolute top-0 right-0 -mt-20 -mr-20 w-96 h-96 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-40 -mt-20 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-32 -left-20 w-96 h-96 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%239C92AC\' fill-opacity=\'0.05\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E')] opacity-60"></div>
    </div>

    <div class="relative z-10 flex flex-col justify-between min-h-screen">
        <!-- Header -->
        <header class="container mx-auto px-6 py-6 flex justify-between items-center bg-white/30 backdrop-blur-md rounded-b-[2rem] shadow-sm sticky top-0 z-50">
            <div class="flex items-center gap-3">
               <x-application-mark class="block h-10 w-auto" />
               <span class="font-bold text-xl tracking-tight text-slate-900 hidden md:block">DPRD Kab. Madiun</span>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-6 py-2.5 rounded-full shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:scale-105 selection:bg-indigo-500 selection:text-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-white bg-indigo-600 hover:bg-indigo-700 px-8 py-2.5 rounded-full shadow-lg shadow-indigo-500/30 transition-all duration-300 hover:scale-105 hover:shadow-indigo-500/50">
                            Masuk
                        </a>
                    @endauth
                </nav>
            @endif
        </header>

        <!-- Hero Section -->
        <main class="container mx-auto px-6 flex flex-col items-center text-center justify-center flex-grow py-20">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/40 backdrop-blur-md border border-white/50 text-indigo-900 text-sm font-medium mb-8 animate-fade-in-up shadow-sm">
                <span class="relative flex h-2 w-2">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                Sistem Informasi Digital
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 mb-6 tracking-tight drop-shadow-sm leading-tight max-w-4xl mx-auto">
                Perjalanan Dinas <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-blue-500">Dalam & Luar Daerah</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                Platform terpadu untuk pengelolaan jadwal, pengajuan, dan pelaporan kegiatan perjalanan dinas DPRD Kabupaten Madiun yang transparan dan akuntabel.
            </p>

            <div class="flex flex-col md:flex-row gap-4 justify-center w-full max-w-md mx-auto mb-20">
                <a href="{{ route('login') }}" class="group relative inline-flex items-center justify-center px-8 py-4 font-bold text-white transition-all duration-200 bg-indigo-600 font-lg rounded-2xl hover:bg-indigo-700 hover:scale-[1.02] hover:shadow-xl hover:shadow-indigo-500/40 focus:outline-none ring-offset-2 focus:ring-2 ring-indigo-500">
                    <span>Mulai Sekarang</span>
                    <svg class="w-5 h-5 ml-2 -mr-1 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                </a>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 max-w-6xl w-full text-left">
                <!-- Card 1 -->
                <div class="group p-8 rounded-[2rem] bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:bg-white/60 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 text-blue-600 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Efisiensi Waktu</h3>
                    <p class="text-slate-600 leading-relaxed">Proses pengajuan dan persetujuan yang terintegrasi mempercepat alur kerja administrasi perjalanan dinas.</p>
                </div>

                <!-- Card 2 -->
                <div class="group p-8 rounded-[2rem] bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:bg-white/60 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center mb-6 text-indigo-600 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Transparansi Data</h3>
                    <p class="text-slate-600 leading-relaxed">Akses data real-time mengenai anggaran dan realisasi perjalanan dinas untuk meningkatkan akuntabilitas.</p>
                </div>

                <!-- Card 3 -->
                <div class="group p-8 rounded-[2rem] bg-white/40 backdrop-blur-xl border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.04)] hover:bg-white/60 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] transition-all duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-purple-100 rounded-2xl flex items-center justify-center mb-6 text-purple-600 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Akuntabilitas</h3>
                    <p class="text-slate-600 leading-relaxed">Pelaporan yang terstruktur memudahkan audit dan memastikan setiap perjalanan dinas tercatat dengan baik.</p>
                </div>
            </div>

            <!-- Workflow Section -->
            <div class="mt-32 w-full max-w-6xl text-left">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-12 text-center">Alur Perjalanan Dinas</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <!-- Step 1 -->
                    <div class="relative p-6 bg-white/50 backdrop-blur-lg rounded-3xl border border-white shadow-sm flex flex-col items-center text-center group hover:bg-white/80 transition-all duration-300">
                        <div class="w-16 h-16 bg-blue-500 rounded-2xl text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-lg shadow-blue-500/30 group-hover:scale-110 transition-transform">1</div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Usulan/Jadwal</h3>
                        <p class="text-sm text-slate-600">Perencanaan dan penjadwalan kegiatan dinas oleh Komisi atau Sekretariat.</p>
                        <!-- Connector Arrow (Desktop Only) -->
                        <div class="hidden md:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-slate-300 z-10">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative p-6 bg-white/50 backdrop-blur-lg rounded-3xl border border-white shadow-sm flex flex-col items-center text-center group hover:bg-white/80 transition-all duration-300">
                        <div class="w-16 h-16 bg-indigo-500 rounded-2xl text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-lg shadow-indigo-500/30 group-hover:scale-110 transition-transform">2</div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Pengajuan</h3>
                        <p class="text-sm text-slate-600">Input data surat tugas perjalanan dinas beserta daftar pengikut (anggota/pendamping).</p>
                         <!-- Connector Arrow (Desktop Only) -->
                         <div class="hidden md:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-slate-300 z-10">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative p-6 bg-white/50 backdrop-blur-lg rounded-3xl border border-white shadow-sm flex flex-col items-center text-center group hover:bg-white/80 transition-all duration-300">
                        <div class="w-16 h-16 bg-purple-500 rounded-2xl text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-lg shadow-purple-500/30 group-hover:scale-110 transition-transform">3</div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Verifikasi & SPT</h3>
                        <p class="text-sm text-slate-600">Verifikasi oleh admin dan penerbitan Surat Perintah Tugas (SPT) resmi.</p>
                         <!-- Connector Arrow (Desktop Only) -->
                         <div class="hidden md:block absolute top-1/2 -right-3 transform -translate-y-1/2 text-slate-300 z-10">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="relative p-6 bg-white/50 backdrop-blur-lg rounded-3xl border border-white shadow-sm flex flex-col items-center text-center group hover:bg-white/80 transition-all duration-300">
                        <div class="w-16 h-16 bg-emerald-500 rounded-2xl text-white flex items-center justify-center text-2xl font-bold mb-4 shadow-lg shadow-emerald-500/30 group-hover:scale-110 transition-transform">4</div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Laporan</h3>
                        <p class="text-sm text-slate-600">Pelaksanaan kegiatan dan unggah laporan hasil perjalanan serta dokumentasi.</p>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-white/80 backdrop-blur-lg border-t border-white">
            <div class="container mx-auto px-6 py-12">
                <div class="flex flex-col md:flex-row justify-between items-center md:items-start gap-8">
                    <!-- Brand & Address -->
                    <div class="text-center md:text-left max-w-sm">
                        <div class="flex items-center justify-center md:justify-start gap-3 mb-4">
                            <x-application-mark class="block h-8 w-auto text-indigo-600" />
                            <span class="font-bold text-lg text-slate-900">DPRD Kab. Madiun</span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-4">
                            Sistem Informasi Manajemen Perjalanan Dinas DPRD Kabupaten Madiun. Mengutamakan transparansi, efisiensi, dan akuntabilitas.
                        </p>
                        <div class="flex flex-col gap-2 text-sm text-slate-500">
                            <p class="flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Jl. Panglima Sudirman No.80, Mejayan, Kab. Madiun
                            </p>
                            <p class="flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                setwan@madiunkab.go.id
                            </p>
                             <p class="flex items-center justify-center md:justify-start gap-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                (0351) 123456
                            </p>
                        </div>
                    </div>

                    <!-- Quick Links (Optional) -->
                    <div class="text-center md:text-left">
                        <h4 class="font-bold text-slate-800 mb-4">Tautan</h4>
                        <ul class="space-y-2 text-sm text-slate-600">
                             <li><a href="#" class="hover:text-indigo-600 transition-colors">Website Resmi DPRD</a></li>
                             <li><a href="#" class="hover:text-indigo-600 transition-colors">Pemerintah Kab. Madiun</a></li>
                             <li><a href="#" class="hover:text-indigo-600 transition-colors">JDIH Madiun</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div class="mt-10 rounded-2xl overflow-hidden shadow-lg border border-white/50">
                    <iframe 
                        src="https://maps.google.com/maps?q=-7.5502589,111.6324181&hl=id&z=16&output=embed"
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>

                <div class="border-t border-slate-200 mt-10 pt-6 text-center">
                    <p class="text-slate-400 text-xs">
                        &copy; {{ date('Y') }} Sekretariat DPRD Kabupaten Madiun. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
