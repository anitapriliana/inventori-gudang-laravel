<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
        }

        p.sub {
            text-align: center;
            margin-top: 0;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th {
            background-color: #f3f4f6;
            text-align: left;
            padding: 8px;
            border: 1px solid #d1d5db;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            padding: 8px;
            border: 1px solid #d1d5db;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <h2>Laporan Barang Masuk</h2>
    <p class="sub">Tanggal: {{ date('d/m/Y', strtotime($tanggal)) }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $d->barang->nama_barang ?? '-' }}</td>
                    <td>{{ $d->barang->merk ?? '-' }}</td>
                    <td>{{ $d->jumlah }} {{ $d->barang->satuan ?? '-' }}</td>
                    <td>{{ date('d/m/Y', strtotime($d->tanggal)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <p class="footer">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p> --}}
</body>

</html>
