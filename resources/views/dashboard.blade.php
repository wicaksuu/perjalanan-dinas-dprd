<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 text-[10px] font-black uppercase tracking-wider border border-indigo-100">Executive Overview</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    Dashboard <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Utama</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Monitoring Aktivitas & Realisasi Anggaran DPRD</p>
            </div>
            <a href="{{ route('kegiatan-dinas.create') }}" class="group relative flex items-center gap-3 bg-slate-900 overflow-hidden text-white px-6 py-3 rounded-2xl font-black shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <span class="relative text-xs uppercase tracking-wider">+ Kegiatan Baru</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8 px-4">
        <!-- FIXED: max-w-7xl consistent with app layout -->
        <div class="max-w-7xl mx-auto space-y-8">
            
            <!-- Row 1: Key Metrics Grid -->
            <!-- Adjusted to 4 columns to fit easier on 7xl, or scrollable on mobile -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Anggaran (Premium Dark Card) -->
                <div class="lg:col-span-1 group relative bg-slate-900 backdrop-blur-xl rounded-[2.5rem] p-6 shadow-2xl shadow-indigo-500/20 border border-slate-800 hover:shadow-indigo-500/30 transition-all duration-700 animate-fade-in-up" style="animation-delay: 50ms;">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 to-violet-600/20 rounded-[2.5rem] opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <div class="relative space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center border border-white/10 group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <p class="text-indigo-200 text-[10px] font-black uppercase tracking-widest">Realisasi</p>
                        </div>
                        <h3 class="text-xl font-black text-white tracking-tighter">Rp{{ number_format($totalRealization/1000000, 0, ',', '.') }}<span class="text-xs text-indigo-300">Jt</span></h3>
                    </div>
                </div>

                <!-- Total Kegiatan -->
                <div class="group bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 shadow-xl shadow-slate-200/40 border border-white hover:border-indigo-100 transition-all duration-500 animate-fade-in-up" style="animation-delay: 100ms;">
                    <div class="relative space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Total Kegiatan</p>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900">{{ $totalKegiatan }} <span class="text-[10px] font-bold text-slate-400 tracking-normal">Data</span></h3>
                    </div>
                </div>

                <!-- Dinas Dalam & Luar (Split Card for Logic) -->
                <div class="group bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 shadow-xl shadow-slate-200/40 border border-white hover:border-emerald-100 transition-all duration-500 animate-fade-in-up" style="animation-delay: 150ms;">
                     <div class="h-full flex flex-col justify-between space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                </div>
                                <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Dalam</span>
                            </div>
                            <span class="text-xl font-black text-slate-900">{{ $totalKegiatanDalam }}</span>
                        </div>
                        <div class="w-full h-px bg-slate-100"></div>
                        <div class="flex items-center justify-between">
                             <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-violet-50 rounded-xl flex items-center justify-center text-violet-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Luar</span>
                            </div>
                            <span class="text-xl font-black text-slate-900">{{ $totalKegiatanLuar }}</span>
                        </div>
                     </div>
                </div>

                <!-- Total Anggota -->
                <div class="group bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-6 shadow-xl shadow-slate-200/40 border border-white hover:border-blue-100 transition-all duration-500 animate-fade-in-up" style="animation-delay: 250ms;">
                    <div class="relative space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Personil</p>
                        </div>
                        <h3 class="text-2xl font-black text-slate-900">{{ $totalAnggota }} <span class="text-[10px] font-bold text-slate-400 tracking-normal">Anggota</span></h3>
                    </div>
                </div>
            </div>

            <!-- Row: Interactive Status Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data="{ focusedStatus: null }">
                <!-- Status: Akan Datang -->
                <div 
                    @mouseenter="focusedStatus = 'upcoming'" 
                    @mouseleave="focusedStatus = null"
                    class="group relative bg-white/70 backdrop-blur-xl rounded-[3rem] p-8 border border-white shadow-xl shadow-slate-200/30 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:scale-[1.02] animate-fade-in-up" 
                    style="animation-delay: 300ms;"
                >
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-blue-500/10 flex items-center justify-center text-blue-600 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-blue-500 bg-blue-500/10 px-3 py-1.5 rounded-xl border border-blue-100">Akan Datang</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-5xl font-black text-slate-900 tracking-tighter">{{ $totalAkanDatang }}</h4>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none">Rencana Kegiatan</p>
                        </div>

                        <!-- Hover Detail: Latest List -->
                        <div 
                            x-show="focusedStatus === 'upcoming'"
                            x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-4"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-8 space-y-4 pt-8 border-t border-slate-100"
                        >
                            @forelse($listAkanDatang as $item)
                            <div 
                                onclick="Livewire.dispatch('open-trip-detail', { id: {{ $item->id }} })"
                                x-data="{
                                    start: new Date('{{ $item->tanggal_mulai->format('Y-m-d 00:00:00') }}').getTime(),
                                    now: new Date().getTime(),
                                    timeStr: '',
                                    update() {
                                        let dist = this.start - this.now;
                                        if (dist < 0) { this.timeStr = 'Segera dimulai'; return; }
                                        let d = Math.floor(dist / (1000 * 60 * 60 * 24));
                                        let h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        let m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                                        
                                        if (d > 0) this.timeStr = `${d} hari lagi`;
                                        else if (h > 0) this.timeStr = `${h} jam, ${m} mnt`;
                                        else this.timeStr = `${m} mnt lagi`;
                                    },
                                    init() {
                                        this.update();
                                        setInterval(() => { this.now = new Date().getTime(); this.update(); }, 1000);
                                    }
                                }"
                                class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer group/item"
                            >
                                <div class="flex justify-between items-start mb-1">
                                    <div class="flex flex-col gap-0.5">
                                        <p class="text-[9px] font-black text-blue-600 uppercase tracking-widest">{{ $item->tanggal_mulai->format('d M Y') }}</p>
                                        @php
                                            $identityVal = $item->komisi->nama;
                                            if (str_contains(strtoupper($identityVal), 'PIMPINAN')) {
                                                $identityVal = $item->anggotas->pluck('nama')->first() ?? 'PIMPINAN';
                                            }
                                        @endphp
                                        <span class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">
                                            {{ Str::limit($identityVal, 20) }}
                                        </span>
                                    </div>
                                    <span class="text-[9px] font-black px-2 py-0.5 rounded-md bg-white border border-slate-100 text-blue-500 uppercase tracking-tighter" x-text="timeStr"></span>
                                </div>
                                <p class="text-sm font-black text-slate-800 line-clamp-1 group-hover/item:text-blue-600 transition-colors">{{ $item->nama_kegiatan }}</p>
                            </div>
                            @empty
                            <p class="text-[10px] font-bold text-slate-400 text-center py-4 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-100">Belum ada rencana kegiatan</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Status: Sedang Berjalan -->
                <div 
                    @mouseenter="focusedStatus = 'ongoing'" 
                    @mouseleave="focusedStatus = null"
                    class="group relative bg-white/70 backdrop-blur-xl rounded-[3rem] p-8 border border-white shadow-xl shadow-slate-200/30 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:scale-[1.02] animate-fade-in-up" 
                    style="animation-delay: 400ms;"
                >
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-emerald-50 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-inner">
                                <svg class="w-6 h-6 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600 bg-emerald-600/10 px-3 py-1.5 rounded-xl border border-emerald-100 animate-pulse">Sedang Berjalan</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-5xl font-black text-slate-900 tracking-tighter">{{ $totalBerjalan }}</h4>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none">Aktif di Lapangan</p>
                        </div>

                        <!-- Hover Detail: Latest List -->
                        <div 
                            x-show="focusedStatus === 'ongoing'"
                            x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-4"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-8 space-y-4 pt-8 border-t border-slate-100"
                        >
                            @forelse($listBerjalan as $item)
                            <div 
                                onclick="Livewire.dispatch('open-trip-detail', { id: {{ $item->id }} })"
                                x-data="{
                                    end: new Date('{{ $item->tanggal_selesai->format('Y-m-d 23:59:59') }}').getTime(),
                                    now: new Date().getTime(),
                                    timeStr: '',
                                    update() {
                                        let dist = this.end - this.now;
                                        if (dist < 0) { this.timeStr = 'Segera berakhir'; return; }
                                        let d = Math.floor(dist / (1000 * 60 * 60 * 24));
                                        let h = Math.floor((dist % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        let m = Math.floor((dist % (1000 * 60 * 60)) / (1000 * 60));
                                        
                                        if (d > 0) this.timeStr = `Sisa ${d} hari lagi`;
                                        else if (h > 0) this.timeStr = `Sisa ${h} jam, ${m} mnt`;
                                        else this.timeStr = `Sisa ${m} mnt lagi`;
                                    },
                                    init() {
                                        this.update();
                                        setInterval(() => { this.now = new Date().getTime(); this.update(); }, 1000);
                                    }
                                }"
                                class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer group/item"
                            >
                                <div class="flex justify-between items-center mb-1">
                                    @php
                                        $identityVal = $item->komisi->nama;
                                        if (str_contains(strtoupper($identityVal), 'PIMPINAN')) {
                                            $identityVal = $item->anggotas->pluck('nama')->first() ?? 'PIMPINAN';
                                        }
                                    @endphp
                                    <p class="text-[9px] font-black text-emerald-600 uppercase tracking-widest shrink-0">
                                        {{ Str::limit($identityVal, 16) }}
                                    </p>
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-tighter" x-text="timeStr"></span>
                                </div>
                                <p class="text-sm font-black text-slate-800 line-clamp-1 group-hover/item:text-emerald-600 transition-colors">{{ $item->nama_kegiatan }}</p>
                                <div class="mt-2 w-full h-1 bg-slate-100 rounded-full overflow-hidden">
                                    @php 
                                        $total = max(1, $item->tanggal_mulai->diffInDays($item->tanggal_selesai));
                                        $elapsed = max(0, $item->tanggal_mulai->diffInDays(now()));
                                        $percent = min(100, round(($elapsed / $total) * 100));
                                    @endphp
                                    <div class="h-full bg-emerald-500 transition-all duration-500" style="width: {{ $percent }}%"></div>
                                </div>
                            </div>
                            @empty
                            <p class="text-[10px] font-bold text-slate-400 text-center py-4 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-100">Tidak ada kegiatan aktif</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Status: Sudah Selesai -->
                <div 
                    @mouseenter="focusedStatus = 'completed'" 
                    @mouseleave="focusedStatus = null"
                    class="group relative bg-white/70 backdrop-blur-xl rounded-[3rem] p-8 border border-white shadow-xl shadow-slate-200/30 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:scale-[1.02] animate-fade-in-up" 
                    style="animation-delay: 500ms;"
                >
                    <div class="absolute -right-12 -top-12 w-40 h-40 bg-slate-50 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>
                    <div class="relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div class="w-12 h-12 rounded-2xl bg-slate-900/10 flex items-center justify-center text-slate-900 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 bg-slate-500/10 px-3 py-1.5 rounded-xl border border-slate-100">Sudah Selesai</span>
                        </div>
                        <div class="space-y-1">
                            <h4 class="text-5xl font-black text-slate-900 tracking-tighter">{{ $totalSelesai }}</h4>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-none">Arsip Kegiatan</p>
                        </div>

                        <!-- Hover Detail: Latest List -->
                        <div 
                            x-show="focusedStatus === 'completed'"
                            x-transition:enter="transition ease-out duration-300 transform opacity-0 translate-y-4"
                            x-transition:enter-start="opacity-0 translate-y-4"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="mt-8 space-y-4 pt-8 border-t border-slate-100"
                        >
                            @forelse($listSelesai as $item)
                            <div 
                                onclick="Livewire.dispatch('open-trip-detail', { id: {{ $item->id }} })"
                                class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all duration-300 cursor-pointer group/item"
                            >
                                <div class="flex justify-between items-start mb-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $item->tanggal_selesai->format('d M Y') }}</p>
                                    @php
                                        $identityVal = $item->komisi->nama;
                                        if (str_contains(strtoupper($identityVal), 'PIMPINAN')) {
                                            $identityVal = $item->anggotas->pluck('nama')->first() ?? 'PIMPINAN';
                                        }
                                    @endphp
                                    <span class="text-[9px] font-black px-2 py-0.5 rounded-md bg-white border border-slate-100 text-slate-500 uppercase tracking-widest">
                                        {{ Str::limit($identityVal, 15) }}
                                    </span>
                                </div>
                                <p class="text-sm font-black text-slate-800 line-clamp-1 group-hover/item:text-slate-900 transition-colors">{{ $item->nama_kegiatan }}</p>
                            </div>
                            @empty
                            <p class="text-[10px] font-bold text-slate-400 text-center py-4 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-100">Belum ada arsip kegiatan</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row 2: Trend Charts (Activity & Budget) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Activity Trend Chart -->
                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white animate-fade-in-up" style="animation-delay: 300ms;">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-black text-slate-900">Tren Aktivitas</h3>
                            <p class="text-xs font-medium text-slate-400">Frekuensi perjalanan dinas per bulan</p>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-100">
                           <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                           <span class="text-[10px] font-bold text-indigo-700">Total Kegiatan</span>
                        </div>
                    </div>
                    <div class="h-[280px] w-full">
                        <canvas id="activityChart"></canvas>
                    </div>
                </div>

                <!-- Budget Trend Chart -->
                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white animate-fade-in-up" style="animation-delay: 400ms;">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h3 class="text-lg font-black text-slate-900">Tren Anggaran</h3>
                            <p class="text-xs font-medium text-slate-400">Realisasi biaya dinas per bulan</p>
                        </div>
                        <div class="flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-100">
                           <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                           <span class="text-[10px] font-bold text-emerald-700">Realisasi (Rp)</span>
                        </div>
                    </div>
                    <div class="h-[280px] w-full">
                        <canvas id="budgetChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Row 3: Analysis & Leaders & PIMPINAN SEPARATED -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- PIMPINAN Performance (Dedicated Card) -->
                <div class="group/pimpinan bg-slate-900 rounded-[2.5rem] p-8 shadow-2xl shadow-slate-900/40 border border-slate-800 relative overflow-hidden animate-fade-in-up transition-all duration-500 hover:scale-[1.02]" style="animation-delay: 500ms;">
                     <div class="absolute -top-24 -right-24 w-48 h-48 bg-orange-500/20 rounded-full blur-[60px] group-hover/pimpinan:bg-orange-500/30 transition-all duration-500"></div>
                     <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/20 to-transparent opacity-50 group-hover/pimpinan:opacity-70 transition-opacity duration-500"></div>
                     
                     <div class="relative h-full flex flex-col justify-between">
                        <!-- Default View (Stats) - Fades out on hover -->
                        <div class="space-y-6 transition-all duration-500 group-hover/pimpinan:opacity-0 group-hover/pimpinan:-translate-y-4 absolute inset-0 p-8 z-10">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-black text-white flex items-center gap-2">
                                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                                    PIMPINAN DPRD
                                </h3>
                                <span class="text-[9px] font-bold text-orange-400 uppercase tracking-wider bg-orange-400/10 px-2 py-1 rounded-lg border border-orange-400/20">Executive</span>
                            </div>

                            @if($pimpinanStats)
                            <div class="space-y-4">
                                 <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Realisasi</p>
                                    <h4 class="text-2xl font-black text-white">Rp {{ number_format($pimpinanStats->total_budget/1000000, 0, ',', '.') }}<span class="text-xs text-slate-500">jt</span></h4>
                                 </div>
                                 <div class="grid grid-cols-2 gap-4">
                                    <div class="p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm">
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Kegiatan</p>
                                        <h4 class="text-xl font-black text-white">{{ $pimpinanStats->kegiatan_dinas_count }} <span class="text-xs text-slate-500">x</span></h4>
                                    </div>
                                    <div class="p-4 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center backdrop-blur-sm">
                                         <span class="text-[10px] font-black uppercase tracking-widest text-indigo-400">
                                            Hover Me →
                                         </span>
                                    </div>
                                 </div>
                            </div>
                            @else
                            <div class="p-4 rounded-2xl bg-white/5 border border-dashed border-white/10 text-center">
                                <p class="text-xs text-slate-500">Data Pimpinan belum tersedia.</p>
                            </div>
                            @endif
                        </div>

                        <!-- Hover View (Members List) - Slides up on hover -->
                        <div class="opacity-0 translate-y-8 group-hover/pimpinan:opacity-100 group-hover/pimpinan:translate-y-0 transition-all duration-500 z-20 h-full flex flex-col">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-black text-white">Top Personil</h3>
                                <a href="{{ route('kegiatan-dinas.laporan-pimpinan') }}" class="text-[9px] font-bold text-white bg-indigo-600 px-2 py-1 rounded-lg hover:bg-indigo-500 transition-colors">
                                    Full Report
                                </a>
                            </div>
                            <div class="space-y-3">
                                @foreach($pimpinanMembers as $pm)
                                <div class="flex items-center gap-3 p-3 rounded-xl bg-white/10 border border-white/10 backdrop-blur-md">
                                    <div class="w-8 h-8 rounded-full bg-orange-500 flex items-center justify-center text-white text-xs font-black ring-2 ring-orange-400/50">
                                        {{ substr($pm->nama, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-white truncate">{{ $pm->nama }}</p>
                                        <p class="text-[9px] text-slate-400 truncate">{{ $pm->jabatan }}</p>
                                    </div>
                                    <span class="text-[10px] font-black text-orange-400">{{ $pm->total_kegiatan }}x</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Top Komisi (Without Pimpinan) -->
                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white animate-fade-in-up" style="animation-delay: 600ms;">
                     <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-slate-900">Kinerja Komisi</h3>
                        <span class="text-[9px] font-bold text-indigo-600 uppercase tracking-wider bg-indigo-50 px-2 py-1 rounded-lg">Non-Pimpinan</span>
                    </div>
                    <div class="space-y-3 pr-2 custom-scrollbar max-h-[250px] overflow-y-auto">
                        @foreach($kegiatanPerKomisi as $index => $komisi)
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-black text-slate-500 w-4">{{ $loop->iteration }}</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-900">{{ $komisi->nama }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $komisi->kegiatan_dinas_count }} Kegiatan</p>
                                </div>
                            </div>
                            <span class="text-xs font-black text-indigo-600">Rp{{ number_format($komisi->total_budget/1000000, 0, ',', '.') }}jt</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Top Staff -->
                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/40 border border-white animate-fade-in-up" style="animation-delay: 700ms;">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-black text-slate-900">Top Staff</h3>
                        <span class="text-[9px] font-bold text-emerald-600 uppercase tracking-wider bg-emerald-50 px-2 py-1 rounded-lg">Pendampingan</span>
                    </div>
                    <div class="space-y-3 pr-2 custom-scrollbar max-h-[250px] overflow-y-auto">
                        @foreach($topStaff as $index => $staff)
                        <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all">
                            <div class="flex items-center gap-3">
                                <span class="text-xs font-black text-slate-400 w-4">{{ $loop->iteration }}</span>
                                <div>
                                    <p class="text-xs font-bold text-slate-900 line-clamp-1">{{ $staff->nama }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $staff->nip }}</p>
                                </div>
                            </div>
                            <span class="text-xs font-black text-emerald-600">{{ $staff->total_kegiatan }}x</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Row 4: Recent Timeline -->
            <div class="bg-white/80 backdrop-blur-2xl rounded-[3rem] border border-white shadow-2xl shadow-slate-200/30 overflow-hidden animate-fade-in-up" style="animation-delay: 800ms;">
                <div class="p-8 border-b border-slate-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="space-y-1">
                        <h3 class="text-xl font-black text-slate-900">Timeline Terbaru</h3>
                        <p class="text-xs font-medium text-slate-500">Monitoring real-time aktivitas yang baru diinput</p>
                    </div>
                    <a href="{{ route('kegiatan-dinas.index') }}" class="text-[11px] font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-800 transition-colors">
                        Lihat Semua Data →
                    </a>
                </div>
                <div class="p-6 overflow-x-auto">
                     <div class="flex gap-6 min-w-max pb-4 px-2">
                        @foreach($kegiatanTerbaru as $kegiatan)
                        <div 
                            onclick="Livewire.dispatch('open-trip-detail', { id: {{ $kegiatan->id }} })"
                            class="w-[300px] p-6 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:scale-[1.02] transition-all duration-500 cursor-pointer group flex flex-col justify-between"
                            x-data="{
                                start: new Date('{{ $kegiatan->tanggal_mulai->format('Y-m-d 00:00:00') }}').getTime(),
                                end: new Date('{{ $kegiatan->tanggal_selesai->format('Y-m-d 23:59:59') }}').getTime(),
                                now: new Date().getTime(),
                                status: '{{ $kegiatan->status_kegiatan }}',
                                timeString: '',
                                progress: 0,
                                init() {
                                    this.update();
                                    setInterval(() => {
                                        this.now = new Date().getTime();
                                        this.update();
                                    }, 1000);
                                },
                                update() {
                                    if (this.status === 'upcoming') {
                                        let distance = this.start - this.now;
                                        if (distance < 0) { this.timeString = 'Segera dimulai'; return; }
                                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        
                                        if (days > 0) {
                                            this.timeString = `${days} hari, ${hours} jam`;
                                        } else if (hours > 0) {
                                            this.timeString = `${hours} jam, ${minutes} menit`;
                                        } else {
                                            this.timeString = `${minutes} mnt, ${seconds} dtk`;
                                        }
                                    } else if (this.status === 'ongoing') {
                                        let total = this.end - this.start;
                                        let elapsed = this.now - this.start;
                                        this.progress = Math.min(100, Math.max(0, (elapsed / total) * 100));
                                        let distance = this.end - this.now;
                                        if (distance < 0) { this.timeString = 'Segera berakhir'; return; }
                                        let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                        
                                        if (days > 0) {
                                            this.timeString = `${days} hari lagi`;
                                        } else if (hours > 0) {
                                            this.timeString = `${hours} jam, ${minutes} mnt`;
                                        } else {
                                            this.timeString = `${minutes} mnt, ${seconds} dtk`;
                                        }
                                    }
                                }
                            }"
                        >
                            <div class="space-y-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex flex-col gap-1.5">
                                        <span class="px-3 py-1 w-fit rounded-lg text-[9px] font-black uppercase tracking-wider {{ $kegiatan->jenis_dinas == 'dalam' ? 'bg-emerald-100 text-emerald-700' : 'bg-violet-100 text-violet-700' }}">
                                            {{ $kegiatan->jenis_dinas }}
                                        </span>
                                        
                                        @php
                                            $identity = $kegiatan->komisi->nama;
                                            $isPimpinan = str_contains(strtoupper($identity), 'PIMPINAN');
                                            if ($isPimpinan) {
                                                $identity = $kegiatan->anggotas->pluck('nama')->first() ?? 'PIMPINAN DPRD';
                                            }
                                        @endphp
                                        
                                        <span class="text-[9px] font-black uppercase tracking-widest {{ $isPimpinan ? 'text-orange-500' : 'text-blue-500' }}">
                                            {{ Str::limit($identity, 20) }}
                                        </span>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400">{{ $kegiatan->tanggal_mulai->format('d M') }}</span>
                                </div>

                                <h4 class="text-sm font-black text-slate-900 line-clamp-2 min-h-[40px] group-hover:text-indigo-600 transition-colors leading-tight">{{ $kegiatan->nama_kegiatan }}</h4>
                                
                                <div class="flex flex-col gap-3">
                                    <div class="flex items-center gap-2 text-[10px] font-bold text-slate-500">
                                        <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                        {{ Str::limit($kegiatan->lokasi, 25) }}
                                    </div>

                                    <!-- REAL-TIME STATUS -->
                                    <div class="bg-white/50 p-3 rounded-2xl border border-slate-100 shadow-sm min-h-[55px]">
                                        <template x-if="status === 'upcoming'">
                                            <div class="flex flex-col gap-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-[8px] font-black text-blue-500 uppercase tracking-widest">Akan Datang</span>
                                                    <span class="text-[8px] font-black text-slate-400" x-text="timeString"></span>
                                                </div>
                                                <div class="w-full h-1 bg-blue-100 rounded-full mt-1 opacity-20"></div>
                                            </div>
                                        </template>
                                        
                                        <template x-if="status === 'ongoing'">
                                            <div class="flex flex-col gap-1">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-[8px] font-black text-emerald-500 uppercase tracking-widest animate-pulse">Berjalan</span>
                                                    <span class="text-[8px] font-black text-slate-500" x-text="timeString"></span>
                                                </div>
                                                <div class="w-full h-1 bg-slate-100 rounded-full mt-1 overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-1000" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </template>

                                        <template x-if="status === 'ended'">
                                            <div class="flex items-center justify-between h-full">
                                                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Selesai Berjalan</span>
                                                <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-6 flex items-center justify-between pt-4 border-t border-slate-100/50">
                                <div class="flex -space-x-2">
                                    @foreach($kegiatan->anggotas->take(3) as $anggota)
                                        <div class="w-7 h-7 rounded-full bg-white border border-slate-200 flex items-center justify-center text-[9px] font-black text-slate-600 shadow-sm" title="{{ $anggota->nama }}">
                                            {{ substr($anggota->nama, 0, 1) }}
                                        </div>
                                    @endforeach
                                </div>
                                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-lg">Rp{{ number_format($kegiatan->total_nominal/1000000, 1, ',', '.') }}jt</span>
                            </div>
                        </div>
                        @endforeach
                     </div>
                </div>
            </div>

        </div>
    </div>
    
    <!-- Inject Livewire Modal -->
    <livewire:trip-detail-modal />

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stats = @json($statistikBulanan);
            const labels = stats.map(item => {
                const date = new Date(item.bulan + '-01');
                return date.toLocaleDateString('id-ID', { month: 'short', year: '2-digit' });
            });
            const activityData = stats.map(item => item.total_kegiatan);
            const budgetData = stats.map(item => item.total_budget);

            // 1. Activity Chart (Bar)
            new Chart(document.getElementById('activityChart').getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Kegiatan',
                        data: activityData,
                        backgroundColor: '#6366f1',
                        borderRadius: 8,
                        barThickness: 24,
                        maxBarThickness: 32
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // 2. Budget Chart (Area/Line)
            const ctxBudget = document.getElementById('budgetChart').getContext('2d');
            const gradientBudget = ctxBudget.createLinearGradient(0, 0, 0, 300);
            gradientBudget.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
            gradientBudget.addColorStop(1, 'rgba(16, 185, 129, 0)');

            new Chart(ctxBudget, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Realisasi',
                        data: budgetData,
                        borderColor: '#10b981',
                        backgroundColor: gradientBudget,
                        borderWidth: 3,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: '#10b981',
                        pointWidth: 4,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            grid: { color: 'rgba(0,0,0,0.03)', drawBorder: false },
                            ticks: { callback: (val) => (val/1000000).toFixed(0) + 'jt' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.2); }
        
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }
    </style>
    @endpush
</x-app-layout>
