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

        .title {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .subtitle {
            font-size: 13px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
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

    <div class="header">
        <div class="title">Laporan Penilaian Kinerja Teknisi</div>
        <div class="subtitle">
            Periode:
            {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }}
            -
            {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}
        </div>
    </div>

    @php
        // Total poin untuk persentase per teknisi
        $totalPoin = max($stats->sum('poin'), 1);
    @endphp

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
