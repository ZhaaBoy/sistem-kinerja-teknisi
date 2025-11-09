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
        // teknisi hanya boleh input untuk tugas miliknya & yang belum selesai
        abort_unless(Auth::user()->role === User::ROLE_TEKNISI, 403);
        abort_unless($assignment->teknisi_id === Auth::user()->id(), 403);
        abort_if($assignment->status === 'selesai', 403);

        return view('hasil_enrollment.create', compact('assignment'));
    }

    public function store(Request $r, EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_TEKNISI, 403);

        $val = $r->validate([
            'deskripsi_hasil' => ['required', 'string', 'max:1000'],
        ]);

        $now = now();

        // Update hasil pengerjaan teknisi
        $assignment->update([
            'deskripsi_hasil' => $val['deskripsi_hasil'],
            'completed_at' => $now,
            'status' => 'proses_packing',
        ]);

        // 💡 Kurangi poin jika penyelesaian lewat timeline
        if ($assignment->timeline && $now->greaterThan($assignment->timeline)) {
            $assignment->update([
                'poin' => $assignment->poin / 2,
            ]);
        }

        return redirect()
            ->route('hasil-enrollment.index')
            ->with([
                'type' => 'success',
                'message' => 'Hasil pekerjaan disimpan. Status berubah ke Proses Packing.'
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
