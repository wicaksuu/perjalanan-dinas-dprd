<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row justify-between items-center gap-6 animate-fade-in-up">
            <div class="space-y-1 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start gap-2 mb-1">
                    <span class="px-2.5 py-0.5 rounded-full bg-indigo-500/10 text-indigo-600 text-[10px] font-black uppercase tracking-wider border border-indigo-100">Pendamping Komisi</span>
                </div>
                <h2 class="font-black text-3xl text-slate-900 leading-tight tracking-tight">
                    {{ isset($pendamping) ? 'Perbarui' : 'Tambah' }} <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600">Pendamping</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Lengkapi data tenaga ahli dan pendamping lapangan</p>
            </div>
            <a href="{{ route('pendamping.index') }}" class="group flex items-center gap-2 text-slate-400 hover:text-slate-900 font-bold text-xs uppercase tracking-widest transition-all duration-300">
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
                    <div class="absolute -top-24 -right-24 w-64 h-64 bg-indigo-500/5 rounded-full blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-violet-500/5 rounded-full blur-3xl"></div>

                    <form method="POST" action="{{ isset($pendamping) ? route('pendamping.update', $pendamping) : route('pendamping.store') }}" class="relative space-y-10">
                        @csrf
                        @if(isset($pendamping))
                            @method('PUT')
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8">
                            <!-- Pegawai / Staf Setwan -->
                            <div class="col-span-1 md:col-span-2 space-y-3">
                                <label for="pegawai_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Pilih Staf Setwan <span class="text-rose-500">*</span></label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    </div>
                                    <select name="pegawai_id" id="pegawai_id" required class="w-full pl-14 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 appearance-none">
                                        <option value="">Pilih Staf...</option>
                                        @foreach($pegawais as $pegawai)
                                            <option value="{{ $pegawai->id }}" {{ (old('pegawai_id', $pendamping->pegawai_id ?? '') == $pegawai->id) ? 'selected' : '' }}>
                                                {{ $pegawai->nama }} ({{ $pegawai->jabatan }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <x-input-error for="pegawai_id" class="mt-2" />
                            </div>

                            <!-- Nama (Override) -->
                            <div class="col-span-1 md:col-span-2 space-y-3">
                                <label for="nama" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nama Pendamping (Opsional Override)</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <input id="nama" type="text" name="nama" value="{{ old('nama', $pendamping->nama ?? '') }}" placeholder="Kosongkan jika menggunakan nama asli staf..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="nama" class="mt-2" />
                            </div>

                            <!-- NIP (Override) -->
                            <div class="space-y-3">
                                <label for="nip" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">NIP / ID (Override)</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-4 0a2 2 0 012-2h2a2 2 0 012 2v1m-4 0h4"></path></svg>
                                    </div>
                                    <input id="nip" type="text" name="nip" value="{{ old('nip', $pendamping->nip ?? '') }}" placeholder="Kosongkan jika menggunakan NIP staf..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="nip" class="mt-2" />
                            </div>

                            <!-- Komisi -->
                            <div class="space-y-3">
                                <label for="komisi_id" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Penugasan Komisi</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v11a2 2 0 002 2h14z"></path></svg>
                                    </div>
                                    <select name="komisi_id" id="komisi_id" required class="w-full pl-14 pr-10 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 appearance-none">
                                        <option value="" class="text-slate-400">Pilih Komisi...</option>
                                        @foreach($komisis as $komisi)
                                            <option value="{{ $komisi->id }}" {{ (old('komisi_id', $pendamping->komisi_id ?? '') == $komisi->id) ? 'selected' : '' }}>
                                                {{ $komisi->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Anggota (Khusus Pimpinan) -->
                            <div class="space-y-3 hidden" id="anggota_container">
                                <label for="anggota_id" class="block text-[10px] font-black text-rose-500 uppercase tracking-[0.2em] ml-1">ASSIGNED TO / KHUSUS UNTUK PIMPINAN</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-rose-400 group-focus-within:text-rose-600 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    </div>
                                    <select name="anggota_id" id="anggota_id" class="w-full pl-14 pr-10 py-4 bg-rose-50 border-none rounded-2xl text-rose-900 font-bold focus:ring-2 focus:ring-rose-500/20 transition-all duration-300 appearance-none">
                                        <option value="">-- Pilih Pimpinan (Opsional) --</option>
                                        <!-- Populated via JS -->
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 text-rose-400 pointer-events-none">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                                <p class="text-[9px] font-bold text-rose-400/80 ml-2">Jika dipilih, pendamping ini akan otomatis muncul saat membuat kegiatan untuk Pimpinan tersebut.</p>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const komisiSelect = document.getElementById('komisi_id');
                                    const anggotaContainer = document.getElementById('anggota_container');
                                    const anggotaSelect = document.getElementById('anggota_id');
                                    const currentAnggotaId = "{{ old('anggota_id', $pendamping->anggota_id ?? '') }}";

                                    function checkKomisi() {
                                        const selectedOption = komisiSelect.options[komisiSelect.selectedIndex];
                                        const text = selectedOption.text.toUpperCase();
                                        
                                        if (text.includes('PIMPINAN DPRD')) {
                                            anggotaContainer.classList.remove('hidden');
                                            fetchAnggota(komisiSelect.value);
                                        } else {
                                            anggotaContainer.classList.add('hidden');
                                            anggotaSelect.innerHTML = '<option value="">-- Pilih Pimpinan (Opsional) --</option>';
                                        }
                                    }

                                    function fetchAnggota(komisiId) {
                                        fetch(`/api/anggota-by-komisi/${komisiId}`)
                                            .then(response => response.json())
                                            .then(data => {
                                                let options = '<option value="">-- Pilih Pimpinan (Opsional) --</option>';
                                                data.forEach(anggota => {
                                                    const selected = anggota.id == currentAnggotaId ? 'selected' : '';
                                                    options += `<option value="${anggota.id}" ${selected}>${anggota.nama} - ${anggota.jabatan}</option>`;
                                                });
                                                anggotaSelect.innerHTML = options;
                                            });
                                    }

                                    komisiSelect.addEventListener('change', checkKomisi);
                                    
                                    // Run on load if needed
                                    if(komisiSelect.value) {
                                        checkKomisi();
                                    }
                                });
                            </script>

                            <!-- Jabatan (Override) -->
                            <div class="space-y-3">
                                <label for="jabatan" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Jabatan (Override)</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                    </div>
                                    <input id="jabatan" type="text" name="jabatan" value="{{ old('jabatan', $pendamping->jabatan ?? '') }}" placeholder="Kosongkan jika menggunakan jabatan staf..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="jabatan" class="mt-2" />
                            </div>

                            <!-- No HP -->
                            <div class="space-y-3">
                                <label for="no_hp" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Nomor WhatsApp</label>
                                <div class="relative group">
                                    <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-indigo-500 transition-colors duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                    <input id="no_hp" type="text" name="no_hp" value="{{ old('no_hp', $pendamping->no_hp ?? '') }}" placeholder="08..." class="w-full pl-14 pr-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300">
                                </div>
                                <x-input-error for="no_hp" class="mt-2" />
                            </div>

                            <!-- Alamat -->
                            <div class="col-span-1 md:col-span-2 space-y-3">
                                <label for="alamat" class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Domisili</label>
                                <textarea name="alamat" id="alamat" rows="4" placeholder="Ketik alamat lengkap pendamping..." class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl text-slate-900 font-bold placeholder:text-slate-300 placeholder:font-medium focus:ring-2 focus:ring-indigo-500/20 transition-all duration-300 resize-none">{{ old('alamat', $pendamping->alamat ?? '') }}</textarea>
                                <x-input-error for="alamat" class="mt-2" />
                            </div>
                        </div>

                        <div class="pt-10 flex flex-col md:flex-row items-center justify-end gap-4 border-t border-slate-100">
                            <a href="{{ route('pendamping.index') }}" class="w-full md:w-auto px-10 py-4 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-rose-500 transition-colors duration-300 text-center">
                                Batalkan
                            </a>
                            <button type="submit" class="w-full md:w-auto group relative overflow-hidden bg-slate-900 text-white px-12 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl hover:shadow-indigo-500/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-violet-600 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                <span class="relative">{{ isset($pendamping) ? 'Simpan Perubahan' : 'Daftarkan Pendamping' }}</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
