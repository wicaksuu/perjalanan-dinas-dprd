<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class KegiatanDinas extends Model
{
    protected $table = 'kegiatan_dinas';

    protected $fillable = [
        'komisi_id',
        'jenis_dinas',
        'nama_kegiatan',
        'lokasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi_hari',
        'keterangan',
        'biaya_bbm',
        'biaya_penginapan',
        'biaya_transportasi',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if ($model->tanggal_mulai && $model->tanggal_selesai) {
                $model->durasi_hari = Carbon::parse($model->tanggal_mulai)
                    ->diffInDays(Carbon::parse($model->tanggal_selesai)) + 1;
            }
        });
    }

    public function komisi(): BelongsTo
    {
        return $this->belongsTo(Komisi::class);
    }

    public function anggotas(): BelongsToMany
    {
        return $this->belongsToMany(Anggota::class, 'peserta_kegiatan')
            ->withPivot(['nominal', 'uang_harian'])
            ->withTimestamps();
    }

    public function pesertaKegiatans(): HasMany
    {
        return $this->hasMany(PesertaKegiatan::class);
    }

    public function pendampingKegiatans(): HasMany
    {
        return $this->hasMany(PendampingKegiatan::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected function totalNominal(): Attribute
    {
        return Attribute::get(function () {
            $pesertaSum = $this->pesertaKegiatans->sum('nominal');
            $pendampingSum = $this->pendampingKegiatans->sum('nominal');
            
            return $pesertaSum + $pendampingSum + $this->biaya_bbm + $this->biaya_penginapan + $this->biaya_transportasi;
        });
    }

    protected function statusKegiatan(): Attribute
    {
        return Attribute::get(function () {
            $now = Carbon::now();
            $start = Carbon::parse($this->tanggal_mulai)->startOfDay();
            $end = Carbon::parse($this->tanggal_selesai)->endOfDay();

            if ($now->lt($start)) {
                return 'upcoming';
            } elseif ($now->gt($end)) {
                return 'ended';
            } else {
                return 'ongoing';
            }
        });
    }

    public function getIsEndedAttribute(): bool
    {
        return $this->status_kegiatan === 'ended';
    }

    public function getIsOngoingAttribute(): bool
    {
        return $this->status_kegiatan === 'ongoing';
    }

    public function getIsUpcomingAttribute(): bool
    {
        return $this->status_kegiatan === 'upcoming';
    }
}
