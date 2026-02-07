<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KegiatanDinas;

use Livewire\Attributes\On;

class TripDetailModal extends Component
{
    public $isOpen = false;
    public $trip = null;

    #[On('open-trip-detail')]
    public function open($id)
    {
        // Handle if $id comes as an array (Livewire behavior with named params)
        if (is_array($id) && isset($id['id'])) {
            $id = $id['id'];
        }

        $this->trip = KegiatanDinas::with([
            'komisi',
            'pesertaKegiatans.anggota',
            'pendampingKegiatans.pegawai',
            'pendampingKegiatans.pendamping.pegawai'
        ])->find($id);

        if ($this->trip) {
            $this->isOpen = true;
        }
    }

    public function close()
    {
        $this->isOpen = false;
        $this->trip = null;
    }

    public function render()
    {
        return view('livewire.trip-detail-modal');
    }
}
