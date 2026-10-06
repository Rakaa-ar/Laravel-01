<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = Pelanggan::paginate(5);

        return view('pelanggan.index', compact('pelanggans'));
    }

    public function create()
    {
        return view('pelanggan.tambah');
    }

    public function store(Request $request)
    { 
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        Pelanggan::create([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect('/pelanggan')->with('success', 'Pelanggan Berhasil Di Tambahkan');

    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        return view('pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update([
            'nama_pelanggan' => $request->nama_pelanggan,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
        ]);

        return redirect('/pelanggan')->with('success', 'Data Pelanggan Berhasil Di Perbarui');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();

        return redirect('/pelanggan')->with('success', 'Data Pelanggan Berhasil Di Hapus');
    }
}
