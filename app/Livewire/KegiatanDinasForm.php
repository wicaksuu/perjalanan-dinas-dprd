<?php

namespace App\Livewire;

use App\Models\Anggota;
use App\Models\KegiatanDinas;
use App\Models\Komisi;
use App\Models\Pegawai;
use App\Models\Pendamping;
use App\Models\PendampingKegiatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class KegiatanDinasForm extends Component
{
    public $komisi_id = '';
    public $jenis_dinas = '';
    public $nama_kegiatan = '';
    public $lokasi = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $keterangan = '';
    
    // Global Budget Components (Attached to Kegiatan)
    public $biaya_bbm = 0;
    public $biaya_penginapan = 0;
    public $biaya_transportasi = 0;
    
    public $anggota_ids = [];
    public $pendamping_ids = [];
    public $pegawai_ids = [];

    // Individual Nominals
    // Individual Daily Rates
    public $anggota_budgets = []; // [id => ['uang_harian' => 0]]
    public $pendamping_budgets = [];
    public $pegawai_budgets = [];
    
    // Pimpinan Specific
    public $pimpinan_pendampings = []; // [anggota_id => [pendamping_id_1, ...]]

    // Search Properties
    public $searchPegawai = '';
    public $searchPendamping = '';
    public $searchAnggota = '';

    // Computed / Dynamic Data
    public $availableAnggotas = [];
    public $availablePendampings = [];

    public $currentStep = 1;
    public $kegiatanDinasId = null;
    public $isEdit = false;
    public $isReadOnly = false;

    public function mount($kegiatan_dinas = null)
    {
        if ($kegiatan_dinas) {
            $kegiatan = KegiatanDinas::with(['anggotas', 'pendampingKegiatans'])->find($kegiatan_dinas);
            
            if (!$kegiatan && $kegiatan_dinas instanceof KegiatanDinas) {
                $kegiatan = $kegiatan_dinas;
            }

            if ($kegiatan) {
                $this->kegiatanDinasId = $kegiatan->id;
                $this->isEdit = true;
                $this->komisi_id = $kegiatan->komisi_id;
                $this->jenis_dinas = $kegiatan->jenis_dinas;
                $this->nama_kegiatan = $kegiatan->nama_kegiatan;
                $this->lokasi = $kegiatan->lokasi;
                $this->tanggal_mulai = $kegiatan->tanggal_mulai->format('Y-m-d');
                $this->tanggal_selesai = $kegiatan->tanggal_selesai->format('Y-m-d');
                $this->keterangan = $kegiatan->keterangan;
                $this->biaya_bbm = $kegiatan->biaya_bbm;
                $this->biaya_penginapan = $kegiatan->biaya_penginapan;
                $this->biaya_transportasi = $kegiatan->biaya_transportasi;

                $this->updatedKomisiId($this->komisi_id);

                foreach ($kegiatan->anggotas as $anggota) {
                    $this->anggota_ids[] = (string) $anggota->id;
                    $this->anggota_budgets[$anggota->id] = [
                        'uang_harian' => $anggota->pivot->uang_harian,
                    ];
                }
                
                foreach ($kegiatan->pendampingKegiatans as $pk) {
                    if ($pk->jenis == 'pendamping_wajib') {
                        $this->pendamping_ids[] = (string) $pk->pendamping_id;
                        $this->pendamping_budgets[$pk->pendamping_id] = [
                            'uang_harian' => $pk->uang_harian,
                        ];
                        
                        // Populate Pimpinan Mapping
                        if ($pk->related_anggota_id) {
                            $this->pimpinan_pendampings[$pk->related_anggota_id][] = (string) $pk->pendamping_id;
                        }
                    } else {
                        $this->pegawai_ids[] = (string) $pk->pegawai_id;
                        $this->pegawai_budgets[$pk->pegawai_id] = [
                            'uang_harian' => $pk->uang_harian,
                        ];
                    }
                }
                if ($kegiatan->is_ended) {
                    $this->isReadOnly = true;
                }
            }
        }
    }

    public function nextStep()
    {
        $this->validateStep();
        $this->currentStep++;
        $this->dispatch('scrollTop');
    }

    public function previousStep()
    {
        $this->currentStep--;
        $this->dispatch('scrollTop');
    }

    private function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'komisi_id' => 'required|exists:komisis,id',
                'jenis_dinas' => 'required|in:dalam,luar',
                'nama_kegiatan' => 'required|string|max:255',
                'lokasi' => 'required|string|max:255',
                'tanggal_mulai' => 'required|date',
                'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'anggota_ids' => 'required|array|min:1',
                'anggota_ids.*' => 'exists:anggotas,id',
                'pendamping_ids' => 'required|array|min:1',
                'pendamping_ids.*' => 'exists:pendampings,id',
                'pegawai_ids' => 'required|array|min:1',
                'pegawai_ids.*' => 'exists:pegawais,id',
                'anggota_budgets.*.uang_harian' => 'nullable|numeric|min:0',
                'pendamping_budgets.*.uang_harian' => 'nullable|numeric|min:0',
                'pegawai_budgets.*.uang_harian' => 'nullable|numeric|min:0',
            ]);
        }
    }

    protected function rules() 
    {
        return [
            'komisi_id' => 'required|exists:komisis,id',
            'jenis_dinas' => 'required|in:dalam,luar',
            'nama_kegiatan' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'keterangan' => 'nullable|string',
            'biaya_bbm' => 'nullable|numeric|min:0',
            'biaya_penginapan' => 'nullable|numeric|min:0',
            'biaya_transportasi' => 'nullable|numeric|min:0',
            'anggota_ids' => 'required|array|min:1',
            'anggota_ids.*' => 'exists:anggotas,id',
            'pendamping_ids' => 'required|array|min:1',
            'pendamping_ids.*' => 'exists:pendampings,id',
            'pegawai_ids' => 'required|array|min:1',
            'pegawai_ids.*' => 'exists:pegawais,id',
            
            'anggota_budgets.*.uang_harian' => 'nullable|numeric|min:0',
            'pendamping_budgets.*.uang_harian' => 'nullable|numeric|min:0',
            'pegawai_budgets.*.uang_harian' => 'nullable|numeric|min:0',
        ];
    }

    public function updatedPimpinanPendampings()
    {
        // Sync to main pendamping_ids for validation and storage
        $allIds = [];
        if (is_array($this->pimpinan_pendampings)) {
            foreach ($this->pimpinan_pendampings as $ids) {
                if (is_array($ids)) {
                    $allIds = array_merge($allIds, $ids);
                }
            }
        }
        $this->pendamping_ids = array_values(array_unique($allIds));
    }

    // Limit removed as per user request
    public function updatedPendampingIds()
    {
        // No restriction
    }

    public function save()
    {
        if ($this->isReadOnly) {
            session()->flash('error', 'Kegiatan ini telah berakhir dan tidak dapat diedit lagi.');
            return;
        }

        $this->validate();

        DB::beginTransaction();
        try {
            if ($this->isEdit) {
                $kegiatan = KegiatanDinas::find($this->kegiatanDinasId);
                $kegiatan->update([
                    'komisi_id' => $this->komisi_id,
                    'jenis_dinas' => $this->jenis_dinas,
                    'nama_kegiatan' => $this->nama_kegiatan,
                    'lokasi' => $this->lokasi,
                    'tanggal_mulai' => $this->tanggal_mulai,
                    'tanggal_selesai' => $this->tanggal_selesai,
                    'keterangan' => $this->keterangan ?: null,
                    'biaya_bbm' => $this->biaya_bbm ?: 0,
                    'biaya_penginapan' => $this->biaya_penginapan ?: 0,
                    'biaya_transportasi' => $this->biaya_transportasi ?: 0,
                    'updated_by' => Auth::id(),
                ]);
                $message = 'Kegiatan dinas berhasil diperbarui.';
            } else {
                $kegiatan = KegiatanDinas::create([
                    'komisi_id' => $this->komisi_id,
                    'jenis_dinas' => $this->jenis_dinas,
                    'nama_kegiatan' => $this->nama_kegiatan,
                    'lokasi' => $this->lokasi,
                    'tanggal_mulai' => $this->tanggal_mulai,
                    'tanggal_selesai' => $this->tanggal_selesai,
                    'keterangan' => $this->keterangan ?: null,
                    'biaya_bbm' => $this->biaya_bbm ?: 0,
                    'biaya_penginapan' => $this->biaya_penginapan ?: 0,
                    'biaya_transportasi' => $this->biaya_transportasi ?: 0,
                    'created_by' => Auth::id(),
                ]);
                $message = 'Kegiatan dinas berhasil ditambahkan.';
            }

            // DURASI
            $durasi = $this->calculateDurasi($this->tanggal_mulai, $this->tanggal_selesai);

            // Sync Anggota
            $syncData = [];
            foreach ($this->anggota_ids as $id) {
                $harian = $this->anggota_budgets[$id]['uang_harian'] ?? 0;
                $total = $harian * $durasi;

                $syncData[$id] = [
                    'uang_harian' => $harian,
                    'nominal' => $total
                ];
            }
            $kegiatan->anggotas()->sync($syncData);

            // Re-create Pendamping & Pegawai
            $kegiatan->pendampingKegiatans()->delete();
            
            foreach ($this->pendamping_ids as $pendampingId) {
                $harian = $this->pendamping_budgets[$pendampingId]['uang_harian'] ?? 0;
                $total = $harian * $durasi;

                // Find if this pendamping belongs to a specific Anggota (Pimpinan)
                $relatedAnggotaId = null;
                foreach ($this->pimpinan_pendampings as $anggotaId => $pIds) {
                    if (is_array($pIds) && in_array($pendampingId, $pIds)) {
                        $relatedAnggotaId = $anggotaId;
                        break;
                    }
                }

                PendampingKegiatan::create([
                    'kegiatan_dinas_id' => $kegiatan->id,
                    'pendamping_id' => $pendampingId,
                    'jenis' => 'pendamping_wajib',
                    'uang_harian' => $harian,
                    'nominal' => $total,
                    'related_anggota_id' => $relatedAnggotaId,
                ]);
            }

            foreach ($this->pegawai_ids as $pegawaiId) {
                $harian = $this->pegawai_budgets[$pegawaiId]['uang_harian'] ?? 0;
                $total = $harian * $durasi;

                PendampingKegiatan::create([
                    'kegiatan_dinas_id' => $kegiatan->id,
                    'pegawai_id' => $pegawaiId,
                    'jenis' => 'pegawai_setwan',
                    'uang_harian' => $harian,
                    'nominal' => $total,
                ]);
            }

            session()->flash('success', $message);

            DB::commit();
            return redirect()->route('kegiatan-dinas.index');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function updatedAnggotaIds($value)
    {
        // Logic Otomatis Pilih Pendamping untuk Pimpinan
        // REVISI: User meminta MANUAL selection.
        // Jadi kita tidak auto-select pendamping yang assigned.
        // User hanya ingin melihat daftarnya (kartu muncul) lalu pilih sendiri.
        
        // Kode auto-select dihapus/dikomentari.
    }

    public function updatedKomisiId($value)
    {
        // Don't reset IDs if we are in Edit mode AND the value hasn't actually changed from initial
        
        if ($value) {
            $komisi = Komisi::find($value);
            
            if ($komisi) {
                if (strtoupper($komisi->nama) === 'PIMPINAN DPRD') {
                    // DUAL ROLES SUPPORT:
                    // Filter by Title (Jabatan) instead of Commission ID
                    // This allows members registered in other commissions to still appear as Pimpinan logic
                    // STRICT FILTER: Hanya Pimpinan DPRD (Excludes Komisi Leaders)
                    $this->availableAnggotas = Anggota::whereIn('jabatan', [
                        'Ketua DPRD', 
                        'Wakil Ketua I', 
                        'Wakil Ketua II', 
                        'Wakil Ketua III'
                    ])->get();
                } else {
                    // Standard Commission Logic
                    $this->availableAnggotas = Anggota::where('komisi_id', $value)->get();
                }
            }
            
            if ($komisi && strtoupper($komisi->nama) === 'PIMPINAN DPRD') {
                // Pimpinan can select ANY pendamping
                $this->availablePendampings = Pendamping::with('pegawai')->get();
            } else {
                $this->availablePendampings = Pendamping::with('pegawai')->where('komisi_id', $value)->get();
            }
        } else {
            $this->availableAnggotas = collect();
            $this->availablePendampings = collect();
        }


        // Only clear selections if we are NOT mounting (checking if property is already set helps, but safer to trust user interaction)
        // However, if user changes Komisi, previous members/pendampings are likely invalid.
        // We need to differentiate "User changed Komisi" vs "System mounted Komisi".
        // The updated hook only runs on user interaction.
        if (!$this->isEdit) {
             $this->anggota_ids = [];
             $this->pendamping_ids = [];
        } 
        // If edit, checking if the selected ids are still valid for new komisi is complex, 
        // simplifying: If user changes Komisi manually during Edit, we probably should clear. 
        // But for now let's just keep the fetch logic.
    }



    public function render()
    {
        // 1. Identify Pegawai IDs that are currently selected as Pendamping
        $selectedPendampings = Pendamping::whereIn('id', $this->pendamping_ids)->get();
        // These Pegawai IDs should be excluded from the "Staf" list
        $excludedPegawaiIds = $selectedPendampings->pluck('pegawai_id')->filter()->toArray();

        // 2. Identify Pendamping IDs that should be excluded because their Pegawai is selected as Staff
        // If a Pegawai is selected as Staff, we shouldn't allow selecting them as Pendamping
        $excludedPendampingIds = Pendamping::whereIn('pegawai_id', $this->pegawai_ids)->pluck('id')->toArray();

        // 3. Filter "Staf Sekretariat" Data
        $pegawais = Pegawai::query()
            ->when($this->searchPegawai, function($query) {
                $query->where('nama', 'like', '%' . $this->searchPegawai . '%')
                      ->orWhere('nip', 'like', '%' . $this->searchPegawai . '%')
                      ->orWhere('jabatan', 'like', '%' . $this->searchPegawai . '%');
            })
            ->whereNotIn('id', $excludedPegawaiIds) // Exclude duplicate selection
            ->get();

        // Ensure currently selected staff remain visible even if criteria change
        if ($this->pegawai_ids) {
            $selectedPegawais = Pegawai::whereIn('id', $this->pegawai_ids)->get();
            $pegawais = $pegawais->merge($selectedPegawais)->unique('id');
        }

        // 4. Filter "Pendamping" Data
        // Filter $availablePendampings (loaded in updatedKomisiId)
        $filteredPendampings = collect($this->availablePendampings)->filter(function($p) use ($excludedPendampingIds) {
             return !in_array($p->id, $excludedPendampingIds);
        });

        return view('livewire.kegiatan-dinas-form', [
            'komisis' => Komisi::all(),
            'pegawais' => $pegawais,
            'filteredPendampings' => $filteredPendampings,
        ])->layout('layouts.app');
    }

    private function calculateDurasi($start, $end)
    {
        if (!$start || !$end) return 0;
        return (int) Carbon::parse($start)->diffInDays(Carbon::parse($end)) + 1;
    }
}
