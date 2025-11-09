<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $r)
    {
        $user = Auth::user();

        // Filter tanggal
        $start = $r->input('start_date') ? Carbon::parse($r->input('start_date'))->startOfDay() : now()->startOfMonth();
        $end = $r->input('end_date') ? Carbon::parse($r->input('end_date'))->endOfDay() : now()->endOfMonth();

        $query = EnrollmentAssignment::with('teknisi')
            ->whereBetween('created_at', [$start, $end]);

        // Role-based filtering
        if ($user->role === User::ROLE_TEKNISI) {
            $query->where('teknisi_id', $user->id);
        }

        $assignments = $query->get();

        // Statistik
        $grouped = $assignments->groupBy('teknisi_id');
        $stats = $grouped->map(function ($rows) {
            return [
                'nama' => $rows->first()->teknisi->name ?? '-',
                'jumlah' => $rows->count(),
                'selesai' => $rows->where('status', 'selesai')->count(),
                'dikerjakan' => $rows->where('status', 'dikerjakan_teknisi')->count(),
                'poin' => $rows->sum('poin'),
            ];
        });

        // Data untuk Chart
        $chartLabels = $stats->pluck('nama');
        $chartValues = $stats->pluck('poin');

        // Data untuk Pie Chart (convert to array numeric)
        $totalPoin = max($stats->sum('poin'), 1);
        $pieData = $stats->map(function ($s) use ($totalPoin) {
            return round(($s['poin'] / $totalPoin) * 100, 2);
        })->values()->toArray();

        if ($chartLabels->isEmpty()) {
            $chartLabels = collect(['Tidak ada data']);
            $chartValues = collect([0]);
            $pieData = [100];
        }

        return view('dashboard', [
            'user' => $user,
            'stats' => $stats,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
            'pieData' => $pieData,
            'start' => $start->format('Y-m-d'),
            'end' => $end->format('Y-m-d'),
        ]);
    }

    public function cetak(Request $r)
    {
        $start = $r->input('start_date');
        $end = $r->input('end_date');

        $assignments = EnrollmentAssignment::with('teknisi')
            ->whereBetween('created_at', [$start, $end])
            ->get();

        $pdf = \PDF::loadView('cetaknilai', compact('assignments', 'start', 'end'))->setPaper('a4', 'portrait');
        return $pdf->stream('Laporan-Nilai-' . now()->format('d-m-Y') . '.pdf');
    }
}
