<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Komisi extends Model
{
    protected $fillable = [
        'nama',
        'keterangan',
    ];

    public function anggotas(): HasMany
    {
        return $this->hasMany(Anggota::class);
    }

    public function pendampings(): HasMany
    {
        return $this->hasMany(Pendamping::class);
    }

    public function kegiatanDinas(): HasMany
    {
        return $this->hasMany(KegiatanDinas::class);
    }
}
