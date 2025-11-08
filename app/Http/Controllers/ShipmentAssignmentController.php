<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShipmentAssignment;
use App\Models\EnrollmentAssignment;

class ShipmentAssignmentController extends Controller
{
    public function index()
    {
        $shipments = ShipmentAssignment::with('penugasan.teknisi')->latest()->paginate(10);
        return view('penugasan_pengiriman.index', compact('shipments'));
    }

    public function create()
    {
        abort_unless(auth()->user()->role === User::ROLE_KEPALA_GUDANG, 403);

        // hanya ambil penugasan selesai & belum dikirim
        $selesai = EnrollmentAssignment::selesai()
            ->doesntHave('pengiriman')
            ->orderByDesc('completed_at')
            ->get(['id', 'nama_barang', 'qty']);

        return view('penugasan_pengiriman.create', compact('selesai'));
    }

    public function store(Request $r)
    {
        abort_unless(auth()->user()->role === User::ROLE_KEPALA_GUDANG, 403);

        $v = $r->validate([
            'enrollment_assignment_id' => ['required', 'exists:enrollment_assignments,id'],
            'no_resi'    => ['nullable', 'string', 'max:100'],
            'jasa_kirim' => ['nullable', 'string', 'max:100'],
        ]);

        ShipmentAssignment::create($v);

        return redirect()->route('penugasan-pengiriman.index')
            ->with(['type' => 'success', 'message' => 'Pengiriman berhasil dibuat.']);
    }

    public function edit(ShipmentAssignment $shipment)
    {
        abort_unless(auth()->user()->role === User::ROLE_KEPALA_GUDANG, 403);
        return view('penugasan_pengiriman.edit', compact('shipment'));
    }

    public function update(Request $r, ShipmentAssignment $shipment)
    {
        abort_unless(auth()->user()->role === User::ROLE_KEPALA_GUDANG, 403);
        $v = $r->validate([
            'no_resi'    => ['nullable', 'string', 'max:100'],
            'jasa_kirim' => ['nullable', 'string', 'max:100'],
        ]);

        $shipment->update($v);
        return back()->with(['type' => 'info', 'message' => 'Data pengiriman diperbarui.']);
    }

    public function destroy(ShipmentAssignment $shipment)
    {
        abort_unless(auth()->user()->role === User::ROLE_KEPALA_GUDANG, 403);
        $shipment->delete();
        return back()->with(['type' => 'error', 'message' => 'Data pengiriman dihapus.']);
    }
}
