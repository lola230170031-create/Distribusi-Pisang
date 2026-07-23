<!DOCTYPE html>
<html>

<head>

    <title>Tambah Kategori</title>

    <style>

        body{
            font-family:Arial;
            margin:40px;
            background:#f4f4f4;
        }

        .card{

            width:500px;
            background:white;
            padding:25px;
            border-radius:10px;

        }

        input,textarea{

            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:15px;

        }

        button{

            background:#198754;
            color:white;
            border:none;
            padding:10px 20px;
            cursor:pointer;

        }

        a{

            text-decoration:none;

        }

    </style>

</head>

<body>

<div class="card">

<h2>Tambah Kategori</h2>

<form action="{{ route('kategori.store') }}" method="POST">

@csrf

<label>Nama Kategori</label>

<input type="text"
name="nama_kategori"
required>

<label>Deskripsi</label>

<textarea
name="deskripsi"
rows="4"></textarea>

<button type="submit">

Simpan

</button>

</form>

<br>

<a href="{{ route('kategori.index') }}">
← Kembali
</a>

</div>

</body>
</html>