<table>
    <!-- BARIS KOSONG BUAT JUDUL -->
    <tr>
        <td colspan="4" style="text-align: center; font-weight: bold; font-size: 14px;">LAPORAN TRANSAKSI GUDANG</td>
    </tr>
    <tr>
        <td colspan="4" style="text-align: center;">
            @if($tanggal_mulai && $tanggal_akhir)
                Periode: {{ $tanggal_mulai }} s/d {{ $tanggal_akhir }}
            @else
                Periode: Semua Data
            @endif
        </td>
    </tr>
    <tr><td colspan="4"></td></tr> 

    <!-- TABEL PENJUALAN -->
    <tr>
        <td colspan="4" style="font-weight: bold; background-color: #d4edda;">Data Penjualan (Uang Masuk)</td>
    </tr>
    <tr>
        <th style="font-weight: bold; border: 1px solid #000;">No</th>
        <th style="font-weight: bold; border: 1px solid #000;">Tanggal</th>
        <th style="font-weight: bold; border: 1px solid #000;">No Transaksi</th>
        <th style="font-weight: bold; border: 1px solid #000;">Total</th>
    </tr>
    @foreach($penjualan as $index => $item)
    <tr>
        <td style="border: 1px solid #000;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000;">{{ $item->tanggal_penjualan }}</td>
        <td style="border: 1px solid #000;">TRX-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
        <td style="border: 1px solid #000;">{{ $item->total }}</td>
    </tr>
    @endforeach
    <tr>
        <th colspan="3" style="font-weight: bold; text-align: right; border: 1px solid #000;">Total Keseluruhan Uang Masuk:</th>
        <th style="font-weight: bold; border: 1px solid #000;">{{ $penjualan->sum('total') }}</th>
    </tr>

    <tr><td colspan="4"></td></tr> 

    <!-- TABEL PEMBELIAN -->
    <tr>
        <td colspan="4" style="font-weight: bold; background-color: #f8d7da;">Data Pembelian (Uang Keluar)</td>
    </tr>
    <tr>
        <th style="font-weight: bold; border: 1px solid #000;">No</th>
        <th style="font-weight: bold; border: 1px solid #000;">Tanggal</th>
        <th style="font-weight: bold; border: 1px solid #000;">Referensi / Faktur</th>
        <th style="font-weight: bold; border: 1px solid #000;">Total</th>
    </tr>
    @foreach($pembelian as $index => $item)
    <tr>
        <td style="border: 1px solid #000;">{{ $index + 1 }}</td>
        <td style="border: 1px solid #000;">{{ $item->tanggal_pembelian }}</td>
        <td style="border: 1px solid #000;">{{ $item->referensi ?? '-' }}</td>
        <td style="border: 1px solid #000;">{{ $item->total }}</td>
    </tr>
    @endforeach
    <tr>
        <th colspan="3" style="font-weight: bold; text-align: right; border: 1px solid #000;">Total Keseluruhan Uang Keluar:</th>
        <th style="font-weight: bold; border: 1px solid #000;">{{ $pembelian->sum('total') }}</th>
    </tr>
</table>