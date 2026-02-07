<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PesertaKegiatan extends Model
{
    protected $table = 'peserta_kegiatan';

    protected $fillable = [
        'kegiatan_dinas_id',
        'anggota_id',
    ];

    public function kegiatanDinas(): BelongsTo
    {
        return $this->belongsTo(KegiatanDinas::class);
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
