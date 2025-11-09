<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penugasan - {{ $assignment->nama_barang }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header {
            text-align: center;
            border-bottom: 2px solid #555;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            width: 60px;
            vertical-align: middle;
            margin-right: 10px;
        }

        .header h1 {
            display: inline-block;
            vertical-align: middle;
            font-size: 18px;
            margin: 0;
            color: #222;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 2px 0;
            font-size: 11px;
            color: #666;
        }

        /* TITLE */
        .report-title {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .report-title h2 {
            font-size: 16px;
            margin: 0;
            text-transform: uppercase;
            color: #2c3e50;
        }

        .report-title small {
            color: #555;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px 10px;
            vertical-align: top;
        }

        th {
            background: #f5f5f5;
            text-align: left;
            font-weight: 600;
        }

        tr:nth-child(even) td {
            background-color: #fafafa;
        }

        /* FOOTER */
        .footer {
            margin-top: 40px;
            width: 100%;
            text-align: right;
            font-size: 11px;
            color: #555;
        }

        .signature {
            margin-top: 50px;
            text-align: right;
            padding-right: 50px;
        }

        .signature p {
            margin: 2px 0;
        }

        .signature .name {
            font-weight: bold;
            margin-top: 60px;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <h1>PT. Complus System</h1>
        <p>Jl. Contoh Raya No. 123, Tangerang, Indonesia</p>
        <p>Telp: (021) 555-0123 | Email: complus@gmail.com</p>
    </div>

    <!-- JUDUL -->
    <div class="report-title">
        <h2>Laporan Penugasan Enrollment</h2>
        <small>Dibuat pada {{ now()->translatedFormat('d F Y, H:i') }}</small>
    </div>

    <!-- TABEL DETAIL -->
    <table>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $assignment->nama_barang }}</td>
        </tr>
        <tr>
            <th>Kode Barang</th>
            <td>{{ $assignment->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama Customer</th>
            <td>{{ $assignment->nama_customer ?? '-' }}</td>
        </tr>
        <tr>
            <th>Teknisi</th>
            <td>{{ $assignment->teknisi->name ?? '-' }}</td>
        </tr>
        <tr>
            <th>Tingkat Kesulitan</th>
            <td>{{ ucfirst($assignment->tingkat_kesulitan) }}</td>
        </tr>
        <tr>
            <th>Qty</th>
            <td>{{ $assignment->qty }}</td>
        </tr>
        <tr>
            <th>Deskripsi Hasil</th>
            <td>{{ $assignment->deskripsi_hasil ?? '-' }}</td>
        </tr>
        <tr>
            <th>Waktu Penyelesaian</th>
            <td>
                @php
                    $created = \Carbon\Carbon::parse($assignment->created_at);
                    $completed = \Carbon\Carbon::parse($assignment->completed_at);
                    $diff = $created->diff($completed);
                @endphp
                {{ $diff->d }} Hari {{ $diff->h }} Jam
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td style="text-transform: capitalize;">{{ str_replace('_', ' ', $assignment->status) }}</td>
        </tr>
    </table>

    <!-- FOOTER -->
    <div class="signature">
        <p>Tangerang, {{ now()->translatedFormat('d F Y') }}</p>
        <p>Kepala Gudang</p>
        <p class="name">{{ auth()->user()->name ?? '__________________' }}</p>
    </div>


</body>

</html>
