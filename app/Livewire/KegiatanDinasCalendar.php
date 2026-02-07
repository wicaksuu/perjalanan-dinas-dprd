<?php

namespace App\Livewire;

use App\Models\KegiatanDinas;
use Livewire\Component;
use Carbon\Carbon;

class KegiatanDinasCalendar extends Component
{
    public $month;
    public $year;
    public $day;
    public $viewMode = 'month'; // month, week, year (future)
    public $showingDetail = false;
    public $selectedKegiatan = null;

    public function showDetail($id)
    {
        $this->selectedKegiatan = KegiatanDinas::with([
            'komisi', 
            'anggotas', 
            'pendampingKegiatans.pendamping', 
            'pendampingKegiatans.pegawai'
        ])->findOrFail($id);
        
        $this->showingDetail = true;
    }

    public function mount()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->day = now()->day;
    }

    public function prev()
    {
        $date = Carbon::create($this->year, $this->month, $this->day ?? 1);
        if ($this->viewMode === 'month') {
            $date->subMonth();
        } elseif ($this->viewMode === 'week') {
            $date->subWeek();
        } elseif ($this->viewMode === 'year') {
            $date->subYear();
        }
        $this->month = $date->month;
        $this->year = $date->year;
        $this->day = $date->day;
    }

    public function next()
    {
        $date = Carbon::create($this->year, $this->month, $this->day ?? 1);
        if ($this->viewMode === 'month') {
            $date->addMonth();
        } elseif ($this->viewMode === 'week') {
            $date->addWeek();
        } elseif ($this->viewMode === 'year') {
            $date->addYear();
        }
        $this->month = $date->month;
        $this->year = $date->year;
        $this->day = $date->day;
    }

    public function goToToday()
    {
        $this->month = now()->month;
        $this->year = now()->year;
        $this->day = now()->day;
    }

    public function setViewMode($mode)
    {
        $this->viewMode = $mode;
        // Reset to today when switching modes to avoid confusion
        if ($mode === 'week') {
            $this->day = now()->day;
            $this->month = now()->month;
            $this->year = now()->year;
        }
    }

    public function selectMonth($m)
    {
        $this->month = $m;
        $this->viewMode = 'month';
    }

    public function render()
    {
        $currentDate = Carbon::create($this->year, $this->month, $this->day ?? 1);
        $calendar = [];
        $headerText = '';

        if ($this->viewMode === 'month') {
            $daysInMonth = $currentDate->daysInMonth;
            $firstDayOfWeek = $currentDate->copy()->startOfMonth()->isoWeekday(); // 1 (Mon) to 7 (Sun)
            
            $prevMonthDate = $currentDate->copy()->subMonth();
            $daysInPrevMonth = $prevMonthDate->daysInMonth;
            
            // Fill previous month days
            for ($i = $firstDayOfWeek - 1; $i > 0; $i--) {
                $day = $daysInPrevMonth - $i + 1;
                $calendar[] = [
                    'day' => $day,
                    'month' => $prevMonthDate->month,
                    'year' => $prevMonthDate->year,
                    'currentMonth' => false,
                    'date' => $prevMonthDate->copy()->day($day)->toDateString()
                ];
            }
            
            // Fill current month days
            for ($day = 1; $day <= $daysInMonth; $day++) {
                $calendar[] = [
                    'day' => $day,
                    'month' => $this->month,
                    'year' => $this->year,
                    'currentMonth' => true,
                    'date' => $currentDate->copy()->day($day)->toDateString()
                ];
            }
            
            // Fill next month days
            $remainingDays = 42 - count($calendar);
            if ($remainingDays > 0) {
                $nextMonthDate = $currentDate->copy()->addMonth();
                for ($day = 1; $day <= $remainingDays; $day++) {
                    $calendar[] = [
                        'day' => $day,
                        'month' => $nextMonthDate->month,
                        'year' => $nextMonthDate->year,
                        'currentMonth' => false,
                        'date' => $nextMonthDate->copy()->day($day)->toDateString()
                    ];
                }
            }
            $headerText = $currentDate->translatedFormat('F Y');
            $startDate = $calendar[0]['date'];
            $endDate = end($calendar)['date'];
        } elseif ($this->viewMode === 'week') {
            $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
            $endOfWeek = $currentDate->copy()->endOfWeek(Carbon::SUNDAY);
            for ($i = 0; $i < 7; $i++) {
                $date = $startOfWeek->copy()->addDays($i);
                $calendar[] = [
                    'day' => $date->day,
                    'month' => $date->month,
                    'year' => $date->year,
                    'currentMonth' => $date->month === $this->month,
                    'date' => $date->toDateString()
                ];
            }
            $headerText = $startOfWeek->translatedFormat('d M') . ' - ' . $endOfWeek->translatedFormat('d M Y');
        } elseif ($this->viewMode === 'year') {
            $headerText = "Tahun " . $this->year;
        }

        // Set Date Range for Fetching
        if ($this->viewMode === 'year') {
            $startDate = Carbon::create($this->year, 1, 1)->toDateString();
            $endDate = Carbon::create($this->year, 12, 31)->toDateString();
        } else {
            $startDate = $calendar[0]['date'];
            $endDate = end($calendar)['date'];
        }

        // Fetch activities for the visible range
        $activities = KegiatanDinas::with(['komisi', 'anggotas', 'pendampingKegiatans'])
            ->where(function($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_mulai', [$startDate, $endDate])
                      ->orWhereBetween('tanggal_selesai', [$startDate, $endDate])
                      ->orWhere(function($q) use ($startDate, $endDate) {
                          $q->where('tanggal_mulai', '<=', $startDate)
                            ->where('tanggal_selesai', '>=', $endDate);
                      });
            })
            ->get();

        // Initialize data
        $activitiesByDate = [];
        $yearStats = [];
        $weeks = [];

        if ($this->viewMode === 'year') {
            // (Yearly logic remains similar)
            for ($m = 1; $m <= 12; $m++) {
                $monthDate = Carbon::create($this->year, $m, 1);
                $monthActivities = $activities->filter(function($activity) use ($monthDate) {
                    $start = $monthDate->copy()->startOfMonth();
                    $end = $monthDate->copy()->endOfMonth();
                    return $activity->tanggal_mulai->between($start, $end) || 
                           $activity->tanggal_selesai->between($start, $end) ||
                           ($activity->tanggal_mulai <= $start && $activity->tanggal_selesai >= $end);
                });
                $yearStats[$m] = [
                    'name' => $monthDate->translatedFormat('F'),
                    'count' => $monthActivities->count(),
                    'budget' => $monthActivities->sum('total_nominal'),
                ];
            }
        } else {
            // Prepare Day Totals for background
            foreach ($calendar as $cell) {
                $cellDate = Carbon::parse($cell['date']);
                $activitiesByDate[$cell['date']] = $activities->filter(function($activity) use ($cellDate) {
                    return $cellDate->between($activity->tanggal_mulai, $activity->tanggal_selesai);
                });
            }

            // Chunk calendar into weeks for bar rendering
            $weekChunks = array_chunk($calendar, 7);
            foreach ($weekChunks as $weekCells) {
                $weekStart = Carbon::parse($weekCells[0]['date']);
                $weekEnd = Carbon::parse($weekCells[6]['date']);

                $weekActivities = $activities->filter(function($activity) use ($weekStart, $weekEnd) {
                    return !($activity->tanggal_selesai->startOfDay() < $weekStart->startOfDay() || $activity->tanggal_mulai->startOfDay() > $weekEnd->startOfDay());
                })->sortBy('id')->map(function($activity) use ($weekStart, $weekEnd) {
                    // Calculate positions using dayOfWeekIso (1 = Mon, 7 = Sun)
                    $actualStart = $activity->tanggal_mulai->copy()->startOfDay();
                    $actualEnd = $activity->tanggal_selesai->copy()->startOfDay();
                    $wStart = $weekStart->copy()->startOfDay();
                    $wEnd = $weekEnd->copy()->startOfDay();
                    
                    $startCol = $actualStart->lessThan($wStart) ? 1 : $actualStart->dayOfWeekIso;
                    $endCol = $actualEnd->greaterThan($wEnd) ? 7 : $actualEnd->dayOfWeekIso;
                    $span = max(1, $endCol - $startCol + 1);
                    
                    // Determine Color Class and label based on Komisi or Pimpinan Position
                    $colorClass = 'bg-slate-600'; // Default
                    $textColorClass = 'text-white';
                    $displayLabel = $activity->komisi->nama;

                    if ($activity->komisi_id == 1) $colorClass = 'bg-emerald-500';
                    elseif ($activity->komisi_id == 2) $colorClass = 'bg-blue-500';
                    elseif ($activity->komisi_id == 3) {
                        $colorClass = 'bg-amber-400';
                        $textColorClass = 'text-slate-900';
                    }
                    elseif ($activity->komisi_id == 4) $colorClass = 'bg-purple-500';
                    elseif ($activity->komisi_id == 5) {
                        // Check participants for Pimpinan rank
                        $pimpinan = $activity->anggotas->first(function($a) {
                            return in_array($a->jabatan, ['Ketua DPRD', 'Wakil Ketua I', 'Wakil Ketua II', 'Wakil Ketua III']);
                        });

                        if ($pimpinan) {
                            $displayLabel = $pimpinan->nama . ' / ' . $pimpinan->jabatan;
                            if ($pimpinan->jabatan == 'Ketua DPRD') $colorClass = 'bg-rose-600';
                            elseif ($pimpinan->jabatan == 'Wakil Ketua I') {
                                $colorClass = 'bg-cyan-400';
                                $textColorClass = 'text-slate-900';
                            }
                            elseif ($pimpinan->jabatan == 'Wakil Ketua II') $colorClass = 'bg-fuchsia-600';
                            elseif ($pimpinan->jabatan == 'Wakil Ketua III') $colorClass = 'bg-teal-600';
                        } else {
                            $colorClass = 'bg-slate-700';
                        }
                    }

                    return [
                        'id' => $activity->id,
                        'nama_kegiatan' => $activity->nama_kegiatan,
                        'komisi_nama' => $displayLabel,
                        'lokasi' => $activity->lokasi,
                        'tanggal_mulai' => $activity->tanggal_mulai,
                        'tanggal_selesai' => $activity->tanggal_selesai,
                        'total_nominal' => $activity->total_nominal,
                        'jenis_dinas' => $activity->jenis_dinas,
                        'colorClass' => $colorClass,
                        'textColorClass' => $textColorClass,
                        'anggotas' => $activity->anggotas,
                        'pendampingKegiatans' => $activity->pendampingKegiatans,
                        'startCol' => $startCol,
                        'span' => $span,
                        'isContinuation' => $actualStart->lessThan($wStart),
                        'hasMore' => $actualEnd->greaterThan($wEnd),
                    ];
                });

                $weeks[] = [
                    'cells' => $weekCells,
                    'events' => $weekActivities
                ];
            }
        }

        return view('livewire.kegiatan-dinas-calendar', [
            'weeks' => $weeks,
            'activitiesByDate' => $activitiesByDate,
            'yearStats' => $yearStats,
            'currentMonthName' => $headerText
        ])->layout('layouts.app');
    }
}
