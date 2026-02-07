<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-orange-500/10 text-orange-600 text-[10px] font-black uppercase tracking-wider border border-orange-100">Struktur Komisi</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    {{ isset($komisi) ? 'Edit' : 'Tambah' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600">Komisi</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Definisikan struktur dan bidang komisi DPRD Kabupaten Madiun</p>
            </div>
            <a href="{{ route('komisi.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="relative p-10 md:p-14">
                    <!-- Decor -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-orange-500/5 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>

                    <form method="POST" action="{{ isset($komisi) ? route('komisi.update', $komisi) : route('komisi.store') }}" class="relative space-y-10">
                        @csrf
                        @if(isset($komisi))
                            @method('PUT')
                        @endif

                        <div class="space-y-8">
                            <!-- Nama -->
                            <div class="space-y-3">
                                <label for="nama" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Komisi</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2h14z"></path></svg>
                                    </div>
                                    <input id="nama" type="text" name="nama" value="{{ old('nama', $komisi->nama ?? '') }}" required autofocus placeholder="Contoh: Komisi I" class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-orange-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="nama" class="mt-2" />
                            </div>

                            <!-- Keterangan -->
                            <div class="space-y-3">
                                <label for="keterangan" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Bidang / Keterangan</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-orange-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <input id="keterangan" type="text" name="keterangan" value="{{ old('keterangan', $komisi->keterangan ?? '') }}" required placeholder="Contoh: Bidang Pemerintahan dan Hukum" class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-orange-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="keterangan" class="mt-2" />
                            </div>
                        </div>

                        <div class="pt-10 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100">
                            <a href="{{ route('komisi.index') }}" class="w-full md:w-auto px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-rose-500 transition-colors duration-300 text-center">
                                Batalkan
                            </a>
                            <button type="submit" class="w-full md:w-auto group relative overflow-hidden bg-slate-900 text-white px-12 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl hover:shadow-orange-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                                <div class="absolute inset-0 bg-gradient-to-r from-orange-600 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <span class="relative">{{ isset($komisi) ? 'Simpan Perubahan' : 'Buat Komisi Baru' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
