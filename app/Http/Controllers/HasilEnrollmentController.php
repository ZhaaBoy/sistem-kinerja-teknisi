<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;

class HasilEnrollmentController extends Controller
{

    public function index()
    {
        abort_unless(auth()->user()->role === User::ROLE_TEKNISI, 403);

        $assignments = EnrollmentAssignment::where('teknisi_id', auth()->id())
            ->latest()->paginate(10);

        return view('hasil_enrollment.index', compact('assignments'));
    }
    public function create(EnrollmentAssignment $assignment)
    {
        // teknisi hanya boleh input untuk tugas miliknya & yang belum selesai
        abort_unless(auth()->user()->role === User::ROLE_TEKNISI, 403);
        abort_unless($assignment->teknisi_id === auth()->id(), 403);
        abort_if($assignment->status === 'selesai', 403);

        return view('hasil_enrollment.create', compact('assignment'));
    }

    public function store(Request $r, EnrollmentAssignment $assignment)
    {
        abort_unless(auth()->user()->role === User::ROLE_TEKNISI, 403);

        $val = $r->validate([
            'deskripsi_hasil' => ['required', 'string'],
        ]);

        $assignment->deskripsi_hasil = $val['deskripsi_hasil'];
        $assignment->completed_at = now();

        // Cek keterlambatan
        if ($assignment->timeline && now()->gt($assignment->timeline)) {
            $assignment->poin = $assignment->poin / 2;
        }

        // Status berubah jadi PROSES PACKING → role helper
        $assignment->status = 'proses_packing';
        $assignment->save();

        return redirect()->route('hasil-enrollment.index')
            ->with(['type' => 'success', 'message' => 'Hasil pekerjaan disimpan. Status berubah ke Proses Packing.']);
    }

    public function selesaiPacking(EnrollmentAssignment $assignment)
    {
        abort_unless(auth()->user()->role === User::ROLE_HELPER, 403);
        abort_unless($assignment->status === 'proses_packing', 403);

        $assignment->update(['status' => 'selesai']);

        return back()->with(['type' => 'success', 'message' => 'Packing selesai. Status penugasan berubah menjadi Selesai.']);
    }
}
