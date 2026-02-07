<div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 text-[10px] font-black uppercase tracking-wider border border-indigo-100">Manajemen Data</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Kegiatan Dinas</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Pengelolaan seluruh data perjalanan dinas DPRD Kabupaten Madiun</p>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-4">
                <a href="{{ route('kegiatan-dinas.laporan') }}" class="group flex items-center gap-3 bg-white hover:bg-slate-50 text-slate-900 px-6 py-3 rounded-2xl font-black text-xs shadow-sm border border-slate-200 transition-all duration-300">
                    <div class="p-1.5 bg-indigo-50 rounded-lg text-indigo-600 group-hover:scale-110 transition-transform">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    Analisa Laporan
                </a>
                <a href="{{ route('kegiatan-dinas.create') }}" class="group relative flex items-center gap-3 bg-slate-900 overflow-hidden text-white px-8 py-3.5 rounded-2xl font-black shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="relative flex items-center gap-3">
                        <svg class="w-5 h-5 transition-transform duration-500 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                        <span class="tracking-tight uppercase text-xs">Tambah Kegiatan</span>
                    </div>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto space-y-10">
            
            <!-- Filter Section -->
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/50 border border-white/80 animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Komisi</label>
                        <div class="relative group">
                            <select wire:model.live="komisi_id" class="w-full pl-5 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm font-bold focus:ring-2 focus:ring-indigo-500/20 transition-all appearance-none cursor-pointer">
                                <option value="">Seluruh Komisi</option>
                                @foreach($komisis as $komisi)
                                <option value="{{ $komisi->id }}">{{ $komisi->nama }}</option>
                                @endforeach
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-indigo-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Jenis</label>
                        <div class="relative group">
                            <select wire:model.live="jenis_dinas" class="w-full pl-5 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm font-bold focus:ring-2 focus:ring-emerald-500/20 transition-all appearance-none cursor-pointer">
                                <option value="">Semua Jenis</option>
                                <option value="dalam">Dinas Dalam</option>
                                <option value="luar">Dinas Luar</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-emerald-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Status Kegiatan</label>
                        <div class="relative group">
                            <select wire:model.live="status" class="w-full pl-5 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm font-bold focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none cursor-pointer">
                                <option value="">Semua Status</option>
                                <option value="upcoming">Akan Datang</option>
                                <option value="ongoing">Sedang Berjalan</option>
                                <option value="ended">Sudah Selesai</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 group-hover:text-blue-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Pencarian Cepat</label>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-violet-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari kegiatan..." class="w-full pl-14 pr-5 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm font-bold placeholder:text-slate-400 placeholder:font-medium focus:ring-2 focus:ring-violet-500/20 transition-all">
                        </div>
                    </div>

                    <div class="md:col-span-2 flex items-end">
                        <button wire:click="$set('komisi_id', ''); $set('jenis_dinas', ''); $set('search', ''); $set('status', '');" class="group w-full py-4 bg-slate-900 hover:bg-slate-800 text-white rounded-2xl text-xs font-black uppercase tracking-widest transition-all shadow-xl hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- List Section -->
            <div class="space-y-6">
                @if(session('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest animate-fade-in-up">
                    {{ session('success') }}
                </div>
                @endif

                <div class="grid grid-cols-1 gap-6">
                    @forelse($kegiatanDinas as $kegiatan)
                    <div wire:key="item-kegiatan-{{ $kegiatan->id }}" class="group bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white hover:border-slate-100 shadow-2xl shadow-slate-200/30 hover:shadow-indigo-500/5 transition-all duration-500 p-2 animate-fade-in-up" style="animation-delay: {{ 200 + ($loop->index * 50) }}ms;">
                        <div class="flex flex-col md:flex-row gap-6 p-6">
                            <!-- Icon & Type -->
                            <div class="flex-shrink-0 flex md:flex-col items-center justify-center gap-4">
                                <div class="w-20 h-20 rounded-3xl {{ $kegiatan->jenis_dinas == 'dalam' ? 'bg-emerald-500/10 text-emerald-600 shadow-emerald-100' : 'bg-violet-500/10 text-violet-600 shadow-violet-100' }} border border-white shadow-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-500">
                                    @if($kegiatan->jenis_dinas == 'dalam')
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                    @else
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    @endif
                                </div>
                                <span class="md:hidden text-[10px] font-black uppercase tracking-widest {{ $kegiatan->jenis_dinas == 'dalam' ? 'text-emerald-500' : 'text-violet-500' }}">
                                    {{ $kegiatan->jenis_dinas == 'dalam' ? 'Dinas Dalam' : 'Dinas Luar' }}
                                </span>
                            </div>

                            <!-- Content -->
                            <div class="flex-1 space-y-4">
                                <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                                    <div class="space-y-1 cursor-pointer" wire:click="showDetail({{ $kegiatan->id }})">
                                        <h3 class="text-xl font-black text-slate-900 group-hover:text-indigo-600 transition-colors leading-tight">
                                            {{ $kegiatan->nama_kegiatan }}
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-4 text-[11px] font-bold text-slate-400 uppercase tracking-tight">
                                            <span class="flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 rounded-lg group-hover:bg-indigo-50 group-hover:text-indigo-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-1 4h1m-1 4h1"></path></svg>
                                                {{ $kegiatan->komisi->nama }}
                                            </span>
                                            <span class="flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 rounded-lg group-hover:bg-emerald-50 group-hover:text-emerald-500 transition-colors">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                                {{ $kegiatan->lokasi }}
                                            </span>
                                            <span class="flex items-center gap-1.5 px-2.5 py-1 bg-rose-50 rounded-lg text-rose-600 font-black">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1m-5-1a6.73 6.73 0 012.176-4.991C7.477 12.114 8.065 12 8.713 12m11.286 0c-.3 0-.588.033-.867.098m0 0a3.374 3.374 0 01-1.25.548m0 0a3.374 3.374 0 001.25-.548"></path></svg>
                                                Rp {{ number_format($kegiatan->total_nominal, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button wire:click="showDetail({{ $kegiatan->id }})" class="p-3 bg-indigo-50 text-indigo-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                        
                                        @if(!$kegiatan->is_ended)
                                            <a href="{{ route('kegiatan-dinas.edit', $kegiatan) }}" class="p-3 bg-amber-50 text-amber-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <button wire:click="confirmDelete({{ $kegiatan->id }})" class="p-3 bg-rose-50 text-rose-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all duration-300">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        @else
                                            <div class="p-3 bg-slate-100 text-slate-400 rounded-xl cursor-not-allowed group/lock relative" title="Kegiatan telah berakhir">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-slate-50">
                                    <div class="space-y-2">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Periode Pelaksanaan</p>
                                        <div class="flex items-center gap-3">
                                            <span class="text-sm font-extrabold text-slate-800">{{ $kegiatan->tanggal_mulai->format('d M Y') }}</span>
                                            <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                            <span class="text-sm font-extrabold text-slate-800">{{ $kegiatan->tanggal_selesai->format('d M Y') }}</span>
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Peserta Delegasi</p>
                                        <div class="flex -space-x-2.5">
                                            @foreach($kegiatan->anggotas->take(5) as $anggota)
                                                <div class="w-9 h-9 rounded-2xl bg-slate-50 border-2 border-white flex items-center justify-center text-[11px] font-black text-slate-600 shadow-sm transition-transform hover:scale-110 hover:z-10 cursor-help" title="{{ $anggota->nama }}">
                                                    {{ substr($anggota->nama, 0, 1) }}
                                                </div>
                                            @endforeach
                                            @if($kegiatan->anggotas->count() > 5)
                                                <div class="w-9 h-9 rounded-2xl bg-slate-900 border-2 border-white flex items-center justify-center text-[9px] font-black text-white shadow-sm">
                                                    +{{ $kegiatan->anggotas->count() - 5 }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div wire:key="progress-{{ $kegiatan->id }}" class="space-y-2 flex flex-col md:items-end w-full md:w-auto"
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
                                                    if (distance < 0) {
                                                        this.timeString = 'Segera dimulai';
                                                        return;
                                                    }
                                                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    this.timeString = `${days}h ${hours}j ${minutes}m ${seconds}d`;
                                                } else if (this.status === 'ongoing') {
                                                    let total = this.end - this.start;
                                                    let elapsed = this.now - this.start;
                                                    this.progress = Math.min(100, Math.max(0, (elapsed / total) * 100));
                                                    
                                                    let distance = this.end - this.now;
                                                    if (distance < 0) {
                                                        this.timeString = 'Segera berakhir';
                                                        return;
                                                    }
                                                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    this.timeString = `${days}h ${hours}j ${minutes}m ${seconds}d`;
                                                }
                                            }
                                         }">
                                        
                                        <!-- Upcoming Status -->
                                        <template x-if="status === 'upcoming'">
                                            <div class="flex flex-col items-end gap-1">
                                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Akan Datang</p>
                                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-blue-500/10 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">
                                                    <svg class="w-3.5 h-3.5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    <span x-text="timeString"></span>
                                                </span>
                                            </div>
                                        </template>

                                        <!-- Ongoing Status -->
                                        <template x-if="status === 'ongoing'">
                                            <div class="flex flex-col items-end gap-2 w-full md:w-48">
                                                <div class="flex items-center justify-between w-full">
                                                    <p class="text-[9px] font-black text-emerald-500 uppercase tracking-widest animate-pulse">Sedang Berjalan</p>
                                                    <span class="text-[9px] font-black text-slate-500" x-text="timeString"></span>
                                                </div>
                                                <div class="w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                                    <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-600 transition-all duration-1000 ease-linear" :style="`width: ${progress}%`"></div>
                                                </div>
                                            </div>
                                        </template>

                                        <!-- Ended Status -->
                                        <template x-if="status === 'ended'">
                                            <div class="flex flex-col items-end gap-1">
                                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Status Data</p>
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                                    Selesai
                                                </span>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="py-24 flex flex-col items-center justify-center text-slate-400 bg-white/50 rounded-[3rem] border-2 border-dashed border-slate-200 animate-fade-in-up">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">Tidak ada data ditemukan</h3>
                        <p class="text-sm font-medium">Sesuaikan filter pencarian atau buat kegiatan dinas baru.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination / Infinity Scroll -->
                <div class="pt-10 space-y-4">
                    <!-- Loading Skeleton -->
                    <div wire:loading wire:target="loadMore" class="w-full">
                        <div class="space-y-4">
                            @foreach(range(1, 2) as $i)
                            <div class="bg-white/40 backdrop-blur-md rounded-[2.5rem] p-8 border border-white animate-pulse">
                                <div class="flex flex-col md:flex-row gap-6 items-center">
                                    <div class="w-full md:w-48 h-24 bg-slate-200 rounded-2xl"></div>
                                    <div class="flex-1 space-y-3 w-full">
                                        <div class="h-5 bg-slate-200 rounded w-3/4"></div>
                                        <div class="h-4 bg-slate-200 rounded w-1/2"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Scroll Sentinel -->
                    @if($hasMore)
                    <div x-intersect="$wire.loadMore()" class="h-10 w-full flex items-center justify-center">
                        <div wire:loading wire:target="loadMore" class="flex gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-400 animate-bounce" style="animation-delay: 0ms"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-bounce" style="animation-delay: 150ms"></span>
                            <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-bounce" style="animation-delay: 300ms"></span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingDeletion">
        <x-slot name="title">
            {{ __('Konfirmasi Hapus') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingDeletion')" wire:loading.attr="disabled">
                {{ __('Batal') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="delete" wire:loading.attr="disabled">
                {{ __('Hapus') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>

    <!-- Detail Modal -->
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
                            
                            <!-- Large Circle Logic -->
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
                    <!-- Total Budget Card -->
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
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Total operasional & insentif</p>
                        </div>
                    </div>

                    <!-- Member Count Card -->
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
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Representatif Komisi {{ $selectedKegiatan->komisi->nama }}</p>
                        </div>
                    </div>

                    <!-- Staff Count Card -->
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
                            <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">Staf Pelaksana & TA</p>
                        </div>
                    </div>
                </div>

                <!-- 3. DETAILED BREAKDOWN DASHBOARD -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- LEFT SIDE: LOGISTICS & FINANCE (7 columns) -->
                    <div class="lg:col-span-7 space-y-8">
                        <!-- Logistics & Timeline -->
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

                        <!-- Global Costs breakdown -->
                        <div class="bg-white p-8 rounded-[2.5rem] border border-slate-100 shadow-xl shadow-slate-200/50">
                            <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center gap-3">
                                <div class="w-1.5 h-1.5 rounded-full bg-rose-500"></div>
                                Rincian Biaya Operasional (Kolektif)
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">BBM & Transportasi</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_bbm, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Akomodasi (Hotel)</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_penginapan, 0, ',', '.') }}</p>
                                </div>
                                <div class="p-5 rounded-3xl bg-slate-50 border border-slate-100 hover:bg-white transition-colors">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2">Tiket & Sewa</p>
                                    <p class="text-lg font-black text-slate-900 font-mono">Rp {{ number_format($selectedKegiatan->biaya_transportasi, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="mt-6 pt-6 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Biaya Kolektif</span>
                                <span class="text-2xl font-black text-indigo-600 font-mono">Rp {{ number_format($selectedKegiatan->biaya_bbm + $selectedKegiatan->biaya_penginapan + $selectedKegiatan->biaya_transportasi, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        @if($selectedKegiatan->keterangan)
                        <div class="bg-amber-50/30 p-8 rounded-[2.5rem] border border-amber-100">
                            <h4 class="text-[11px] font-black text-amber-800 uppercase tracking-[0.2em] mb-4">Catatan Khusus</h4>
                            <p class="text-slate-600 font-medium italic leading-relaxed text-sm">"{{ $selectedKegiatan->keterangan }}"</p>
                        </div>
                        @endif
                    </div>

                    <!-- RIGHT SIDE: DELEGATION (5 columns) -->
                    <div class="lg:col-span-5 h-full flex flex-col">
                        <div class="bg-white p-2 rounded-[3rem] border border-slate-100 shadow-2xl h-full flex flex-col min-h-[600px]">
                            <div class="p-8 pb-4">
                                <h4 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6 flex items-center gap-3">
                                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500"></div>
                                    Personel & Insentif Perjalanan
                                </h4>
                            </div>

                            <div class="flex-1 overflow-y-auto px-6 pb-8 space-y-8 custom-scrollbar">
                                <!-- Members Section -->
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <p class="text-[10px] font-black text-slate-800 uppercase tracking-widest bg-slate-100 px-3 py-1 rounded-full">Anggota DPRD</p>
                                        <span class="text-[10px] font-extrabold text-slate-400">{{ $selectedKegiatan->anggotas->count() }} Orang</span>
                                    </div>
                                    <div class="space-y-3">
                                        @foreach($selectedKegiatan->anggotas as $anggota)
                                        <div class="group bg-slate-50/50 hover:bg-white p-4 rounded-3xl border border-transparent hover:border-slate-100 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-2xl bg-white border border-slate-100 flex items-center justify-center text-slate-900 font-black relative overflow-hidden group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-6 transition-all">
                                                    {{ substr($anggota->nama, 0, 1) }}
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="font-black text-slate-800 truncate leading-tight">{{ $anggota->nama }}</p>
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 truncate">{{ $anggota->jabatan }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs font-black text-indigo-600 font-mono">Rp {{ number_format($anggota->pivot->nominal, 0, ',', '.') }}</p>
                                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ number_format($anggota->pivot->uang_harian, 0, ',', '.') }}/Hari</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Staff Section -->
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <p class="text-[10px] font-black text-emerald-800 uppercase tracking-widest bg-emerald-50 px-3 py-1 rounded-full">Staf & Pendamping</p>
                                        <span class="text-[10px] font-extrabold text-slate-400">{{ $selectedKegiatan->pendampingKegiatans->count() }} Orang</span>
                                    </div>
                                    <div class="space-y-3">
                                        @foreach($selectedKegiatan->pendampingKegiatans as $pk)
                                        <div class="group bg-emerald-50/20 hover:bg-white p-4 rounded-3xl border border-transparent hover:border-emerald-100 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-center gap-4">
                                                <div class="w-12 h-12 rounded-2xl bg-white border border-emerald-50 flex items-center justify-center text-emerald-600 font-black group-hover:bg-emerald-600 group-hover:text-white transition-all">
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
                                                    <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 truncate">
                                                        @if($pk->jenis == 'pendamping_wajib')
                                                            {{ $pk->pendamping->pegawai ? $pk->pendamping->pegawai->jabatan : ($pk->pendamping->jabatan ?? 'TA') }}
                                                        @else
                                                            {{ $pk->pegawai->jabatan ?? 'Staf' }}
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-xs font-black text-emerald-600 font-mono">Rp {{ number_format($pk->nominal, 0, ',', '.') }}</p>
                                                    <p class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">{{ number_format($pk->uang_harian, 0, ',', '.') }}/Hari</p>
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
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center gap-3">
                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Diverifikasi oleh Sistem</span>
                    <div class="w-1.5 h-1.5 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></div>
                </div>
                <x-secondary-button wire:click="$set('showingDetail', false)" class="!rounded-2xl !px-10 !py-4 !text-[10px] !font-black !uppercase !tracking-widest !bg-slate-900 !text-white !border-none !hover:bg-slate-800 !transition-all">
                    Tutup Dashboard
                </x-secondary-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
