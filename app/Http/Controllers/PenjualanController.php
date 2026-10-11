<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
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
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required|distinct|exists:barangs,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $total = 0;
            $penjualan = Penjualan::create([
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total' => 0,
            ]);

            foreach ($request->barang_id as $index => $barangId) {
                $barang = Barang::whereKey($barangId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $jumlah = (int) $request->jumlah[$index];

                if ($barang->stok < $jumlah) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'jumlah' => "Stok {$barang->nama_barang} tidak mencukupi. Stok tersedia: {$barang->stok}.",
                    ]);
                }

                $harga = $barang->harga;
                $subtotal = $harga * $jumlah;

                DetailPenjualan::create([
                    'penjualan_Id' => $penjualan->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                ]);

                $barang->decrement('stok', $jumlah);
                $total += $subtotal;
            }

            $penjualan->update([
                'total' => $total,
            ]);
        });

        return redirect('/penjualan')
            ->with('success', 'Penjualan berhasil ditambahkan dan stok diperbarui.');
    }


    public function edit($id)
    {
        $penjualan = Penjualan::with('detailPenjualans.barang')
            ->findOrFail($id);

        $pelanggans = Pelanggan::all();
        $barangs = Barang::all();

        return view('penjualan.edit', compact(
            'penjualan',
            'pelanggans',
            'barangs'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'tanggal_penjualan' => 'required|date',
            'barang_id' => 'required|array|min:1',
            'barang_id.*' => 'required|distinct|exists:barangs,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request, $id) {
            $penjualan = Penjualan::findOrFail($id);
            //TAMBAHKAN: Ambil detail penjualan lama 
            $detailLama = DetailPenjualan::where(
                'penjualan_Id',
                $penjualan->id)->get();  
            
            //Tambahkan: kembalikan stok dari penjualan lama
            foreach ($detailLama as $detail) {
                $barang = Barang::findOrFail($detail->barang_id);
                $barang ->increment('stok', $detail->jumlah);
            }

            $detailBaru = [];
            $total = 0;

            foreach ($request->barang_id as $index => $barangId) {
                $barang = Barang::findOrFail($barangId);
                $jumlah = (int) $request->jumlah[$index];

                $harga = $barang->harga;
                $subtotal = $harga * $jumlah;

                if ($barang->stok < $jumlah) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'jumlah' => "Stok {$barang->nama_barang} tidak mencukupi.",
                    ]);
                }
                //kurangin stok sesuai jumlah terbaru
                $barang->decrement('stok', $jumlah);

                $detailBaru[] = [
                    'penjualan_Id' => $penjualan->id,
                    'barang_id' => $barang->id,
                    'jumlah' => $jumlah,
                    'harga' => $harga,
                    'subtotal' => $subtotal,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $total += $subtotal;
            }

            $penjualan->update([
                'pelanggan_id' => $request->pelanggan_id,
                'tanggal_penjualan' => $request->tanggal_penjualan,
                'total' => $total,
            ]);

            DetailPenjualan::where('penjualan_Id', $penjualan->id)
                ->delete();

            DetailPenjualan::insert($detailBaru);
        });

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

    public function show($id)
    {
        $penjualan = Penjualan::with([
            'pelanggan',
            'detailPenjualans.barang',
        ])->findOrFail($id);

        return view('penjualan.detail', compact('penjualan'));
    }
}
