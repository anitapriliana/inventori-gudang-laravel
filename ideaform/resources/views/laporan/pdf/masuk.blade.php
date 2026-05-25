<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #334155;
        }

        h2 {
            text-align: center;
            margin-bottom: 4px;
            color: #0f172a;
        }

        p.sub {
            text-align: center;
            margin-top: 0;
            color: #64748b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th {
            background-color: #3D6A82;
            color: #ffffff;
            text-align: left;
            padding: 8px;
            border: 1px solid #3D6A82;
            font-size: 11px;
            text-transform: uppercase;
        }

        td {
            padding: 8px;
            border: 1px solid #e2e8f0;
        }

        tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            font-size: 11px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <h2>Laporan Barang Masuk</h2>
    <p class="sub">Tanggal: {{ date('d/m/Y', strtotime($tanggal)) }}</p>

    <table>
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Merk</th>
                <th class="text-right">Jumlah</th>
                <th class="text-center">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $d->barang->kode_barang ?? '-' }}</td>
                    <td>{{ $d->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>
                    <td>{{ $d->barang->merk ?? '-' }}</td>
                    <td class="text-right">{{ $d->jumlah }} {{ $d->barang->satuan ?? '-' }}</td>
                    <td class="text-center">{{ date('d/m/Y', strtotime($d->tanggal)) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data barang masuk untuk filter ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- <p class="footer">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p> --}}
</body>

</html>
