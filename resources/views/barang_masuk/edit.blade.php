@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">

            ✏️ Edit Pisang Masuk

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

        <form action="{{ route('barang-masuk.update',$barangMasuk->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Jenis Pisang

                </label>

                <select name="barang_id" class="form-select">

                    @foreach($barang as $item)

                        <option value="{{ $item->id }}"
                            {{ $barangMasuk->barang_id == $item->id ? 'selected' : '' }}>

                            {{ $item->nama_barang }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Petani / Supplier

                </label>

                <select name="supplier_id" class="form-select">

                    @foreach($supplier as $item)

                        <option value="{{ $item->id }}"
                            {{ $barangMasuk->supplier_id == $item->id ? 'selected' : '' }}>

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
                            value="{{ $barangMasuk->jumlah }}"
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
                            value="{{ $barangMasuk->tanggal_masuk }}"
                            required>

                    </div>

                </div>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang-masuk.index') }}" class="btn btn-secondary">

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