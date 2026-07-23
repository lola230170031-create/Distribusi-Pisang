@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Data Kategori</h2>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Kategori
    </a>

</div>

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<div class="card">

<div class="card-body">

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th width="60">No</th>

<th>Nama Kategori</th>

<th>Deskripsi</th>

<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

@forelse($kategori as $item)

<tr>

<td>{{ $loop->iteration }}</td>

<td>{{ $item->nama_kategori }}</td>

<td>{{ $item->deskripsi }}</td>

<td>

<a href="{{ route('kategori.edit',$item->id) }}"
class="btn btn-warning btn-sm">

Edit

</a>

<form action="{{ route('kategori.destroy',$item->id) }}"
method="POST"
style="display:inline;">

@csrf

@method('DELETE')

<button
onclick="return confirm('Yakin ingin menghapus data ini?')"
class="btn btn-danger btn-sm">

Hapus

</button>

</form>

</td>

</tr>

@empty

<tr>

<td colspan="4" class="text-center">

Belum ada data kategori

</td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

@endsection