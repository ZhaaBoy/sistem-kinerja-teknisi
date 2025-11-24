<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    // Display a listing of barangs
    public function index()
    {
        $barangs = Barang::all();
        return view('barangs.index', compact('barangs'));
    }

    // Show the form for creating a new barang
    public function create()
    {
        return view('barangs.create');
    }

    // Store a newly created barang in storage
    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        Barang::create($request->all());

        return redirect()->route('barangs.index')->with(['type' => 'success', 'message' => 'Barang berhasil dibuat.']);
    }

    // Show the form for editing the specified barang
    public function edit(Barang $barang)
    {
        return view('barangs.edit', compact('barang'));
    }

    // Update the specified barang in storage
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'kode_barang' => 'required|string|max:50',
            'nama_barang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $barang->update($request->all());

        return redirect()->route('barangs.index')->with('success', 'Barang updated successfully.');
    }

    // Remove the specified barang from storage
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barangs.index')->with(['type' => 'success', 'message' => 'Penugasan berhasil dibuat.']);
    }
}
