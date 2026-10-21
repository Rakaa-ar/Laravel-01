<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Data untuk 4 Kotak di atas
        $total_barang = Barang::count();
        $total_supplier = Supplier::count();
        $uang_masuk = Penjualan::sum('total');
        $uang_keluar = Pembelian::sum('total');

        // 2. Data Grafik: Rekap Penjualan (Uang Masuk) Per Bulan di Tahun Ini
        $penjualan_per_bulan = Penjualan::select(
            DB::raw('MONTH(tanggal_penjualan) as bulan'),
            DB::raw('SUM(total) as total')
        )
        ->whereYear('tanggal_penjualan', date('Y'))
        ->groupBy('bulan')
        ->pluck('total', 'bulan')->all();

        // 3. Data Grafik: Rekap Pembelian (Uang Keluar) Per Bulan di Tahun Ini
        $pembelian_per_bulan = Pembelian::select(
            DB::raw('MONTH(tanggal_pembelian) as bulan'),
            DB::raw('SUM(total) as total')
        )
        ->whereYear('tanggal_pembelian', date('Y'))
        ->groupBy('bulan')
        ->pluck('total', 'bulan')->all();

        // 4. Siapin array 12 bulan (kosongin dulu pakai angka 0)
        $data_masuk = array_fill(1, 12, 0);
        $data_keluar = array_fill(1, 12, 0);

        // Isi array dengan data asli dari database
        foreach ($penjualan_per_bulan as $bulan => $total) {
            $data_masuk[$bulan] = $total;
        }
        foreach ($pembelian_per_bulan as $bulan => $total) {
            $data_keluar[$bulan] = $total;
        }

        // 5. Lempar data ke View (ubah format ke JSON biar bisa dibaca Javascript)
        return view('dashboard.index', [
            'total_barang' => $total_barang,
            'total_supplier' => $total_supplier,
            'uang_masuk' => $uang_masuk,
            'uang_keluar' => $uang_keluar,
            'grafik_masuk' => json_encode(array_values($data_masuk)),
            'grafik_keluar' => json_encode(array_values($data_keluar)),
        ]);
    }
}