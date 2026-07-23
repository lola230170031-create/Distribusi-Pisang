@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">

            🍌 Tambah Data Pisang

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

        <form action="{{ route('barang.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Kategori Pisang

                </label>

                <select name="kategori_id" class="form-select" required>

                    <option value="">-- Pilih Kategori --</option>

                    @foreach($kategori as $k)

                        <option value="{{ $k->id }}">

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
                    placeholder="Contoh : PSG001"
                    required>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Nama Pisang

                </label>

                <input
                    type="text"
                    name="nama_barang"
                    class="form-control"
                    placeholder="Contoh : Pisang Cavendish"
                    required>

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
                            required>

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
                            required>

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
                    class="form-control"
                    placeholder="Masukkan keterangan..."></textarea>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang.index') }}" class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button type="submit" class="btn btn-success">

                    <i class="bi bi-check-circle"></i>

                    Simpan Data

                </button>

            </div>

        </form>

    </div>

</div>

@endsection