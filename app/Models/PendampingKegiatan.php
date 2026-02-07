<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendampingKegiatan extends Model
{
    protected $table = 'pendamping_kegiatan';

    protected $fillable = [
        'kegiatan_dinas_id',
        'pendamping_id',
        'pegawai_id',
        'related_anggota_id',
        'jenis',
        'nominal',
        'uang_harian',
    ];

    public function kegiatanDinas(): BelongsTo
    {
        return $this->belongsTo(KegiatanDinas::class);
    }

    public function pendamping(): BelongsTo
    {
        return $this->belongsTo(Pendamping::class);
    }

    public function pegawai(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function relatedAnggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'related_anggota_id');
    }
}
