<?php

namespace App\Livewire;

use App\Models\Komisi;
use Livewire\Component;

class KomisiIndex extends Component
{
    public $search = '';
    public $confirmingDeletion = false;
    public $deletingId = null;

    public $showMembersModal = false;
    public $showPendampingModal = false;
    public $selectedKomisiId = null;
    public $amount = 8;
    public $hasMore = true;

    protected $queryString = ['search'];

    public function loadMore()
    {
        $this->amount += 8;
    }

    public function openMembersModal($id)
    {
        $this->selectedKomisiId = $id;
        $this->showMembersModal = true;
    }

    public function openPendampingModal($id)
    {
        $this->selectedKomisiId = $id;
        $this->showPendampingModal = true;
    }

    public function getSelectedKomisiProperty()
    {
        if (!$this->selectedKomisiId) return null;
        return Komisi::with(['anggotas', 'pendampings'])->find($this->selectedKomisiId);
    }

    public function updatingSearch()
    {
        $this->amount = 8;
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        $komisi = Komisi::find($this->deletingId);

        if ($komisi) {
            if ($komisi->anggotas()->exists() || $komisi->kegiatanDinas()->exists()) {
                session()->flash('error', 'Komisi tidak dapat dihapus karena masih memiliki anggota atau kegiatan terkait.');
            } else {
                $komisi->delete();
                session()->flash('success', 'Komisi berhasil dihapus.');
            }
        }

        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function render()
    {
        $query = Komisi::withCount(['anggotas', 'pendampings'])
            ->when($this->search, function($query) {
                $query->where('nama', 'like', '%' . $this->search . '%');
            });
            
        $totalCount = (clone $query)->count();
        $komisis = $query->take($this->amount)->get();
        $this->hasMore = $komisis->count() < $totalCount;

        return view('livewire.komisi-index', compact('komisis'))->layout('layouts.app');
    }
}
