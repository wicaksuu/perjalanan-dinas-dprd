<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    protected $fillable = [
        'nama',
        'komisi_id',
        'jabatan',
        'no_hp',
    ];

    public function komisi(): BelongsTo
    {
        return $this->belongsTo(Komisi::class);
    }

    public function kegiatanDinas(): BelongsToMany
    {
        return $this->belongsToMany(KegiatanDinas::class, 'peserta_kegiatan')
            ->withTimestamps();
    }

    public function pesertaKegiatans(): HasMany
    {
        return $this->hasMany(PesertaKegiatan::class);
    }
}
