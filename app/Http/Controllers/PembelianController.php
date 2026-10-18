<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\DetailPembelian;
use Illuminate\Auth\Events\Validated;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with([
            'supplier',
            'detailPembelians.barang'
        ])->latest()->get();


        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Barang::all();

        return view('pembelian.tambah', compact('suppliers', 'barangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal_pembelian' => 'required|date',
            'referensi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated) {
            $total = 0;
            $items = [];

            foreach ($validated['items'] as $item) {
                $subtotal = $item['jumlah'] * $item['harga'];

                $items[] = [
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'subtotal' => $subtotal,
                ];

                $total += $subtotal;
            }

            $pembelian = Pembelian::create([
                'supplier_id' => $validated['supplier_id'],
                'tanggal_pembelian' => $validated['tanggal_pembelian'],
                'referensi' => $validated['referensi'] ?? null,
                'catatan' => $validated['catatan'] ?? null,
                'total' => $total,
            ]);

            foreach ($items as $item) {
                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'subtotal' => $item['subtotal'],
                ]);

                $barang = Barang::whereKey($item['barang_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $barang->increment('stok', $item['jumlah']);

                BarangMasuk::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $item['barang_id'],
                    'supplier_id' => $validated['supplier_id'],
                    'jumlah' => $item['jumlah'],
                    'tanggal_masuk' => $validated['tanggal_pembelian'],
                ]);
            }
        });

        return redirect('/pembelian')
            ->with('success', 'Pembelian berhasil disimpan!');
    }

    public function edit($id)
    {
        $pembelian = Pembelian::with([
            'supplier',
            'detailpembelians.barang',
        ])->findOrFail($id);

        $suppliers = Supplier::all();
        $barangs = Barang::all();

        return view('pembelian.edit', compact('pembelian', 'suppliers', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal_pembelian' => 'required|date',
            'referensi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',

            'items' => 'required|array|min:1',
            'items.*.barang_id' => 'required|exists:barangs,id',
            'items.*.jumlah' => 'required|integer|min:1',
            'items.*.harga' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($validated, $id) {
            $pembelian = Pembelian::with('detailPembelians')
                ->lockForUpdate()
                ->findOrFail($id);

            // Simpan detail pembelian lama
            $detailLama = $pembelian->detailPembelians;

            // Kurangi stok berdasarkan jumlah lama
            foreach ($detailLama as $detail) {
                $barang = Barang::whereKey($detail->barang_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $barang->decrement('stok', $detail->jumlah);
            }

            // Hapus detail lama dan riwayat barang masuk terkait
            BarangMasuk::where('pembelian_id', $pembelian->id)->delete();
            $pembelian->detailPembelians()->delete();

            $total = 0;

            foreach ($validated['items'] as $item) {
                $subtotal = $item['jumlah'] * $item['harga'];
                $total += $subtotal;

                DetailPembelian::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $item['barang_id'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga'],
                    'subtotal' => $subtotal,
                ]);

                $barang = Barang::whereKey($item['barang_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $barang->increment('stok', $item['jumlah']);

                BarangMasuk::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $item['barang_id'],
                    'supplier_id' => $validated['supplier_id'],
                    'jumlah' => $item['jumlah'],
                    'tanggal_masuk' => $validated['tanggal_pembelian'],
                ]);
            }

            $pembelian->update([
                'supplier_id' => $validated['supplier_id'],
                'tanggal_pembelian' => $validated['tanggal_pembelian'],
                'referensi' => $validated['referensi'] ?? null,
                'catatan' => $validated['catatan'] ?? null,
                'total' => $total,
            ]);
        });

        return redirect('/pembelian')->with('success', 'Pembelian berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            //CARI PEMBELIAN  BERSERTA DETAILNYA
            $pembelian = Pembelian::with('detailPembelians')
                ->lockForUpdate()
                ->findOrFail($id);
            //BALIKIN STOK BARANG
            foreach ($pembelian->detailPembelians as $detail) {
                $barang = Barang::whereKey($detail->barang_id)
                    ->lockForUpdate()
                    ->firstOrFail();
            //KURANGIN STOK BARANG SEJUMLAH QTY YANG ADA DI DETAIL PEMBELIAN
                $barang->decrement('stok', $detail->jumlah);
            }

            BarangMasuk::where('pembelian_id', $pembelian->id)->delete();

            $pembelian->detailPembelians()->delete();

            $pembelian->delete();
        });

        return redirect('/pembelian')->with('success', 'Data Pembelian Berhasil di Hapus dan stok otomatis di kembalikan');
    }
}
