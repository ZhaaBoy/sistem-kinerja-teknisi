<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;
use Illuminate\Support\Facades\Auth;

class EnrollmentAssignmentController extends Controller
{
    public const POIN = ['mudah' => 5, 'menengah' => 10, 'sulit' => 20];
    public function hitungPoin(EnrollmentAssignment $assignment)
    {
        $fullPoint = self::POIN[$assignment->tingkat_kesulitan];

        if (!$assignment->completed_at || !$assignment->timeline) {
            return 0;
        }

        $completed = \Carbon\Carbon::parse($assignment->completed_at);
        $deadline  = \Carbon\Carbon::parse($assignment->timeline);

        // Jika sebelum atau tepat deadline → poin penuh
        if ($completed->lte($deadline)) {
            return $fullPoint;
        }

        // Jika melewati deadline → setengah
        return floor($fullPoint / 2);
    }


    public function index()
    {
        $user = Auth::user();

        $q = EnrollmentAssignment::with(['teknisi', 'customer', 'barang']);

        if ($user->role === User::ROLE_TEKNISI) {
            $q->where('teknisi_id', $user->id);
        }

        if ($user->role === User::ROLE_HELPER) {
            $q->where('status', 'proses_packing');
        }

        $assignments = $q->latest()->paginate(10);

        return view('penugasan_enrollment.index', compact('assignments'));
    }

    public function create()
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        $busyTeknisi = EnrollmentAssignment::where('status', 'dikerjakan_teknisi')
            ->pluck('teknisi_id')
            ->toArray();

        $teknisi = User::where('role', User::ROLE_TEKNISI)
            ->whereNotIn('id', $busyTeknisi)
            ->orderBy('name')
            ->get();

        return view('penugasan_enrollment.create', compact('teknisi'));
    }

    public function store(Request $r)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        $val = $r->validate([
            'customer_id'       => ['required', 'exists:customers,id'],
            'barang_id'         => ['required', 'exists:barangs,id'],
            'qty'               => ['required', 'integer', 'min:1'],
            'timeline'          => ['required', 'date'],
            'teknisi_id'        => ['required', 'exists:users,id'],
            'tingkat_kesulitan' => ['required', 'in:mudah,menengah,sulit'],
        ]);

        $val['kepala_gudang_id'] = Auth::id();
        $val['status'] = 'dikerjakan_teknisi'; // tidak set poin di sini

        EnrollmentAssignment::create($val);

        return redirect()->route('penugasan-enrollment.index')
            ->with(['type' => 'success', 'message' => 'Penugasan berhasil dibuat.']);
    }

    public function edit(EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);
        abort_if($assignment->status !== 'dikerjakan_teknisi', 403);

        $teknisi = User::where('role', User::ROLE_TEKNISI)->orderBy('name')->get();

        return view('penugasan_enrollment.edit', compact('assignment', 'teknisi'));
    }

    public function update(Request $r, EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);
        abort_if($assignment->status !== 'dikerjakan_teknisi', 403);

        $val = $r->validate([
            'customer_id'       => ['required', 'exists:customers,id'],
            'barang_id'         => ['required', 'exists:barangs,id'],
            'qty'               => ['required', 'integer', 'min:1'],
            'timeline'          => ['required', 'date'],
            'teknisi_id'        => ['required', 'exists:users,id'],
            'tingkat_kesulitan' => ['required', 'in:mudah,menengah,sulit'],
        ]);

        // tidak set poin di update
        $assignment->update($val);

        return redirect()->route('penugasan-enrollment.index')
            ->with(['type' => 'info', 'message' => 'Penugasan berhasil diperbarui.']);
    }

    public function destroy(EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        $assignment->delete();

        return back()->with(['type' => 'error', 'message' => 'Penugasan dihapus.']);
    }
}
