<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EnrollmentAssignment;
use Illuminate\Support\Facades\Auth;

class EnrollmentAssignmentController extends Controller
{
    // mapping poin per kesulitan
    private const POIN = ['mudah' => 5, 'menengah' => 10, 'sulit' => 20];

    public function index()
    {
        $user = Auth::user();
        $q = EnrollmentAssignment::with(['teknisi']);

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
        // Hanya kepala gudang yang bisa akses
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        // Ambil ID teknisi yang sedang mengerjakan penugasan (status masih aktif)
        $busyTeknisiIds = \App\Models\EnrollmentAssignment::whereIn('status', ['dikerjakan_teknisi'])
            ->pluck('teknisi_id')
            ->toArray();

        // Ambil teknisi yang tidak sedang mengerjakan tugas
        $teknisi = \App\Models\User::where('role', User::ROLE_TEKNISI)
            ->whereNotIn('id', $busyTeknisiIds)
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('penugasan_enrollment.create', compact('teknisi'));
    }

    public function store(Request $r)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        $val = $r->validate([
            'nama_barang'       => ['required', 'string', 'max:255'],
            'nama_customer'     => ['required', 'string', 'max:255'],
            'kode_barang'       => ['nullable', 'string', 'max:100'],
            'qty'               => ['required', 'integer', 'min:1'],
            'timeline'          => ['required', 'date'],
            'teknisi_id'        => ['required', 'exists:users,id'],
            'tingkat_kesulitan' => ['required', 'in:mudah,menengah,sulit'],
        ]);

        // ✅ generate kode otomatis jika tidak diisi
        if (empty($val['kode_barang'])) {
            $last = EnrollmentAssignment::orderBy('id', 'desc')->first();
            $nextNumber = $last ? $last->id + 1 : 1;
            $val['kode_barang'] = 'BRG-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }

        $val['kepala_gudang_id'] = Auth::id();
        $val['poin'] = self::POIN[$val['tingkat_kesulitan']];
        $val['status'] = 'dikerjakan_teknisi';

        EnrollmentAssignment::create($val);

        return redirect()->route('penugasan-enrollment.index')
            ->with(['type' => 'success', 'message' => 'Penugasan berhasil dibuat.']);
    }

    public function edit(EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);

        // ❌ hanya boleh edit selama belum selesai
        abort_if($assignment->status !== 'dikerjakan_teknisi', 403, 'Penugasan sudah selesai dan tidak bisa diubah.');

        $teknisi = User::where('role', User::ROLE_TEKNISI)->orderBy('name')->get(['id', 'name']);

        return view('penugasan_enrollment.edit', compact('assignment', 'teknisi'));
    }

    public function update(Request $r, EnrollmentAssignment $assignment)
    {
        abort_unless(Auth::user()->role === User::ROLE_KEPALA_GUDANG, 403);
        abort_if($assignment->status !== 'dikerjakan_teknisi', 403, 'Penugasan sudah selesai dan tidak bisa diubah.');

        $val = $r->validate([
            'nama_barang'       => ['required', 'string', 'max:255'],
            'nama_customer'     => ['required', 'string', 'max:255'],
            'kode_barang'       => ['required', 'string', 'max:100'],
            'qty'               => ['required', 'integer', 'min:1'],
            'timeline'          => ['required', 'date'],
            'teknisi_id'        => ['required', 'exists:users,id'],
            'tingkat_kesulitan' => ['required', 'in:mudah,menengah,sulit'],
        ]);

        $val['poin'] = self::POIN[$val['tingkat_kesulitan']];

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
