<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Detail Kegiatan Dinas
            </h2>
            <div class="flex gap-2">
                <a href="{{ route('kegiatan-dinas.edit', $kegiatanDina) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                    Edit
                </a>
                <a href="{{ route('kegiatan-dinas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Informasi Kegiatan -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                <div class="flex items-start justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ $kegiatanDina->nama_kegiatan }}</h3>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $kegiatanDina->lokasi }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $kegiatanDina->tanggal_mulai->format('d M Y') }} - {{ $kegiatanDina->tanggal_selesai->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    @if($kegiatanDina->jenis_dinas == 'dalam')
                        <span class="px-4 py-2 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                            Dinas Dalam
                        </span>
                    @else
                        <span class="px-4 py-2 text-sm font-semibold rounded-full bg-purple-100 text-purple-800">
                            Dinas Luar
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 rounded-lg p-4">
                        <p class="text-sm text-blue-600 font-medium mb-1">Komisi</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $kegiatanDina->komisi->nama }}</p>
                        <p class="text-sm text-gray-600">{{ $kegiatanDina->komisi->keterangan }}</p>
                    </div>

                    <div class="bg-green-50 rounded-lg p-4">
                        <p class="text-sm text-green-600 font-medium mb-1">Durasi</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $kegiatanDina->durasi_hari }} Hari</p>
                        <p class="text-sm text-gray-600">{{ $kegiatanDina->tanggal_mulai->format('d/m/Y') }} - {{ $kegiatanDina->tanggal_selesai->format('d/m/Y') }}</p>
                    </div>

                    <div class="bg-purple-50 rounded-lg p-4">
                        <p class="text-sm text-purple-600 font-medium mb-1">Total Peserta</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $kegiatanDina->anggotas->count() }} Anggota</p>
                        <p class="text-sm text-gray-600">+ 3 Pendamping</p>
                    </div>
                </div>

                @if($kegiatanDina->keterangan)
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-sm text-gray-600 font-medium mb-2">Keterangan:</p>
                    <p class="text-gray-800">{{ $kegiatanDina->keterangan }}</p>
                </div>
                @endif
            </div>

            <!-- Peserta Kegiatan -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Peserta Kegiatan (Anggota DPRD)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($kegiatanDina->anggotas as $anggota)
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <div class="bg-blue-100 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $anggota->nama }}</p>
                            <p class="text-sm text-gray-600">{{ $anggota->jabatan }}</p>
                            @if($anggota->no_hp)
                            <p class="text-xs text-gray-500">{{ $anggota->no_hp }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Pendamping -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b">Pendamping Kegiatan</h3>
                
                <div class="mb-6">
                    <h4 class="text-md font-medium text-gray-700 mb-3">Pendamping Wajib (2 Orang)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($kegiatanDina->pendampingKegiatans->where('jenis', 'pendamping_wajib') as $pk)
                        <div class="flex items-center p-4 bg-green-50 rounded-lg">
                            <div class="bg-green-100 rounded-full p-3 mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $pk->pendamping->nama }}</p>
                                <p class="text-sm text-gray-600">{{ $pk->pendamping->jabatan }}</p>
                                @if($pk->pendamping->no_hp)
                                <p class="text-xs text-gray-500">{{ $pk->pendamping->no_hp }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h4 class="text-md font-medium text-gray-700 mb-3">Pegawai Setwan (1 Orang)</h4>
                    @foreach($kegiatanDina->pendampingKegiatans->where('jenis', 'pegawai_setwan') as $pk)
                    <div class="flex items-center p-4 bg-purple-50 rounded-lg">
                        <div class="bg-purple-100 rounded-full p-3 mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $pk->pegawai->nama }}</p>
                            <p class="text-sm text-gray-600">{{ $pk->pegawai->jabatan }}</p>
                            <p class="text-xs text-gray-500">NIP: {{ $pk->pegawai->nip }}</p>
                            @if($pk->pegawai->no_hp)
                            <p class="text-xs text-gray-500">{{ $pk->pegawai->no_hp }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                @if($kegiatanDina->creator)
                <div class="mt-6 pt-6 border-t text-sm text-gray-500">
                    <p>Dibuat oleh: <span class="font-medium">{{ $kegiatanDina->creator->name }}</span></p>
                    <p>Pada: {{ $kegiatanDina->created_at->format('d M Y, H:i') }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
