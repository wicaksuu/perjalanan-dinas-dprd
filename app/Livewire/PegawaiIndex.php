<?php

namespace App\Livewire;

use App\Models\Pegawai;
use Livewire\Component;

class PegawaiIndex extends Component
{
    public $search = '';
    public $confirmingDeletion = false;
    public $deletingId = null;
    public $amount = 12;
    public $hasMore = true;

    protected $queryString = ['search'];

    public function loadMore()
    {
        $this->amount += 12;
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
        $pegawai = Pegawai::find($this->deletingId);

        if ($pegawai) {
            $pegawai->delete();
            session()->flash('success', 'Pegawai berhasil dihapus.');
        }

        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function render()
    {
        $query = Pegawai::when($this->search, function ($query) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                ->orWhere('nip', 'like', '%' . $this->search . '%')
                ->orWhere('jabatan', 'like', '%' . $this->search . '%');
        });

        $totalCount = (clone $query)->count();
        $pegawais = $query->take($this->amount)->get();
        $this->hasMore = $pegawais->count() < $totalCount;

        return view('livewire.pegawai-index', compact('pegawais'))->layout('layouts.app');
    }
}
