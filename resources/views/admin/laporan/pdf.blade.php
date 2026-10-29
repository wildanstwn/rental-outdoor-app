<!DOCTYPE html>
<html>
<head>
    <title>Laporan Operasional - Selekta Adventure</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
        }
        .header h2 {
            margin: 0;
            color: #f96d00;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-danger {
            color: #d9534f;
        }
        .text-success {
            color: #5cb85c;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>SELEKTA ADVENTURE</h2>
        <p>Jl. Raya Teras, Boyolali | Telp: +62 812-3456-7890</p>
        <h3>LAPORAN OPERASIONAL PENYEWAAN ALAT</h3>
        <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Periode / Bulan</th>
                <th class="text-center">Total Transaksi</th>
                <th class="text-center">Unit Keluar</th>
                <th class="text-right">Total Denda</th>
                <th class="text-right">Total Pendapatan</th>
            </tr>
        </thead>
        <tbody>
            @php 
                $no = 1; 
                $grand_total_denda = 0;
                $grand_total_pendapatan = 0;
            @endphp
            
            @forelse ($laporan as $bulan => $data)
                @php
                    $grand_total_denda += $data['total_denda'];
                    $grand_total_pendapatan += $data['total_pendapatan'];
                @endphp
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td><b>{{ $bulan }}</b></td>
                    <td class="text-center">{{ $data['total_transaksi'] }}</td>
                    <td class="text-center">{{ $data['unit_keluar'] }}</td>
                    <td class="text-right text-danger">Rp {{ number_format($data['total_denda'], 0, ',', '.') }}</td>
                    <td class="text-right text-success"><b>Rp {{ number_format($data['total_pendapatan'], 0, ',', '.') }}</b></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-right">GRAND TOTAL</th>
                <th class="text-right text-danger">Rp {{ number_format($grand_total_denda, 0, ',', '.') }}</th>
                <th class="text-right text-success">Rp {{ number_format($grand_total_pendapatan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

</body>
</html>