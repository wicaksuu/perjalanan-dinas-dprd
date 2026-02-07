<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tambah Kegiatan Dinas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <form action="{{ route('kegiatan-dinas.store') }}" method="POST" id="kegiatanForm">
                    @csrf

                    @if($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Informasi Kegiatan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Informasi Kegiatan</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Komisi <span class="text-red-500">*</span></label>
                                <select name="komisi_id" id="komisi_id" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih Komisi</option>
                                    @foreach($komisis as $komisi)
                                    <option value="{{ $komisi->id }}" {{ old('komisi_id') == $komisi->id ? 'selected' : '' }}>
                                        {{ $komisi->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Dinas <span class="text-red-500">*</span></label>
                                <select name="jenis_dinas" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                                    <option value="">Pilih Jenis</option>
                                    <option value="dalam" {{ old('jenis_dinas') == 'dalam' ? 'selected' : '' }}>Dinas Dalam</option>
                                    <option value="luar" {{ old('jenis_dinas') == 'luar' ? 'selected' : '' }}>Dinas Luar</option>
                                </select>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-2">Nama Kegiatan <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Kunjungan Kerja ke Dinas Pendidikan">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-2">Lokasi <span class="text-red-500">*</span></label>
                                <input type="text" name="lokasi" value="{{ old('lokasi') }}" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Contoh: Dinas Pendidikan Kab. Madiun">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-slate-900 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-slate-900 mb-2">Keterangan</label>
                                <textarea name="keterangan" rows="3" class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Keterangan tambahan (opsional)">{{ old('keterangan') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Peserta Kegiatan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Peserta Kegiatan (Anggota DPRD)</h3>
                        <div id="anggotaContainer">
                            <p class="text-gray-500 text-sm">Pilih komisi terlebih dahulu untuk memilih anggota</p>
                        </div>
                    </div>

                    <!-- Pendamping -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Pendamping Wajib (2 Orang) <span class="text-red-500">*</span></h3>
                        <div id="pendampingContainer">
                            <p class="text-gray-500 text-sm">Pilih komisi terlebih dahulu untuk memilih pendamping</p>
                        </div>
                    </div>

                    <!-- Pegawai Setwan -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Pegawai Setwan (1 Orang) <span class="text-red-500">*</span></h3>
                        <div>
                            <select name="pegawai_id" required class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Pilih Pegawai Setwan</option>
                                @foreach(\App\Models\Pegawai::all() as $pegawai)
                                <option value="{{ $pegawai->id }}" {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->nama }} - {{ $pegawai->jabatan }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-end gap-4 pt-6 border-t">
                        <a href="{{ route('kegiatan-dinas.index') }}" class="px-6 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg font-medium transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                            Simpan Kegiatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('komisi_id').addEventListener('change', function() {
            const komisiId = this.value;
            
            if (!komisiId) {
                document.getElementById('anggotaContainer').innerHTML = '<p class="text-gray-500 text-sm">Pilih komisi terlebih dahulu untuk memilih anggota</p>';
                document.getElementById('pendampingContainer').innerHTML = '<p class="text-gray-500 text-sm">Pilih komisi terlebih dahulu untuk memilih pendamping</p>';
                return;
            }

            // Load Anggota
            fetch(`/api/anggota-by-komisi/${komisiId}`)
                .then(response => response.json())
                .then(data => {
                    let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-3">';
                    data.forEach(anggota => {
                        html += `
                            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="anggota_ids[]" value="${anggota.id}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-3">
                                <div>
                                    <div class="font-medium text-gray-900">${anggota.nama}</div>
                                    <div class="text-sm text-gray-500">${anggota.jabatan || 'Anggota'}</div>
                                </div>
                            </label>
                        `;
                    });
                    html += '</div>';
                    document.getElementById('anggotaContainer').innerHTML = html;
                });

            // Load Pendamping
            fetch(`/api/pendamping-by-komisi/${komisiId}`)
                .then(response => response.json())
                .then(data => {
                    let html = '<p class="text-sm text-gray-600 mb-3">Pilih 2 pendamping wajib:</p><div class="grid grid-cols-1 md:grid-cols-2 gap-3">';
                    data.forEach(pendamping => {
                        html += `
                            <label class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer">
                                <input type="checkbox" name="pendamping_ids[]" value="${pendamping.id}" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 mr-3 pendamping-checkbox">
                                <div>
                                    <div class="font-medium text-gray-900">${pendamping.nama}</div>
                                    <div class="text-sm text-gray-500">${pendamping.jabatan || 'Pendamping'}</div>
                                </div>
                            </label>
                        `;
                    });
                    html += '</div>';
                    document.getElementById('pendampingContainer').innerHTML = html;

                    // Limit pendamping to 2
                    document.querySelectorAll('.pendamping-checkbox').forEach(checkbox => {
                        checkbox.addEventListener('change', function() {
                            const checked = document.querySelectorAll('.pendamping-checkbox:checked');
                            if (checked.length > 2) {
                                this.checked = false;
                                alert('Maksimal 2 pendamping wajib');
                            }
                        });
                    });
                });
        });
    </script>
    @endpush
</x-app-layout>
