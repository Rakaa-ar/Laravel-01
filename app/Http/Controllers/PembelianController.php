<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Barang;
use App\Models\Supplier;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::all();

        return view('pembelian.index', compact('pembelians'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $barangs = Barang::all();

        return view('pembelian.tambah', compact('suppliers', 'barangs'));
    }
}
