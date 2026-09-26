<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use Illuminate\Pagination\Paginator;

use function Pest\Laravel\delete;

class GudangController extends Controller
{
    public function index()
    {
        $gudang = Gudang::Paginate(5);

        return view('gudang.index', compact('gudang'));
    }

    public function create()
    {
        return view('gudang.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'alamat' => 'nullable',
        ]);

        Gudang::create([
            'nama_gudang' => $request->nama_gudang,
            'alamat' => $request->alamat,

        ]);

        return redirect('/gudang')->with('success', 'Gudang Berhasil di tambahkan');
    }

    public function edit($id)
    {
        $gudang = Gudang::findOrFail($id);

        return view('gudang.edit', compact('gudang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_gudang' => 'required',
            'alamat' => 'nullable',
        ]);

        $gudang = Gudang::findOrFail($id);

        $gudang->update([
            'nama_gudang' => $request->nama_gudang,
            'alamat' => $request->alamat,
        ]);

        return redirect('/gudang', 'success', 'Data Berhasil Di Perbarui');
    }

    public function destroy($id)
    {
        $gudang = Gudang::findOrFail($id);

        $gudang->delete();

        return redirect('/gudang')->with('success', 'Data Berhasil Di Hapus');
    }
}
