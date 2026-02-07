<div class="py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 min-h-screen" x-data="{ printing: false }">
    <div class="max-w-7xl mx-auto space-y-8">
        <!-- HEADER & FILTERS -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8 bg-white/70 backdrop-blur-xl p-8 rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white/80 ring-1 ring-slate-100 animate-fade-in-up">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-[0.2em] mb-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-600"></span>
                    </span>
                    Real-time Data
                </div>
                <h1 class="text-4xl lg:text-5xl font-black text-slate-900 tracking-tight">Analisa Laporan</h1>
                <p class="text-slate-500 font-medium text-lg lg:text-xl max-w-xl leading-relaxed">Pantau performa dan intensitas perjalanan dinas dengan wawasan mendalam.</p>
            </div>
            
            <div class="flex flex-wrap items-center gap-5">
                <div class="flex bg-slate-100/80 backdrop-blur-md p-1.5 rounded-[1.5rem] border border-slate-200/50 shadow-inner">
                    <button wire:click="setRange('week')" class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 {{ $rangeType == 'week' ? 'bg-white text-blue-600 shadow-xl shadow-blue-500/10' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">Minggu</button>
                    <button wire:click="setRange('month')" class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 {{ $rangeType == 'month' ? 'bg-white text-blue-600 shadow-xl shadow-blue-500/10' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">Bulan</button>
                    <button wire:click="setRange('year')" class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 {{ $rangeType == 'year' ? 'bg-white text-blue-600 shadow-xl shadow-blue-500/10' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">Tahun</button>
                    <button wire:click="setRange('custom')" class="px-6 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 {{ $rangeType == 'custom' ? 'bg-white text-blue-600 shadow-xl shadow-blue-500/10' : 'text-slate-500 hover:text-slate-900 hover:bg-white/50' }}">Kustom</button>
                </div>

                @if($rangeType == 'custom')
                <div class="flex items-center gap-3 bg-white border border-slate-200/60 p-2 rounded-[1.5rem] shadow-sm hover:border-blue-400 transition-all duration-300 animate-fade-in-up">
                    <div class="flex items-center gap-3 px-4 border-r border-slate-100">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Dari</label>
                        <input type="date" wire:model.live="startDate" class="bg-transparent border-none text-[11px] font-black text-slate-700 focus:ring-0 p-0 cursor-pointer">
                    </div>
                    <div class="flex items-center gap-3 px-4">
                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Sampai</label>
                        <input type="date" wire:model.live="endDate" class="bg-transparent border-none text-[11px] font-black text-slate-700 focus:ring-0 p-0 cursor-pointer">
                    </div>
                </div>
                @endif

                <div class="flex items-center gap-3 bg-white border border-slate-200/60 p-2 rounded-[1.5rem] shadow-sm hover:border-blue-400 transition-colors duration-300">
                    <div class="bg-blue-50 p-2 rounded-xl text-blue-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                    <select wire:model.live="selectedKomisi" class="bg-transparent border-none text-[11px] font-black text-slate-700 focus:ring-0 cursor-pointer min-w-[160px] uppercase tracking-wider">
                        <option value="">Semua Komisi</option>
                        @foreach($komisis as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <button @click="window.print()" class="group relative bg-slate-900 hover:bg-black text-white px-8 py-4 rounded-[1.5rem] text-[10px] font-black uppercase tracking-[0.2em] shadow-2xl shadow-slate-900/30 transition-all duration-500 overflow-hidden">
                    <div class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2-2v4h10z"></path></svg>
                        <span>Export Laporan</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- SUMMARY CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 animate-fade-in-up delay-100">
            <div class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 p-8 rounded-[3.5rem] shadow-2xl shadow-blue-500/30 text-white relative overflow-hidden group transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02]">
                <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-white/10 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="absolute -right-12 top-0 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
                <div class="relative z-10 space-y-6">
                    <div class="bg-white/20 w-16 h-16 rounded-[1.5rem] flex items-center justify-center backdrop-blur-xl border border-white/30 shadow-xl group-hover:rotate-12 transition-transform duration-500">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <p class="text-blue-100/80 text-[10px] font-black uppercase tracking-[0.3em]">Total Intensitas</p>
                        <h3 class="text-5xl font-black mt-2 tracking-tighter">{{ $stats['total_trips'] }} <span class="text-xl font-medium opacity-60">Kegiatan</span></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl p-8 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 relative overflow-hidden group transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] ring-1 ring-slate-100">
                <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-emerald-50 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="bg-emerald-50 text-emerald-600 w-16 h-16 rounded-[1.5rem] flex items-center justify-center group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500 shadow-lg group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Akumulasi Durasi</p>
                        <h3 class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">{{ $stats['total_days'] }} <span class="text-xl font-medium text-slate-400">Hari</span></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl p-8 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 relative overflow-hidden group transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] ring-1 ring-slate-100">
                <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-purple-50 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="bg-purple-50 text-purple-600 w-16 h-16 rounded-[1.5rem] flex items-center justify-center group-hover:bg-purple-600 group-hover:text-white transition-all duration-500 shadow-lg group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Keterlibatan Aktif</p>
                        <h3 class="text-5xl font-black text-slate-900 mt-2 tracking-tighter">{{ $stats['anggota_stats']->count() }} <span class="text-xl font-medium text-slate-400">Orang</span></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white/70 backdrop-blur-xl p-8 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 relative overflow-hidden group transition-all duration-500 hover:-translate-y-2 hover:scale-[1.02] ring-1 ring-slate-100">
                <div class="absolute -right-8 -bottom-8 w-48 h-48 bg-rose-50 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                <div class="relative z-10 space-y-6">
                    <div class="bg-rose-50 text-rose-600 w-16 h-16 rounded-[1.5rem] flex items-center justify-center group-hover:bg-rose-600 group-hover:text-white transition-all duration-500 shadow-lg group-hover:rotate-12">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1m-5-1a6.73 6.73 0 012.176-4.991C7.477 12.114 8.065 12 8.713 12m11.286 0c-.3 0-.588.033-.867.098m0 0a3.374 3.374 0 01-1.25.548m0 0a3.374 3.374 0 001.25-.548"></path></svg>
                    </div>
                    <div>
                        <p class="text-slate-400 text-[10px] font-black uppercase tracking-[0.3em]">Akumulasi Anggaran</p>
                        <h3 class="text-4xl font-black text-rose-600 mt-2 tracking-tighter">Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- VISUALIZATION -->
        
        <!-- ROW 1: TOP RANKINGS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in-up delay-200">
            <!-- Top 5 Activity -->
            <div class="bg-white/70 backdrop-blur-xl p-10 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 min-h-[500px] flex flex-col relative overflow-hidden group ring-1 ring-slate-100">
                <div class="relative z-10 flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Top 5 Paling Aktif</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Activity Leaderboard</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-2xl text-blue-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                </div>
                <div id="top5ActivityChart" class="flex-1 min-h-[350px]" wire:ignore></div>
            </div>

            <!-- Top 5 Budget -->
            <div class="bg-white/70 backdrop-blur-xl p-10 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 min-h-[500px] flex flex-col relative overflow-hidden group ring-1 ring-slate-100">
                <div class="relative z-10 flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Top 5 Penggunaan Anggaran</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Budget Leaderboard</p>
                    </div>
                    <div class="bg-rose-50 p-4 rounded-2xl text-rose-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1m-5-1a6.73 6.73 0 012.176-4.991C7.477 12.114 8.065 12 8.713 12m11.286 0c-.3 0-.588.033-.867.098m0 0a3.374 3.374 0 01-1.25.548m0 0a3.374 3.374 0 001.25-.548"></path></svg>
                    </div>
                </div>
                <div id="top5BudgetChart" class="flex-1 min-h-[350px]" wire:ignore></div>
            </div>
        </div>

        <!-- ROW 2: ANALYSIS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in-up delay-300">
            <!-- Trend Budget -->
            <div class="bg-white/70 backdrop-blur-xl p-10 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 min-h-[500px] flex flex-col relative overflow-hidden group ring-1 ring-slate-100">
                 <div class="relative z-10 flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Tren Anggaran</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Budget Accumulation Analysis</p>
                    </div>
                    <div class="bg-purple-50 p-4 rounded-2xl text-purple-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                    </div>
                </div>
                <div id="trendBudgetChart" class="flex-1 min-h-[350px]" wire:ignore></div>
            </div>

            <!-- Distribution Duration -->
            <div class="bg-white/70 backdrop-blur-xl p-10 rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 min-h-[500px] flex flex-col relative overflow-hidden group ring-1 ring-slate-100">
                <div class="relative z-10 flex items-center justify-between mb-10">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Distribusi Hari</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Duration by Commission</p>
                    </div>
                    <div class="bg-emerald-50 p-4 rounded-2xl text-emerald-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div id="hariChart" class="flex-1 min-h-[350px]" wire:ignore></div>
            </div>
        </div>

        <!-- TABLES -->
        <div class="grid grid-cols-1 xl:grid-cols-12 gap-10 animate-fade-in-up delay-300">
            <!-- Komisi Table -->
            <div class="xl:col-span-12 bg-white/70 backdrop-blur-xl rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 overflow-hidden ring-1 ring-slate-100">
                <div class="p-10 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">Performa Komisi</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Summary of activities by commission</p>
                    </div>
                    <div class="bg-blue-600 text-white px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-blue-500/30">
                        {{ count($stats['komisi_stats']) }} Komisi
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Komisi</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Intensitas</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Durasi Total</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Anggaran</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-right">Efektivitas</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($stats['komisi_stats'] as $k)
                            <tr wire:click="openKomisiTrips({{ $k['id'] }}, '{{ $k['nama'] }}')" class="hover:bg-blue-50/30 transition-all duration-300 group cursor-pointer">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-6">
                                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 text-white flex items-center justify-center text-xl font-black shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-500">
                                            {{ substr($k['nama'], -1) }}
                                        </div>
                                        <div>
                                            <span class="font-black text-slate-900 text-lg tracking-tight block">{{ $k['nama'] }}</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">DPRD Kabupaten Madiun</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <span class="inline-flex flex-col items-center">
                                        <span class="text-2xl font-black text-slate-900 leading-none">{{ $k['total_kegiatan'] }}</span>
                                        <span class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Trip</span>
                                    </span>
                                </td>
                                <td class="px-10 py-8 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="flex items-center gap-2 mb-2">
                                            <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                                            <span class="text-xl font-black text-slate-900 tracking-tight">{{ $k['total_hari'] }} Hari</span>
                                        </div>
                                        <div class="w-20 h-1 bg-slate-100 rounded-full overflow-hidden">
                                            <div class="h-full bg-emerald-500" style="width: {{ min(100, ($k['total_hari'] / max(1, $stats['total_days'])) * 100) }}%"></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center font-bold text-rose-600">
                                    Rp {{ number_format($k['total_nominal'], 0, ',', '.') }}
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="inline-flex flex-col items-end">
                                        <span class="text-lg font-black text-blue-600 bg-blue-50 px-4 py-1.5 rounded-xl">
                                            {{ $k['total_kegiatan'] > 0 ? number_format($k['total_hari'] / $k['total_kegiatan'], 1) : 0 }} <small class="text-[10px] opacity-70">D/T</small>
                                        </span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Avg Duration</span>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Anggota Table -->
            <div class="xl:col-span-12 bg-white/70 backdrop-blur-xl rounded-[3.5rem] shadow-xl shadow-slate-200/50 border border-white/80 overflow-hidden ring-1 ring-slate-100">
                <div class="p-10 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                    <div>
                        <h3 class="text-2xl font-black text-slate-900 tracking-tight">
                            @if($selectedKomisi)
                                @php $selectedName = collect($komisis)->firstWhere('id', $selectedKomisi)->nama ?? 'Komisi'; @endphp
                                Ranking Partisipasi Member {{ $selectedName }}
                            @else
                                Ranking Partisipasi Anggota
                            @endif
                        </h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">
                            Urutan berdasarkan: Intensitas Kegiatan > Total Hari > Total Anggaran
                        </p>
                    </div>
                    <div class="bg-indigo-600 text-white px-5 py-2.5 rounded-2xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-indigo-500/30">
                        {{ $stats['anggota_stats']->count() }} Anggota
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50/50">
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Nama Anggota</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Kegiatan</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Total Anggaran</th>
                                <th class="px-10 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 text-center">Pencapaian Hari</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm">
                            @foreach($stats['anggota_stats'] as $a)
                            <tr wire:click="openTrips({{ $a->id }}, '{{ $a->nama }}')" class="hover:bg-indigo-50/30 transition-all duration-300 group cursor-pointer">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-6">
                                        <div class="w-14 h-14 rounded-full bg-gradient-to-tr from-slate-100 to-slate-200 border-4 border-white flex items-center justify-center text-slate-500 font-black text-lg group-hover:from-indigo-600 group-hover:to-blue-600 group-hover:text-white transition-all duration-500 shadow-md">
                                            {{ substr($a->nama, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="font-black text-slate-800 text-xl tracking-tight block">{{ $a->nama }}</span>
                                            <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">DPRD Member</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center text-2xl font-black text-slate-900">
                                    {{ $a->total_kegiatan }}
                                </td>
                                <td class="px-10 py-8 text-center group-hover:scale-110 transition-transform duration-500">
                                    <div class="inline-flex flex-col items-center">
                                        <span class="text-xl font-black text-rose-600">Rp {{ number_format($a->total_nominal, 0, ',', '.') }}</span>
                                        <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-1">Rp {{ number_format($a->avg_uang_harian, 0, ',', '.') }}/Hari</span>
                                    </div>
                                </td>
                                <td class="px-10 py-8 text-center text-xl font-black text-slate-900">
                                    {{ $a->total_hari }} Hari
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- TRIP DETAIL MODAL -->
    @if($showTripModal)
    <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-md transition-opacity" wire:click="$set('showTripModal', false)"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-[3rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full animate-fade-in-up">
                <div class="bg-white px-8 pt-8 pb-8 sm:p-10 sm:pb-10">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight" id="modal-title">
                                {{ $modalTitle }}
                            </h3>
                            <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.2em] mt-1">Periode: {{ Carbon\Carbon::parse($startDate)->format('d M') }} - {{ Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
                        </div>
                        <button wire:click="$set('showTripModal', false)" class="text-slate-400 hover:text-slate-900 transition-colors">
                            <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>
                    
                    <div class="max-h-[60vh] overflow-y-auto pr-4 custom-scrollbar">
                        <div class="space-y-4">
                            @forelse($modalTrips as $trip)
                                <div class="relative group">
                                    <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-[3rem] blur opacity-0 group-hover:opacity-10 transition duration-500"></div>
                                    <div class="relative bg-white p-8 rounded-[3rem] border border-slate-100 shadow-xl shadow-slate-200/50 hover:shadow-2xl hover:shadow-blue-500/10 transition-all duration-500 overflow-hidden">
                                        
                                        <!-- Item Header -->
                                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                                            <div class="space-y-3 flex-1">
                                                <div class="flex items-center gap-3">
                                                    <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-emerald-100 shadow-sm">{{ $trip->jenis_dinas == 'luar' ? 'Luar Daerah' : 'Dalam Daerah' }}</span>
                                                    <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-blue-100 shadow-sm">{{ $trip->komisi->nama }}</span>
                                                    <span class="text-xs font-black text-slate-400 bg-white px-3 py-1.5 rounded-lg border border-slate-100 shadow-sm flex items-center gap-2">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                        {{ Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}
                                                    </span>
                                                </div>
                                                <h4 class="text-2xl font-black text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">{{ $trip->nama_kegiatan }}</h4>
                                                <div class="flex items-center gap-4 text-slate-500 font-bold text-xs">
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                        </div>
                                                        <span class="tracking-tight">{{ $trip->lokasi }}</span>
                                                    </div>
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        </div>
                                                        <span class="tracking-tight">{{ $trip->durasi_hari }} Hari Kerja</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Financial Summary Side -->
                                            <div class="flex flex-col items-end gap-1 shrink-0 p-6 bg-slate-50 rounded-[2rem] border border-slate-100 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                                                @if(isset($trip->nominal_personal))
                                                    <span class="text-[9px] font-black text-slate-400 group-hover:text-white/60 uppercase tracking-[0.2em] mb-1">Trip Personal Value</span>
                                                    <span class="text-3xl font-black tabular-nums">Rp {{ number_format($trip->nominal_personal, 0, ',', '.') }}</span>
                                                    <div class="mt-2 flex items-center gap-3">
                                                        <div class="flex items-center gap-1.5 p-1 px-3 bg-white/20 backdrop-blur-md rounded-lg group-hover:bg-white/10 outline outline-1 outline-blue-500/20">
                                                            <span class="text-[9px] font-black group-hover:text-white/80 uppercase tracking-widest text-blue-600">Total Akumulasi: Rp {{ number_format($trip->total_nominal, 0, ',', '.') }}</span>
                                                        </div>
                                                @else
                                                    <span class="text-[9px] font-black text-slate-400 group-hover:text-white/60 uppercase tracking-[0.2em] mb-1">Total Akumulasi Biaya</span>
                                                    <span class="text-3xl font-black tabular-nums">Rp {{ number_format($trip->total_nominal, 0, ',', '.') }}</span>
                                                    <div class="mt-2 flex items-center gap-3">
                                                @endif
                                                    <div class="flex items-center gap-1.5 p-1 px-3 bg-white/20 backdrop-blur-md rounded-lg group-hover:bg-white/10">
                                                        <span class="text-[9px] font-black group-hover:text-white/80 uppercase tracking-widest">{{ $trip->pesertaKegiatans->count() }} Anggota</span>
                                                    </div>
                                                    <div class="flex items-center gap-1.5 p-1 px-3 bg-white/20 backdrop-blur-md rounded-lg group-hover:bg-white/10">
                                                        <span class="text-[9px] font-black group-hover:text-white/80 uppercase tracking-widest">{{ $trip->pendampingKegiatans->count() }} Staf</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Participants Dashboard -->
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-100">
                                            <!-- Anggota Column -->
                                            <div class="space-y-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Delegasi Anggota Dewan</h5>
                                                </div>
                                                <div class="grid grid-cols-1 gap-3">
                                                    @foreach($trip->pesertaKegiatans as $pk)
                                                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50/50 hover:bg-white hover:shadow-lg transition-all border border-transparent hover:border-slate-100">
                                                        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-900 font-black text-xs shadow-sm border border-slate-100">
                                                            {{ substr($pk->anggota->nama, 0, 1) }}
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-xs font-black text-slate-800 truncate">{{ $pk->anggota->nama }}</p>
                                                            <p class="text-[8px] font-bold text-blue-500 uppercase tracking-widest mt-0.5 truncate">{{ $pk->anggota->jabatan }}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[10px] font-black text-slate-900 font-mono">Rp {{ number_format($pk->nominal, 0, ',', '.') }}</p>
                                                            <p class="text-[7.5px] font-bold text-slate-400 uppercase tracking-tight">{{ number_format($pk->uang_harian, 0, ',', '.') }}/Hr</p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Staff Column -->
                                            <div class="space-y-4">
                                                <div class="flex items-center justify-between mb-2">
                                                    <h5 class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tim Pendamping & Staf</h5>
                                                </div>
                                                <div class="grid grid-cols-1 gap-3">
                                                    @foreach($trip->pendampingKegiatans as $pdk)
                                                        @php 
                                                            $pName = $pdk->pegawai->nama ?? ($pdk->pendamping->pegawai->nama ?? 'Unknown');
                                                            $pJabatan = $pdk->pegawai->jabatan ?? ($pdk->pendamping->pegawai->jabatan ?? 'Tenaga Ahli');
                                                        @endphp
                                                    <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50/20 hover:bg-white hover:shadow-lg transition-all border border-transparent hover:border-emerald-100">
                                                        <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-600 font-black text-xs shadow-sm border border-emerald-100">
                                                            {{ substr($pName, 0, 1) }}
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-xs font-black text-slate-800 truncate">
                                                                {{ $pName }}
                                                            </p>
                                                            <p class="text-[8px] font-bold text-emerald-600 uppercase tracking-widest mt-0.5 truncate">
                                                                {{ $pJabatan }}
                                                            </p>
                                                        </div>
                                                        <div class="text-right">
                                                            <p class="text-[10px] font-black text-slate-900 font-mono">Rp {{ number_format($pdk->nominal, 0, ',', '.') }}</p>
                                                            <p class="text-[7.5px] font-bold text-slate-400 uppercase tracking-tight">{{ number_format($pdk->uang_harian, 0, ',', '.') }}/Hr</p>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Footer Badge -->
                                        <div class="mt-6 flex items-center gap-4">
                                            <div class="flex-1 h-px bg-slate-100"></div>
                                            <div class="px-5 py-2 rounded-full bg-slate-50 border border-slate-100 flex items-center gap-4 shadow-sm group-hover:bg-white transition-colors">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Total Ops:</span>
                                                    <span class="text-[10px] font-black text-slate-900 font-mono">Rp {{ number_format($trip->biaya_bbm + $trip->biaya_penginapan + $trip->biaya_transportasi, 0, ',', '.') }}</span>
                                                </div>
                                                <div class="w-1 h-1 rounded-full bg-slate-200"></div>
                                                <div class="flex items-center gap-2">
                                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Durasi:</span>
                                                    <span class="text-[10px] font-black text-slate-900 font-mono">{{ $trip->durasi_hari }} Hari</span>
                                                </div>
                                            </div>
                                            <div class="flex-1 h-px bg-slate-100"></div>
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-20 bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200">
                                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Tidak ada record perjalanan</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- SCRIPTS FOR CHARTS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            let top5ActivityChart, top5BudgetChart, trendBudgetChart, hariChart;

            function initCharts(updatedStats = null) {
                const stats = updatedStats ? updatedStats : @json($stats);
                
                // 1. Top 5 Activity (Horizontal Bar)
                const top5ActivityOptions = {
                    series: [{
                        name: 'Total Kegiatan',
                        data: stats.top5_activity.map(a => a.total_kegiatan)
                    }],
                    chart: { type: 'bar', height: 350, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                    plotOptions: { 
                        bar: { 
                            borderRadius: 6, 
                            horizontal: true, 
                            barHeight: '50%',
                            distributed: true 
                        } 
                    },
                    colors: ['#3b82f6', '#8b5cf6', '#10b981', '#f59e0b', '#ef4444'],
                    xaxis: { categories: stats.top5_activity.map(a => a.nama) },
                    legend: { show: false },
                    grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
                    dataLabels: { enabled: true, style: { fontSize: '10px', fontWeight: 900 } }
                };

                // 2. Top 5 Budget (Horizontal Bar)
                const top5BudgetOptions = {
                    series: [{
                        name: 'Total Anggaran',
                        data: stats.top5_budget.map(a => a.total_nominal)
                    }],
                    chart: { type: 'bar', height: 350, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                    plotOptions: { 
                        bar: { 
                            borderRadius: 6, 
                            horizontal: true, 
                            barHeight: '50%',
                            distributed: true 
                        } 
                    },
                    colors: ['#ef4444', '#f59e0b', '#10b981', '#8b5cf6', '#3b82f6'],
                    xaxis: { 
                        categories: stats.top5_budget.map(a => a.nama),
                        labels: {
                            formatter: function (val) {
                                return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                            }
                        }
                    },
                    legend: { show: false },
                    grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
                    dataLabels: { 
                        enabled: true, 
                        formatter: function (val) {
                            return "Rp " + new Intl.NumberFormat('id-ID', { notation: "compact", compactDisplay: "short" }).format(val);
                        },
                        style: { fontSize: '10px', fontWeight: 900 } 
                    }
                };

                // 3. Trend Budget (Area)
                const trendBudgetOptions = {
                    series: [{
                        name: 'Akumulasi Anggaran',
                        data: stats.trend_budget.map(t => t.total)
                    }],
                    chart: { type: 'area', height: 350, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
                    stroke: { curve: 'smooth', width: 3 },
                    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.2, stops: [0, 90, 100] } },
                    colors: ['#8b5cf6'],
                    xaxis: { categories: stats.trend_budget.map(t => t.month) },
                    yaxis: {
                        labels: {
                            formatter: function (val) {
                                return "Rp " + new Intl.NumberFormat('id-ID', { notation: "compact" }).format(val);
                            }
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return "Rp " + new Intl.NumberFormat('id-ID').format(val);
                            }
                        }
                    },
                    grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
                    dataLabels: { enabled: false }
                };

                // 4. Hari Chart (Donut - Distribution by Commission)
                // We use komisi_stats total_hari for distribution
                const hariOptions = {
                    series: stats.komisi_stats.map(k => k.total_hari),
                    chart: { type: 'donut', height: 350, fontFamily: 'Inter, sans-serif' },
                    labels: stats.komisi_stats.map(k => k.nama),
                    colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'],
                    plotOptions: { 
                        pie: { 
                            donut: { 
                                size: '75%', 
                                labels: { 
                                    show: true, 
                                    name: { show: true, fontWeight: 900 }, 
                                    value: { 
                                        show: true, 
                                        fontWeight: 900,
                                        formatter: function (val) { return val + " Hari" }
                                    },
                                    total: {
                                        show: true,
                                        label: 'Total Hari',
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0) + " Hari"
                                        }
                                    }
                                } 
                            } 
                        } 
                    },
                    legend: { position: 'bottom', fontWeight: 700 }
                };

                if (top5ActivityChart) top5ActivityChart.destroy();
                if (top5BudgetChart) top5BudgetChart.destroy();
                if (trendBudgetChart) trendBudgetChart.destroy();
                if (hariChart) hariChart.destroy();

                top5ActivityChart = new ApexCharts(document.querySelector("#top5ActivityChart"), top5ActivityOptions);
                top5BudgetChart = new ApexCharts(document.querySelector("#top5BudgetChart"), top5BudgetOptions);
                trendBudgetChart = new ApexCharts(document.querySelector("#trendBudgetChart"), trendBudgetOptions);
                hariChart = new ApexCharts(document.querySelector("#hariChart"), hariOptions);

                top5ActivityChart.render();
                top5BudgetChart.render();
                trendBudgetChart.render();
                hariChart.render();
            }

            initCharts();

            Livewire.on('refreshCharts', (data) => {
                initCharts(data.stats);
            });
            
            // Re-render when data updates
            window.addEventListener('livewire:load', () => {
                initCharts();
            });
        });
    </script>


    <style>
        [x-cloak] { display: none !important; }
        
        .custom-scrollbar::-webkit-scrollbar { width: 8px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: rgba(241, 245, 249, 0.5); }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 20px; border: 2px solid transparent; background-clip: content-box; shadow: inset 0 0 10px rgba(0,0,0,0.05); }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; border: 2px solid transparent; background-clip: content-box; }
        
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fade-in-up { animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        
        @media print {
            .bg-slate-50 { background-color: white !important; }
            button, .no-print, .animate-ping { display: none !important; }
            .py-12 { padding-top: 0 !important; }
            .shadow-xl, .shadow-2xl, .shadow-sm, .shadow-lg { shadow: none !important; border: 1px solid #eee !important; }
            canvas, .apexcharts-canvas { max-width: 100% !important; }
            .rounded-\[3\.5rem\], .rounded-\[3rem\] { border-radius: 1rem !important; }
            .backdrop-blur-xl, .backdrop-blur-md { backdrop-filter: none !important; background: white !important; }
        }
    </style>
</div>
