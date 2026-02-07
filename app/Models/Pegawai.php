<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'no_hp',
    ];
    public function pendampingKegiatans()
    {
        return $this->hasMany(PendampingKegiatan::class);
    }
}
