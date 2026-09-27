<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\Gudang;

class BarangKeluarController extends Controller
{
    public function index()
    {
        $barangKeluars = BarangKeluar::with(['barang','gudang'])->paginate(5);

        return view('barang_keluar.index', compact('barangKeluars'));
    }

    public function create()
    {
        $barangs = Barang::all();   
        $gudang = Gudang::all();

        return view('barang_keluar.tambah', compact('barangs', 'gudang'));
    }

    public function store(Request $request)
{
    $request->validate([
        'barang_id' => 'required',
        'gudang_id' => 'required',
        'jumlah' => 'required|integer|min:1',
        'tanggal_keluar' => 'required|date',
    ]);

    $barang = Barang::findOrFail($request->barang_id);

    // Cek stok cukup
    if ($barang->stok < $request->jumlah) {
        return back()->with('error', 'Stok barang tidak mencukupi');
    }

    // Kurangi stok
    $barang->stok -= $request->jumlah;
    $barang->save();

    // Simpan barang keluar
    BarangKeluar::create([
        'barang_id' => $request->barang_id,
        'gudang_id' => $request->gudang_id,
        'jumlah' => $request->jumlah,
        'tanggal_keluar' => $request->tanggal_keluar,
    ]);

    return redirect('/barang-keluar')
        ->with('success', 'Barang Berhasil Di Keluarkan');
}
}
