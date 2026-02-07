<div>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-orange-500/10 text-orange-600 text-[10px] font-black uppercase tracking-wider border border-orange-100">Data Master</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    Data <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600">Komisi</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Struktur organisasi komisi DPRD Kabupaten Madiun</p>
            </div>
            <a href="{{ route('komisi.create') }}" class="group relative flex items-center gap-3 bg-slate-900 overflow-hidden text-white px-8 py-3.5 rounded-2xl font-black shadow-2xl hover:shadow-orange-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                <div class="relative flex items-center gap-3">
                    <svg class="w-5 h-5 transition-transform duration-500 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
                    <span class="tracking-tight uppercase text-xs">Tambah Komisi</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-7xl mx-auto space-y-10">
            
            <!-- Filter Section -->
            <div class="bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/50 border border-white/80 animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <div class="flex-1 w-full">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3 ml-1">Cari Komisi</label>
                        <div class="relative group">
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama komisi atau keterangan..." class="w-full pl-14 pr-5 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 text-sm font-bold placeholder:text-slate-400 placeholder:font-medium focus:ring-2 focus:ring-orange-500/20 transition-all">
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Section -->
            <div class="space-y-6">
                @if (session()->has('success'))
                <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest animate-fade-in-up">
                    {{ session('success') }}
                </div>
                @endif
                @if (session()->has('error'))
                <div class="bg-rose-500/10 border border-rose-500/20 text-rose-600 px-6 py-4 rounded-2xl font-black text-xs uppercase tracking-widest animate-fade-in-up">
                    {{ session('error') }}
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8">
                    @forelse($komisis as $komisi)
                    <div class="group bg-white/80 backdrop-blur-xl rounded-[2.5rem] border border-white hover:border-slate-100 shadow-2xl shadow-slate-200/30 hover:shadow-orange-500/10 transition-all duration-500 p-2 animate-fade-in-up" style="animation-delay: {{ 200 + ($loop->index * 50) }}ms;">
                        <div class="relative overflow-hidden rounded-[2.2rem] bg-white p-8 space-y-6">
                            <!-- Background Decor -->
                            <div class="absolute -top-10 -right-10 w-40 h-40 bg-orange-500/5 rounded-full blur-3xl group-hover:bg-orange-500/10 transition-colors duration-700"></div>
                            
                            <div class="flex justify-between items-start">
                                <div class="space-y-1">
                                    <h3 class="text-2xl font-black text-slate-900 group-hover:text-orange-600 transition-colors leading-tight">
                                        {{ $komisi->nama }}
                                    </h3>
                                    <p class="text-slate-500 text-sm font-medium line-clamp-1 italic">"{{ $komisi->keterangan ?? 'Tidak ada keterangan' }}"</p>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('komisi.edit', $komisi) }}" class="p-3 bg-blue-50 text-blue-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <button wire:click="confirmDelete({{ $komisi->id }})" class="p-3 bg-rose-50 text-rose-500 rounded-xl hover:bg-slate-900 hover:text-white transition-all duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-6 border-t border-slate-50">
                                <button wire:click="openMembersModal({{ $komisi->id }})" class="text-left space-y-1 group/btn p-4 rounded-2xl hover:bg-orange-50 transition-all duration-300">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover/btn:text-orange-500 transition-colors">Total Anggota</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-3xl font-black text-slate-900 group-hover/btn:scale-110 transition-transform">{{ $komisi->anggotas_count }}</span>
                                        <span class="text-xs font-bold text-slate-400">Orang</span>
                                    </div>
                                </button>
                                <button wire:click="openPendampingModal({{ $komisi->id }})" class="text-left space-y-1 group/btn p-4 rounded-2xl hover:bg-amber-50 transition-all duration-300">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover/btn:text-amber-500 transition-colors">Pendamping</p>
                                    <div class="flex items-center gap-2">
                                        <span class="text-3xl font-black text-slate-400 group-hover/btn:text-amber-600 group-hover/btn:scale-110 transition-all">{{ $komisi->pendampings_count }}</span>
                                        <span class="text-xs font-bold text-slate-400">Staff</span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full py-24 flex flex-col items-center justify-center text-slate-400 bg-white/50 rounded-[3rem] border-2 border-dashed border-slate-200 animate-fade-in-up">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-1 4h1m-1 4h1"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-2">Tidak ada data ditemukan</h3>
                        <p class="text-sm font-medium">Buat data komisi baru untuk memulai pengelolaan.</p>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination / Infinity Scroll -->
                <div class="pt-10 space-y-4">
                    <!-- Loading Skeleton -->
                    <div wire:loading wire:target="loadMore" class="w-full">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                            @foreach(range(1, 4) as $i)
                            <div class="bg-white/40 backdrop-blur-md rounded-[2.5rem] p-8 border border-white animate-pulse">
                                <div class="w-16 h-16 rounded-2xl bg-slate-200 mb-6"></div>
                                <div class="space-y-3">
                                    <div class="h-4 bg-slate-200 rounded w-3/4"></div>
                                    <div class="h-10 bg-slate-100 rounded-xl"></div>
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

    <!-- Members Modal -->
    <x-dialog-modal wire:model.live="showMembersModal" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-orange-100 text-orange-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900">Daftar Anggota</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $this->selectedKomisi->nama ?? '' }}</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                @if($this->selectedKomisi && $this->selectedKomisi->anggotas->count() > 0)
                    @foreach($this->selectedKomisi->anggotas as $anggota)
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-500 to-amber-600 text-white flex items-center justify-center font-black">
                                {{ substr($anggota->nama, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900">{{ $anggota->nama }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $anggota->jabatan ?? 'Anggota Dewan' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="py-12 text-center">
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Belum ada anggota terdaftar</p>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showMembersModal')" wire:loading.attr="disabled">
                {{ __('Tutup') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Pendamping Modal -->
    <x-dialog-modal wire:model.live="showPendampingModal" maxWidth="2xl">
        <x-slot name="title">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900">Daftar Pendamping</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $this->selectedKomisi->nama ?? '' }}</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                @if($this->selectedKomisi && $this->selectedKomisi->pendampings->count() > 0)
                    @foreach($this->selectedKomisi->pendampings as $staff)
                    <div class="flex items-center justify-between p-5 rounded-2xl bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-black">
                                {{ substr($staff->nama, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-900">{{ $staff->nama }}</h4>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $staff->jabatan ?? 'Staff Setwan' }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="py-12 text-center">
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Belum ada pendamping terdaftar</p>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('showPendampingModal')" wire:loading.attr="disabled">
                {{ __('Tutup') }}
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
