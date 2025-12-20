<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;
use Illuminate\Support\Facades\Auth;

class HasilEnrollmentController extends Controller
{

    public function index()
    {
        abort_unless(Auth::user()->role === User::ROLE_TEKNISI, 403);

        $assignments = EnrollmentAssignment::where('teknisi_id', Auth::user()->id)
            ->latest()->paginate(10);

        return view('hasil_enrollment.index', compact('assignments'));
    }

    public function create(EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_TEKNISI, 403);
        abort_unless($assignment->teknisi_id === Auth::id(), 403);
        abort_if($assignment->status === 'selesai', 403);

        return view('hasil_enrollment.create', compact('assignment'));
    }

    public function store(Request $r, EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_TEKNISI, 403);

        $val = $r->validate([
            'deskripsi_hasil' => ['required', 'string', 'max:1000'],
            'solusi'          => ['required', 'string', 'max:1000'],
        ]);

        $now = now();

        $fullPoint = \App\Http\Controllers\EnrollmentAssignmentController::POIN[$assignment->tingkat_kesulitan];

        if ($assignment->timeline) {
            $deadline = \Carbon\Carbon::parse($assignment->timeline);
            $finalPoint = $now->lte($deadline)
                ? $fullPoint
                : floor($fullPoint / 2);
        } else {
            $finalPoint = $fullPoint;
        }

        $assignment->update([
            'deskripsi_hasil' => $val['deskripsi_hasil'],
            'solusi'          => $val['solusi'],
            'completed_at'    => $now,
            'poin'            => $finalPoint,
            'status'          => 'proses_packing',
        ]);

        return redirect()
            ->route('hasil-enrollment.index')
            ->with([
                'type' => 'success',
                'message' => 'Hasil pekerjaan dan solusi berhasil disimpan.'
            ]);
    }


    public function selesaiPacking(EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_HELPER, 403);
        abort_unless($assignment->status === 'proses_packing', 403);

        $assignment->update(['status' => 'selesai']);

        return back()->with(['type' => 'success', 'message' => 'Packing selesai. Status penugasan berubah menjadi Selesai.']);
    }
}
