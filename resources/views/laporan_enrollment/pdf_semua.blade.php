<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Semua Teknisi</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #555;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .section-title {
            text-align: left;
            font-size: 15px;
            font-weight: bold;
            margin: 20px 0 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
            /* <--- INI WAJIB */
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px 10px;
            vertical-align: top;
        }

        /* FIXED COLUMN WIDTH */
        th {
            background: #f5f5f5;
            text-align: left;
            font-weight: 600;
            width: 180px;
            /* <--- FIX LEBAR */
        }

        td {
            width: calc(100% - 180px);
            /* <--- BIARKAN NYESUAIKAN */
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>PT. Complus System</h1>
        <p>Laporan Penugasan Semua Teknisi</p>
        <p>Dibuat pada {{ now()->translatedFormat('d F Y, H:i') }}</p>
    </div>

    @foreach ($assignments as $assignment)
        {{-- Judul per teknisi --}}
        <div class="section-title">
            Teknisi: {{ $assignment->teknisi->name ?? '-' }}
        </div>

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
                <td>{{ str_replace('_', ' ', $assignment->status) }}</td>
            </tr>
        </table>

        {{-- @if (!$loop->last)
            <div class="page-break"></div>
        @endif --}}
    @endforeach

</body>

</html>
