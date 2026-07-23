@extends('layouts.app')

@section('content')

<div class="card shadow">

    <div class="card-header bg-warning">

        <h4 class="mb-0">

            ✏️ Edit Distribusi Pisang

        </h4>

    </div>

    <div class="card-body">

        @if(session('error'))

            <div class="alert alert-danger">

                {{ session('error') }}

            </div>

        @endif

        @if($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('barang-keluar.update',$barangKeluar->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">

                    Jenis Pisang

                </label>

                <select name="barang_id" class="form-select">

                    @foreach($barang as $item)

                        <option
                            value="{{ $item->id }}"
                            {{ $barangKeluar->barang_id == $item->id ? 'selected' : '' }}>

                            {{ $item->nama_barang }}

                            (Stok : {{ $item->stok }} Kg)

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Tanggal Distribusi

                        </label>

                        <input
                            type="date"
                            name="tanggal_keluar"
                            class="form-control"
                            value="{{ $barangKeluar->tanggal_keluar }}"
                            required>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="mb-3">

                        <label class="form-label">

                            Jumlah (Kg)

                        </label>

                        <input
                            type="number"
                            name="jumlah"
                            class="form-control"
                            value="{{ $barangKeluar->jumlah }}"
                            required>

                    </div>

                </div>

            </div>

            <div class="mb-3">

                <label class="form-label">

                    Tujuan Pengiriman

                </label>

                <input
                    type="text"
                    name="tujuan"
                    class="form-control"
                    value="{{ $barangKeluar->tujuan }}"
                    required>

            </div>

            <div class="d-flex justify-content-between">

                <a href="{{ route('barang-keluar.index') }}"
                   class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i>

                    Kembali

                </a>

                <button class="btn btn-warning">

                    <i class="bi bi-check-circle"></i>

                    Update Distribusi

                </button>

            </div>

        </form>

    </div>

</div>

@endsection