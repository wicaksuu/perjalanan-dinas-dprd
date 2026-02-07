<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\KegiatanDinas;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KegiatanDinasLaporanPegawai extends Component
{
    public $startDate;
    public $endDate;
    public $rangeType = 'month';

    public $showTripModal = false;
    public $modalTitle = '';
    public $modalTrips = [];

    public function mount()
    {
        $this->startDate = Carbon::now()->startOfMonth()->format('Y-m-d');
        $this->endDate = Carbon::now()->endOfMonth()->format('Y-m-d');
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


    public function openTrips($id, $nama)
    {
        $this->modalTitle = "Daftar Perjalanan Dinas: " . $nama;
        
        $isNonPegawai = str_starts_with($id, 'NP-');
        $cleanId = $isNonPegawai ? substr($id, 3) : $id;

        $this->modalTrips = KegiatanDinas::query()
            ->with([
                'komisi',
                'pesertaKegiatans.anggota',
                'pendampingKegiatans.pegawai',
                'pendampingKegiatans.pendamping.pegawai'
            ])
            ->join('pendamping_kegiatan', 'kegiatan_dinas.id', '=', 'pendamping_kegiatan.kegiatan_dinas_id')
            ->leftJoin('pendampings', 'pendamping_kegiatan.pendamping_id', '=', 'pendampings.id')
            ->where(function($q) use ($cleanId, $isNonPegawai) {
                if ($isNonPegawai) {
                    $q->where('pendamping_kegiatan.pendamping_id', $cleanId);
                } else {
                    $q->where('pendamping_kegiatan.pegawai_id', $cleanId)
                      ->orWhere('pendampings.pegawai_id', $cleanId);
                }
            })
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->select('kegiatan_dinas.*', 'pendamping_kegiatan.nominal as nominal_personal', 'pendamping_kegiatan.uang_harian as rate_harian')
            ->orderBy('tanggal_mulai', 'desc')
            ->get();
        $this->showTripModal = true;
    }


    public function getStatsProperty()
    {
        // Query for activities that have Pegawai Setwan or Pendamping involved
        $query = KegiatanDinas::query()
            ->whereBetween('tanggal_mulai', [$this->startDate, $this->endDate])
            ->whereHas('pendampingKegiatans', function($q) {
                // Any activity that has a staff or pendamping
                $q->whereNotNull('id');
            });

        $totalTrips = $query->count();
        $totalDays = $query->sum('durasi_hari');
        
        // Aggregasi per Pegawai (Unifikasi direct pegawai_setwan dan via pendamping)
        // Also include Pendampings who are NOT linked to a Pegawai
        $pegawaiStats = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->leftJoin('pegawais as p_direct', 'pendamping_kegiatan.pegawai_id', '=', 'p_direct.id')
            ->leftJoin('pendampings', 'pendamping_kegiatan.pendamping_id', '=', 'pendampings.id')
            ->leftJoin('pegawais as p_via_pq', 'pendampings.pegawai_id', '=', 'p_via_pq.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->select(
                DB::raw('COALESCE(p_direct.id, p_via_pq.id, "NP-" || pendampings.id) as v_id'),
                DB::raw('COALESCE(p_direct.nama, p_via_pq.nama, pendampings.nama, "Unknown") as v_nama'),
                DB::raw('COALESCE(p_direct.jabatan, p_via_pq.jabatan, pendampings.jabatan, "Pendamping") as v_jabatan'),
                DB::raw('count(kegiatan_dinas.id) as total_kegiatan'),
                DB::raw('sum(kegiatan_dinas.durasi_hari) as total_hari'),
                DB::raw('sum(pendamping_kegiatan.nominal) as total_nominal'),
                DB::raw('avg(pendamping_kegiatan.uang_harian) as avg_uang_harian')
            )
            ->groupBy('v_id', 'v_nama', 'v_jabatan')
            ->havingNotNull('v_id')
            ->get()
            ->sort(function($a, $b) {
                if ($a->total_kegiatan != $b->total_kegiatan) return $b->total_kegiatan <=> $a->total_kegiatan;
                if ($a->total_hari != $b->total_hari) return $b->total_hari <=> $a->total_hari;
                return $b->total_nominal <=> $a->total_nominal;
            })
            ->values(); // Reset keys for JSON serialization

        $sortedByActivity = $pegawaiStats->sortByDesc('total_kegiatan')->values();
        $sortedByBudget = $pegawaiStats->sortByDesc('total_nominal')->values();

        // 1. Top 5 Activity
        $top5Activity = $sortedByActivity->take(5);

        // 2. Top 5 Budget
        $top5Budget = $sortedByBudget->take(5);

        // 3. Trend Budget (Monthly Accumulation)
        // For staff, we only care about pendamping_kegiatan costs + global cost (if relevant, but usually global cost is attached to trip, not staff).
        // However, user asked for "Budgeting Grafik Akumulasi Total", which implies the total cost of activities involving staff vs just staff cost?
        // Usually reports focus on what they are reporting on. For Staff report, it's staff costs.
        
        $pendampingTrend = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->select(
                DB::raw("strftime('%Y-%m', kegiatan_dinas.tanggal_mulai) as month"),
                DB::raw("SUM(pendamping_kegiatan.nominal) as total_nominal")
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
            
        $trendBudget = $pendampingTrend->map(function($item) {
             return [
                'month' => Carbon::createFromFormat('Y-m', $item->month)->format('M Y'),
                'total' => $item->total_nominal,
                'days' => 0 // Days not aggregated per month for staff trend in this context usually
            ];
        });

        $totalNominal = DB::table('pendamping_kegiatan')
            ->join('kegiatan_dinas', 'pendamping_kegiatan.kegiatan_dinas_id', '=', 'kegiatan_dinas.id')
            ->whereBetween('kegiatan_dinas.tanggal_mulai', [$this->startDate, $this->endDate])
            ->sum('pendamping_kegiatan.nominal');

        return [
            'total_trips' => $totalTrips,
            'total_days' => $totalDays,
            'total_nominal' => $totalNominal,
            'pegawai_stats' => $pegawaiStats,
            'top5_activity' => $top5Activity,
            'top5_budget' => $top5Budget,
            'trend_budget' => $trendBudget,
        ];
    }

    public function render()
    {
        return view('livewire.kegiatan-dinas-laporan-pegawai', [
            'stats' => $this->stats
        ])->layout('layouts.app');
    }
}
