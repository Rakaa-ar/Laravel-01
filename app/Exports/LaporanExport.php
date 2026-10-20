<?php

namespace App\Exports;

use App\Models\Penjualan;
use App\Models\Pembelian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class LaporanExport implements FromView, ShouldAutoSize 
{
  protected $tanggal_mulai;
  protected $tanggal_akhir;

  public function __construct($tanggal_mulai, $tanggal_akhir)
  {
    $this->tanggal_mulai = $tanggal_mulai;
    $this->tanggal_akhir = $tanggal_akhir;
  }

  public function view(): View
  {
    $queryPenjualan = Penjualan::query();
    $queryPembelian = Pembelian::query();

    if ($this->tanggal_mulai && $this->tanggal_akhir) {
      $queryPenjualan->whereBetween('tanggal_penjualan', [$this->tanggal_mulai . ' 00:00:00', $this->tanggal_akhir . ' 23:59:59']);
      $queryPembelian->whereBetween('tanggal_pembelian', [$this->tanggal_mulai . ' 00:00:00', $this->tanggal_akhir . ' 23:59:59']);
    }

    return view('laporan.excel', [
      'penjualan' => $queryPenjualan->latest('tanggal_penjualan')->get(),
      'pembelian' => $queryPembelian->latest('tanggal_pembelian')->get(),
      'tanggal_mulai' => $this->tanggal_mulai,
      'tanggal_akhir' => $this->tanggal_akhir
    ]);
  }
}