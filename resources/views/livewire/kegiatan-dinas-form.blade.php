<div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-500/10 text-blue-600 text-[10px] font-black uppercase tracking-wider border border-blue-100">Operasional</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    {{ $isEdit ? 'Perbarui' : 'Entri' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Kegiatan Dinas</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Dokumentasikan rincian kegiatan dan koordinasi perjalanan dinas</p>
            </div>
            <a href="{{ route('kegiatan-dinas.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4" x-data="{ currentStep: @entangle('currentStep') }">
        <div class="max-w-5xl mx-auto">
            
            <!-- Step Indicator -->
            <div class="mb-14 relative">
                <div class="absolute top-1/2 left-0 w-full h-1 bg-slate-100 -translate-y-1/2 rounded-full"></div>
                <div class="absolute top-1/2 left-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-600 -translate-y-1/2 rounded-full transition-all duration-700" style="width: {{ (($currentStep - 1) / 2) * 100 }}%"></div>
                
                <div class="relative flex justify-between">
                    <!-- Step 1 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 {{ $currentStep >= 1 ? 'bg-slate-900 shadow-xl shadow-slate-900/20 scale-110' : 'bg-white border-2 border-slate-100 text-slate-300' }}">
                            @if($currentStep > 1)
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <span class="text-sm font-black {{ $currentStep == 1 ? 'text-white' : '' }}">01</span>
                            @endif
                        </div>
                        <span class="mt-4 text-[10px] font-black uppercase tracking-widest {{ $currentStep == 1 ? 'text-slate-900' : 'text-slate-400' }}">Informasi Utama</span>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 {{ $currentStep >= 2 ? ($currentStep == 2 ? 'bg-slate-900 shadow-xl shadow-slate-900/20 scale-110' : 'bg-slate-900') : 'bg-white border-2 border-slate-100 text-slate-300' }}">
                            @if($currentStep > 2)
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                <span class="text-sm font-black {{ $currentStep == 2 ? 'text-white' : '' }}">02</span>
                            @endif
                        </div>
                        <span class="mt-4 text-[10px] font-black uppercase tracking-widest {{ $currentStep == 2 ? 'text-slate-900' : 'text-slate-400' }}">Delegasi & Tim</span>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col items-center">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 {{ $currentStep == 3 ? 'bg-slate-900 shadow-xl shadow-slate-900/20 scale-110' : 'bg-white border-2 border-slate-100 text-slate-300' }}">
                            <span class="text-sm font-black {{ $currentStep == 3 ? 'text-white' : '' }}">03</span>
                        </div>
                        <span class="mt-4 text-[10px] font-black uppercase tracking-widest {{ $currentStep == 3 ? 'text-slate-900' : 'text-slate-400' }}">Finalisasi</span>
                    </div>
                </div>
            </div>

            @if($isReadOnly)
            <div class="mb-10 animate-fade-in-up">
                <div class="bg-slate-900 rounded-[2.5rem] p-8 border border-white/10 shadow-2xl relative overflow-hidden group">
                    <div class="absolute -right-10 -top-10 w-40 h-40 bg-indigo-500/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-all duration-700"></div>
                    <div class="relative flex flex-col md:flex-row items-center gap-6">
                        <div class="w-16 h-16 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center text-indigo-400 group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h4 class="text-xl font-black text-white tracking-tight">Kegiatan Telah Terkunci</h4>
                            <p class="text-indigo-200/60 font-medium text-sm mt-1">Status kegiatan ini (BERAKHIR) membuat data tidak dapat diubah kembali demi integritas laporan.</p>
                        </div>
                        <div class="px-6 py-2 rounded-xl bg-indigo-500/20 border border-indigo-500/30 text-[10px] font-black text-indigo-300 uppercase tracking-[0.2em]">
                            Mode Baca Saja
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <form wire:submit="save" class="space-y-10">
                
                @if($currentStep == 1)
                <!-- Step 1: Informasi Utama -->
                <div class="animate-fade-in-up" x-transition>
                    <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white p-12 relative overflow-hidden">
                        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl transition-colors duration-700"></div>
                        
                        <div class="max-w-3xl mx-auto space-y-10">
                            <div class="text-center space-y-2">
                                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Rincian Agenda Kegiatan</h3>
                                <p class="text-slate-500 font-medium text-sm">Lengkapi informasi dasar pelaksanaan kegiatan dinas</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Komisi Penyelenggara <span class="text-rose-500">*</span></label>
                                    <div class="relative group">
                                        <select wire:model.live="komisi_id" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-6 pr-10 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none disabled:opacity-60 disabled:cursor-not-allowed">
                                            <option value="">Pilih Komisi...</option>
                                            @foreach($komisis as $komisi)
                                                <option value="{{ $komisi->id }}">{{ $komisi->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                    @error('komisi_id') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Jenis Layanan <span class="text-rose-500">*</span></label>
                                    <div class="relative group">
                                        <select wire:model="jenis_dinas" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-6 pr-10 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all appearance-none disabled:opacity-60 disabled:cursor-not-allowed">
                                            <option value="">Pilih Jenis...</option>
                                            <option value="dalam">Dinas Dalam Daerah</option>
                                            <option value="luar">Dinas Luar Daerah</option>
                                        </select>
                                        <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                    @error('jenis_dinas') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="md:col-span-2 space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Agenda Kegiatan <span class="text-rose-500">*</span></label>
                                    <input type="text" wire:model="nama_kegiatan" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all text-lg disabled:opacity-60 disabled:cursor-not-allowed" placeholder="Contoh: Kunjungan Kerja Koordinasi Sistem Pemerintahan...">
                                    @error('nama_kegiatan') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="md:col-span-2 space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Lokasi Tujuan <span class="text-rose-500">*</span></label>
                                    <div class="relative group">
                                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <input type="text" wire:model="lokasi" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-14 pr-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all disabled:opacity-60 disabled:cursor-not-allowed" placeholder="Misal: Kantor DPRD Provinsi Jawa Timur, Surabaya">
                                    </div>
                                    @error('lokasi') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Waktu Mulai <span class="text-rose-500">*</span></label>
                                    <input type="date" wire:model="tanggal_mulai" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed">
                                    @error('tanggal_mulai') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>

                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Waktu Selesai <span class="text-rose-500">*</span></label>
                                    <input type="date" wire:model="tanggal_selesai" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed">
                                    @error('tanggal_selesai') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-1 block px-1">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentStep == 2)
                @php
                    $dur = (int) Carbon\Carbon::parse($tanggal_mulai)->diffInDays(Carbon\Carbon::parse($tanggal_selesai)) + 1;
                    $selectedKomisi = $komisi_id ? $komisis->find($komisi_id) : null;
                    $isPimpinanMode = $selectedKomisi && strtoupper($selectedKomisi->nama) === 'PIMPINAN DPRD';
                @endphp
                <!-- Step 2: Delegasi & Tim -->
                <div class="animate-fade-in-up" x-transition>
                    <div class="space-y-10">
                        <!-- Card: Peserta (Anggota) -->
                        <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-10 relative overflow-hidden">
                             <h3 class="relative text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-10 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center text-indigo-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                Peserta Anggota Dewan
                            </h3>

                            @if($komisi_id)
                                <div class="mb-8">
                                    <div class="relative group max-w-md">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                        <input type="text" wire:model.live.debounce.300ms="searchAnggota" {{ $isReadOnly ? 'disabled' : '' }} placeholder="Cari anggota..." class="w-full pl-11 pr-4 py-4 bg-slate-50 border-none rounded-2xl text-sm font-bold placeholder:text-slate-300 focus:ring-2 focus:ring-indigo-500/20 transition-all disabled:opacity-60 disabled:cursor-not-allowed">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    @php
                                        $filteredAnggotas = $availableAnggotas->filter(function($a) {
                                            if (!$this->searchAnggota) return true;
                                            return str_contains(strtolower($a->nama), strtolower($this->searchAnggota));
                                        });
                                        $selectedAnggotasInList = $availableAnggotas->whereIn('id', $this->anggota_ids);
                                        $displayAnggotas = $filteredAnggotas->merge($selectedAnggotasInList)->unique('id');
                                    @endphp

                                    @forelse($displayAnggotas as $anggota)
                                    <label class="group/item flex flex-col p-6 {{ in_array($anggota->id, $anggota_ids) ? 'bg-indigo-50/50 border-indigo-200 ring-2 ring-indigo-500/10' : 'bg-slate-50/50 border-transparent hover:bg-white hover:border-indigo-100 hover:shadow-xl hover:shadow-indigo-500/5' }} rounded-[2rem] border transition-all duration-300 cursor-pointer">
                                        <div class="flex items-center mb-4">
                                            <div class="relative flex items-center justify-center w-6 h-6 mr-4">
                                                <input type="checkbox" wire:model.live="anggota_ids" value="{{ $anggota->id }}" {{ $isReadOnly ? 'disabled' : '' }} class="peer relative appearance-none w-6 h-6 border-2 border-slate-200 rounded-lg checked:bg-indigo-600 checked:border-indigo-600 focus:ring-0 transition-all cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                                <svg class="absolute w-4 h-4 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="font-black text-slate-900 group-hover/item:text-indigo-600 transition-colors truncate">{{ $anggota->nama }}</div>
                                                <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $anggota->jabatan ?? 'Anggota' }}</div>
                                            </div>
                                        </div>

                                        @if(in_array($anggota->id, $anggota_ids))
                                            <div class="mt-2 pt-4 border-t border-indigo-100/50" onclick="event.preventDefault()">
                                                <div class="flex items-end justify-between gap-4">
                                                    <div class="flex-1 space-y-2">
                                                        <label class="block text-[8px] font-black text-indigo-400 uppercase tracking-widest pl-1">Uang Harian / Hari</label>
                                                        <div class="relative">
                                                            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-[10px] font-black text-slate-400">Rp</div>
                                                            <input type="number" wire:model.live="anggota_budgets.{{ $anggota->id }}.uang_harian" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-9 pr-3 py-2.5 bg-white border-2 border-indigo-100 rounded-xl text-xs font-bold text-indigo-600 focus:ring-2 focus:ring-indigo-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0 text-right">
                                                        @php
                                                            $h = $anggota_budgets[$anggota->id]['uang_harian'] ?? 0;
                                                            $dur = (int) Carbon\Carbon::parse($tanggal_mulai)->diffInDays(Carbon\Carbon::parse($tanggal_selesai)) + 1;
                                                            $subTotal = $h * $dur;
                                                        @endphp
                                                        <span class="block text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Subtotal</span>
                                                        <div class="bg-indigo-600 text-white px-3 py-2 rounded-xl text-[11px] font-black shadow-lg shadow-indigo-200">
                                                            Rp {{ number_format($subTotal, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                    @empty
                                    <div class="col-span-full py-20 bg-slate-50 rounded-[2.5rem] border-2 border-dashed border-slate-200 text-center text-slate-300 font-bold uppercase tracking-widest text-xs">Data tidak ditemukan</div>
                                    @endforelse
                                </div>
                                @error('anggota_ids') <span class="text-rose-500 text-[10px] font-bold uppercase tracking-wider mt-6 block text-center">{{ $message }}</span> @enderror
                            @else
                                <div class="text-center py-24 bg-slate-50/50 rounded-[3rem] border-2 border-dashed border-slate-200">
                                    <p class="text-sm font-bold text-slate-400 shadow-sm italic">Pilih <span class="text-indigo-500">Komisi</span> pada langkah pertama.</p>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            <!-- Card: Pendamping -->
                            <!-- Card: Pendamping -->
                            @if($isPimpinanMode)
                                <div x-data="{ 
                                    selections: @entangle('pimpinan_pendampings').live,
                                    isSelected(pid, id) {
                                        if (!this.selections) return false;
                                        let list = this.selections[pid];
                                        if (!list) return false;
                                        let items = Array.isArray(list) ? list : Object.values(list);
                                        return items.some(item => item == id);
                                    },
                                    toggleSelection(pid, id) {
                                        if (!this.selections) this.selections = {};
                                        // Ensure the sub-array exists
                                        if (!this.selections[pid]) {
                                             this.selections[pid] = [];
                                        } else if (!Array.isArray(this.selections[pid])) {
                                             // Convert object to array if needed (Livewire serialization quirk)
                                             this.selections[pid] = Object.values(this.selections[pid]);
                                        }
                                        
                                        // Helper to find index ensuring type safety
                                        let index = this.selections[pid].findIndex(item => item == id);
                                        
                                        if (index === -1) {
                                            this.selections[pid].push(id);
                                        } else {
                                            this.selections[pid].splice(index, 1);
                                        }
                                    }
                                }" class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8 relative overflow-hidden group">
                                     <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-500/5 rounded-full blur-2xl group-hover:bg-emerald-500/10 transition-colors"></div>
                                    <h3 class="relative text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] mb-8 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-md bg-rose-500/10 flex items-center justify-center text-rose-600">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            Pendamping Pimpinan
                                        </div>
                                    </h3>

                                    @if(count($anggota_ids) > 0)
                                        <div class="mb-6">
                                            <div class="relative group">
                                                <input type="text" wire:model.live.debounce.300ms="searchPendamping" {{ $isReadOnly ? 'disabled' : '' }} placeholder="Cari pendamping..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold placeholder:text-slate-300 disabled:opacity-60 disabled:cursor-not-allowed">
                                                <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                            @php
                                                // MERGED LIST LOGIC
                                                $mergedPendampings = collect();
                                                
                                                foreach($anggota_ids as $pid) {
                                                    $pName = $availableAnggotas->find($pid)->nama ?? 'Pimpinan';
                                                    $assigned = $filteredPendampings->where('anggota_id', $pid);
                                                    
                                                    foreach($assigned as $p) {
                                                        $p->target_pimpinan_id = $pid;
                                                        $p->target_pimpinan_name = $pName;
                                                        $mergedPendampings->push($p);
                                                    }
                                                }
                                                
                                                if ($searchPendamping) {
                                                    $searchResults = $filteredPendampings->filter(function($p) use ($searchPendamping) {
                                                        $name = $p->pegawai ? $p->pegawai->nama : $p->nama;
                                                        return str_contains(strtolower($name), strtolower($searchPendamping));
                                                    });
                                                    
                                                    foreach($searchResults as $res) {
                                                        if (!$mergedPendampings->contains('id', $res->id)) {
                                                            $res->target_pimpinan_id = null; // Will need selection
                                                            $mergedPendampings->push($res);
                                                        }
                                                    }
                                                }
                                                
                                                $mergedPendampings = $mergedPendampings->unique('id');
                                            @endphp

                                            @forelse($mergedPendampings as $pendamping)
                                                @php
                                                    $targetPid = $pendamping->target_pimpinan_id ?? $anggota_ids[0]; 
                                                    $targetName = $pendamping->target_pimpinan_name ?? ($availableAnggotas->find($targetPid)->nama ?? 'Lead');
                                                    $modelName = "pimpinan_pendampings." . $targetPid;
                                                @endphp

                                                <label wire:key="pendamping-pimpinan-{{ $pendamping->id }}-{{ $targetPid }}" 
                                                       class="group/item flex flex-col p-4 hover:bg-white rounded-2xl border transition-all duration-300 cursor-pointer relative"
                                                       :class="isSelected('{{ $targetPid }}', '{{ $pendamping->id }}') 
                                                            ? 'bg-rose-50 border-rose-100 shadow-sm ring-2 ring-rose-500/5' 
                                                            : 'bg-slate-50/50 border-transparent'">
                                                    
                                                    <div class="flex items-center">
                                                        <div class="relative flex items-center justify-center w-4 h-4 mr-3">
                                                            <input type="checkbox" 
                                                                   @change="toggleSelection('{{ $targetPid }}', '{{ $pendamping->id }}')"
                                                                   :checked="isSelected('{{ $targetPid }}', '{{ $pendamping->id }}')"
                                                                   {{ $isReadOnly ? 'disabled' : '' }}
                                                                   class="peer relative appearance-none w-4 h-4 border-2 border-slate-200 rounded-md checked:bg-rose-500 checked:border-rose-500 focus:ring-0 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                                            <svg class="absolute w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                                                        </div>
                                                        <div class="min-w-0 flex-1">
                                                            <div class="font-bold text-slate-800 group-hover/item:text-rose-600 transition-colors text-xs truncate flex items-center gap-2">
                                                                {{ $pendamping->pegawai ? $pendamping->pegawai->nama : $pendamping->nama }}
                                                                <span class="px-1.5 py-0.5 rounded-full bg-slate-100 text-[8px] font-black text-slate-400 uppercase tracking-wider">
                                                                    {{ Str::limit($targetName, 10) }}
                                                                </span>
                                                            </div>
                                                            <div class="text-[7px] font-black text-slate-400 uppercase tracking-widest">{{ $pendamping->pegawai ? $pendamping->pegawai->jabatan : ($pendamping->jabatan ?? 'Staf') }}</div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div x-show="isSelected('{{ $targetPid }}', '{{ $pendamping->id }}')" 
                                                         x-transition
                                                         class="mt-3 pt-3 border-t border-rose-100/50 relative z-20" 
                                                         @click.stop>
                                                        <div class="flex items-end justify-between gap-3">
                                                            <div class="flex-1 space-y-1">
                                                                <label class="block text-[6px] font-black text-rose-500 uppercase tracking-widest pl-1">Harian</label>
                                                                <input type="number" wire:model.live="pendamping_budgets.{{ $pendamping->id }}.uang_harian" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-2 py-1 bg-white border border-rose-100 rounded text-[9px] font-bold text-rose-600 font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                                            </div>
                                                            <div class="bg-rose-500 text-white px-2 py-1 rounded text-[7px] font-black shadow-lg shadow-rose-200/50">
                                                                Σ {{ number_format(($pendamping_budgets[$pendamping->id]['uang_harian'] ?? 0) * $dur, 0, ',', '.') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            @empty
                                                <div class="text-center py-8">
                                                    <p class="text-[10px] font-bold text-slate-400">Belum ada pendamping khusus.</p>
                                                    <p class="text-[9px] text-slate-300 mt-1">Gunakan pencarian untuk menambah manual.</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    @else
                                        <div class="p-4 text-center">
                                             <p class="text-xs font-bold text-slate-400 italic">Pilih <span class="text-indigo-500">Pimpinan DPRD</span> terlebih dahulu.</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                               <!-- STANDARD MODE: Generic Pendamping Card -->
                                <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8">
                                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-md bg-emerald-500/10 flex items-center justify-center text-emerald-600">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </div>
                                            Pendamping Wajib
                                        </div>
                                        <span class="px-2 py-0.5 rounded bg-slate-100 text-[9px] font-black">{{ count($pendamping_ids) }} Terpilih</span>
                                    </h3>

                                    <div class="mb-6">
                                        <div class="relative group">
                                            <input type="text" wire:model.live.debounce.300ms="searchPendamping" {{ $isReadOnly ? 'disabled' : '' }} placeholder="Cari pendamping..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold placeholder:text-slate-300 disabled:opacity-60 disabled:cursor-not-allowed">
                                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-emerald-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">

                                        @php
                                            // Use the filtered collection passed from the component
                                            $displayPendampings = $filteredPendampings->filter(function($p) {
                                                if (!$this->searchPendamping) return true;
                                                $name = $p->pegawai ? $p->pegawai->nama : $p->nama;
                                                return str_contains(strtolower($name), strtolower($this->searchPendamping));
                                            })->merge($filteredPendampings->whereIn('id', $this->pendamping_ids))->unique('id');
                                        @endphp

                                        @forelse($displayPendampings as $pendamping)
                                        <label class="group/item flex flex-col p-4 {{ in_array($pendamping->id, $pendamping_ids) ? 'bg-emerald-50 border-emerald-100 ring-2 ring-emerald-500/5' : 'bg-slate-50/50 border-transparent hover:bg-white hover:border-emerald-100' }} rounded-2xl border transition-all duration-300 cursor-pointer">
                                            <div class="flex items-center">
                                                <div class="relative flex items-center justify-center w-5 h-5 mr-3">
                                                    <input type="checkbox" wire:model.live="pendamping_ids" value="{{ $pendamping->id }}" {{ $isReadOnly ? 'disabled' : '' }} class="peer relative appearance-none w-5 h-5 border-2 border-slate-200 rounded-md checked:bg-emerald-500 checked:border-emerald-500 focus:ring-0 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                                    <svg class="absolute w-3 h-3 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="font-bold text-slate-800 group-hover/item:text-emerald-600 transition-colors truncate text-sm">{{ $pendamping->pegawai ? $pendamping->pegawai->nama : $pendamping->nama }}</div>
                                                    <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ $pendamping->pegawai ? $pendamping->pegawai->jabatan : ($pendamping->jabatan ?? 'Staf') }}</div>
                                                </div>
                                            </div>
                                            @if(in_array($pendamping->id, $pendamping_ids))
                                                <div class="mt-3 pt-3 border-t border-emerald-100/50" onclick="event.preventDefault()">
                                                    <div class="flex items-end justify-between gap-3">
                                                        <div class="flex-1 space-y-1">
                                                            <label class="block text-[7px] font-black text-emerald-400 uppercase tracking-widest pl-1">Harian</label>
                                                            <input type="number" wire:model.live="pendamping_budgets.{{ $pendamping->id }}.uang_harian" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-3 py-1.5 bg-white border border-emerald-100 rounded-lg text-[10px] font-bold text-emerald-600 font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                                        </div>
                                                        <div class="bg-emerald-500 text-white px-2 py-1.5 rounded-lg text-[8px] font-black shadow-lg shadow-emerald-200/50">
                                                            Σ {{ number_format(($pendamping_budgets[$pendamping->id]['uang_harian'] ?? 0) * $dur, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </label>
                                        @empty
                                        <div class="text-center py-6 bg-slate-50 rounded-2xl border border-dotted border-slate-200 text-[10px] font-black text-slate-300 uppercase tracking-widest">Kosong</div>
                                        @endforelse
                                    </div>
                                </div>
                            @endif

                            <!-- Card: Staf Sekretariat -->
                            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8">
                                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-8 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-md bg-amber-500/10 flex items-center justify-center text-amber-600">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        </div>
                                        Staf Sekretariat
                                    </div>
                                    <span class="px-2 py-0.5 rounded bg-slate-100 text-[9px] font-black">{{ count($pegawai_ids) }} Terpilih</span>
                                </h3>

                                <div class="mb-6">
                                    <div class="relative group">
                                        <input type="text" wire:model.live.debounce.300ms="searchPegawai" {{ $isReadOnly ? 'disabled' : '' }} placeholder="Cari nama staf..." class="w-full pl-11 pr-4 py-3 bg-slate-50 border-none rounded-xl text-xs font-bold placeholder:text-slate-300 disabled:opacity-60 disabled:cursor-not-allowed">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="max-h-[400px] overflow-y-auto pr-2 space-y-4 custom-scrollbar">
                                    @forelse($pegawais as $pegawai)
                                    <label class="group/item flex flex-col p-4 {{ in_array($pegawai->id, $pegawai_ids) ? 'bg-amber-50 border-amber-100 shadow-sm ring-2 ring-amber-500/5' : 'bg-slate-50/50 border-transparent hover:bg-white hover:border-amber-100' }} rounded-2xl border transition-all duration-300 cursor-pointer">
                                        <div class="flex items-center">
                                            <div class="relative flex items-center justify-center w-4 h-4 mr-3">
                                                <input type="checkbox" wire:model.live="pegawai_ids" value="{{ $pegawai->id }}" {{ $isReadOnly ? 'disabled' : '' }} class="peer relative appearance-none w-4 h-4 border-2 border-slate-200 rounded-md checked:bg-amber-500 checked:border-amber-500 focus:ring-0 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                                                <svg class="absolute w-2.5 h-2.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3.5" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="font-bold text-slate-800 group-hover/item:text-amber-600 transition-colors truncate text-xs">{{ $pegawai->nama }}</div>
                                                <div class="text-[7px] font-black text-slate-400 uppercase tracking-widest">{{ $pegawai->jabatan }}</div>
                                            </div>
                                        </div>
                                        @if(in_array($pegawai->id, $pegawai_ids))
                                            <div class="mt-3 pt-3 border-t border-amber-100/50" onclick="event.preventDefault()">
                                                <div class="flex items-end justify-between gap-3">
                                                    <div class="flex-1 space-y-1">
                                                        <label class="block text-[6px] font-black text-amber-500 uppercase tracking-widest pl-1">Harian</label>
                                                        <input type="number" wire:model.live="pegawai_budgets.{{ $pegawai->id }}.uang_harian" {{ $isReadOnly ? 'disabled' : '' }} class="w-full px-2 py-1 bg-white border border-amber-100 rounded text-[9px] font-bold text-amber-600 font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                                    </div>
                                                    <div class="bg-amber-500 text-white px-2 py-1 rounded text-[7px] font-black shadow-lg shadow-amber-200/50">
                                                        Σ {{ number_format(($pegawai_budgets[$pegawai->id]['uang_harian'] ?? 0) * $dur, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                    @empty
                                    <div class="text-center py-6 bg-slate-50 rounded-2xl border border-dotted border-slate-200 text-[10px] font-black text-slate-300 uppercase tracking-widest italic text-center">Data tidak ditemukan</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if($currentStep == 3)
                <!-- Step 3: Anggaran & Finalisasi -->
                <div class="animate-fade-in-up" x-transition>
                    <div class="space-y-10">
                        <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white p-12 relative overflow-hidden">
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-[0.2em] mb-10 flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-rose-500/10 flex items-center justify-center text-rose-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.67 1M12 17c-1.12 0-2.09-.41-2.68-1m0-8V7m0 10v1"></path></svg>
                                </div>
                                Biaya Kolektif (Non-Harian)
                            </h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Biaya BBM</label>
                                    <div class="relative">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-300">Rp</div>
                                        <input type="number" wire:model.live="biaya_bbm" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-12 pr-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-rose-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Biaya Hotel</label>
                                    <div class="relative">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-300">Rp</div>
                                        <input type="number" wire:model.live="biaya_penginapan" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-12 pr-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-rose-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                    </div>
                                </div>
                                <div class="space-y-3">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Total Biaya Transportasi</label>
                                    <div class="relative">
                                        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-300">Rp</div>
                                        <input type="number" wire:model.live="biaya_transportasi" {{ $isReadOnly ? 'disabled' : '' }} class="w-full pl-12 pr-6 py-4.5 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-rose-500/20 transition-all font-mono disabled:opacity-60 disabled:cursor-not-allowed" placeholder="0">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] shadow-2xl shadow-slate-200/50 border border-white p-8">
                                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Catatan Tambahan</h3>
                                <textarea wire:model="keterangan" {{ $isReadOnly ? 'disabled' : '' }} rows="6" class="w-full px-6 py-4.5 bg-slate-50 border-none rounded-3xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all resize-none text-sm disabled:opacity-60 disabled:cursor-not-allowed" placeholder="Berikan keterangan atau instruksi khusus..."></textarea>
                            </div>

                            <div class="bg-slate-900 rounded-[3rem] p-10 shadow-2xl shadow-slate-900/40 relative overflow-hidden group">
                                <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl group-hover:bg-white/10 transition-colors duration-700"></div>
                                <h3 class="text-[10px] font-black text-white/40 uppercase tracking-[0.2em] mb-8">Review Ringkasan</h3>
                                <div class="space-y-6">
                                    <div class="flex justify-between items-end border-b border-white/10 pb-4">
                                        <div>
                                            <span class="block text-[9px] font-black text-white/30 uppercase tracking-widest mb-1">Agenda</span>
                                            <span class="text-sm font-bold text-white line-clamp-1">{{ $nama_kegiatan ?: '-' }}</span>
                                        </div>
                                        <div class="text-right">
                                            <span class="block text-[9px] font-black text-white/30 uppercase tracking-widest mb-1">Durasi</span>
                                            <span class="text-sm font-black text-indigo-400">{{ (int) Carbon\Carbon::parse($tanggal_mulai)->diffInDays(Carbon\Carbon::parse($tanggal_selesai)) + 1 }} Hari</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-3 gap-4">
                                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center"><span class="block text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Anggota</span><span class="text-lg font-black text-white">{{ count($anggota_ids) }}</span></div>
                                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center"><span class="block text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Pendamping</span><span class="text-lg font-black text-white">{{ count($pendamping_ids) }}</span></div>
                                        <div class="bg-white/5 p-4 rounded-2xl border border-white/5 text-center"><span class="block text-[8px] font-black text-white/30 uppercase tracking-widest mb-1">Staf</span><span class="text-lg font-black text-white">{{ count($pegawai_ids) }}</span></div>
                                    </div>
                                    @php
                                        $dur = (int) Carbon\Carbon::parse($tanggal_mulai)->diffInDays(Carbon\Carbon::parse($tanggal_selesai)) + 1;
                                        $total = (float) $biaya_bbm + (float) $biaya_penginapan + (float) $biaya_transportasi;
                                        foreach($anggota_ids as $id) $total += (($anggota_budgets[$id]['uang_harian'] ?? 0) * $dur);
                                        foreach($pendamping_ids as $id) $total += (($pendamping_budgets[$id]['uang_harian'] ?? 0) * $dur);
                                        foreach($pegawai_ids as $id) $total += (($pegawai_budgets[$id]['uang_harian'] ?? 0) * $dur);
                                    @endphp
                                    <div class="pt-4 mt-6 border-t border-white/5">
                                        <span class="text-[10px] font-black text-indigo-400 uppercase tracking-[0.2em] block mb-2">Total Estimasi Anggaran</span>
                                        <div class="text-4xl font-black text-white tracking-tighter"><span class="text-xl text-white/40 mr-1">Rp</span>{{ number_format($total, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Action Bar -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-6 bg-slate-900 p-8 rounded-[2.5rem] shadow-2xl shadow-slate-900/20 border border-slate-800">
                    <div class="flex items-center gap-6">
                        @if($currentStep > 1)
                        <button type="button" wire:click="previousStep" class="group flex items-center gap-3 text-slate-400 hover:text-white font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            Kembali
                        </button>
                        @else
                        <a href="{{ route('kegiatan-dinas.index') }}" class="group flex items-center gap-3 text-slate-500 hover:text-white font-black text-[10px] uppercase tracking-[0.2em] transition-all duration-300">
                            Batalkan
                        </a>
                        @endif
                    </div>

                    <div class="flex items-center gap-4 w-full md:w-auto">
                        @if($currentStep < 3)
                        <button type="button" wire:click="nextStep" class="w-full md:w-auto group relative overflow-hidden bg-white text-slate-900 px-12 py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-xl transition-all duration-500 hover:-translate-y-1">
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                            <span class="relative group-hover:text-white transition-colors duration-500">Lanjutkan Ke Tahap Berikutnya</span>
                        </button>
                        @endif

                        @if($currentStep == 3 && !$isReadOnly)
                        <button type="submit" wire:loading.attr="disabled" class="w-full md:w-auto group relative overflow-hidden bg-indigo-600 text-white px-16 py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] shadow-2xl transition-all duration-500 hover:bg-indigo-700 hover:-translate-y-1 active:scale-95 disabled:opacity-50">
                            <span wire:loading.remove>Finalisasi & Simpan Data</span>
                            <span wire:loading>Memproses...</span>
                        </button>
                        @endif
                        
                        @if($currentStep == 3 && $isReadOnly)
                        <div class="px-12 py-5 bg-white/10 border border-white/20 rounded-2xl flex items-center gap-3">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Data Terkunci</span>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
