<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Pelanggan;
use App\Models\Barang;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('pelanggan')->get();

        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();

        return view('penjualan.tambah', compact('pelanggans', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_penjualan' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        Penjualan::create([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total' => $request->total,
        ]);

        return redirect('/penjualan')->with('success', 'Penjualan Berhasil DI Tambahkan');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $pelanggans = Pelanggan::all();

        return view('penjualan.edit', compact('penjualan', 'pelanggans'));
    }

    public function update(Request $request, $id)
    {
        $request->merge([
            'total' => str_replace('.', '', $request->total),
        ]);

        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_penjualan' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'pelanggan_id' => $request->pelanggan_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'total' => $request->total,
        ]);

        return redirect('/penjualan')->with(
            'success',
            'Data Penjualan Berhasil Diperbarui!'
        );
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $penjualan->delete();

        return redirect('/penjualan')->with('success', 'Penjualan Berhasil Dihapus');
    }
}
