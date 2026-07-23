@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">

            ✏️ Edit Data Pisang

        </h4>

    </div>

    <div class="card-body">

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('barang.update',$barang->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Kategori Pisang

                </label>

                <select name="kategori_id" class="form-select">

                    @foreach($kategori as $k)

                        <option
                            value="{{ $k->id }}"
                            {{ $barang->kategori_id == $k->id ? 'selected' : '' }}>

                            {{ $k->nama_kategori }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Kode Pisang

                </label>

                <input
                    type="text"
                    name="kode_barang"
                    class="form-control"
                    value="{{ $barang->kode_barang }}">

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Nama Pisang

                </label>

                <input
                    type="text"
                    name="nama_barang"
                    class="form-control"
                    value="{{ $barang->nama_barang }}">

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Stok (Kg)

                        </label>

                        <input
                            type="number"
                            name="stok"
                            class="form-control"
                            value="{{ $barang->stok }}">

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Harga per Kg

                        </label>

                        <input
                            type="number"
                            name="harga"
                            class="form-control"
                            value="{{ $barang->harga }}">

                    </div>

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Keterangan

                </label>

                <textarea
                    name="deskripsi"
                    rows="4"
                    class="form-control">{{ $barang->deskripsi }}</textarea>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button class="btn btn-warning">

                    <i class="bi bi-check-circle"></i>

                    Update Data

                </button>

            </div>

        </form>

    </div>

</div>

@endsection