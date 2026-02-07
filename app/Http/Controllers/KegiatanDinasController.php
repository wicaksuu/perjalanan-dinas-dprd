<?php

namespace App\Http\Controllers;

use App\Models\KegiatanDinas;
use App\Models\Komisi;
use App\Models\Anggota;
use App\Models\Pegawai;
use App\Models\Pendamping;
use App\Models\PendampingKegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KegiatanDinasController extends Controller
{
    public function index(Request $request)
    {
        $query = KegiatanDinas::with(['komisi', 'anggotas']);

        // Filter by komisi
        if ($request->filled('komisi_id')) {
            $query->where('komisi_id', $request->komisi_id);
        }

        // Filter by jenis dinas
        if ($request->filled('jenis_dinas')) {
            $query->where('jenis_dinas', $request->jenis_dinas);
        }

        // Filter by date range
        if ($request->filled('tanggal_mulai')) {
            $query->where('tanggal_mulai', '>=', $request->tanggal_mulai);
        }
        if ($request->filled('tanggal_selesai')) {
            $query->where('tanggal_selesai', '<=', $request->tanggal_selesai);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('nama_kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $request->search . '%');
            });
        }

        $kegiatanDinas = $query->latest()->paginate(10);
        $komisis = Komisi::all();

        return view('kegiatan-dinas.index', compact('kegiatanDinas', 'komisis'));
    }

    public function create()
    {
        $komisis = Komisi::all();
        return view('kegiatan-dinas.create', compact('komisis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'komisi_id' => 'required|exists:komisis,id',
            'jenis_dinas' => 'required|in:dalam,luar',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
            'anggota_ids' => 'required|array|min:1',
            'anggota_ids.*' => 'exists:anggotas,id',
            'pendamping_ids' => 'required|array|size:2',
            'pendamping_ids.*' => 'exists:pendampings,id',
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        DB::beginTransaction();
        try {
            $kegiatan = KegiatanDinas::create([
                'komisi_id' => $validated['komisi_id'],
                'jenis_dinas' => $validated['jenis_dinas'],
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'lokasi' => $validated['lokasi'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'keterangan' => $validated['keterangan'] ?? null,
                'created_by' => Auth::id(),
            ]);

            // Attach anggota
            $kegiatan->anggotas()->attach($validated['anggota_ids']);

            // Attach pendamping wajib
            foreach ($validated['pendamping_ids'] as $pendampingId) {
                PendampingKegiatan::create([
                    'kegiatan_dinas_id' => $kegiatan->id,
                    'pendamping_id' => $pendampingId,
                    'jenis' => 'pendamping_wajib',
                ]);
            }

            // Attach pegawai setwan
            PendampingKegiatan::create([
                'kegiatan_dinas_id' => $kegiatan->id,
                'pegawai_id' => $validated['pegawai_id'],
                'jenis' => 'pegawai_setwan',
            ]);

            DB::commit();
            return redirect()->route('kegiatan-dinas.index')
                ->with('success', 'Kegiatan dinas berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(KegiatanDinas $kegiatanDina)
    {
        $kegiatanDina->load(['komisi', 'anggotas', 'pendampingKegiatans.pendamping', 'pendampingKegiatans.pegawai', 'creator']);
        return view('kegiatan-dinas.show', compact('kegiatanDina'));
    }

    public function edit(KegiatanDinas $kegiatanDina)
    {
        $kegiatanDina->load(['anggotas', 'pendampingKegiatans']);
        $komisis = Komisi::all();
        $anggotas = Anggota::where('komisi_id', $kegiatanDina->komisi_id)->get();
        $pendampings = Pendamping::where('komisi_id', $kegiatanDina->komisi_id)->get();
        $pegawais = Pegawai::all();

        return view('kegiatan-dinas.edit', compact('kegiatanDina', 'komisis', 'anggotas', 'pendampings', 'pegawais'));
    }

    public function update(Request $request, KegiatanDinas $kegiatanDina)
    {
        $validated = $request->validate([
            'komisi_id' => 'required|exists:komisis,id',
            'jenis_dinas' => 'required|in:dalam,luar',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
            'anggota_ids' => 'required|array|min:1',
            'anggota_ids.*' => 'exists:anggotas,id',
            'pendamping_ids' => 'required|array|size:2',
            'pendamping_ids.*' => 'exists:pendampings,id',
            'pegawai_id' => 'required|exists:pegawais,id',
        ]);

        DB::beginTransaction();
        try {
            $kegiatanDina->update([
                'komisi_id' => $validated['komisi_id'],
                'jenis_dinas' => $validated['jenis_dinas'],
                'nama_kegiatan' => $validated['nama_kegiatan'],
                'lokasi' => $validated['lokasi'],
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'tanggal_selesai' => $validated['tanggal_selesai'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            // Sync anggota
            $kegiatanDina->anggotas()->sync($validated['anggota_ids']);

            // Delete old pendamping and create new ones
            $kegiatanDina->pendampingKegiatans()->delete();

            foreach ($validated['pendamping_ids'] as $pendampingId) {
                PendampingKegiatan::create([
                    'kegiatan_dinas_id' => $kegiatanDina->id,
                    'pendamping_id' => $pendampingId,
                    'jenis' => 'pendamping_wajib',
                ]);
            }

            PendampingKegiatan::create([
                'kegiatan_dinas_id' => $kegiatanDina->id,
                'pegawai_id' => $validated['pegawai_id'],
                'jenis' => 'pegawai_setwan',
            ]);

            DB::commit();
            return redirect()->route('kegiatan-dinas.index')
                ->with('success', 'Kegiatan dinas berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(KegiatanDinas $kegiatanDina)
    {
        try {
            $kegiatanDina->delete();
            return redirect()->route('kegiatan-dinas.index')
                ->with('success', 'Kegiatan dinas berhasil dihapus.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // API endpoint untuk mendapatkan anggota berdasarkan komisi
    public function getAnggotaByKomisi($komisiId)
    {
        $komisi = Komisi::find($komisiId);
        if ($komisi && strtoupper($komisi->nama) === 'PIMPINAN DPRD') {
            // Logic khusus Pimpinan: Ambil berdasarkan Jabatan (untuk cover rangkap jabatan)
            // STRICT FILTER: Hanya Ketua DPRD & Wakil Ketua I/II/III (Excludes Ketua/Wakil Ketua Komisi)
            $anggotas = Anggota::whereIn('jabatan', [
                'Ketua DPRD', 
                'Wakil Ketua I', 
                'Wakil Ketua II', 
                'Wakil Ketua III'
            ])->get();
        } else {
            $anggotas = Anggota::where('komisi_id', $komisiId)->get();
        }
        return response()->json($anggotas);
    }

    // API endpoint untuk mendapatkan pendamping berdasarkan komisi
    public function getPendampingByKomisi($komisiId)
    {
        $pendampings = Pendamping::where('komisi_id', $komisiId)->get();
        return response()->json($pendampings);
    }
}
