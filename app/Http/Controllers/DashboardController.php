<?php

namespace App\Http\Controllers;

use App\Models\Komisi;
use App\Models\Anggota;
use App\Models\KegiatanDinas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Basic Counts
        $totalKegiatan = KegiatanDinas::count();
        $totalKegiatanDalam = KegiatanDinas::where('jenis_dinas', 'dalam')->count();
        $totalKegiatanLuar = KegiatanDinas::where('jenis_dinas', 'luar')->count();
        $totalKomisi = Komisi::count();
        $totalAnggota = Anggota::count();

        // 2. Budget Realization (Total)
        $totalRealization = 0;
        
        // Sum from Peserta
        $totalRealization += \Illuminate\Support\Facades\DB::table('peserta_kegiatan')
            ->sum('nominal');
            
        // Sum from Pendamping
        $totalRealization += \Illuminate\Support\Facades\DB::table('pendamping_kegiatan')
            ->sum('nominal');

        // Sum from Global Costs (BBM, Hotel, Transport)
        $totalRealization += KegiatanDinas::sum(\Illuminate\Support\Facades\DB::raw('biaya_bbm + biaya_penginapan + biaya_transportasi'));

        // 3. Top Commissions (Excluding Pimpinan) & Top Pimpinan
        $allCommissions = Komisi::withCount('kegiatanDinas')
            ->get()
            ->map(function($komisi) {
                $kegiatanIds = $komisi->kegiatanDinas->pluck('id');
                
                $budget = 0;
                $budget += \Illuminate\Support\Facades\DB::table('peserta_kegiatan')
                    ->whereIn('kegiatan_dinas_id', $kegiatanIds)
                    ->sum('nominal');
                    
                $budget += \Illuminate\Support\Facades\DB::table('pendamping_kegiatan')
                    ->whereIn('kegiatan_dinas_id', $kegiatanIds)
                    ->sum('nominal');
                    
                $budget += \App\Models\KegiatanDinas::whereIn('id', $kegiatanIds)
                    ->sum(\Illuminate\Support\Facades\DB::raw('biaya_bbm + biaya_penginapan + biaya_transportasi'));
                
                $komisi->total_budget = $budget;
                return $komisi;
            });

        // Separate Pimpinan
        $pimpinanStats = $allCommissions->firstWhere('nama', 'PIMPINAN DPRD');
        
        // Filter Commissions (Exclude Pimpinan)
        $kegiatanPerKomisi = $allCommissions->where('nama', '!=', 'PIMPINAN DPRD')
            ->sortByDesc('total_budget')
            ->take(5);

        // Get Top Pimpinan Members (for animation)
        $pimpinanMembers = \App\Models\Anggota::whereHas('komisi', function($q) {
                $q->where('nama', 'PIMPINAN DPRD');
            })
            ->withCount('pesertaKegiatans as total_kegiatan')
            ->orderByDesc('total_kegiatan')
            ->take(3)
            ->get();

        // 4. Top Staff by Activity
        $topStaff = \App\Models\Pegawai::withCount(['pendampingKegiatans as total_kegiatan'])
            ->orderByDesc('total_kegiatan')
            ->take(5)
            ->get();

        // 5. Recent Activities
        $kegiatanTerbaru = KegiatanDinas::with(['komisi', 'anggotas'])
            ->latest()
            ->take(5)
            ->get();

        // 6. Monthly Statistics (Activity & Budget) - 6 Months
        $kegiatanRecent = KegiatanDinas::where('tanggal_mulai', '>=', now()->subMonths(6))
            ->orderBy('tanggal_mulai', 'asc')
            ->get();
        
        $statistikBulanan = $kegiatanRecent->groupBy(function($item) {
            return $item->tanggal_mulai->format('Y-m');
        })->map(function($items, $bulan) {
            // Calculate budget for this month
            $kegiatanIds = $items->pluck('id');
            $budget = 0;
            
            $budget += \Illuminate\Support\Facades\DB::table('peserta_kegiatan')
                ->whereIn('kegiatan_dinas_id', $kegiatanIds)
                ->sum('nominal');
                
            $budget += \Illuminate\Support\Facades\DB::table('pendamping_kegiatan')
                ->whereIn('kegiatan_dinas_id', $kegiatanIds)
                ->sum('nominal');
                
            $budget += $items->sum(function($k) {
                return $k->biaya_bbm + $k->biaya_penginapan + $k->biaya_transportasi;
            });

            return (object)[
                'bulan' => $bulan,
                'total_kegiatan' => $items->count(),
                'total_budget' => $budget,
                'dalam' => $items->where('jenis_dinas', 'dalam')->count(),
                'luar' => $items->where('jenis_dinas', 'luar')->count(),
            ];
        })->values();
        
        // 7. Status Based Statistics
        $today = now()->startOfDay();
        $totalSelesai = KegiatanDinas::where('tanggal_selesai', '<', $today)->count();
        $totalBerjalan = KegiatanDinas::where('tanggal_mulai', '<=', $today)
            ->where('tanggal_selesai', '>=', $today)
            ->count();
        $totalAkanDatang = KegiatanDinas::where('tanggal_mulai', '>', $today)->count();

        // Get latest items for each status (for visual details on hover/focus)
        $listSelesai = KegiatanDinas::where('tanggal_selesai', '<', $today)->latest()->take(3)->get();
        $listBerjalan = KegiatanDinas::where('tanggal_mulai', '<=', $today)
            ->where('tanggal_selesai', '>=', $today)
            ->latest()
            ->take(3)
            ->get();
        $listAkanDatang = KegiatanDinas::where('tanggal_mulai', '>', $today)->latest()->take(3)->get();

        return view('dashboard', compact(
            'totalKegiatan',
            'totalKegiatanDalam',
            'totalKegiatanLuar',
            'totalKomisi',
            'totalAnggota',
            'totalRealization',
            'kegiatanPerKomisi',
            'pimpinanStats',
            'pimpinanMembers',
            'topStaff',
            'kegiatanTerbaru',
            'statistikBulanan',
            'totalSelesai',
            'totalBerjalan',
            'totalAkanDatang',
            'listSelesai',
            'listBerjalan',
            'listAkanDatang'
        ));
    }
}
