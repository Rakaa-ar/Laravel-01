<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0 0 10px 0;
        }

        .text-right {
            text-align: right;
        }

        .bg-gray {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Laporan Transaksi Gudang</h2>
    @if ($tanggal_mulai && $tanggal_akhir)
        <h4>Periode: {{ $tanggal_mulai }} s/d {{ $tanggal_akhir }}</h4>
    @else
        <h4>Periode: Semua Data</h4>
    @endif

    <br>

    <h3>Data Penjualan (Uang Masuk)</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Transaksi</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_penjualan }}</td>
                    <td>TRX-{{ str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" class="text-right bg-gray">Total Keseluruhan Uang Masuk:</th>
                <th class="bg-gray">Rp {{ number_format($penjualan->sum('total'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <h3>Data Pembelian (Uang Keluar)</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Referensi / Faktur</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pembelian as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->tanggal_pembelian }}</td>
                    <td>{{ $item->referensi ?? '-' }}</td>
                    <td>Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" class="text-right bg-gray">Total Keseluruhan Uang Keluar:</th>
                <th class="bg-gray">Rp {{ number_format($pembelian->sum('total'), 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>

</html>
