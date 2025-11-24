<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Nilai Teknisi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            margin: 30px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .chart-table {
            width: 100%;
            margin-top: 25px;
            display: table;
            /* WAJIB: untuk DomPDF */
        }

        .chart-row {
            display: table-row;
        }

        .chart-cell {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: center;
            padding: 5px;
        }

        .chart-cell img {
            width: 100%;
            border: 1px solid #ddd;
            padding: 6px;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #555;
            padding: 6px 8px;
            text-align: center;
        }

        th {
            background: #e5e7eb;
            font-weight: bold;
        }

        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
        }
    </style>

</head>

<body>

    {{-- Header --}}
    <div class="header">
        <div class="title">Laporan Penilaian Kinerja Teknisi</div>
        <div class="subtitle">
            Periode:
            {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }}
            -
            {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}
        </div>
    </div>

    {{-- Perhitungan total poin --}}
    @php
        $totalPoin = max($stats->sum('poin'), 1);
    @endphp

    <div class="chart-table">
        <div class="chart-row">

            {{-- BAR CHART --}}
            <div class="chart-cell">
                <h4>Grafik Total Poin Teknisi</h4>
                @if (!empty($chart_bar))
                    <img src="{{ $chart_bar }}" alt="Bar Chart">
                @else
                    <p><i>Tidak ada data grafik</i></p>
                @endif
            </div>

            {{-- PIE CHART --}}
            <div class="chart-cell">
                <h4>Persentase Poin (%)</h4>
                @if (!empty($chart_pie))
                    <img src="{{ $chart_pie }}" alt="Pie Chart">
                @else
                    <p><i>Tidak ada data grafik</i></p>
                @endif
            </div>

        </div>
    </div>

    {{-- TABEL --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Teknisi</th>
                <th>Jumlah Tugas</th>
                <th>Selesai</th>
                <th>Dikerjakan</th>
                <th>Total Poin</th>
                <th>Persentase (%)</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($stats as $index => $s)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $s['nama'] }}</td>
                    <td>{{ $s['jumlah'] }}</td>
                    <td>{{ $s['selesai'] }}</td>
                    <td>{{ $s['dikerjakan'] }}</td>
                    <td>{{ $s['poin'] }}</td>
                    <td>{{ round(($s['poin'] / $totalPoin) * 100, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Tanggal Cetak: {{ now()->translatedFormat('d F Y H:i') }} WIB
    </div>

    <div class="signature">
        <p><strong>Kepala Gudang</strong></p>
        <br><br><br>
        <p><u>{{ auth()->user()->name ?? '_________________' }}</u></p>
    </div>

</body>

</html>
