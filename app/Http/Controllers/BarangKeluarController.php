<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BarangKeluar;
use App\Models\Barang;
use App\Models\Gudang;
use Illuminate\Support\Facades\Redirect;

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
    public function edit($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barangs = Barang::all();
        $gudang = Gudang::all();

        return view('barang_keluar.edit', compact('barangKeluar', 'barangs', 'gudang'));

    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'barang_id' => 'required',
            'gudang_id' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
        ]);

        $barangKeluar = BarangKeluar::findOrFail($id);

        $barangLama = Barang::findOrfail($barangKeluar->barang_id);
        $barangLama->stok += $barangKeluar->jumlah;
        $barangLama->save();

        //ambil barang yang mau di pilih
        $barangBaru = Barang::findOrfail($request->barang_id);

        if ($barangBaru->stok < $request->jumlah) {
            //kalo engga cukup balikin ke semula
            $barangBaru->stok -= $barangKeluar->jumlah;
            $barangLama->save();

            return back()->with('eror', 'Stok Tidak Mencukupi');
        }

        //kurangi stok dengan jumlah baru
        $barangBaru->stok -= $request->jumlah;
        $barangBaru->save();

        $barangKeluar->update([
            'barang_id' => $request->barang_id,
            'gudang_id' => $request->gudang_id,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,

        ]);

        return redirect('/barang-keluar')->with('success', 'Data Berhasil Di Update');

    }

    public function destroy($id)
    {
        $barangKeluar = BarangKeluar::findOrFail($id);

        $barang = Barang::findOrFail($barangKeluar->barang_id);

        $barang->stok += $barangKeluar->jumlah;
        $barang->save();

        $barangKeluar->delete();

        return redirect('/barang-keluar')->with('success', 'Data Berhasil Di Hapus');
    }
}
