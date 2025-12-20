<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // eager load biar index tidak N+1
        $customers = Customer::with('barang')->get();

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_telpon'     => 'required|string|max:20',
            'nama_pic'      => 'required|string|max:255',
            'barang_id'     => 'nullable|exists:barangs,id',
            'keterangan'    => 'nullable|string',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    public function edit(Customer $customer)
    {
        // kalau edit nanti mau kamu tambahin search barang juga, tinggal reuse script yang sama
        $customer->load('barang');

        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'alamat'        => 'required|string',
            'no_telpon'     => 'required|string|max:20',
            'nama_pic'      => 'required|string|max:255',
            'barang_id'     => 'nullable|exists:barangs,id',
            'keterangan'    => 'nullable|string',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
