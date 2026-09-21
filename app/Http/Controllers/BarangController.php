<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all();

        return view('inventori.barang', compact('barangs'));
    }
    public function create()
    {
        return view('inventori.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/inventori')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        return view('inventori.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
        ]);

        return redirect('/inventori')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        $barang->delete();

        return redirect('/inventori')->with('success', 'Barang berhasil dihapus!');
    }
}
