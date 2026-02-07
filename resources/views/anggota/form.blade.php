<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-500/10 text-blue-600 text-[10px] font-black uppercase tracking-wider border border-blue-100">Anggota Dewan</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    {{ isset($anggota) ? 'Perbarui' : 'Tambah' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">Data</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Lengkapi informasi detail anggota DPRD Kabupaten Madiun</p>
            </div>
            <a href="{{ route('anggota.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-all duration-300">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar
            </a>
        </div>
    </x-slot>

    <div class="py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white/80 backdrop-blur-xl rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-white overflow-hidden animate-fade-in-up" style="animation-delay: 100ms;">
                <div class="relative p-10 md:p-14">
                    <!-- Decor -->
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>

                    <form method="POST" action="{{ isset($anggota) ? route('anggota.update', $anggota) : route('anggota.store') }}" class="relative space-y-10">
                        @csrf
                        @if(isset($anggota))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                            <!-- Nama -->
                            <div class="col-span-1 md:col-span-2 space-y-3">
                                <label for="nama" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Lengkap (dengan gelar)</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input id="nama" type="text" name="nama" value="{{ old('nama', $anggota->nama ?? '') }}" required autofocus placeholder="Masukkan nama lengkap..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="nama" class="mt-2" />
                            </div>

                            <!-- Komisi -->
                            <div class="space-y-3">
                                <label for="komisi_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Komisi</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2h14z"></path></svg>
                                    </div>
                                    <select name="komisi_id" id="komisi_id" required class="w-full pl-14 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 appearance-none">
                                        <option value="" class="text-slate-400">Pilih Komisi...</option>
                                        @foreach($komisis as $komisi)
                                            <option value="{{ $komisi->id }}" {{ (old('komisi_id', $anggota->komisi_id ?? '') == $komisi->id) ? 'selected' : '' }}>
                                                {{ $komisi->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <x-input-error for="komisi_id" class="mt-2" />
                            </div>

                            <!-- Jabatan -->
                            <div class="space-y-3">
                                <label for="jabatan" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jabatan</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <select name="jabatan" id="jabatan" required class="w-full pl-14 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 appearance-none">
                                        <option value="Anggota" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Anggota') ? 'selected' : '' }}>Anggota</option>
                                        <option value="Ketua DPRD" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Ketua DPRD') ? 'selected' : '' }}>Ketua DPRD</option>
                                        <option value="Wakil Ketua I" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Wakil Ketua I') ? 'selected' : '' }}>Wakil Ketua I</option>
                                        <option value="Wakil Ketua II" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Wakil Ketua II') ? 'selected' : '' }}>Wakil Ketua II</option>
                                        <option value="Wakil Ketua III" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Wakil Ketua III') ? 'selected' : '' }}>Wakil Ketua III</option>
                                        <option value="Ketua Komisi" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Ketua Komisi') ? 'selected' : '' }}>Ketua Komisi</option>
                                        <option value="Wakil Ketua Komisi" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Wakil Ketua Komisi') ? 'selected' : '' }}>Wakil Ketua Komisi</option>
                                        <option value="Sekretaris Komisi" {{ (old('jabatan', $anggota->jabatan ?? '') == 'Sekretaris Komisi') ? 'selected' : '' }}>Sekretaris Komisi</option>
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <x-input-error for="jabatan" class="mt-2" />
                            </div>

                            <!-- NIK / NIP -->
                            <div class="space-y-3">
                                <label for="nik" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">NIP / ID Anggota</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-4 0a2 2 0 012-2h2a2 2 0 012 2v1m-4 0h4"></path></svg>
                                    </div>
                                    <input id="nik" type="text" name="nik" value="{{ old('nik', $anggota->nik ?? '') }}" placeholder="Masukkan NIP atau ID..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="nik" class="mt-2" />
                            </div>

                            <!-- Kontak -->
                            <div class="space-y-3">
                                <label for="no_hp" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nomor WhatsApp</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $anggota->no_hp ?? '') }}" placeholder="08..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="no_hp" class="mt-2" />
                            </div>

                            <!-- Alamat -->
                            <div class="col-span-1 md:col-span-2 space-y-3">
                                <label for="alamat" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Tinggal</label>
                                <textarea name="alamat" id="alamat" rows="4" placeholder="Ketik alamat lengkap di sini..." class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 resize-none">{{ old('alamat', $anggota->alamat ?? '') }}</textarea>
                                <x-input-error for="alamat" class="mt-2" />
                            </div>
                        </div>

                        <div class="pt-10 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100">
                            <a href="{{ route('anggota.index') }}" class="w-full md:w-auto px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-rose-500 transition-colors duration-300 text-center">
                                Batalkan
                            </a>
                            <button type="submit" class="w-full md:w-auto group relative overflow-hidden bg-slate-900 text-white px-12 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl hover:shadow-blue-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <span class="relative">{{ isset($anggota) ? 'Simpan Perubahan' : 'Daftarkan Anggota' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
