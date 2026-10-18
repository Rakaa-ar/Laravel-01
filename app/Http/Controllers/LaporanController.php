<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Pembelian;
use App\Models\Penjualan;


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $queryPenjualan = Penjualan::query();
        $queryPembelian = Pembelian::query();

        if ($tanggal_mulai && $tanggal_akhir) {

            $queryPenjualan->whereBetween('tanggal_penjualan', [$tanggal_mulai . '00:00:00', $tanggal_akhir . '23:59:59']);
            $queryPembelian->whereBetween('tanggal_pembelian', [$tanggal_mulai . '00:00:00', $tanggal_akhir . '23:59:59']);
        } 

        $penjualan = $queryPenjualan->latest('tanggal_penjualan')->get();
        $pembelian = $queryPembelian->latest('tanggal_pembelian')->get();

        return view('laporan.index', compact('penjualan', 'pembelian', 'tanggal_mulai', 'tanggal_akhir'));
    }

    public function cetakPdf(Request $request)
    {
        $tanggal_mulai = $request->input('tanggal_mulai');
        $tanggal_akhir = $request->input('tanggal_akhir');

        $queryPenjualan = Penjualan::query();
        $queryPembelian = Pembelian::query();

        if ($tanggal_mulai && $tanggal_akhir) {
            $queryPenjualan->whereBetween('tanggal_penjualan', [$tanggal_mulai . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
            $queryPembelian->whereBetween('tanggal_pembelian', [$tanggal_mulai . ' 00:00:00', $tanggal_akhir . ' 23:59:59']);
        }

        $penjualan = $queryPenjualan->latest('tanggal_penjualan')->get();
        $pembelian = $queryPembelian->latest('tanggal_pembelian')->get();

        // Load view khusus buat PDF
        $pdf = Pdf::loadView('laporan.pdf', compact('penjualan', 'pembelian', 'tanggal_mulai', 'tanggal_akhir'));
        
        // Atur ukuran kertas ke A4 (opsional)
        $pdf->setPaper('A4', 'portrait');

        return $pdf->download('Laporan-Transaksi.pdf');
        
    }
}
