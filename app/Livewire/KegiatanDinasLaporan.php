<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KegiatanDinas;
use App\Models\Komisi;
use App\Models\Anggota;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KegiatanDinasLaporan extends Component
{
    public $startDate;
    public $endDate;
    public $selectedKomisi = '';
    public $rangeType = 'month'; // 'week', 'month', 'year', 'custom'
    public $showTripModal = false;
    public $modalTitle = '';
    public $modalTrips = [];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
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
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->select('kegiatan_dinas.*', 'peserta_kegiatan.nominal as nominal_personal', 'peserta_kegiatan.uang_harian as rate_harian')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        $this->showTripModal = true;
    }

    public function openKomisiTrips($komisiId, $nama)
    {
        $this->modalTitle = "Daftar Perjalanan Dinas: " . $nama;
        $this->modalTrips = KegiatanDinas::query()
            ->with([
                'komisi',
                'pesertaKegiatans.anggota',
                'pendampingKegiatans.pegawai',
                'pendampingKegiatans.pendamping.pegawai'
            ])
            ->where('komisi_id', $komisiId)
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        $this->showTripModal = true;
    }

    public function updatedSelectedKomisi()
    {
        $this->dispatch('refreshCharts', stats: $this->stats);
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
        $query = KegiatanDinas::query()
            ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate]);

        if ($this->selectedKomisi) {
            $query->where('komisi_id', $this->selectedKomisi);
        }

        $totalTrips = $query->count();
        $totalDays = $query->sum('durasi_hari');
        
        $excludedPimpinan = ['Ketua DPRD', 'Wakil Ketua I', 'Wakil Ketua II', 'Wakil Ketua III'];

        $totalNominalPeserta = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->join('anggotas', 'peserta_kegiatan.anggota_id', '=', 'anggotas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->whereNotIn('anggotas.jabatan', $excludedPimpinan)
            ->when($this->selectedKomisi, fn($q) => $q->where('kegiatan_dinas.komisi_id', $this->selectedKomisi))
            ->sum('peserta_kegiatan.nominal');

        $totalNominalPendamping = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->when($this->selectedKomisi, fn($q) => $q->where('kegiatan_dinas.komisi_id', $this->selectedKomisi))
            ->sum('pendamping_kegiatan.nominal');

        $totalNominalGlobal = $query->clone()->sum(DB::raw('biaya_bbm + biaya_penginapan + biaya_transportasi'));
        $totalNominal = $totalNominalPeserta + $totalNominalPendamping + $totalNominalGlobal;
        
        $komisiStats = Komisi::withCount(['kegiatanDinas as total_kegiatan' => function ($query) {
                $query->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate]);
            }])
            ->get()
            ->map(function ($komisi) use ($excludedPimpinan) {
                $durasi = KegiatanDinas::where('komisi_id', $komisi->id)
                    ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])
                    ->sum('durasi_hari');
                
                $nomPeserta = DB::table('peserta_kegiatan')
                    ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
                    ->join('anggotas', 'peserta_kegiatan.anggota_id', '=', 'anggotas.id')
                    ->where('kegiatan_dinas.komisi_id', $komisi->id)
                    ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
                    ->whereNotIn('anggotas.jabatan', $excludedPimpinan)
                    ->sum('peserta_kegiatan.nominal');

                $nomPendamping = DB::table('pendamping_kegiatan')
                    ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
                    ->where('kegiatan_dinas.komisi_id', $komisi->id)
                    ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
                    ->sum('pendamping_kegiatan.nominal');

                $nomGlobal = KegiatanDinas::where('komisi_id', $komisi->id)
                    ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])
                    ->sum(DB::raw('biaya_bbm + biaya_penginapan + biaya_transportasi'));

                return [
                    'id' => $komisi->id,
                    'nama' => $komisi->nama,
                    'total_kegiatan' => $komisi->total_kegiatan,
                    'total_hari' => $durasi,
                    'total_nominal' => $nomPeserta + $nomPendamping + $nomGlobal,
                ];
            });

        // Aggregasi per Anggota (Filtered by Komisi if selected)
        $anggotaQuery = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->join('anggotas', 'peserta_kegiatan.anggota_id', '=', 'anggotas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->whereNotIn('anggotas.jabatan', $excludedPimpinan);

        if ($this->selectedKomisi) {
            $anggotaQuery->where('kegiatan_dinas.komisi_id', $this->selectedKomisi);
        }

        $anggotaStats = $anggotaQuery->select(
                'anggotas.id',
                'anggotas.nama',
                DB::raw('count(kegiatan_dinas.id) as total_kegiatan'),
                DB::raw('sum(kegiatan_dinas.durasi_hari) as total_hari'),
                DB::raw('sum(peserta_kegiatan.nominal) as total_nominal'),
                DB::raw('avg(peserta_kegiatan.uang_harian) as avg_uang_harian')
            )
            ->groupBy('anggotas.id', 'anggotas.nama')
            ->get();

        $sortedByActivity = $anggotaStats->sortByDesc('total_kegiatan')->values();
        $sortedByBudget = $anggotaStats->sortByDesc('total_nominal')->values();

        // 1. Top 5 Activity
        $top5Activity = $sortedByActivity->take(5);

        // 2. Top 5 Budget
        $top5Budget = $sortedByBudget->take(5);

        // 3. Trend Budget & Duration (Monthly Accumulation)
        // Note: Using a raw query for performance to group by month
        $trendQuery = DB::table('kegiatan_dinas')
            ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate]);
        
        if ($this->selectedKomisi) {
            $trendQuery->where('komisi_id', $this->selectedKomisi);
        }

        $monthlyData = $trendQuery->select(
            DB::raw("strftime('%Y-%m', tanggal_mulai) as month"),
            DB::raw("SUM(biaya_bbm + biaya_penginapan + biaya_transportasi) as global_cost"),
            DB::raw("SUM(durasi_hari) as total_days")
        )
        ->groupBy('month')
        ->orderBy('month')
        ->get();

        // We need to add participant costs to the trend. This is complex with single query, 
        // so we'll fetch participant costs similarly grouped by month and merge.
        
        $pesertaTrend = DB::table('peserta_kegiatan')
            ->join('kegiatan_dinas', 'peserta_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->when($this->selectedKomisi, fn($q) => $q->where('kegiatan_dinas.komisi_id', $this->selectedKomisi))
            ->select(
                DB::raw("strftime('%Y-%m', kegiatan_dinas.tanggal_mulai) as month"),
                DB::raw("SUM(peserta_kegiatan.nominal) as total_nominal")
            )
            ->groupBy('month')
            ->pluck('total_nominal', 'month');

        $pendampingTrend = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->when($this->selectedKomisi, fn($q) => $q->where('kegiatan_dinas.komisi_id', $this->selectedKomisi))
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

        // If range is custom or small, maybe group by date? 
        // strictly following user request "bugeting grafik nya akumulasi total", assuming monthly trend is best for "Analisa".


        return [
            'total_trips' => $totalTrips,
            'total_days' => $totalDays,
            'total_nominal' => $totalNominal,
            'komisi_stats' => $komisiStats,
            'anggota_stats' => $anggotaStats,
            'top5_activity' => $top5Activity,
            'top5_budget' => $top5Budget,
            'trend_budget' => $trendBudget,
        ];
    }

    public function render()
    {
        return view('livewire.kegiatan-dinas-laporan', [
            'stats' => $this->stats,
            'komisis' => Komisi::orderBy('nama')->get()
        ])->layout('layouts.app');
    }
}
