<div>
    @if($isOpen && $trip)
    <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-slate-900/60 backdrop-blur-md" wire:click="close" aria-hidden="true"></div>

            <!-- Modal positioning -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Panel -->
            <div class="inline-block align-bottom bg-slate-50 rounded-[3rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full animate-fade-in-up border border-white">
                
                <!-- Explicit Close Button (Top Right) -->
                <button wire:click="close" class="absolute top-6 right-6 z-50 p-2 rounded-full bg-white/50 hover:bg-white text-slate-400 hover:text-rose-500 transition-all shadow-sm backdrop-blur-sm">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>

                <div class="bg-white px-8 pt-8 pb-8 sm:p-10 sm:pb-10 relative">
                    <!-- Header Section -->
                    <div class="mb-8 pr-10">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-1.5 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-emerald-100 shadow-sm">{{ $trip->jenis_dinas == 'luar' ? 'Luar Daerah' : 'Dalam Daerah' }}</span>
                            <span class="px-4 py-1.5 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-xl border border-blue-100 shadow-sm">{{ $trip->komisi->nama }}</span>
                            <span class="text-xs font-black text-slate-400 bg-white px-3 py-1.5 rounded-lg border border-slate-100 shadow-sm flex items-center gap-2">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ Carbon\Carbon::parse($trip->tanggal_mulai)->format('d M Y') }}
                            </span>
                        </div>
                        <h3 class="text-3xl font-black text-slate-900 leading-tight mb-2">{{ $trip->nama_kegiatan }}</h3>
                        <div class="flex items-center gap-6 text-slate-500 font-bold text-sm">
                             <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <span>{{ $trip->lokasi }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 flex items-center justify-center text-emerald-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <span>{{ $trip->durasi_hari }} Hari Kerja</span>
                            </div>
                        </div>
                    </div>

                    <!-- Financial Summary Card -->
                    <div class="bg-slate-900 rounded-[2.5rem] p-8 mb-8 relative overflow-hidden shadow-xl shadow-slate-900/20">
                         <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
                         <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-slate-800"></div>
                         <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                             <div class="space-y-1">
                                 <p class="text-[10px] font-black text-indigo-400 uppercase tracking-widest">Total Akumulasi Biaya</p>
                                 <h4 class="text-4xl font-black text-white tracking-tight">Rp {{ number_format($trip->totalNominal, 0, ',', '.') }}</h4>
                                 <p class="text-xs font-medium text-slate-400">Termasuk transport, akomodasi, dan uang harian seluruh peserta.</p>
                             </div>
                             <div class="flex gap-4">
                                <div class="px-5 py-3 rounded-2xl bg-white/10 border border-white/10 text-center">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Anggota</p>
                                    <p class="text-xl font-black text-white">{{ $trip->pesertaKegiatans->count() }}</p>
                                </div>
                                <div class="px-5 py-3 rounded-2xl bg-white/10 border border-white/10 text-center">
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Staf</p>
                                    <p class="text-xl font-black text-white">{{ $trip->pendampingKegiatans->count() }}</p>
                                </div>
                             </div>
                         </div>
                    </div>

                    <!-- Participants Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 custom-scrollbar max-h-[400px] overflow-y-auto pr-2">
                        <!-- Anggota Column -->
                        <div class="space-y-4">
                            <h5 class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest sticky top-0 bg-white py-2 z-10">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                Delegasi Anggota Dewan
                            </h5>
                            @foreach($trip->pesertaKegiatans as $pk)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-lg transition-all hover:scale-[1.02]">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-slate-900 font-black text-xs shadow-sm border border-slate-100">
                                    {{ substr($pk->anggota->nama, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-black text-slate-900 truncate">{{ $pk->anggota->nama }}</p>
                                    <p class="text-[8px] font-bold text-blue-500 uppercase tracking-widest mt-0.5 truncate">{{ $pk->anggota->jabatan }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-slate-900 font-mono">Rp {{ number_format($pk->nominal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Staff Column -->
                        <div class="space-y-4">
                            <h5 class="flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-widest sticky top-0 bg-white py-2 z-10">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Tim Pendamping & Staf
                            </h5>
                            @foreach($trip->pendampingKegiatans as $pdk)
                                @php 
                                    $pName = $pdk->pegawai->nama ?? ($pdk->pendamping->pegawai->nama ?? 'Unknown');
                                    $pJabatan = $pdk->pegawai->jabatan ?? ($pdk->pendamping->pegawai->jabatan ?? 'Tenaga Ahli');
                                @endphp
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-emerald-50/30 border border-emerald-100/50 hover:bg-white hover:shadow-lg transition-all hover:scale-[1.02]">
                                <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center text-emerald-600 font-black text-xs shadow-sm border border-emerald-100">
                                    {{ substr($pName, 0, 1) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-xs font-black text-slate-900 truncate">{{ $pName }}</p>
                                    <p class="text-[8px] font-bold text-emerald-600 uppercase tracking-widest mt-0.5 truncate">{{ $pJabatan }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] font-black text-slate-900 font-mono">Rp {{ number_format($pdk->nominal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
