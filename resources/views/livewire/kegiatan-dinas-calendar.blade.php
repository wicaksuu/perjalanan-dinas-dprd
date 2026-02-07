<div class="min-h-screen bg-slate-50">
    <!-- Component Header (Inside Livewire Root for Reactivity) -->
    <div class="bg-white border-b border-slate-200 shadow-sm animate-fade-in-down">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="space-y-1 text-center md:text-left">
                    <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                        <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 text-[10px] font-black uppercase tracking-wider border border-indigo-100">Visualisasi Jadwal</span>
                    </div>
                    <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                        Kalender <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Kegiatan Dinas</span>
                    </h2>
                    <p class="text-slate-500 text-sm font-medium">Monitoring persebaran kegiatan dan penggunaan anggaran secara visual</p>
                </div>
                
                <!-- View Toggles -->
                <div class="flex items-center bg-slate-100 p-1.5 rounded-2xl border border-slate-200 shadow-inner">
                    <button wire:click="setViewMode('year')" class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all {{ $viewMode === 'year' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">Tahunan</button>
                    <button wire:click="setViewMode('month')" class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all {{ $viewMode === 'month' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">Bulanan</button>
                    <button wire:click="setViewMode('week')" class="px-5 py-2.5 rounded-xl text-[10px] font-black uppercase tracking-wider transition-all {{ $viewMode === 'week' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-400 hover:text-slate-600' }}">Mingguan</button>
                </div>

                <!-- Calendar Controls -->
                <div class="flex items-center bg-white/50 backdrop-blur-xl p-2 rounded-[2rem] border border-white shadow-xl shadow-slate-200/50 group">
                    <button wire:click="prev" wire:loading.attr="disabled" class="p-3 hover:bg-slate-900 hover:text-white rounded-2xl transition-all duration-300 disabled:opacity-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
                    </button>
                    <div class="px-8 flex flex-col items-center min-w-[200px]">
                        <span class="text-xs font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Periode</span>
                        <span class="text-lg font-black text-slate-900 capitalize">{{ $currentMonthName }}</span>
                    </div>
                    <button wire:click="next" wire:loading.attr="disabled" class="p-3 hover:bg-slate-900 hover:text-white rounded-2xl transition-all duration-300 disabled:opacity-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </div>

                <div class="flex items-center gap-4">
                    <button wire:click="goToToday" class="px-6 py-3 bg-white hover:bg-slate-50 text-slate-900 rounded-2xl font-black text-xs border border-slate-200 shadow-sm transition-all duration-300 active:scale-95">
                        Hari Ini
                    </button>
                    <a href="{{ route('kegiatan-dinas.create') }}" class="group relative flex items-center gap-3 bg-slate-900 overflow-hidden text-white px-8 py-3.5 rounded-2xl font-black shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="relative flex items-center gap-3">
                            <svg class="w-5 h-5 transition-transform duration-500 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                            <span class="tracking-tight uppercase text-xs">Agenda Baru</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto">
            
            <!-- Color Legend -->
            <div class="flex flex-wrap items-center justify-center gap-x-6 gap-y-3 mb-8 bg-white/50 backdrop-blur-md p-6 rounded-[2rem] border border-white shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-rose-600 shadow-sm shadow-rose-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Ketua DPRD</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-cyan-600 shadow-sm shadow-cyan-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Wakil Ketua I</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-fuchsia-600 shadow-sm shadow-fuchsia-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Wakil Ketua II</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-teal-600 shadow-sm shadow-teal-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Wakil Ketua III</span>
                </div>
                <div class="w-px h-4 bg-slate-200 mx-2 hidden lg:block"></div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-emerald-500 shadow-sm shadow-emerald-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Komisi I</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-blue-500 shadow-sm shadow-blue-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Komisi II</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-amber-500 shadow-sm shadow-amber-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Komisi III</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3.5 h-3.5 rounded-full bg-purple-500 shadow-sm shadow-purple-200"></div>
                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider">Komisi IV</span>
                </div>
            </div>

            <!-- Calendar Grid Container -->
            <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] p-4 shadow-2xl shadow-slate-200/50 border border-white/80 overflow-hidden">
                
                @if($viewMode === 'year')
                <!-- Yearly Grid -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 p-4">
                    @foreach($yearStats as $m => $stat)
                    <div 
                        wire:click="selectMonth({{ $m }})"
                        class="group cursor-pointer bg-slate-50/50 rounded-[2rem] p-8 border border-slate-100 hover:bg-white hover:shadow-xl hover:shadow-indigo-500/10 transition-all duration-500 hover:-translate-y-2 animate-fade-in-up"
                        style="animation-delay: {{ $loop->index * 50 }}ms"
                    >
                        <div class="flex justify-between items-start mb-6">
                            <h5 class="text-lg font-black text-slate-900 capitalize">{{ $stat['name'] }}</h5>
                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Kegiatan</p>
                                <p class="text-xl font-black text-slate-900">{{ $stat['count'] }}</p>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Anggaran</p>
                                <p class="text-sm font-black text-rose-500 tabular-nums">Rp {{ number_format($stat['budget'], 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <!-- Day Names Header -->
                <div class="grid grid-cols-7 gap-4 mb-4">
                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                    <div class="text-center py-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">{{ $day }}</span>
                    </div>
                    @endforeach
                </div>

                <!-- Calendar Grid -->
                <div class="space-y-2 bg-slate-100 border border-slate-100 rounded-[2.5rem] overflow-hidden p-2">
                    @foreach($weeks as $week)
                    <div class="grid grid-cols-7 gap-1 relative min-h-[140px]">
                        <!-- Background Layer: 7 Columns for Days -->
                        @foreach($week['cells'] as $cell)
                        <div class="bg-white p-4 transition-all duration-300 {{ !$cell['currentMonth'] ? 'bg-slate-50/50 opacity-40' : '' }} {{ $cell['date'] == now()->toDateString() ? 'ring-2 ring-inset ring-indigo-500/10' : '' }} rounded-2xl">
                            <div class="flex justify-between items-start">
                                <span class="text-xs font-black {{ $cell['date'] == now()->toDateString() ? 'text-indigo-600' : 'text-slate-900' }}">
                                    {{ $cell['day'] }}
                                </span>
                            </div>
                        </div>
                        @endforeach

                        <!-- Events Layer: Spanning Bars -->
                        <div class="absolute inset-0 grid grid-cols-7 gap-1 pointer-events-none pt-12 pb-2">
                            @foreach($week['events'] as $event)
                            <div 
                                wire:click="showDetail({{ $event['id'] }})"
                                class="pointer-events-auto h-7 mt-1 rounded-lg flex items-center px-3 gap-2 cursor-pointer transition-all duration-300 hover:scale-[1.01] hover:z-20 shadow-sm {{ $event['textColorClass'] }}
                                    {{ $event['colorClass'] }}
                                    {{ $event['isContinuation'] ? 'rounded-l-none border-l border-white/20' : '' }}
                                    {{ $event['hasMore'] ? 'rounded-r-none border-r border-white/20' : '' }}"
                                style="grid-column: {{ $event['startCol'] }} / span {{ $event['span'] }};"
                            >
                                @if($event['isContinuation'])
                                    <svg class="w-2.5 h-2.5 opacity-40 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                                @endif
                                <div class="flex-1 flex items-center justify-between min-w-0 gap-2">
                                    <span class="text-[8px] font-black uppercase truncate tracking-tight select-text cursor-text">
                                        <span class="opacity-60">[{{ $event['komisi_nama'] }}]</span> {{ $event['nama_kegiatan'] }}
                                    </span>
                                    <span class="text-[7px] font-black bg-black/10 px-1.5 py-0.5 rounded tabular-nums shrink-0 uppercase select-text cursor-text">Rp {{ number_format($event['total_nominal'], 0, ',', '.') }}</span>
                                </div>
                                @if($event['hasMore'])
                                    <svg class="w-2.5 h-2.5 text-white/40" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Detailed Stats Summary below calendar -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-8 animate-fade-in-up" style="animation-delay: 300ms;">
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-[2rem] border border-white shadow-xl shadow-slate-200/50 flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Kegiatan</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ collect($activitiesByDate)->flatten()->unique('id')->count() }}</h4>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-[2rem] border border-white shadow-xl shadow-slate-200/50 flex items-center gap-5 col-span-2">
                    <div class="w-12 h-12 rounded-2xl bg-rose-500/10 flex items-center justify-center text-rose-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1m-5-1a6.73 6.73 0 012.176-4.991C7.477 12.114 8.065 12 8.713 12m11.286 0c-.3 0-.588.033-.867.098m0 0a3.374 3.374 0 01-1.25.548m0 0a3.374 3.374 0 001.25-.548"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Anggaran Periode Ini</p>
                        <h4 class="text-2xl font-black text-slate-900 tabular-nums">Rp {{ number_format(collect($activitiesByDate)->flatten()->unique('id')->sum(fn($a) => $a->total_nominal), 0, ',', '.') }}</h4>
                    </div>
                </div>
                <div class="bg-white/80 backdrop-blur-xl p-6 rounded-[2rem] border border-white shadow-xl shadow-slate-200/50 flex items-center gap-5">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Personel</p>
                        <h4 class="text-2xl font-black text-slate-900">{{ collect($activitiesByDate)->flatten()->unique('id')->sum(fn($a) => $a->anggotas->count() + $a->pendampingKegiatans->count()) }}</h4>
                    </div>
                </div>
            </div>
        </div>

    <!-- Detail Modal (Synced with Index) -->
    <x-dialog-modal wire:model.live="showingDetail" maxWidth="5xl">
        <x-slot name="title">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-indigo-500/10 flex items-center justify-center text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-slate-900 leading-none">Detail Kegiatan</h3>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Activity Intelligence Dashboard</p>
                    </div>
                </div>
                <button wire:click="$set('showingDetail', false)" class="p-2 hover:bg-slate-100 rounded-xl transition-colors text-slate-400 hover:text-rose-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </x-slot>

        <x-slot name="content">
            @if($selectedKegiatan)
            <div class="space-y-8 pb-4">
                <!-- 1. PREMIUM HERO BANNER -->
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-[2.5rem] blur opacity-10 group-hover:opacity-20 transition duration-1000"></div>
                    <div class="relative bg-slate-900 rounded-[2.5rem] overflow-hidden shadow-2xl">
                        <!-- Abstract Background -->
                        <div class="absolute inset-0">
                            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-indigo-500/20 to-transparent"></div>
                            <div class="absolute -top-24 -left-20 w-80 h-80 bg-purple-500/20 rounded-full blur-[100px] animate-pulse"></div>
                            <div class="absolute -bottom-24 right-20 w-80 h-80 bg-indigo-500/20 rounded-full blur-[100px] animate-pulse" style="animation-delay: 1s;"></div>
                        </div>

                        <div class="relative px-8 py-10 md:px-12 md:py-14 flex flex-col md:flex-row items-center gap-10">
                            <div class="flex-1 space-y-6 text-center md:text-left">
                                <div class="flex flex-wrap justify-center md:justify-start items-center gap-3">
                                    <span class="px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-[10px] font-black uppercase tracking-[0.2em] text-indigo-300 shadow-xl">
                                        {{ $selectedKegiatan->jenis_dinas == 'dalam' ? 'Dinas Dalam' : 'Dinas Luar' }}
                                    </span>
                                    <div class="h-1.5 w-1.5 rounded-full bg-white/20"></div>
                                    <span class="px-4 py-1.5 rounded-full bg-indigo-500/20 backdrop-blur-md border border-indigo-500/30 text-[10px] font-black uppercase tracking-[0.2em] text-blue-300 flex items-center gap-2">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-1 4h1m-1 4h1"></path></svg>
                                        {{ $selectedKegiatan->komisi->nama }}
                                    </span>
                                </div>
                                
                                <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-[1.1] text-white">
                                    {{ $selectedKegiatan->nama_kegiatan }}
                                </h2>

                                <div class="flex flex-wrap justify-center md:justify-start items-center gap-6 text-slate-400 font-bold text-sm lg:text-base">
                                    <div class="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-2xl border border-white/10">
                                        <div class="w-8 h-8 rounded-xl bg-indigo-500/20 flex items-center justify-center text-indigo-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        {{ $selectedKegiatan->lokasi }}
                                    </div>
                                    <div class="flex items-center gap-3 bg-white/5 px-4 py-2 rounded-2xl border border-white/10">
                                        <div class="w-8 h-8 rounded-xl bg-rose-500/20 flex items-center justify-center text-rose-400">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                        {{ $selectedKegiatan->tanggal_mulai->format('d M') }} - {{ $selectedKegiatan->tanggal_selesai->format('d M Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="relative shrink-0 flex items-center justify-center w-40 h-40">
                                <div class="absolute inset-0 rounded-full border-4 border-white/5 rotate-12 scale-110"></div>
                                <div class="absolute inset-0 rounded-full border-4 border-indigo-500/30 -rotate-12"></div>
                                <div class="relative z-10 w-32 h-32 rounded-full bg-white/10 backdrop-blur-2xl border border-white/20 flex flex-col items-center justify-center shadow-3xl text-white group-hover:scale-110 transition-transform duration-500">
                                    <span class="text-5xl font-black">{{ $selectedKegiatan->durasi_hari }}</span>
                                    <span class="text-[9px] font-black uppercase tracking-[0.3em] opacity-60">HARI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2. SUMMARY DASHBOARD -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-rose-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Akumulasi Biaya</p>
                                <div class="p-2 bg-rose-50 rounded-xl text-rose-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1m-5-1a6.73 6.73 0 012.176-4.991C7.477 12.114 8.065 12 8.713 12m11.286 0c-.3 0-.588.033-.867.098m0 0a3.374 3.374 0 01-1.25.548m0 0a3.374 3.374 0 001.25-.548"></path></svg>
                                </div>
                            </div>
                            <h4 class="text-2xl font-black text-slate-900 tabular-nums">Rp {{ number_format($selectedKegiatan->total_nominal, 0, ',', '.') }}</h4>
                        </div>
                    </div>

                    <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Delegasi Anggota</p>
                                <div class="p-2 bg-indigo-50 rounded-xl text-indigo-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354l1.107 3.18h3.338l-2.7 1.96 1.03 3.17-2.767-2.01-2.767 2.01 1.03-3.17-2.7-1.96h3.338L12 4.354zm0 0V4"></path></svg>
                                </div>
                            </div>
                            <h4 class="text-2xl font-black text-slate-900">{{ $selectedKegiatan->anggotas->count() }} <span class="text-sm font-medium text-slate-400">Anggota</span></h4>
                        </div>
                    </div>

                    <div class="relative overflow-hidden bg-white p-6 rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 group hover:-translate-y-1 transition-all duration-300">
                        <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                        <div class="relative z-10 space-y-3">
                            <div class="flex items-center justify-between">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Tim Pendamping</p>
                                <div class="p-2 bg-emerald-50 rounded-xl text-emerald-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                            </div>
                            <h4 class="text-2xl font-black text-slate-900">{{ $selectedKegiatan->pendampingKegiatans->count() }} <span class="text-sm font-medium text-slate-400">Pegawai</span></h4>
                        </div>
                    </div>
                </div>

                <!-- 3. DETAILED BREAKDOWN DASHBOARD -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    <div class="lg:col-span-7 space-y-8">
                        <div class="bg-indigo-50/30 p-8 rounded-[2.5rem] border border-indigo-100 shadow-sm">
                            <h4 class="text-[11px] font-black text-indigo-800 uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></div>
                                Logistik & Timeline
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <div class="relative pl-8 py-1 border-l-2 border-slate-200">
                                        <div class="absolute -left-[9px] top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-white border-4 border-indigo-600 shadow-lg shadow-indigo-200"></div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Berangkat</p>
                                        <p class="text-lg font-black text-slate-900">{{ $selectedKegiatan->tanggal_mulai->format('d F Y') }}</p>
                                    </div>
                                    <div class="relative pl-8 py-1 border-l-2 border-slate-200">
                                        <div class="absolute -left-[9px] top-1/2 -translate-y-1/2 w-4 h-4 rounded-full bg-white border-4 border-slate-300"></div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kembali</p>
                                        <p class="text-lg font-black text-slate-900">{{ $selectedKegiatan->tanggal_selesai->format('d F Y') }}</p>
                                    </div>
                                </div>
                                <div class="bg-white/50 backdrop-blur-sm p-6 rounded-3xl border border-white shadow-inner flex flex-col justify-center">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Rencana Lokasi</p>
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center shadow-lg shadow-indigo-200">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <span class="text-xl font-black text-slate-900 leading-tight">{{ $selectedKegiatan->lokasi }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-rose-500"></div>
                                Rincian Biaya Operasional
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">BBM & Transport</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_bbm, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Penginapan</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_penginapan, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Lain-lain</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_transportasi, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-5 h-full flex flex-col">
                        <div class="bg-white p-2 rounded-[3rem] border border-slate-100 shadow-2xl h-full flex flex-col min-h-[500px]">
                            <div class="p-8 pb-4">
                                <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-3">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                    Peserta & Pendamping
                                </h4>
                            </div>

                            <div class="flex-1 overflow-y-auto px-6 pb-8 space-y-8 custom-scrollbar">
                                <div class="space-y-4">
                                    <div class="space-y-3">
                                        @foreach($selectedKegiatan->anggotas as $anggota)
                                        <div class="group bg-slate-50/50 hover:bg-white p-4 rounded-3xl border border-transparent hover:border-slate-100 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-xl bg-white border border-slate-100 flex items-center justify-center text-slate-900 font-black group-hover:bg-indigo-600 group-hover:text-white transition-all">
                                                    {{ substr($anggota->nama, 0, 1) }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-black text-slate-800 truncate leading-tight">{{ $anggota->nama }}</p>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest truncate">{{ $anggota->jabatan }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs font-black text-indigo-600 font-mono">Rp {{ number_format($anggota->pivot->nominal, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                        @foreach($selectedKegiatan->pendampingKegiatans as $pk)
                                        <div class="group bg-emerald-50/20 hover:bg-white p-4 rounded-3xl border border-transparent hover:border-emerald-100 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="w-10 h-10 rounded-xl bg-white border border-emerald-50 flex items-center justify-center text-emerald-600 font-black group-hover:bg-emerald-600 group-hover:text-white transition-all">
                                                    @if($pk->jenis == 'pendamping_wajib')
                                                        {{ substr($pk->pendamping->pegawai ? $pk->pendamping->pegawai->nama : ($pk->pendamping->nama ?? 'P'), 0, 1) }}
                                                    @else
                                                        {{ substr($pk->pegawai->nama ?? 'S', 0, 1) }}
                                                    @endif
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-black text-slate-800 truncate leading-tight">
                                                        @if($pk->jenis == 'pendamping_wajib')
                                                            {{ $pk->pendamping->pegawai ? $pk->pendamping->pegawai->nama : ($pk->pendamping->nama ?? '-') }}
                                                        @else
                                                            {{ $pk->pegawai->nama ?? '-' }}
                                                        @endif
                                                    </p>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest truncate">Pendamping</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs font-black text-emerald-600 font-mono">Rp {{ number_format($pk->nominal, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <div class="flex items-center justify-end w-full">
                <x-secondary-button wire:click="$set('showingDetail', false)" class="!rounded-2xl !px-10 !py-4 !text-[10px] !font-black !uppercase !tracking-widest !bg-slate-900 !text-white !border-none !hover:bg-slate-800 !transition-all">
                    Tutup Detail
                </x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>

    </div>
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
</div>
