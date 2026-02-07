<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Daftar Kegiatan Dinas
            </h2>
            <a href="{{ route('kegiatan-dinas.create') }}" style="background-color: #1e293b; color: white;" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-900 active:bg-slate-950 text-white px-5 py-2.5 rounded-xl font-bold shadow-md hover:shadow-lg transition-all duration-200 border border-slate-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Kegiatan
            </a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{ confirmingDeletion: false, deletingUrl: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <!-- Filter Section -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <form method="GET" action="{{ route('kegiatan-dinas.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Komisi</label>
                        <select name="komisi_id" class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Komisi</option>
                            @foreach($komisis as $komisi)
                            <option value="{{ $komisi->id }}" {{ request('komisi_id') == $komisi->id ? 'selected' : '' }}>
                                {{ $komisi->nama }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Jenis Dinas</label>
                        <select name="jenis_dinas" class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Jenis</option>
                            <option value="dalam" {{ request('jenis_dinas') == 'dalam' ? 'selected' : '' }}>Dinas Dalam</option>
                            <option value="luar" {{ request('jenis_dinas') == 'luar' ? 'selected' : '' }}>Dinas Luar</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-900 mb-2">Cari Kegiatan</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau lokasi..." class="w-full rounded-lg border-gray-400 text-slate-900 focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                            Filter
                        </button>
                        <a href="{{ route('kegiatan-dinas.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kegiatan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Komisi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peserta</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($kegiatanDinas as $kegiatan)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $kegiatan->nama_kegiatan }}</div>
                                    <div class="text-sm text-gray-500">{{ $kegiatan->lokasi }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-900">{{ $kegiatan->komisi->nama }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($kegiatan->jenis_dinas == 'dalam')
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Dalam
                                        </span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                            Luar
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $kegiatan->tanggal_mulai->format('d M Y') }}</div>
                                    <div class="text-xs text-gray-400">s/d {{ $kegiatan->tanggal_selesai->format('d M Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $kegiatan->durasi_hari }} hari
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $kegiatan->anggotas->count() }} orang
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex gap-2">
                                        <a href="{{ route('kegiatan-dinas.show', $kegiatan) }}" class="text-blue-600 hover:text-blue-900">Detail</a>
                                    <!-- Edit -->
                                        <a href="{{ route('kegiatan-dinas.edit', $kegiatan) }}" class="text-blue-600 hover:text-blue-900 border border-blue-200 rounded-lg p-1 hover:bg-blue-50 transition inline-block">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        <!-- Delete -->
                                        <button @click="confirmingDeletion = true; deletingUrl = '{{ route('kegiatan-dinas.destroy', $kegiatan) }}'" class="text-red-600 hover:text-red-900 border border-red-200 rounded-lg p-1 hover:bg-red-50 transition inline-block">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p class="mt-2">Belum ada data kegiatan dinas</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($kegiatanDinas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $kegiatanDinas->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
        <!-- Delete Confirmation Modal -->
        <div x-show="confirmingDeletion" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto px-4 py-6 sm:px-0" style="display: none;">
            <div x-show="confirmingDeletion" class="fixed inset-0 transition-all transform" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="confirmingDeletion = false">
                <div class="absolute inset-0 bg-slate-900 opacity-75"></div>
            </div>

            <div x-show="confirmingDeletion" class="mb-6 bg-white rounded-2xl overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg sm:mx-auto" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-800">
                        Konfirmasi Hapus
                    </h3>
                    <p class="mt-4 text-sm text-slate-600">
                        Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
                <div class="bg-slate-50 px-6 py-4 flex flex-row-reverse gap-3">
                     <form :action="deletingUrl" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="inline-flex justify-center w-full px-4 py-2 text-base font-bold text-white bg-red-600 border border-transparent rounded-xl shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Ya, Hapus
                        </button>
                    </form>
                    <button @click="confirmingDeletion = false" type="button" class="inline-flex justify-center w-full px-4 py-2 text-base font-bold text-slate-700 bg-white border border-slate-300 rounded-xl shadow-sm hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
