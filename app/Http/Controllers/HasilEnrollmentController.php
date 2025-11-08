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
            ->latest()
            ->get();

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
        abort_unless($assignment->teknisi_id === auth()->id(), 403);
        abort_if($assignment->status === 'selesai', 403);

        $data = $r->validate([
            'deskripsi_hasil' => ['required', 'string', 'min:5'],
        ]);

        $assignment->update([
            'deskripsi_hasil' => $data['deskripsi_hasil'],
            'status'          => 'selesai',
            'completed_at'    => now(),
        ]);

        // tambah poin teknisi (nullable safe)
        $user = auth()->user();
        $user->score = ($user->score ?? 0) + ($assignment->poin ?? 0);
        $user->save();

        return redirect()->route('penugasan-enrollment.index')
            ->with(['type' => 'success', 'message' => 'Hasil disimpan dan penugasan selesai.']);
    }
}
