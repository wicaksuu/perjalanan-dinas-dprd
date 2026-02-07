<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KegiatanDinas;
use App\Models\Komisi;
use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KegiatanDinasLaporanPimpinan extends Component
{
    public $startDate;
    public $endDate;
    public $rangeType = 'month'; // 'week', 'month', 'year', 'custom'
    public $showTripModal = false;
    public $modalTitle = '';
    public $modalTrips = [];
    public $pimpinanKomisiId;

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
        
        $pimpinan = Komisi::where('nama', 'PIMPINAN DPRD')->first();
        $this->pimpinanKomisiId = $pimpinan ? $pimpinan->id : null;
    }

    public function openTrips($anggotaId, $nama)
    {
        $this->modalTitle = "Daftar Perjalanan Dinas: " . $nama;
        $this->modalTrips = KegiatanDinas::query()
            ->with([
                'komisi',
                'pesertaKegiatans.anggota',
                'pendampingKegiatans.pegawai',
                'pendampingKegiatans.pendamping.pegawai'
            ])
            ->join('peserta_kegiatan', 'kegiatan_dinas.id', '=', 'peserta_kegiatan.kegiatan_dinas_id')
            ->where('peserta_kegiatan.anggota_id', $anggotaId)
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId) // Strict filter
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->select('kegiatan_dinas.*', 'peserta_kegiatan.nominal as nominal_personal', 'peserta_kegiatan.uang_harian as rate_harian')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        $this->showTripModal = true;
    }

    public function setRange($type)
    {
        $this->rangeType = $type;
        $now = Carbon::now();

        switch ($type) {
            case 'week':
                $this->startDate = $now->startOfWeek()->format('Y-m-d');
                $this->endDate = $now->endOfWeek()->format('Y-m-d');
                break;
            case 'month':
                $this->startDate = $now->startOfMonth()->format('Y-m-d');
                $this->endDate = $now->endOfMonth()->format('Y-m-d');
                break;
            case 'year':
                $this->startDate = $now->startOfYear()->format('Y-m-d');
                $this->endDate = $now->endOfYear()->format('Y-m-d');
                break;
        }
        $this->dispatch('refreshCharts', stats: $this->stats);
    }

    public function updatedStartDate()
    {
        $this->rangeType = 'custom';
        $this->dispatch('refreshCharts', stats: $this->stats);
    }

    public function updatedEndDate()
    {
        $this->rangeType = 'custom';
        $this->dispatch('refreshCharts', stats: $this->stats);
    }

    public function getStatsProperty()
    {
        if (!$this->pimpinanKomisiId) {
            return [
                'total_trips' => 0,
                'total_days' => 0,
                'total_nominal' => 0,
                'anggota_stats' => collect(),
            ];
        }

        $query = KegiatanDinas::query()
            ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('komisi_id', $this->pimpinanKomisiId);

        $totalTrips = $query->count();
        $totalDays = $query->sum('durasi_hari');
        
        $totalNominalPeserta = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId)
            ->sum('peserta_kegiatan.nominal');

        $totalNominalPendamping = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId)
            ->sum('pendamping_kegiatan.nominal');

        $totalNominalGlobal = $query->clone()->sum(DB::raw('biaya_bbm + biaya_penginapan + biaya_transportasi'));
        $totalNominal = $totalNominalPeserta + $totalNominalPendamping + $totalNominalGlobal;
        
        // Aggregasi per Anggota (Hanya Pimpinan yang melakukan kegiatan di bawah bendera Pimpinan)
        $anggotaStats = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->join('anggotas', 'peserta_kegiatan.anggota_id', '=', 'anggotas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId)
            ->select(
                'anggotas.id',
                'anggotas.nama',
                'anggotas.jabatan',
                DB::raw('count(kegiatan_dinas.id) as total_kegiatan'),
                DB::raw('sum(kegiatan_dinas.durasi_hari) as total_hari'),
                DB::raw('sum(peserta_kegiatan.nominal) as total_nominal'),
                DB::raw('avg(peserta_kegiatan.uang_harian) as avg_uang_harian')
            )
            ->groupBy('anggotas.id', 'anggotas.nama', 'anggotas.jabatan')
            ->get();

        $sortedByActivity = $anggotaStats->sortByDesc('total_kegiatan')->values();
        $sortedByBudget = $anggotaStats->sortByDesc('total_nominal')->values();

        // 1. Top 5 Activity
        $top5Activity = $sortedByActivity->take(5);

        // 2. Top 5 Budget
        $top5Budget = $sortedByBudget->take(5);

        // 3. Trend Budget (Monthly Accumulation)
        $monthlyData = DB::table('kegiatan_dinas')
            ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('komisi_id', $this->pimpinanKomisiId)
            ->select(
                DB::raw("strftime('%Y-%m', tanggal_mulai) as month"),
                DB::raw("SUM(biaya_bbm + biaya_penginapan + biaya_transportasi) as global_cost"),
                DB::raw("SUM(durasi_hari) as total_days")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $pesertaTrend = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId)
            ->select(
                DB::raw("strftime('%Y-%m', kegiatan_dinas.tanggal_mulai) as month"),
                DB::raw("SUM(peserta_kegiatan.nominal) as total_nominal")
            )
            ->groupBy('month')
            ->pluck('total_nominal', 'month');

        $pendampingTrend = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->where('kegiatan_dinas.komisi_id', $this->pimpinanKomisiId)
            ->select(
                DB::raw("strftime('%Y-%m', kegiatan_dinas.tanggal_mulai) as month"),
                DB::raw("SUM(pendamping_kegiatan.nominal) as total_nominal")
            )
            ->groupBy('month')
            ->pluck('total_nominal', 'month');

        $trendBudget = $monthlyData->map(function($item) use ($pesertaTrend, $pendampingTrend) {
            $p = $pesertaTrend[$item->month] ?? 0;
            $s = $pendampingTrend[$item->month] ?? 0;
            return [
                'month' => Carbon::createFromFormat('Y-m', $item->month)->format('M Y'),
                'total' => $item->global_cost + $p + $s,
                'days' => $item->total_days
            ];
        });

        return [
            'total_trips' => $totalTrips,
            'total_days' => $totalDays,
            'total_nominal' => $totalNominal,
            'anggota_stats' => $anggotaStats,
            'top5_activity' => $top5Activity,
            'top5_budget' => $top5Budget,
            'trend_budget' => $trendBudget,
        ];
    }

    public function render()
    {
        return view('livewire.kegiatan-dinas-laporan-pimpinan', [
            'stats' => $this->stats,
        ])->layout('layouts.app');
    }
}
