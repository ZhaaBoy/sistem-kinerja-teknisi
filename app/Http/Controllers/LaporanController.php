<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;

class LaporanController extends Controller
{
    public function index(Request $r)
    {
        $query = EnrollmentAssignment::with('teknisi')->orderByDesc('created_at');

        // opsional: filter
        if ($r->filled('status')) {
            $query->where('status', $r->status);
        }

        if ($r->filled('teknisi_id')) {
            $query->where('teknisi_id', $r->teknisi_id);
        }

        $assignments = $query->paginate(10);

        return view('laporan_enrollment.index', compact('assignments'));
    }

    public function cetak(EnrollmentAssignment $assignment)
    {
        $pdf = PDF::loadView('laporan_enrollment.pdf', compact('assignment'))
            ->setPaper('A4', 'portrait');

        return $pdf->stream("Laporan-{$assignment->kode_barang}.pdf");
    }
}
