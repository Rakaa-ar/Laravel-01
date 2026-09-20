<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\Supplier;

class BarangMasukController extends Controller
{
    public function index()
    {
        $barangMasuks = BarangMasuk::with(['barang', 'supplier'])->get();

        return view('barang_masuk.index', compact('barangMasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();

        $suppliers = Supplier::all();

        return view('barang_masuk.tambah', compact('barangs', 'suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        BarangMasuk::create([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        $barang = Barang::findOrFail($request->barang_id);

        $barang->stok += $request->jumlah;
        $barang->save();

        return redirect('/barang-masuk')->with(
            'success',
            'Barang masuk berhasil ditambahkan!'
        );
    }
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $barangs = Barang::all();
        $suppliers = Supplier::all();

        return view('barang_masuk.edit', compact(
            'barangMasuk',
            'barangs',
            'suppliers'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required',
            'supplier_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);

        // Barang lama
        $barangLama = Barang::findOrFail($barangMasuk->barang_id);

        // Kembalikan stok dari transaksi lama
        $barangLama->stok -= $barangMasuk->jumlah;
        $barangLama->save();

        // Barang baru
        $barangBaru = Barang::findOrFail($request->barang_id);

        // Tambahkan stok sesuai transaksi baru
        $barangBaru->stok += $request->jumlah;
        $barangBaru->save();

        // Update transaksi
        $barangMasuk->update([
            'barang_id' => $request->barang_id,
            'supplier_id' => $request->supplier_id,
            'jumlah' => $request->jumlah,
            'tanggal_masuk' => $request->tanggal_masuk,
        ]);

        return redirect('/barang-masuk')->with(
            'success',
            'Barang masuk berhasil diperbarui!'
        );
    }

    public function destroy($id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);

        $barang = Barang::findOrFail($barangMasuk->barang_id);

        $barang->stok -= $barangMasuk->jumlah;
        $barang->save();

        $barangMasuk->delete();

        return redirect('/barang-masuk')->with(
            'success',
            'Barang masuk berhasil dihapus!'
        );
    }
}
