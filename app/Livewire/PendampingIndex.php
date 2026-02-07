<?php

namespace App\Livewire;

use App\Models\Pendamping;
use Livewire\Component;

class PendampingIndex extends Component
{
    public $search = '';
    public $komisi_id = '';
    public $confirmingDeletion = false;
    public $deletingId = null;
    public $amount = 12;
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
        $pendamping = Pendamping::find($this->deletingId);

        if ($pendamping) {
            $pendamping->delete();
            session()->flash('success', 'Pendamping berhasil dihapus.');
        }

        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function render()
    {
        $query = Pendamping::with(['komisi', 'pegawai'])
            ->when($this->search, function ($query) {
                $query->where(function($q) {
                    $q->where('nama', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%')
                      ->orWhere('jabatan', 'like', '%' . $this->search . '%')
                      ->orWhereHas('pegawai', function($pq) {
                          $pq->where('nama', 'like', '%' . $this->search . '%')
                            ->orWhere('nip', 'like', '%' . $this->search . '%')
                            ->orWhere('jabatan', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->when($this->komisi_id, function($query) {
                $query->where('komisi_id', $this->komisi_id);
            });

        $totalCount = (clone $query)->count();
        $pendampings = $query->take($this->amount)->get();
        $this->hasMore = $pendampings->count() < $totalCount;

        $komisis = \App\Models\Komisi::all();

        return view('livewire.pendamping-index', compact('pendampings', 'komisis'))->layout('layouts.app');
    }
}
