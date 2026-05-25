<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang Keluar</title>
    <style>
        /* margin halaman */
        @page {
            margin: 28px 32px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #334155;
        }

        /* kop laporan */
        .kop {
            text-align: center;
            padding-bottom: 6px;
        }

        .kop h2 {
            margin: 0 0 4px;
            font-size: 18px;
            color: #0f172a;
        }

        .kop p {
            margin: 0;
            font-size: 11px;
            color: #64748b;
        }

        /* tabel data */
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }

        /* header ikut tampil di tiap halaman */
        table.data thead {
            display: table-header-group;
        }

        table.data tr {
            page-break-inside: avoid;
        }

        table.data th {
            background-color: #fcfcfc;
            color: #000000;
            text-align: left;
            padding: 7px 6px;
            border: 1px solid #000000;
            font-size: 10.5px;
            font-weight: bold;
        }

        table.data td {
            padding: 6px;
            border: 1px solid #000000;
            vertical-align: top;
            word-wrap: break-word;
        }

        table.data tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        /* nama barang + merk di bawahnya */
        .nama {
            font-weight: bold;
            color: #000000;
        }

        .muted {
            color: #64748b;
            font-size: 10px;
        }

        /* status */
        .status-keluar,
        .status-retur {
            color: #000000;
            font-weight: bold;
        }

        .empty {
            padding: 24px 6px;
            color: #64748b;
        }

        .footer {
            margin-top: 14px;
            font-size: 10px;
            color: #64748b;
        }
    </style>
</head>

<body>

    {{-- kop laporan --}}
    <div class="kop">
        <h2>Laporan Barang Keluar</h2>
        <p>
            @if (!empty($tanggal))
                Tanggal: {{ date('d/m/Y', strtotime($tanggal)) }}
            @else
                Periode: Semua Tanggal
            @endif
        </p>
    </div>

    {{-- tabel data --}}
    <table class="data">
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 32%;">Nama Barang</th>
                <th class="text-right" style="width: 15%;">Total Jumlah</th>
                <th class="text-center" style="width: 14%;">Tanggal</th>
                <th style="width: 19%;">Proyek</th>
                <th style="width: 15%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
                <tr>
                    {{-- nomor --}}
                    <td class="text-center">{{ $index + 1 }}</td>

                    {{-- nama barang + merk --}}
                    <td>
                        <div class="nama">{{ $d->barang->nama_barang ?? 'Barang tidak ditemukan' }}</div>
                        <div class="muted">Merk: {{ $d->barang->merk ?? '-' }}</div>
                    </td>

                    {{-- total jumlah terakumulasi --}}
                    <td class="text-right">{{ $d->total_jumlah }} {{ $d->barang->satuan ?? '-' }}</td>

                    {{-- tanggal --}}
                    <td class="text-center">{{ date('d/m/Y', strtotime($d->tanggal)) }}</td>

                    {{-- proyek --}}
                    <td>{{ $d->proyek->nama_proyek ?? '-' }}</td>

                    {{-- status + alasan retur --}}
                    <td>
                        @if ($d->status === 'returned')
                            <span class="status-retur">Retur</span>
                            @if ($d->gabungan_alasan)
                                <div class="muted">{{ $d->gabungan_alasan }}</div>
                            @endif
                        @else
                            <span class="status-keluar">Keluar</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center empty">
                        Belum ada data barang keluar untuk filter ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Dicetak otomatis pada: {{ date('d/m/Y H:i') }}</p>
</body>

</html>
