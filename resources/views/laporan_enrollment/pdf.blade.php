<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penugasan {{ $assignment->kode_barang }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2>Laporan Penugasan Enrollment</h2>

    <table>
        <tr>
            <th>Kode Barang</th>
            <td>{{ $assignment->kode_barang }}</td>
        </tr>
        <tr>
            <th>Nama Barang</th>
            <td>{{ $assignment->nama_barang }}</td>
        </tr>
        <tr>
            <th>Qty</th>
            <td>{{ $assignment->qty }}</td>
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
            <th>Poin</th>
            <td>{{ $assignment->poin }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst(str_replace('_', ' ', $assignment->status)) }}</td>
        </tr>
        <tr>
            <th>Timeline</th>
            <td>{{ $assignment->timeline ? \Carbon\Carbon::parse($assignment->timeline)->format('d M Y H:i') : '-' }}
            </td>
        </tr>
        <tr>
            <th>Deskripsi Hasil</th>
            <td>{{ $assignment->deskripsi_hasil ?? '-' }}</td>
        </tr>
        <tr>
            <th>Dibuat Pada</th>
            <td>{{ $assignment->created_at->format('d M Y H:i') }}</td>
        </tr>
    </table>
</body>

</html>
