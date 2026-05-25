<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk</title>
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

        /* kolom yang isinya di tengah (atas-bawah dan kiri-kanan) */
        td.mid {
            text-align: center;
            vertical-align: middle;
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
        <h2>Laporan Barang Masuk</h2>
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
                <th class="text-center" style="width: 6%;">No</th>
                <th style="width: 18%;">Kode Barang</th>
                <th style="width: 34%;">Nama Barang</th>
                <th style="width: 22%;">Merk</th>
                <th style="width: 20%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $d)
                <tr>
                    {{-- nomor --}}
                    <td class="mid">{{ $loop->iteration }}</td>

                    {{-- kode barang --}}
                    <td class="mid">{{ $d->barang->kode_barang ?? '-' }}</td>

                    {{-- nama barang --}}
                    <td class="mid">{{ $d->barang->nama_barang ?? 'Barang tidak ditemukan' }}</td>

                    {{-- merk --}}
                    <td class="mid">{{ $d->barang->merk ?? '-' }}</td>

                    {{-- jumlah + satuan --}}
                    <td>{{ floatval($d->total_jumlah ?? $d->jumlah) }} {{ $d->barang->satuan ?? '' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center empty">
                        Belum ada data barang masuk untuk filter ini.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="footer">Dicetak otomatis pada: {{ date('d/m/Y H:i') }}</p>
</body>

</html>
