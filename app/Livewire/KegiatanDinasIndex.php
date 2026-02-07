<?php

namespace App\Livewire;

use App\Models\KegiatanDinas;
use App\Models\Komisi;
use Livewire\Component;

class KegiatanDinasIndex extends Component
{
    public $search = '';
    public $komisi_id = '';
    public $jenis_dinas = '';
    public $tanggal_mulai = '';
    public $tanggal_selesai = '';
    public $status = '';
    public $amount = 10;
    public $hasMore = true;

    public $confirmingDeletion = false;
    public $deletingId = null;

    public $showingDetail = false;
    public $selectedKegiatan = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'komisi_id' => ['except' => ''],
        'jenis_dinas' => ['except' => ''],
        'tanggal_mulai' => ['except' => ''],
        'tanggal_selesai' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function loadMore()
    {
        $this->amount += 10;
    }

    public function showDetail($id)
    {
        $this->selectedKegiatan = KegiatanDinas::with([
            'komisi', 
            'anggotas', 
            'pendampingKegiatans.pendamping', 
            'pendampingKegiatans.pegawai'
        ])->findOrFail($id);
        
        $this->showingDetail = true;
    }

    public function updatingSearch()
    {
        $this->amount = 10;
    }

    public function updatingKomisiId()
    {
        $this->amount = 10;
    }

    public function updatingJenisDinas()
    {
        $this->amount = 10;
    }
    public function updatingStatus()
    {
        $this->amount = 10;
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        $kegiatan = KegiatanDinas::find($this->deletingId);

        if ($kegiatan) {
            try {
                $kegiatan->delete();
                session()->flash('success', 'Kegiatan dinas berhasil dihapus.');
            } catch (\Exception $e) {
                session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
            }
        }

        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function render()
    {
        $query = KegiatanDinas::with(['komisi', 'anggotas', 'pendampingKegiatans']);

        // Filter by komisi
        if ($this->komisi_id) {
            $query->where('komisi_id', $this->komisi_id);
        }

        // Filter by jenis dinas
        if ($this->jenis_dinas) {
            $query->where('jenis_dinas', $this->jenis_dinas);
        }

        // Filter by date range
        if ($this->tanggal_mulai) {
            $query->where('tanggal_mulai', '>=', $this->tanggal_mulai);
        }
        if ($this->tanggal_selesai) {
            $query->where('tanggal_selesai', '<=', $this->tanggal_selesai);
        }

        // Search
        if ($this->search) {
            $query->where(function($q) {
                $q->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                  ->orWhere('lokasi', 'like', '%' . $this->search . '%');
            });
        }

        // Status Filter
        if ($this->status) {
            $today = now()->startOfDay();
            if ($this->status === 'upcoming') {
                $query->whereDate('tanggal_mulai', '>', $today);
            } elseif ($this->status === 'ongoing') {
                $query->whereDate('tanggal_mulai', '<=', $today)
                      ->whereDate('tanggal_selesai', '>=', $today);
            } elseif ($this->status === 'ended') {
                $query->whereDate('tanggal_selesai', '<', $today);
            }
        }

        $totalCount = (clone $query)->count();
        $kegiatanDinas = $query->latest()->take($this->amount)->get();
        $this->hasMore = $kegiatanDinas->count() < $totalCount;

        $komisis = Komisi::all();

        return view('livewire.kegiatan-dinas-index', compact('kegiatanDinas', 'komisis'))->layout('layouts.app');
    }
}
