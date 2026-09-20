<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();

        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'nama_penanggung_jawab' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'nama_penanggung_jawab' => $request->nama_penanggung_jawab,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect('/supplier')->with('success', 'Supplier berhasil ditambahkan!');
    }
    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);

        return view('supplier.edit', compact('supplier'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required',
            'nama_penanggung_jawab' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);
        $supplier = Supplier:: findOrFail($id);

        $supplier->update([
            'nama_supplier' => $request ->nama_supplier,
            'nama_penanggung_jawab' => $request ->nama_penanggung_jawab,
            'no_telepon' => $request->no_telepon,
            'alamat'=> $request->alamat,
        ]);

        return redirect('/supplier')->with('success', 'Supplier berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        $supplier->delete();

        return redirect('/supplier')->with('success', 'Supplier berhasil dihapus!');
    }
}
