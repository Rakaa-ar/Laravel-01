<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\DetailPembelian;

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
}
