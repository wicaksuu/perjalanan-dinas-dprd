<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendamping extends Model
{
    protected $fillable = [
        'komisi_id',
        'pegawai_id',
        'anggota_id',
        'nama',
        'jabatan',
        'no_hp',
    ];

    public function komisi(): BelongsTo
    {
        return $this->belongsTo(Komisi::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
