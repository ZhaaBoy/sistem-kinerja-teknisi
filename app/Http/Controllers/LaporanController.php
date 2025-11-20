<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\EnrollmentAssignment;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = EnrollmentAssignment::with('teknisi')
            ->where('status', 'selesai')
            ->latest();

        // 👇 Filter hanya untuk teknisi
        if ($user->role === User::ROLE_TEKNISI) {
            $query->where('teknisi_id', $user->id);
        }

        $assignments = $query->paginate(10);

        return view('laporan_enrollment.index', compact('assignments'));
    }

    public function cetak(EnrollmentAssignment $assignment)
    {
        $pdf = \PDF::loadView('laporan_enrollment.pdf', compact('assignment'));
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan_' . $assignment->kode_barang . '.pdf');
    }

    public function cetakSemua(Request $r)
    {
        $user = Auth::user();

        $query = EnrollmentAssignment::with('teknisi')
            ->where('status', 'selesai')
            ->orderBy('teknisi_id');

        // Kalau teknisi login → hanya cetak miliknya
        if ($user->role === User::ROLE_TEKNISI) {
            $query->where('teknisi_id', $user->id);
        }

        $assignments = $query->get();

        $pdf = \PDF::loadView('laporan_enrollment.pdf_semua', [
            'assignments' => $assignments,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Laporan-Semua-Teknisi-' . now()->format('d-m-Y') . '.pdf');
    }
}
