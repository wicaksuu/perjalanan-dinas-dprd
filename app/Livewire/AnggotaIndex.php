<?php

namespace App\Livewire;

use App\Models\Anggota;
use Livewire\Component;

class AnggotaIndex extends Component
{
    public $search = '';
    public $komisi_id = '';
    public $confirmingDeletion = false;
    public $deletingId = null;
    public $amount = 12; // Start with 12 for 3-column grid
    public $hasMore = true;

    protected $queryString = ['search', 'komisi_id'];

    public function loadMore()
    {
        $this->amount += 12;
    }

    public function updatingKomisiId()
    {
        $this->amount = 12;
    }

    public function updatingSearch()
    {
        $this->amount = 12;
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        $anggota = Anggota::find($this->deletingId);

        if ($anggota) {
            $anggota->delete();
            session()->flash('success', 'Anggota berhasil dihapus.');
        }

        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function render()
    {
        $query = Anggota::with('komisi')
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%')
                      ->orWhere('jabatan', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->komisi_id, function($query) {
                if ($this->komisi_id === 'pimpinan') {
                    $query->whereIn('jabatan', ['Ketua DPRD', 'Wakil Ketua I', 'Wakil Ketua II', 'Wakil Ketua III']);
                } else {
                    $query->where('komisi_id', $this->komisi_id);
                }
            });

        $totalCount = (clone $query)->count();
        $anggotas = $query->take($this->amount)->get();
        $this->hasMore = $anggotas->count() < $totalCount;

        $komisis = \App\Models\Komisi::all();

        return view('livewire.anggota-index', compact('anggotas', 'komisis'))->layout('layouts.app');
    }
}
