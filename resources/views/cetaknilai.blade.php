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

        .header img {
            width: 70px;
            height: auto;
            position: absolute;
            left: 40px;
            top: 20px;
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

        .info {
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
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
            margin-top: 50px;
            text-align: right;
            font-size: 12px;
        }

        .signature {
            margin-top: 40px;
            text-align: right;
        }

        .signature p {
            margin: 2px 0;
        }
    </style>
</head>

<body>
    <div class="header">
        {{-- Ganti logo sesuai kebutuhan --}}
        {{-- <img src="{{ public_path('images/logo.png') }}" alt="Logo"> --}}
        <div class="title">Laporan Penilaian Kinerja Teknisi</div>
        <div class="subtitle">Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} -
            {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}</div>
    </div>

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
            @php
                $grouped = $assignments->groupBy('teknisi_id');
                $no = 1;
                $totalPoin = $assignments->sum('poin');
            @endphp

            @foreach ($grouped as $rows)
                @php
                    $nama = $rows->first()->teknisi->name ?? '-';
                    $jumlah = $rows->count();
                    $selesai = $rows->where('status', 'selesai')->count();
                    $dikerjakan = $rows->where('status', 'dikerjakan_teknisi')->count();
                    $poin = $rows->sum('poin');
                    $persen = $totalPoin > 0 ? round(($poin / $totalPoin) * 100, 2) : 0;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $nama }}</td>
                    <td>{{ $jumlah }}</td>
                    <td>{{ $selesai }}</td>
                    <td>{{ $dikerjakan }}</td>
                    <td>{{ $poin }}</td>
                    <td>{{ $persen }}%</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Tanggal Cetak: {{ now()->translatedFormat('d F Y H:i') }} WIB</p>
    </div>

    <div class="signature">
        <p><strong>Kepala Gudang</strong></p>
        <br><br><br>
        <p><u>{{ auth()->user()->name ?? '__________________' }}</u></p>
    </div>
</body>

</html>
