@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">

            📥 Tambah Pisang Masuk

        </h4>

    </div>

    <div class="card-body">

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('barang-masuk.store') }}" method="POST">

            @csrf

            <div class="mb-3">

                <label class="form-label">

                    Jenis Pisang

                </label>

                <select name="barang_id" class="form-select" required>

                    <option value="">-- Pilih Jenis Pisang --</option>

                    @foreach($barang as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->nama_barang }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Petani / Supplier

                </label>

                <select name="supplier_id" class="form-select" required>

                    <option value="">-- Pilih Supplier --</option>

                    @foreach($supplier as $item)

                        <option value="{{ $item->id }}">

                            {{ $item->nama_supplier }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Jumlah (Kg)

                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            class="form-control"
                            placeholder="Masukkan jumlah"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal Masuk

                        </label>

                        <input
                            type="date"
                            name="tanggal_masuk"
                            class="form-control"
                            required>

                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">

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