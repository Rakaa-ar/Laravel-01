<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;


class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::paginate(5);

        return view('inventori.barang', compact('barangs'));
    }
    public function create()
    {
        $kategoris = Kategori::all();

        return view('inventori.tambah', compact('kategoris'));
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
            'kategori_id' => $request->kategori_id,
        ]);

        return redirect('/inventori')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);

        $kategoris = Kategori::all();

        return view('inventori.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori_id' => $request->kategori_id,
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
