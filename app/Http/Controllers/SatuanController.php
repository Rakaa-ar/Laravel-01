<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Satuan;

class SatuanController extends Controller
{
    public function index()
    {
        $satuans = Satuan::all();

        return view('satuan.index', compact('satuans'));
    }

    public function create()
    {
        return view('satuan.tambah');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_satuan' => 'required',
    ]);

    Satuan::create([
        'nama_satuan' => $request->nama_satuan,
    ]);

    return redirect('/satuan')->with(
        'success',
        'Satuan berhasil ditambahkan'
    );
}

    public function edit($id)
    {
        $satuan = Satuan::findOrFail($id);
        
        return view('satuan.edit', compact('satuan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_satuan' => 'required',
        ]);

        $satuan = Satuan::findOrFail($id);

        $satuan->update([
            'nama_satuan' => $request->nama_satuan,
        ]);

        return redirect('/satuan')->with('success','Satuan Berhasil di Perbarui');
    }
}
