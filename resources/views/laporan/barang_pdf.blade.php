<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Barang</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            font-size:12px;
        }

        h2{
            text-align:center;
        }

        table{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        table, th, td{
            border:1px solid black;
        }

        th{
            background:#dddddd;
            padding:8px;
        }

        td{
            padding:8px;
        }
    </style>

</head>
<body>

<h2>LAPORAN DATA BARANG</h2>

<table>

<tr>
    <th>No</th>
    <th>Kode</th>
    <th>Nama Barang</th>
    <th>Kategori</th>
    <th>Stok</th>
    <th>Harga</th>
</tr>

@foreach($barang as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->kode_barang }}</td>

<td>{{ $item->nama_barang }}</td>

<td>{{ $item->kategori->nama_kategori }}</td>

<td>{{ $item->stok }}</td>

<td>Rp {{ number_format($item->harga,0,',','.') }}</td>

</tr>

@endforeach

</table>

</body>
</html>